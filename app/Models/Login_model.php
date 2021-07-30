<?php 
namespace App\models;
use CodeIgniter\Model;
class Login_model extends Model
{
	public function verify_account($username,$password){
		$builder = $this->db->table('admin_login');
		$builder->select('id, name,email,password,mobile');
		$builder->where('email', $username);
		$builder->where('password', $password);
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRowArray();
		}else{
			return false;
		}
	}

	public function verifyEmail($email,$password){
		$builder = $this->db->table('users_master');
		$builder->select('id,uid,status,name,password,email,mobile,gender');
		$builder->where('email', $email);
		$builder->where('password', md5($password));
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRowArray();
		}else{
			return false;
		}
	}

	public function verifyEmaildelivery_boy($email,$password){
		$builder = $this->db->table('delivery_boy_master');
		$builder->select('id,uid,status,name,password,email,mobile,image,pincode,image');
		$builder->where('email', $email);
		$builder->where('password', md5($password));
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRowArray();
		}else{
			return false;
		}
	}

	public function verify_restaurent_email($email,$password){
		$builder = $this->db->table('restaurent');
		$builder->select('id,restaurent_uid,status,name,password,email,mobile,image,pincode');
		$builder->where('email', $email);
		$builder->where('password', md5($password));
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRowArray();
		}else{
			return false;
		}
	}


	public function verify_users_account($id){
		$builder = $this->db->table('users_master');
		$builder->select('id,added_date,uid,status,name');
		$builder->where('uid', $id);
		$result =  $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRow();
		}else{
			return false;
		}
	}


	public function verify_delivery_boy_account($id){
		$builder = $this->db->table('delivery_boy_master');
		$builder->select('added_date,uid,status');
		$builder->where('uid', $id);
		$result =  $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRow();
		}else{
			return false;
		}
	}

	public function verify_restaurent_account($id){
		$builder = $this->db->table('restaurent');
		$builder->select('added_on,restaurent_uid,status');
		$builder->where('restaurent_uid', $id);
		$result =  $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRow();
		}else{
			return false;
		}
	}

	public function update_users_status($id){
		$builder  = $this->db->table('users_master');
		$builder->where('uid',$id);
		$builder->update(['status'=>'Active']);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function update_delivery_boy_status($id){
		$builder  = $this->db->table('delivery_boy_master');
		$builder->where('uid',$id);
		$builder->update(['status'=>'AdminVerification']);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function update_restaurent_status($id){
		$builder  = $this->db->table('restaurent');
		$builder->where('restaurent_uid',$id);
		$builder->update(['status'=>'AdminVerification']);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function google_user_exists($id){
		$builder = $this->db->table('users_master');
		$builder->where('uid',$id);
		if ($builder->countAllResults() == 1) {
			return true;
		}else{
			return false;
		}
	}


	public function updateGoogleUser($data,$id){
		$builder = $this->db->table('users_master');
		$builder->where('uid', $id);
		$builder->update($data);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function verifyEmail_with_args($tablename, $email){
		$builder = $this->db->table($tablename);
		$builder->select('uid,status,name,password,email');
		$builder->where('email', $email);
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRowArray();
		}else{
			return false;
		}
	}

	public function updatedAt($tablename,$id){
		$builder = $this->db->table($tablename);
		$builder->where('uid', $id);
		$builder->update(['updated_at'=> date('Y-m-d h:i:s')]);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function verifyToken($tablename, $token){
		$builder = $this->db->table($tablename);
		$builder->select('uid,name,updated_at');
		$builder->where('uid', $token);
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRowArray();
		}else{
			return false;
		}
	}

	public function update_password($tablename, $token,$pass){
		$builder = $this->db->table($tablename);
		$builder->where('uid', $token);
		$builder->update(['password' => $pass]);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function SaveOeningInfo($data){
		$status = $this->db->table('restaurent_opening_status')
					->insert($data);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}			
	}	

	public function updateLogoutTime($tablename , $args, $data){
		$builder = $this->db->table($tablename);
		$builder->where($args);
		$builder->update($data);
		if ($this->db->affectedRows() > 0) {
			return true;
		}else{
			return false;
		}
	}


}