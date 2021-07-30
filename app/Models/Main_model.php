<?php 
namespace App\models;
use CodeIgniter\Model;

class Main_model extends Model
{
	public function get_logged_in_user_data($tablename, $id){
		$builder = $this->db->table($tablename);
		$builder->where('id', $id);
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRow();
		}else{
			return false;
		}
	}

	public function Insertdata($tablename,$data){
		$builder = $this->db->table($tablename);
		$res = $builder->insert($data);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function Insertdata_return_id($tablename,$data){
	 	$builder = $this->db->table($tablename);
	 	$res = $builder->insert($data);
	 	if ($this->db->affectedRows() == 1) {
	 		return $this->primaryKey = $this->db->insertID();
	 	}else{
			return false;
	 	}
	}

	public function fetch_all_records($tablename){
		$builder = $this->db->table($tablename);
		$builder->select("*");
		$builder->orderBy('id', 'DESC');
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}	
	}

	public function fetch_order_status($tablename){
		$builder = $this->db->table($tablename);
		$builder->select("*");
		$builder->orderBy('id', 'ASC');
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}	
	}

	public function fetch_order_status_by_args($tablename, $args){
		$builder = $this->db->table($tablename);
		$builder->select("*");
		$builder->orderBy('id', 'ASC');
		$builder->where($args);
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}	
	}

	public function update_rec_by_args($tablename, $args, $data){
		$builder = $this->db->table($tablename);
		$builder->where($args);
		$builder->update($data);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function fetch_rec_by_args($tablename, $args){
		$builder = $this->db->table($tablename);
		$builder->select('*');
		$result = $builder->where($args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	public function fetch_rec_by_args_products($tablename, $args){
		$builder = $this->db->table($tablename);
		$builder->select('*');
		$builder->where($args);
		$result = $builder->orderBy('id', 'desc')
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	public function delete_records($tablename, $args){
		$builder = $this->db->table($tablename);
		$builder->where($args);
		$builder->delete();
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function filter_rec_by_args($tablename, $order_format){
		extract($order_format);
		$builder = $this->db->table($tablename);
		$builder->orderBy($order_format['column_name'],$order_format['order']);
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return $result->getResult();
		}
	}

	public function filter_rec_by_args_with_type($tablename, $order_format, $args){
		extract($order_format);
		$builder = $this->db->table($tablename);
		$builder->orderBy($order_format['column_name'],$order_format['order']);
		$builder->where($args);
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return $result->getResult();
		}
	}

	public function fetch_rec_by_args_by_like($tablename, $args){
		$builder = $this->db->table($tablename);
		$builder->like($args);
		$builder->orderBy('id', 'DESC');
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return $result->getResult();
		}
	}

		//Front Page Query Section Start
	public function get_image_by_args($tablename, $args, $limit){
		$builder = $this->db->table($tablename);
		$builder->select('*');
		$builder->where($args);
		$builder->orderBy('id', 'DESC');
		$result = $builder->limit($limit);
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	} 


	public function fetch_rec_by_args_by_like_with_args($tablename,$search,$search_second, $args){
		$builder = $this->db->table($tablename);
		$builder->like($search);
		$builder->orLike($search_second);
		$builder->orderBy('id', 'DESC');
		$result = $builder->where($args);
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return $result->getResult();
		}
	}

	//Get Logged In User data
	public function getLoggedInUserData($id){
		$builder = $this->db->table('users_master');
		$builder->where('id', $id);
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRow();
		}else{
			return false;
		}
	}

	public function fetch_all_sales($tablename, $args){
		$fetch_data =  $this->db->table($tablename)
	            ->select('order_date,COUNT(order_date),SUM(total_quantity),SUM(total_amount)')
	            ->where($args)
	            ->groupBy('order_date')
		        ->get();
		if (count($fetch_data->getResultArray())> 0) {
			return $fetch_data->getResultArray();
		}else{
			return $fetch_data->getResultArray();
		}	
	}





}