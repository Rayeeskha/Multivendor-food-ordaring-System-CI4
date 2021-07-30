<?php 
namespace App\Controllers;
use \App\Models\Login_model;
use \App\Models\Main_model;

class Registration extends BaseController
{
	public $session;
	public $mainmodel;
	public function __construct(){
		helper(['form','Admin_helper','text','date','time']);
		$this->loginModel = new Login_model();
		$this->session   = session();
		$this->email = \Config\Services::email();
		$this->mainmodel  = new Main_model();
		
	}


	public function register_users(){
		$data  = [];
		$data['validation'] = null;
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'Username'          => 'required|min_length[4]|max_length[20]',
				'gender'            => 'required',
				'email'             => 'required|valid_email|is_unique[users_master.email]',
				'mobile'            => 'required|numeric|exact_length[10]',
				'password'          => 'required|min_length[6]|max_length[16]',
				'conf_password'     => 'required|matches[password]',
			];
			if($this->validate($rules)){
				if(session()->has('FROM_REFERAL_CODE_SESSION')){
					$from_referal_code = session()->get('FROM_REFERAL_CODE_SESSION');
				}else{
					$from_referal_code =  "";
				}
			
				$uid = md5(str_shuffle('abcdefghizklmnopqrstuvwxyz'.time()));
				$referal_code = substr(md5(time()), 0, 6);
					$userdata = [
						'name'              => $this->request->getVar('Username',FILTER_SANITIZE_STRING),
						'gender'            => $this->request->getVar('gender',FILTER_SANITIZE_STRING),
						'email'             => $this->request->getVar('email'),
						'password'          => md5($this->request->getVar('password',FILTER_SANITIZE_STRING)),
						'mobile'            => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
						'referal_code'      => $referal_code,
						'from_referal_code' => $from_referal_code,
						'uid'               => $uid,
						'status'            => 'InActive',
						'added_date'        => date('Y-m-d h:i:s')
					];
					$insert_data = $this->mainmodel->Insertdata_return_id('users_master',$userdata);
					if ($insert_data) {
						$get_web_wallet  = get_website_settings();
						if ($get_web_wallet[0]->wallet_amt !== "0") {
							$wallet_amount = $get_web_wallet[0]->wallet_amt;
							manage_user_wallet($insert_data,$wallet_amount,'In','Register');
						}
						
						$to        = $this->request->getVar('email');
						$subject   = 'Account Activation Link  - Online Food Ordaring System';
						$message   = 'Hi ' .$this->request->getVar('Username',FILTER_SANITIZE_STRING).",<br><br>Thanks Your Account Created Successfully, Please Click the below Link to Activate your Account <br><br>"
						   ."<a href='".base_url()."/Registration/Activate_account/".$uid."' target='_blank'>Activate  Now</a><br><br>Thanks<br>khan Rayees Team"; 
						
						$this->email->setTo($to);
						$this->email->setFrom('khanrayeesq121@gmail.com', 'Food Ordaring System');
						$this->email->setSubject($subject);
						$this->email->setMessage($message);
						$filepath = 'public/images/ff.png';
						$this->email->attach($filepath);
						if ($this->email->send()) {
							
							$this->session->setTempdata('success', 'Account Created Successfully, Please Activate Your Account with in 20 Minutes' );
							return redirect()->to(current_url());
						}else{
							//$data = $this->email->printDebugger(['headers']);
							//print_r($data);
							$this->session->setTempdata('error', 'Account Created Successfully, Sorry Unable to Send Activation Link,Contact to Admin Disk <br> FlexionSoftware Solution by Khan Rayees <br> Mobile: 9554540271');
							return redirect()->to(current_url());
						}   
					}else{
						$this->session->setTempdata('error', 'Sorry Unable to Create an Account, Try Again ?',3);
						return redirect()->to(current_url());
					}
			}else{
				$data['validation'] =  $this->validator;
			}
		}
		$data['carts_pro'] = $this->get_session_carts_details();
		return  view('Home/login_register', $data);
	}


	public function register_delivery_boy_acc(){
		$data  = [];
		$data['validation'] = null;
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'usernamme'         => 'required|min_length[4]|max_length[20]',
				'Aadharnumber'      => 'required|exact_length[12]',
				'pincode'           => 'required|exact_length[6]',
				'state'             => 'required',
				'city'              => 'required',
				'email'             => 'required|valid_email|is_unique[delivery_boy_master.email]',
				'mobile'            => 'required|numeric|exact_length[10]|is_unique[delivery_boy_master.mobile]',
				'password'          => 'required|min_length[6]|max_length[16]',
				'confirmpassword'   => 'required|matches[password]',
				'avatar' => [
	                'uploaded[avatar]',
	                'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]',
	                'max_size[avatar,4096]',
	            ],
			];
			if($this->validate($rules)){
				$uid = md5(str_shuffle('abcdefghizklmnopqrstuvwxyz'.time()));
				$img = $this->request->getFile('avatar');
				if ($img->isValid() &&  !$img->hasMoved()) {
				 	 $newName = $img->getRandomName();
				 	 // $doc_img = $image->getName();
                	$img->move('./public/uploads/delivery_boy', $newName); 
                	// $path = $this->request->getFile('doctor_image')->store();
                	$deli_img = $img->getName();

                	$userdata = [
						'name'             => $this->request->getVar('usernamme',FILTER_SANITIZE_STRING),
						'aadhar_number'    => $this->request->getVar('Aadharnumber',FILTER_SANITIZE_STRING),
						'pincode'     => $this->request->getVar('pincode',FILTER_SANITIZE_STRING),
						'state'       => $this->request->getVar('state',FILTER_SANITIZE_STRING),
						'city'        => $this->request->getVar('city',FILTER_SANITIZE_STRING),
						'email'       => $this->request->getVar('email'),
						'password'    => md5($this->request->getVar('password',FILTER_SANITIZE_STRING)),
						'mobile'      => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
						'image'       => $deli_img,
						'uid'         => $uid,
						'status'      => 'InActive',
						'added_date'  => date('Y-m-d h:i:s')
					];
					$insert_data = $this->mainmodel->Insertdata_return_id('delivery_boy_master',$userdata);
					if ($insert_data) {
						$get_web_wallet  = get_website_settings();
						if ($get_web_wallet[0]->deli_boy_reg_cahback !== "0") {
							$wallet_amount = $get_web_wallet[0]->deli_boy_reg_cahback;
							manage_delivery_boy_wallet($insert_data,$wallet_amount,'In','Register');
						}
						$to        = $this->request->getVar('email');
						$subject   = 'Account Activation Link  - Online Food Ordaring System';
						$message   = 'Hi ' .$this->request->getVar('Username',FILTER_SANITIZE_STRING).",<br><br>Thanks Your Account Created Successfully, Please Click the below Link to Activate your Account <br><br>"
						   ."<a href='".base_url()."/Registration/Activate_deli_boy_account/".$uid."' target='_blank'>Activate  Now</a><br><br>Thanks<br>khan Rayees Team"; 
						
						$this->email->setTo($to);
						$this->email->setFrom('khanrayeesq121@gmail.com', 'Food Ordaring System');
						$this->email->setSubject($subject);
						$this->email->setMessage($message);
						$filepath = 'public/images/ff.png';
						$this->email->attach($filepath);
						if ($this->email->send()) {
							
							$this->session->setTempdata('success', 'Account Created Successfully, Please Activate Your Account with in 20 Minutes' );
							return redirect()->to(current_url());
						}else{
							//$data = $this->email->printDebugger(['headers']);
							//print_r($data);
							$this->session->setTempdata('error', 'Account Created Successfully, Sorry Unable to Send Activation Link,Contact to Admin Disk <br> by Khan Rayees <br> Mobile');
							return redirect()->to(current_url());
						}   
					}else{
						$this->session->setTempdata('error', 'Sorry Unable to Create an Account, Try Again ?',3);
						return redirect()->to(current_url());
					}
	            }else{
					echo $image->getErrorString(). " " .$image->getError();
				}
			}else{
				$data['validation'] =  $this->validator;
			}
		}

		return view('Delivery_boy/index', $data);
	}


	public function Restaurent_register(){
		$data['validation'] = null;
		return view('Restaurent/register', $data);
	}

	public function register_restaurent(){
		$data  = [];
		$data['validation'] = null;
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'name'              => 'required|min_length[3]|max_length[40]',
				'Aadharnumber'      => 'required|exact_length[12]',
				'GSTNumber'         => 'required|exact_length[15]',
				'pincode'           => 'required|exact_length[6]',
				'state'             => 'required',
				'city'              => 'required',

				'email'  => [
					'rules'   => 'required|valid_email|is_unique[restaurent.email]',
					'errors'  => [
						'required'  => 'Email is Required',
						'is_unique' => 'Email is Already Register'
					],
				],
				'mobile'  => [
					'rules'   => 'required|numeric|exact_length[10]|is_unique[restaurent.mobile]',
					'errors'  => [
						'required'  => 'Mobile is Required',
						'is_unique' => 'Mobile is Already Register'
					],
				],
				'exact_location'  => [
					'rules'   => 'required',
					'errors'  => [
						'required'  => 'Enter Restaurent Exact Pickup Location is Required',
						
					],
				],
				'password'          => 'required|min_length[6]|max_length[16]',
				'confirmpassword'   => 'required|matches[password]',

				'avatar' => [
	                'uploaded[avatar]',
	                'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]',
	                'max_size[avatar,4096]',
	            ],
			];
			if($this->validate($rules)){
				$uid = md5(str_shuffle('abcdefghizklmnopqrstuvwxyz'.time()));
				$res_uid = rand(999999,444444);
				$img = $this->request->getFile('avatar');
				if ($img->isValid() &&  !$img->hasMoved()) {
				 	 $newName = $img->getRandomName();
				 	 // $doc_img = $image->getName();
                	$img->move('./public/uploads/restaurent/uploads/restaurent_img', $newName); 
                	// $path = $this->request->getFile('doctor_image')->store();
                	$res_img = $img->getName();

                	$userdata = [
						'name'             => $this->request->getVar('name',FILTER_SANITIZE_STRING),
						'aadhar_number'    => $this->request->getVar('Aadharnumber',FILTER_SANITIZE_STRING),
						'gst_number'       => $this->request->getVar('GSTNumber',FILTER_SANITIZE_STRING),
						'exact_location'   => $this->request->getVar('exact_location',FILTER_SANITIZE_STRING),
						'pincode'          => $this->request->getVar('pincode',FILTER_SANITIZE_STRING),
						'state'            => $this->request->getVar('state',FILTER_SANITIZE_STRING),
						'city'             => $this->request->getVar('city',FILTER_SANITIZE_STRING),
						'email'            => $this->request->getVar('email'),
						'password'         => md5($this->request->getVar('password',FILTER_SANITIZE_STRING)),
						'mobile'           => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
						'image'            => $res_img,
						'auth_uid'         => $uid,
						'restaurent_uid'   => $res_uid,
						'status'           => 'InActive',
						'added_on'         => date('Y-m-d h:i:s')
					];
					$insert_data = $this->mainmodel->Insertdata('restaurent',$userdata);
					if ($insert_data) {
						$to        = $this->request->getVar('email');
						$subject   = 'Account Activation Link  - Online Food Ordaring System';
						$message   = 'Hi ' .$this->request->getVar('name',FILTER_SANITIZE_STRING).",<br><br>Thanks Your Account Created Successfully, Please Click the below Link to Activate your Account <br><br>"
						   ."<a href='".base_url()."/Registration/Activate_restaurent/".$res_uid."' target='_blank'>Activate  Now</a><br><br>Thanks<br>khan Rayees Team"; 
						$this->email->setTo($to);
						$this->email->setFrom('khanrayeesq121@gmail.com', 'Food Ordaring System');
						$this->email->setSubject($subject);
						$this->email->setMessage($message);
						$filepath = 'public/images/ff.png';
						$this->email->attach($filepath);
						if ($this->email->send()) {
							$this->session->setTempdata('success', 'Account Created Successfully, Please Activate Your Account with in 20 Minutes' );
							return redirect()->to(current_url());
						}else{
							//$data = $this->email->printDebugger(['headers']);
							//print_r($data);
							$this->session->setTempdata('error', 'Account Created Successfully, Sorry Unable to Send Activation Link,Contact to Admin Disk <br> FlexionSoftware Solution by Khan Rayees <br> Mobile: 9554540271');
							return redirect()->to(current_url());
						}   
					}else{
						$this->session->setTempdata('error', 'Sorry Unable to Create an Account, Try Again ?',3);
						return redirect()->to(current_url());
					}
	            }else{
					echo $image->getErrorString(). " " .$image->getError();
				}
			}else{
				$data['validation'] =  $this->validator;
			}
		}

		return view('Restaurent/register', $data);
	}


	public function Activate_restaurent($unid = null){
		$data = [];
		if(!empty($unid)){
			$userdata = $this->loginModel->verify_restaurent_account($unid);
			if ($userdata) {
				$expiry_time = $this->verify_expiry_time($userdata->added_on);
				if ($expiry_time) {
					if ($userdata->status === 'InActive') {
						$status = $this->loginModel->update_restaurent_status($unid);
						if ($status == true) {
							$data = [
								'restaurent_id'    => $unid,
								'opening_status'   => 'Close',
							];
							$this->mainmodel->Insertdata('restaurent_opening_status', $data);
							$this->session->setTempdata('success', 'Account Activated Successfully Login After Admin Verify' );						
						}
						
						// return redirect()->to(base_url().'/Delivery_boy/index');
					}else{
						$this->session->setTempdata('success', 'Your Account is Already Activated' );
					}
				}else{
					$this->session->setTempdata('success', 'Sorry Activation Link was Expired Try Again!' );
				}
			}else{
				$this->session->setTempdata('success', 'Sorry Unable to Process Activate Your Account Request ?' );
				
			}
		}else{
			$this->session->setTempdata('success', 'Sorry Unable to Process Your Request Your Not Elegible here Sorry');
		}
		return view('Restaurent/activate_acc', $data);
	}





	public function Activate_deli_boy_account($unid = null){
		$data = [];
		if(!empty($unid)){
			$userdata = $this->loginModel->verify_delivery_boy_account($unid);
			if ($userdata) {
				$expiry_time = $this->verify_expiry_time($userdata->added_date);
				if ($expiry_time) {
					if ($userdata->status === 'InActive') {
						$status = $this->loginModel->update_delivery_boy_status($unid);
						if ($status == true) {
							$this->session->setTempdata('success', 'Account Activated Successfully Login After Admin Verify' );						}
						
						// return redirect()->to(base_url().'/Delivery_boy/index');
					}else{
						$this->session->setTempdata('success', 'Your Account is Already Activated' );
					}
				}else{
					$this->session->setTempdata('success', 'Sorry Activation Link was Expired Try Again!' );
				}
			}else{
				$this->session->setTempdata('success', 'Sorry Unable to Process Activate Your Account Request ?' );
				
			}
		}else{
			$this->session->setTempdata('success', 'Sorry Unable to Process Your Request Your Not Elegible here Sorry');
		}
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Delivery_boy/activate_acc', $data);
	}


	public function Activate_account($unid = null){
		$data = [];

		if(!empty($unid)){
			$userdata = $this->loginModel->verify_users_account($unid);
			if ($userdata) {
				$expiry_time = $this->verify_expiry_time($userdata->added_date);
				if ($expiry_time) {
					if ($userdata->status === 'InActive') {
						$status = $this->loginModel->update_users_status($unid);
						if (session()->has('FROM_REFERAL_CODE_SESSION')) {
							$referal_code = session()->get('FROM_REFERAL_CODE_SESSION');
							$referal_user = get_user_details($referal_code);
							$user_id = $userdata->id;
							$msg = 'Referal Amount From :'.$referal_user[0]->name;
							$ramount = get_website_settings();
							$referal_amount = $ramount[0]->referal_amount;
							manage_user_wallet($user_id,$referal_amount, 'In',$msg);
							session()->remove('FROM_REFERAL_CODE_SESSION');
						}
						$this->session->setTempdata('success', 'Account Activated Successfully Login Your Account' );
						return redirect()->to(base_url().'/Home/login_register');
					}else{
						$data['success'] = 'Your Account is Already Activated';
					}
				}else{
					$data['error'] = 'Sorry Activation Link was Expired Try Again!';
				}
			}else{
				$data['error'] = 'Sorry Unable to Process Activate Your Account Request ?';
			}
		}else{
			$data['error'] = 'Sorry Unable to Process Your Request Your Not Elegible here Sorry';
		}
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/activate_users_acc', $data);
	}

	public function verify_expiry_time($regTime){
		$added_time = strtotime($regTime);
		$diffTime = verify_db_detatime_to_current_time_stamp($added_time);
		if ($diffTime < 25) {
			return true;
		}else{
			return false;
		}
	}


	public function get_session_carts_details(){
		if ($this->session->get('session_id') != "") {
			$args = [
				'session_id'  => $this->session->get('session_id')
			];
			$response = $this->mainmodel->fetch_rec_by_args_products('dish_carts', $args);
			return $response;
		}else if (session()->has('google_user')) {
			$uinfo = session()->get('google_user_info');
			$user_id = $uinfo['google_uid'];
			$args = [
				'user_id'   => $user_id
			];
			$response = $this->mainmodel->fetch_rec_by_args_products('dish_carts', $args);
			return $response;
		}else{
			$args =  [
				'user_id'  => $this->session->get('user_id')
			];
			$response = $this->mainmodel->fetch_rec_by_args_products('dish_carts', $args);
			return $response;
		}
	}






}