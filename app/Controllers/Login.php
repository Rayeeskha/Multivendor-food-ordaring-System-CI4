<?php namespace App\Controllers;
use \App\Models\Login_model;

class Login extends BaseController
{
	public $session;
	public function __construct(){
		helper(['form','Admin_helper','text','date','time']);
		$this->loginModel = new Login_model();
		$this->session   = session();
		$this->email = \Config\Services::email();
		
	}
	public function index(){	
		$data = [];
		if ($this->request->getMethod() == 'post') {
			$rules = [
			    'username'  => [
				'rules'  => 'required',
				'errors'    => [
					'required' => 'Name is Manidatory'
				],
			],
			'checkbox'  => [
				'rules'   => 'required',
				'errors'  => [
					'required'     => 'Please Select Remember me !',
				],
			],
			'password'  => [
				'rules'   => 'required|min_length[6]|max_length[16]',
				'errors'  => [
					'required'  => 'Password is Required',
				],
			],
		];
		if ($this->validate($rules)) {
			$username     = $this->request->getVar('username');
			$password  = $this->request->getVar('password');
			$throttler = \Config\Services::throttler();
			$allow     = $throttler->check("login", 4, MINUTE);
			if ($allow) {
				$userdata = $this->loginModel->verify_account($username, $password);
				if ($userdata) {
					$loginInfo  = [
						'admin_id'      => $userdata['id'],
						'admin_name'      => $userdata['name'],
						'admin_mobile'      => $userdata['mobile'],
						'admin_email'      => $userdata['email'],
					];
					$this->session->set('loggedin_user', $userdata['id']);
					return redirect()->to(base_url().'/Super_admin');
				}else{
					$data['error']  = 'Username & Password don Not Matched ! Please Enter Valid Username & Password';
				}
				
			}else{
				$data['error']  = 'Max No. of failed Login Attempt, Try Again a Few Minutes';
			}
		}else{
			
			$data['validation']  = $this->validator;
		}
	}
		return view('Login/Login', $data);
	}

	public function login_user_account(){
		$data = [];
		//site login 
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'email'  => 'required|valid_email',
				'checkbox'  => 'required',
				'password'   => 'required|min_length[4]|max_length[16]'
			];
			if ($this->validate($rules)) {
				$email     = $this->request->getVar('email');
				$password  = $this->request->getVar('password');
				$throttler = \Config\Services::throttler();
				$allow     = $throttler->check("login", 4, MINUTE);
				if ($allow) {
					$userdata = $this->loginModel->verifyEmail($email, $password);
					if (!$userdata) {
						$this->session->setTempdata('error', 'Sorry ! Unable to Login Email & Password doesNot Exists ?', 3);
						return redirect()->to(base_url().'/Home/login_register');
					}else{
						if ($userdata['status'] == 'Active') {
							$loginInfo  = [
								'user_id'     => $userdata['id'],
								'user_unid'   => $userdata['uid'],
								'username'    => $userdata['name'],      
								'mobile'      => $userdata['mobile'],      
								'email'       => $userdata['email'],      
								'status'      => $userdata['status'],      
								'gender'      => $userdata['gender'],  
								'loggedin_user' => TRUE    
							];
								$this->session->set($loginInfo);
								return redirect()->to(base_url().'/Home/choose_restaurent');
							}else{
								$this->session->setTempdata('error', 'Your Account is Not Verified !', 3);
							}
							return redirect()->to(base_url().'/Home/login_register');
							}
						}else{
							$this->session->setTempdata('error', 'Max No. of failed Login Attempt, Try Again a Few Minutes', 3);
						}
				}else{
					$data['validation']  = $this->validator;
				}
			}		
		//Google Gmail Login Query Software Developer Khan Rayees
		return view('Home/login_register', $data);
	}


	public function login_delivery_boyaccount(){
		$data = [];
		$data['validation'] = null;	
		//site login 
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'email'     => 'required|valid_email',
				'password'   => 'required|min_length[4]|max_length[16]'
			];
			if ($this->validate($rules)) {
				$email     = $this->request->getVar('email');
				$password  = $this->request->getVar('password');
				$throttler = \Config\Services::throttler();
				$allow     = $throttler->check("login", 4, MINUTE);
				if ($allow) {
					$userdata = $this->loginModel->verifyEmaildelivery_boy($email, $password);
					if (!$userdata) {
						$this->session->setTempdata('error', 'Sorry ! Unable to Login Email & Password doesNot Exists ?', 3);
						return redirect()->to(base_url().'/Login/login_delivery_boyaccount');
					}else{
						if ($userdata['status'] == 'Active') {
							$logindeliInfo  = [
								'delivery_boy_id'    => $userdata['id'],
								'deli_unid'          => $userdata['uid'],
								'deliboyname'        => $userdata['name'],      
								'deliboymobile'      => $userdata['mobile'],      
								'deliboyemail'       => $userdata['email'],      
								'deliboystatus'      => $userdata['status'],      
								'deliboypincode'     => $userdata['pincode'],      
								'deliboyimage'       => $userdata['image'],      
								'loggedin_delivery_boy'  => TRUE    
							];
							$this->session->set($logindeliInfo);
								return redirect()->to(base_url().'/Delivery_boy/dashboard');
						}else{
							$this->session->setTempdata('error', 'Your Account is Not Verified !', 3);
						}
						return redirect()->to(base_url().'/Login/login_delivery_boyaccount');
					}
				}else{
					$this->session->setTempdata('error', 'Max No. of failed Login Attempt, Try Again a Few Minutes', 3);
				}
			}else{
				$data['validation']  = $this->validator;
			}
		}	
			
		//Google Gmail Login Query Software Developer Khan Rayees
		return view('Delivery_boy/login', $data);
	}


	public function restaurent_login(){
			$data = [];
		$data['validation'] = null;	
		//site login 
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'Email'     => 'required|valid_email',
				'checkbox'  => 'required',
				'password'  => 'required|min_length[4]|max_length[16]'
			];
			if ($this->validate($rules)) {
				$email     = $this->request->getVar('Email');
				$password  = $this->request->getVar('password');
				$throttler = \Config\Services::throttler();
				$allow     = $throttler->check("login", 4, MINUTE);
				if ($allow) {
					$userdata = $this->loginModel->verify_restaurent_email($email, $password);
					if (!$userdata) {
						$this->session->setTempdata('error', 'Sorry ! Unable to Login Email & Password doesNot Exists ?', 3);
						return redirect()->to(base_url().'/Login/restaurent_login');
					}else{
						if ($userdata['status'] == 'Active') {
							$loggied_in_res_info  = [
								'RES_ID'                 => $userdata['id'],
								'RESTAURENT_UID'         => $userdata['restaurent_uid'],
								'RES_NAME'               => $userdata['name'],      
								'RES_MOBILE'             => $userdata['mobile'],      
								'RES_EMAIL'              => $userdata['email'],      
								'RES_STATUS'             => $userdata['status'],      
								'RES_PINCODE'            => $userdata['pincode'],      
								'RES_IMAGE'              => $userdata['image'],      
								'LOGGIED_IN_RESTAURENT'  => TRUE    
							];
							$this->session->set($loggied_in_res_info);

							//Set Restaurent Opening Status Khan Rayees all Right Reserved

							$OpeningInfo  = [
								'restaurent_id'     => $userdata['restaurent_uid'],
								'opening_status'    => 'Open',
								'browser'           => $this->getUserAgent(),
								'login_ip'          => $this->request->getIPAddress(),
								'login_time'        => date('Y-m-d h:i:s'),
								'login_date'        => date('Y-m-d')   
							];
							$login_activity_id = $this->loginModel->SaveOeningInfo($OpeningInfo);

							return redirect()->to(base_url().'/Restaurent/dashboard');
						}else{
							$this->session->setTempdata('error', 'Your Account is Not Verified !', 3);
						}
						return redirect()->to(base_url().'/Login/restaurent_login');
					}
				}else{
					$this->session->setTempdata('error', 'Max No. of failed Login Attempt, Try Again a Few Minutes Later', 3);
				}
			}else{
				$data['validation']  = $this->validator;
			}
		}	
		return view('Restaurent/restaurent_login', $data);
	}



    public function getUserAgent(){
		$agent = $this->request->getUserAgent(); //predefine method
		if ($agent->isBrowser()) {
			$currentAgent  = $agent->getBrowser();
		}else if ($agent->isRobot()) {
			$currentAgent  = $this->agent->robot();
		}else if ($agent->isMobile()) {
			$currentAgent  = $agent->getMobile();
		}else{
			$currentAgent  = 'Unidentified User Agent';
		}
		return $currentAgent;
	}









	public function forget_users_password(){
		$data['validation'] = null;
		return view('Home/forget_users_password', $data);
	}

	public function forget_pass_users(){
		$data = [];
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'email' => [
					'label'  => 'Email',
					'rules'   => 'required|valid_email',
					'errors'  => [
						'required'    => ' Email is required',
						'valid_email' => 'Please Enter valid Email required'
					]
				],
			];

			if ($this->validate($rules)) {
				$email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
				$userdata = $this->loginModel->verifyEmail_with_args('users_master',$email);
				if (!empty($userdata)) {
					$update = $this->loginModel->updatedAt('users_master',$userdata['uid']);
					if ($update) {
						$to = $email;
						$subject  = 'Reset Password Link';
						$token    = $userdata['uid'];
						$message  = 'Hi ' .$userdata['name']. '<br><br>'
									.'Your Reset Password request has been Received. Please Click'
									.'the below Link to reset your Password.<br><br>'
									.'<a href="'.base_url().'/Login/reset_user_password/'.$token.'">Click Here to Reset Password</a>'
									.'<br>Thanks <br> Food Ordaring System <br>'
									.'Khan Rayees visit my site khanrayees.000webhostapp.com <br>';
						$this->email->setTo($to);
						$this->email->setFrom('khanrayeesq121@gmail.com', 'Software Developer & Blogger');
						$this->email->setSubject($subject);
						$this->email->setMessage($message);
						if ($this->email->send()) {
							$this->session->setTempdata('success', 'Reset Password Link Send to Your Email Please Check and Verify, with in 15min',3);
							return redirect()->to(current_url());
						}else{
							$data = $this->email->printDebugger(['headers']);
							print_r($data);
						} 
					}else{
						$this->session->setTempdata('error', 'Sorry ! Unable to Update Try Again ?', 3);
							return redirect()->to(current_url());
					}
					
				}else{
					$this->session->setTempdata('error', 'Sorry Email Does Not Exists Try Again valid Email?', 3);
					return redirect()->to(current_url());
				}
			}else{
				$data['validation'] = $this->validator;
			}
		}
		$data['validation'] = null;
		return view('Home/forget_users_password', $data);
		return view('Home/forget_users_password', $data);
	}

	public function reset_user_password($token=null){
		$data = [];
		if (!empty($token)) {
			$userdata = $this->loginModel->verifyToken('users_master', $token);
			if (!empty($userdata)) {
				$check_exp_time = $this->checkExpiry_time($userdata['updated_at']);
				if ($check_exp_time) {
					if ($this->request->getMethod() == 'post') {
					 	$rules = [
							'new_password' => [
								'label'  => 'Password',
								'rules'  => 'required|min_length[6] |max_length[16]',
							],
							'Confirm_password' => [
								'label'  => 'Confirm Password',
								'rules'  => 'required|matches[new_password]'

							],
						];
						if ($this->validate($rules)) {
							$password = md5($this->request->getVar('new_password'));
							$update_pass = $this->loginModel->update_password('users_master',$token, $password);
							if ($update_pass) {
								$this->session->setTempdata('success', 'Password Updated Successfully',3);
								return redirect()->to(base_url().'/Home/index');
							}else{
								$this->session->setTempdata('error', 'Sorry Unable to Update Password Try Again !',3);
									return redirect()->to(current_url());
							}
						}else{
							$data['validation'] = $this->validator;
						}
					}else{
						
					}
				}else{
					$data['error']  = 'Reset Password Link was Expired';
				}
			}else{
				$data['error'] = 'Unable to Find User Account';
			}
		}else{
			$data['error']  = 'Sorry ! Unauthorized access';
		}
		$data['validation'] = null;
		return view('Home/reset_user_password', $data);
	}

	public function checkExpiry_time($time){
		$update_time   = strtotime($time);
		$current_time  = time();
		$timeDiff      = ($current_time - $update_time)/60;
		if ($timeDiff < 900) {
			return true;
		}else{
			return false;
		}
	}


	public function Logout(){
		if (session()->has('loggedin_user')) {
		}
		session()->remove('loggedin_user');
		session()->destroy();
		return redirect()->to(base_url()."/Login");
	}



	//--------------------------------------------------------------------

}
