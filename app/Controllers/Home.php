<?php namespace App\Controllers;
use \App\Models\Main_model;
use \App\Models\Login_model;


//Google Login Client Id : 887283368464-2nt5baf8he61cknaqkphslpo24uncrfm.apps.googleusercontent.com
//Client Scret : shPcjV1xLY93P9aIeXR3uGBw
class Home extends BaseController
{
	public $session;
	public $mainmodel;
	public $loginModel;
	public function __construct(){
		// helper(['form','Admin_helper','text','url']);
		$this->mainmodel  = new Main_model();
		$this->loginModel = new Login_model();
		$this->session   = session();
		$this->email = \Config\Services::email();
	}
	public function index()
	{	
		$args = [
			'status'  => 'Active'
		];
		$data['banner'] = $this->mainmodel->get_image_by_args('slider_image', $args, 2);
		return view('Home/index', $data);
	}

	public function about_us(){
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/about_us', $data);
	}

	public function contact_us(){
		$data['validation'] = null;
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/contact_us', $data);
	}

	public function login_register($param = "", $referal = ""){
		if ($param == 'referral_code') {
			$referal_code=  $referal;
			$referaluser_detail = get_user_details($referal_code);
			$referal_session = [
				'FROM_REFERAL_CODE_SESSION'  => $referaluser_detail[0]->referal_code
			];
			$this->session->set($referal_session);
		}
		// die();
		$from_referal =  $this->session->get('FROM_REFERAL_CODE_SESSION');

		if ($from_referal != "") {
			$from_referal = $this->session->get('FROM_REFERAL_CODE_SESSION');
		}else{
			$from_referal = "";
		}

		$data['validation']  = null;
		//Google Gmail Login Query Software Developer Khan Rayees
		include_once APPPATH . "libraries/vendor/autoload.php";
		$google_client = new \Google_Client();
		$google_client->setClientId('887283368464-2nt5baf8he61cknaqkphslpo24uncrfm.apps.googleusercontent.com');
		$google_client->setClientSecret('shPcjV1xLY93P9aIeXR3uGBw');
		$google_client->setRedirectUri(base_url(). '/Home/login_register');
		$google_client->addScope('email');
		$google_client->addScope('profile');
		
		if ($this->request->getVar('code')) {
			$token = $google_client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
			if (!isset($token['error'])) {
				$google_client->setAccessToken($token['access_token']);
				$this->session->set('access_token',$token['access_token']);
				//to get the profile data
				$google_service = new \Google_Service_Oauth2($google_client);
				$gdata = $google_service->userinfo->get();
				if ($this->loginModel->google_user_exists($gdata['id'])) {
					# update
					$userdata = [
						'uid'         => $gdata['id'],
						'name'        => $gdata['given_name'],
						'email'       => $gdata['email'],
						'profile_pic' => $gdata['picture'],
						'gender'      => $gdata['family_name'],
						'status'      => 'Active',
						'added_date'  => date('Y-m-d h:i:s')
					];
					$this->loginModel->updateGoogleUser($userdata, $gdata['id']);
					$this->session->set('google_user', $userdata);
					$uinfo = session()->get('google_user');
					$user_id = $uinfo['uid'];
					$args = [
						'uid'   => $user_id
					];
					$gmail_user = $this->mainmodel->fetch_rec_by_args_products('users_master', $args);
					$google_user_info = [
						'google_uid'   => $gmail_user[0]->id
					];
					$this->session->set('google_user_info', $google_user_info);
					return redirect()->to(base_url() . "/Home/choose_restaurent");
				}else{
					//insert
					$referal_code = substr(md5(time()), 0, 6);
					$userdata = [
						'uid'               => $gdata['id'],
						'name'              => $gdata['given_name'],
						'email'             => $gdata['email'],
						'profile_pic'       => $gdata['picture'],
						'gender'            => $gdata['family_name'],
						'referal_code'      => $referal_code,
						'from_referal_code' => $from_referal,
						'status'            => 'Active',
						'added_date'        => date('Y-m-d h:i:s')
					];
					$login_u_id = $this->mainmodel->Insertdata_return_id('users_master', $userdata);
					$get_web_wallet  = get_website_settings();
					$wallet_amount = $get_web_wallet[0]->wallet_amt;
					manage_user_wallet($login_u_id,$wallet_amount,'In','Register');

					$this->session->set('google_user', $userdata);
					$uinfo = session()->get('google_user');
					$user_id = $uinfo['uid'];
					$args = [
						'uid'   => $user_id
					];
					$gmail_user = $this->mainmodel->fetch_rec_by_args_products('users_master', $args);
					$google_user_info = [
						'google_uid'   => $gmail_user[0]->id
					];
					$this->session->set('google_user_info', $google_user_info);
					if (session()->has('FROM_REFERAL_CODE_SESSION')) {
						session()->remove('FROM_REFERAL_CODE_SESSION');
					}
					return redirect()->to(base_url() . "/Home/choose_restaurent");
				}
			}
		}
		if (!$this->session->get('access_token')) {
			$data['loginButton'] = $google_client->createAuthUrl(); 
		}
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/login_register', $data);
	}


	public function choose_restaurent(){
		$args = [
			'status'  => 'Active'
		];
		$data['restaurent'] = $this->mainmodel->fetch_rec_by_args_products('restaurent', $args);
		$data['carts_pro'] = $this->get_session_carts_details();
		// var_dump($data['carts_pro']);
		return view('Home/choose_restaurent', $data);
	}
	public function search_restaurent($val){	
		$args = [
			'name'    => $val,
			'status'  => 'Active'
		];
		$restaurent = $this->mainmodel->fetch_rec_by_args_by_like('restaurent', $args);
		$output = '';
		if ($restaurent) {
			count($restaurent);
			$i=  0;
			foreach($restaurent as $pro){
				$i++;
				$output .= '<a href="'.site_url("Home/restaurent_details/").$pro->restaurent_uid.'">'.$pro->name.'</a>';
				if ($i>13): break;
				endif;
			}
		}else{
			$output = '<a href="#!" style="color:red;">Products Not Available</a>';
		}
		echo $output;
	}

	public function shop($restaurent_id){
		// $data['carts_pro'] = "";
		$args = [
			'restaurent_id'  => $restaurent_id,
			'opening_status' => 'Open'
		];
		$res_open_status = $this->mainmodel->fetch_rec_by_args_products('restaurent_opening_status', $args);
		if ($res_open_status == true) {
			
			$args = [
				'status'  => 'Active',
				'restaurent_id' => $restaurent_id
			];
			$data['dishes'] = $this->mainmodel->fetch_rec_by_args_products('dish_master', $args);
			if($data['dishes']){
				$args = [
					'status'        => 'Active'
				];
				$data['categories'] = $this->mainmodel->fetch_rec_by_args_products('category_master', $args);
			}else{
				$this->session->setTempdata('error', 'Restaurent ! Not Added any Item Wait Try Again Some timg ? Thanku', 3);
				return redirect()->to(base_url() . "/Home/choose_restaurent");
			}
			$data['carts_pro'] = $this->get_session_carts_details();
			return view('Home/shop', $data);
		}else{
			$this->session->setTempdata('error', 'OOPS ! Currently Restaurent is Closed', 3);
			return redirect()->to(base_url() . "/Home/choose_restaurent");
		}

	}

	public function filter_shop($id){
		$args = [
			'category_id'  => $id,
			'status'       => 'Active'
		];
		$data['filter_pro'] = $this->mainmodel->fetch_rec_by_args_products('dish_master', $args);
		$args = [
			'status'  => 'Active'
		];
		$data['categories'] = $this->mainmodel->fetch_rec_by_args_products('category_master', $args);
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/filter_shop', $data);
	}

	public function search_shop_products(){
		$search_first = [
			'dish_title'  => $this->request->getVar('search_dish_title', FILTER_SANITIZE_STRING),
			'status'       => 'Active'
		];
		$search_second = [
			'dish_details'  => $this->request->getVar('search_dish_title', FILTER_SANITIZE_STRING),
		];
		$args = [
			'category_id'  => $this->request->getVar('category_id', FILTER_SANITIZE_STRING)
		];
		$data['filter_pro'] = $this->mainmodel->fetch_rec_by_args_by_like_with_args('dish_master',$search_first, $search_second,$args);
		$args = [
			'status'  => 'Active'
		];
		$data['categories'] = $this->mainmodel->fetch_rec_by_args_products('category_master', $args);
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/filter_shop', $data);
	}



	public function restaurent_details($id){
		$args = [
			'restaurent_uid'     => $id,
			'status' => 'Active'
		];
		$data['restaurent'] = $this->mainmodel->fetch_rec_by_args_products('restaurent', $args);
		$args = [
			'restaurent_uid!='     => $id,
			'status'               => 'Active'
		];
		$data['filter_rest'] = $this->mainmodel->fetch_rec_by_args_products('restaurent', $args);
		$data['carts_pro']   = $this->get_session_carts_details();	
		return view('Home/restaurent_details', $data);
	}

	public function filter_restaurent($city){
		$args = [
			'city'   => $city,
			'status'  => 'Active'
		];
		$data['filter_res'] = $this->mainmodel->fetch_rec_by_args_products('restaurent', $args);
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/filter_restaurent', $data);
	}

	public function filter_veg_non_veg($filter){
		if ($filter == 'Veg') {
			$args = [
				'dish_type'  => 'Veg'
			];
			$order = [
				'column_name'  => 'id',
				'order'        => 'desc'
			];
		}else if ($filter == 'Non-Veg') {
			$args = [
				'dish_type'  => 'Non-Veg'
			];
			$order = [
				'column_name'  => 'id',
				'order'        => 'asc'
			];
		}else{
			$order = [
				'column_name'  => 'id',
				'order'        => 'desc'
			];
		}
		$data['filter_pro'] = $this->mainmodel->filter_rec_by_args_with_type('dish_master', $order, $args);
		$args = [
			'status'        => 'Active'
		];
		$data['categories'] = $this->mainmodel->fetch_rec_by_args_products('category_master', $args);
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/filter_shop', $data);
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



	//Add to carts Section Start
	public function add_to_cart($id, $attr){
		if ($this->session->get('session_id') == "") {
			$user_session_id  = [
				'session_id'   => rand(9999999,999999)
			];
			$this->session->set($user_session_id);
		}

		$args = [
			'id'     => $id,
			'status' => 'Active'
		];
		$pro_details = $this->mainmodel->fetch_rec_by_args_products('dish_master', $args);
		
		$args = [
			'id'     => $attr,
			'status' => 'Active'
		];
		$dish_attribute = $this->mainmodel->fetch_rec_by_args_products('dish_details',$args);

		$args = [
			'dish_details_id'  => $id,
			'session_id'       => $this->session->get('session_id')
		];

		$check_product = $this->mainmodel->fetch_rec_by_args_products('dish_carts', $args);
		if ($check_product) {
			count($check_product);
			$old_qty = $check_product[0]->qty;
			$new_qty = $old_qty + 1;
			$args = [
				'id'  => $check_product[0]->id
			];
			$data = [
				'qty'   => $new_qty
			];
			$result = $this->mainmodel->update_rec_by_args('dish_carts', $args,$data);
			if ($result == true) {
				# code...
				echo "1";
			}else{	
				echo "0";
			}
		}else{
			
			$user_id  = $this->get_login_user_details();

			$data = [
				'dish_details_id'  => $pro_details[0]->id,
				'dish_title'       => $pro_details[0]->dish_title,
				'session_id'       => $this->session->get('session_id'),
				'restaurent_id'    => $pro_details[0]->restaurent_id,
				'qty'              => '1',
				'attr_id'          => $dish_attribute[0]->id,
				'user_id'          => $user_id,
				'attribute'        => $dish_attribute[0]->attribute,
				'rate'             => $dish_attribute[0]->price,
				'added_on'         => date('Y-m-d h:i:s')
			];
			$result = $this->mainmodel->Insertdata('dish_carts',$data);
			if ($result == true) {
				# code...
				echo "1";
			}else{
				echo "0";
			}
		}
	}




	public function calculate_carts_products(){
		$products = $this->get_cart_details_by();
		$calculate_amount = 0;
		if ($products) {
			count($products);
			foreach($products as $product){
				$calculate_amount  += ($product->rate * $product->qty);
			}
		}else{
			$calculate_amount = 0;
		}
		$data   = [
			'total_products'   => count($products),
			'total_amount'     => ($calculate_amount > 0) ? number_format($calculate_amount) : '0'
		];
		echo json_encode($data);
	}


	public function update_quantity($quantity, $type,$product_id){
		if ($type == "add") {
			$new_qty = $quantity + 1;
			$args = [
				'dish_details_id'   => $product_id
			];
			$data = [
				'qty'  => $new_qty
			];
			$result = $this->mainmodel->update_rec_by_args('dish_carts',$args,$data);
		}else{
			if ($quantity > 1) {
				$new_qty = $quantity - 1;
				$args = [
					'dish_details_id'   => $product_id
				];
				$data = [
					'qty'  => $new_qty
				];
				$result = $this->mainmodel->update_rec_by_args('dish_carts',$args,$data);
			}else{
				$result = false;
			}
			
		}
		if ($result == true) {
			# code...
			echo "1";
		}else{
			echo "0";
		}
	}

	//Add to carts Section End
	public function delete_dish_in_carts($id){
		$args = [
			'id'  => $id
		];
		$status = $this->mainmodel->delete_records('dish_carts', $args);
		if ($status) {
			echo "1";
		}else{
			echo "0";
		}
	}

	public function view_carts($session_id){
		$args = [
			'session_id'  => $session_id
		];
		$data['view_carts'] = $this->mainmodel->fetch_rec_by_args_products('dish_carts', $args);
		$data['carts_pro'] = $this->get_session_carts_details();
		$this->remove_coupon_session();
		return view('Home/view_carts_dish', $data);
	}

	public function check_out(){
		$data['validation'] = null;
		$data['carts_pro'] = $this->get_session_carts_details();
		$user_id = $this->get_login_user_details();
		$data['wallat_total'] = get_wallate_amount($user_id);
		return view('Home/check_out', $data);
	}


	//Checkout User Login
	public function login_user_account(){
		$data = [];
		//site login 
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'email'  => 'required|valid_email',
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
						return redirect()->to(base_url().'/Home/check_out');
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
								return redirect()->to(base_url().'/Home/check_out');
							}else{
								$this->session->setTempdata('error', 'Your Account is Not Verified !', 3);
							}
							return redirect()->to(base_url().'/Home/check_out');
							}
						}else{
							$this->session->setTempdata('error', 'Max No. of failed Login Attempt, Try Again a Few Minutes', 3);
						}
				}else{
					$data['validation']  = $this->validator;
				}
			}		
		//Google Gmail Login Query Software Developer Khan Rayees
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/check_out', $data);
	}
	//Checkout User Login

	public function remove_coupon_session(){
		if (session()->has('COUPON_ID')) {
			session()->remove('COUPON_ID');
			session()->remove('FINAL_PRICE');
			session()->remove('COUPON_VALUE');
			session()->remove('COUPON_CODE');
		}
		
	}

	//Shipping Address 
	public function complete_purchase(){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			return redirect()->to(base_url()."/Home/login_register");
		}else{
			$data = [];
			$data['validation'] = null;
			if ($this->request->getMethod() == 'post') {
				$rules = [
					'first_name'         => 'required',
					'permanent_address'  => 'required|min_length[4]',
					'mobile'             => 'required|numeric|exact_length[10]',
					'pinCode'            => 'required|exact_length[6]',
					'state'              => 'required',
					'city'               => 'required',
					'house_number'       => 'required',
				];
				if ($this->validate($rules)) {
					$products = $this->get_cart_details_by();
					$user_id = $this->get_login_user_details();

					//Get Products
					$total_quantity = 0;
					$total_amount = 0;
					if ($products) {
						count($products);
						foreach ($products as $pro) {
							$total_quantity   += $pro->qty;
							$total_amount     += ($pro->qty * $pro->rate);
						}
					}else{
						$total_quantity  = 0;
					}

					if (session()->has('COUPON_ID') && session()->has('COUPON_CODE')) {
						$coupan_id     = session()->get('COUPON_ID');
						$coupan_code   = session()->get('COUPON_CODE');
						$final_price   = session()->get('FINAL_PRICE');
						$this->remove_coupon_session();
					}else{
						$coupan_id    = "0";
						$coupan_code  = "0";
						$final_price  = $total_amount;
					}
					$payment_type  = $this->request->getVar('payment_type',FILTER_SANITIZE_STRING);

					$order_id = rand(111111,999999);
					$data = [
						'first_name'         => $this->request->getVar('first_name',FILTER_SANITIZE_STRING),
						'last_name'          => $this->request->getVar('last_name',FILTER_SANITIZE_STRING),
						'permanent_address'  => $this->request->getVar('permanent_address',FILTER_SANITIZE_STRING),
						'mobile'             => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
						'pinCode'            => $this->request->getVar('pinCode',FILTER_SANITIZE_STRING),
						'state'              => $this->request->getVar('state',FILTER_SANITIZE_STRING),
						'city'               => $this->request->getVar('city',FILTER_SANITIZE_STRING),
						'house_number'       => $this->request->getVar('house_number',FILTER_SANITIZE_STRING),
						'user_id'            => $user_id,
						'order_id'           => $order_id,
						'total_quantity'     => $total_quantity,
						'total_amount'       => $total_amount,
						'restaurent_id'      => $products[0]->restaurent_id,
						'coupon_id'          => $coupan_id,
						'coupon_code'        => $coupan_code,
						'final_price'        => $final_price,
						'payment_mode'       => $payment_type,
						'payment_status'     => 'Pending',
						'order_status'       => 'Pending',
						'order_date'         => date('Y-m-d')

					];
					$get_order_id = $this->mainmodel->Insertdata_return_id('order_master', $data);
					$args = [
						'id'   => $get_order_id
					];
					$get_order_id_details = $this->mainmodel->fetch_rec_by_args_products('order_master', $args);

					$user_order_id = $get_order_id_details[0]->order_id;

					//CallBack Function Get User Latitude & Logitude
					  get_latitude_and_logitude_according_to_order($user_order_id);
					//CallBack Function Get User Latitude & Logitude

					if ($products) {
						count($products);
						foreach($products as $pro){
							$data = [
								'order_id'        => $user_order_id,
								'dish_detail_id'  => $pro->dish_details_id,
								'price'           => $pro->rate,
								'qty'             => $pro->qty,
								'attr_id'         => $pro->attr_id,
								'attribute'       => $pro->attribute
							];
							$this->mainmodel->Insertdata('ordere_details', $data);
						}
					}
					
					if ($payment_type == 'COD') {
						$this->session->setTempdata('success', 'Congratulation ! Order Purchase Successfully', 3);$this->remove_coupon_session();
						$this->empty_cart_details();
						return redirect()->to(base_url().'/Home/choose_restaurent');
					}

					if ($payment_type == "Wallet") {
						$order_id = $get_order_id_details[0]->order_id;
						$user_id = $this->get_login_user_details();
						manage_user_wallet($user_id,$final_price,'Out',$order_id);
						$args = [
							'order_id'  => $order_id
						];
						$data = [
							'payment_status'  => 'SUCCESS',
							'order_date'      => date('Y-m-d')
						];
						$this->mainmodel->update_rec_by_args('order_master', $args, $data);
						$this->session->setTempdata('success', 'Congratulation ! Order Purchase Successfully', 3);
						$this->remove_coupon_session();
						$this->empty_cart_details();
						return redirect()->to(base_url().'/Home/choose_restaurent');
					}

					if ($payment_type == 'Paytm') {
						$user_id = $this->get_login_user_details();
						$order_id = $get_order_id_details[0]->order_id;
						// $data['validation'] = null;
						$data =  [
							'order_id'  => $order_id,
							'user_id'   => $user_id,
							'final_price' => $final_price
						];
						return view('Home/patym_payment', $data);
					}
					$this->remove_coupon_session();
					$this->empty_cart_details();
				}else{
					$data['validation'] = $this->validator;
				}
				$data['carts_pro'] = $this->get_session_carts_details();
				$user_id = $this->get_login_user_details();
				$data['wallat_total'] = get_wallate_amount($user_id);
				return view('Home/check_out', $data);
			}
		}
	}



	public function empty_cart_details(){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			$user_id = session()->get('user_id');
		}else if (session()->has('google_user')) {
			$uinfo = session()->get('google_user_info');
			$user_id = $uinfo['google_uid'];
		}
		if ($this->session->get('session_id') != "") {
			$args =[
				'session_id'       => $this->session->get('session_id')
			];
			$status = $this->mainmodel->delete_records('dish_carts', $args);
		}else{
			$args = [
				'user_id'  => $user_id
			];
			$status = $this->mainmodel->delete_records('dish_carts', $args);
		}
		return $status;
	}


	public function get_cart_details_by(){
		if ($this->session->get('session_id') != "") {
			$args =[
				'session_id'       => $this->session->get('session_id')
			];
			$products = $this->mainmodel->fetch_rec_by_args_products('dish_carts', $args);
		}else if (session()->has('google_user')) {
			$uinfo = session()->get('google_user_info');
			$user_id = $uinfo['google_uid'];
			$args = [
				'user_id'  => $user_id
			];
			$products  = $this->mainmodel->fetch_rec_by_args_products('dish_carts', $args);
		}else{
			$user_id = $this->session->get('user_id');
			$args = [
				'user_id'  => $user_id
			];
			$products  = $this->mainmodel->fetch_rec_by_args_products('dish_carts', $args);
		}
		return $products;
	}


	public function get_login_user_details(){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			$user_id = '0';
		}else if (session()->has('google_user')) {
			$uinfo = session()->get('google_user_info');
			$user_id = $uinfo['google_uid'];
		}
		else {
			$user_id = $this->session->get('user_id');
		}
		return $user_id;
	}


	public function view_profile(){
		if (!(session()->has('loggedin_user'))) {
			$this->session->setTempdata('error', 'Sorry ! Unable to View your Profile your Google Login I am Not Getting your Pressional Details ?', 3);
			return redirect()->to(base_url()."/Home/choose_restaurent");
		}else{
			$args = [
				'id'   => $this->session->get('user_id')
			];
			$data['view_profile'] = $this->mainmodel->fetch_rec_by_args_products('users_master', $args);
			$data['carts_pro'] = $this->get_session_carts_details();
			$data['validation']  = null;
			return view('Home/view_profile', $data);
		}
	}

	public function update_user_info($id){

		$data['validation']  = null;
		$args = [
			'id'  => $id
		];
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'profile_pic' => [
		            'uploaded[profile_pic]',
		            'mime_in[profile_pic,image/jpg,image/jpeg,image/gif,image/png]',
		            'max_size[profile_pic,4096]',
		        ],
			];
			if ($this->validate($rules)) {
				$img = $this->request->getFile('profile_pic');
				if ($img->isValid() &&  !$img->hasMoved()) {
					 $newName = $img->getRandomName();
					 $img->move('./public/uploads/user_profile', $newName); 
					 $profile_img = $img->getName();

					 $data = [
						'name'        => $this->request->getVar('name',FILTER_SANITIZE_STRING),
						'gender'      => $this->request->getVar('gender',FILTER_SANITIZE_STRING),
						'mobile'      => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
						'profile_pic' => $profile_img,
						'updated_at'  => date('Y-m-d h:i:s') 
					];

					$status = $this->mainmodel->update_rec_by_args('users_master', $args, $data);
					if ($status == true) {
						$args = [
							'id'  => $id
						];
						$user_infoses = $this->mainmodel->fetch_rec_by_args_products('users_master', $args);
						$set_user_image_session = [
							'user_profile_session'  => $user_infoses[0]->profile_pic
						];
						$this->session->set($set_user_image_session);
						$this->session->setTempdata('success', 'Congratulation ! Profile Updated Successfully', 3);
					}else{
						$this->session->setTempdata('error', 'Sorry ! Unable to Update your profile ?', 3);
					}
					return redirect()->to(base_url().'/Home/view_profile/'.$id);
				}else{
			    	echo $image->getErrorString(). " " .$image->getError();
			    }
			    
			    return redirect()->to(base_url().'/Home/check_out/'.$id);
			}
		}
		
	}

	public function change_user_password(){
		$data = [];
		$data['validation'] = null;
		$user_id = $this->session->get('user_id');
		$data['userdata'] = $this->mainmodel->getLoggedInUserData($user_id);
		if ($this->request->getMethod() == 'post') {
			$validation =  \Config\Services::validation();

			$rules = [
				'old_password'     => 'required',
				'new_password'     => 'required|min_length[6]|max_length[16]',
				'confirm_password' => 'required|matches[new_password]',
			];
			if ($this->validate($rules)) {
				$oldpass  = $this->request->getVar('old_password');
				$check_pass_verify = $this->check_old_password($oldpass);
				if ($check_pass_verify) {
					$args = [
						'id'  => $this->session->get('user_id')
					];
					$data = [
						'password'  => md5($this->request->getVar('new_password'))
					];
					$status = $this->mainmodel->update_rec_by_args('users_master',$args, $data);
					if ($status) {
						$this->session->setTempdata('success', 'Congratulation ! Password Updated Successfully!', 3);
							return redirect()->to(current_url());
					}else{
						$this->session->setTempdata('error', 'Sorry Unable to Update Password Try Again!', 3);
						return redirect()->to(current_url());
					}
				}else{
					$this->session->setTempdata('error', 'Failed ! Your Password does not match with old Password!', 3);
           			return redirect()->to(base_url().'/Home/change_user_password');
				}
				
			}else{
				$data['validation']  = $this->validator;
			}
		}
		$args = [
			'id'   => $this->session->get('user_id')
		];
		$data['view_profile'] = $this->mainmodel->fetch_rec_by_args_products('users_master', $args);
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/view_profile', $data);	
	}


	public function check_old_password($oldpass){
		$user_id = $this->session->get('user_id');
        $user = $this->mainmodel->getLoggedInUserData($user_id);
        if($user->password !== md5($oldpass)) {
        	$this->session->setTempdata('error', 'Failed ! Password does not match!', 3);
           	return redirect()->to(base_url().'/Home/change_user_password');
            // return false;
        }else{
   		 
        	return true;
        }
	}

	public function order_history(){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			return redirect()->to(base_url()."/Home/login_register");
		}else{
			if (session()->has('google_user')) {
				$uinfo = session()->get('google_user_info');
				$user_id = $uinfo['google_uid'];
			}else {
				$user_id = $this->session->get('user_id');
			}
			$args = [
				'user_id' => $user_id 
			];
			$data['order_history'] = $this->mainmodel->fetch_rec_by_args_products('order_master', $args);
			$data['carts_pro'] = $this->get_session_carts_details();
			return view('Home/order_history', $data);
		}
	}

	public function download_invoice($order_id){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			return redirect()->to(base_url()."/Home/login_register");
		}
		$args = [
			'order_id'        => $order_id,
		];
		$data['down_invoice'] = $this->mainmodel->fetch_rec_by_args_products('order_master', $args);
		
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/download_invoice', $data);
	}

	public function discount_coupn_code(){
		$args = [
    		'coupon_code'  => $this->request->getVar('coupon_code')
    	];
    	$coupan_valid   = $this->mainmodel->fetch_rec_by_args_products('coupon_master', $args);
		$cart_details   = $this->get_cart_details_by();

		$total_quantity = 0;
		$carttotal_amount = 0;
		if ($cart_details) {
			count($cart_details);
			foreach ($cart_details as $pro) {
				$total_quantity   += $pro->qty;
				$carttotal_amount     += ($pro->qty * $pro->rate);
			}
		}else{
			$total_quantity  = 0;
		}

		$jsonArr = array();
    	if ($coupan_valid) {
    		if ($coupan_valid[0]->expiry_on > date('Y-m-d')) {
    			    $coupan_id       = $coupan_valid[0]->id;
	    			$coupan_code     = $coupan_valid[0]->coupon_code;
	    			$coupan_value    = $coupan_valid[0]->coupon_value;
	    			$cart_min_value = $coupan_valid[0]->cart_min_value;
			    	$coupon_type    = $coupan_valid[0]->coupon_type;
			    	$expired_on     = $coupan_valid[0]->expiry_on;
    			if ($coupan_valid[0]->restaurent_id == $pro->restaurent_id) {
			    	if ($cart_min_value > $carttotal_amount) {
			    		$jsonArr = array('is_error' => 'yes', 'result'=>$carttotal_amount, 'dd'=> 'Cart Value Must be Greater than : '.$cart_min_value);
			    	}else{
			    		if ($coupon_type == 'Rupee') {
							$fnl_prc  = $carttotal_amount - $coupan_value;
							$final_price = ceil($fnl_prc);

						}else{
							$fnl_prc =$carttotal_amount - (($carttotal_amount * $coupan_value)/100);
							$final_price = ceil($fnl_prc);
						}
						$disc = $carttotal_amount - $final_price; 
						$discount = ceil($disc);
						$coupan_session_id  = [
							'COUPON_ID'      => $coupan_id,
							'FINAL_PRICE'      => $final_price,
							'COUPON_VALUE'     => $discount,
							'COUPON_CODE'      => $coupan_code
						];
						$this->session->set($coupan_session_id);
						$jsonArr = array('is_error' => 'no', 'result' => $final_price, 'dd'=>$discount);
			    	}
    			}else if ($coupan_valid[0]->restaurent_id == "0") {
    				if ($cart_min_value > $carttotal_amount) {
			    		$jsonArr = array('is_error' => 'yes', 'result'=>$carttotal_amount, 'dd'=> 'Cart Value Must be Greater than : '.$cart_min_value);
			    	}else{
			    		if ($coupon_type == 'Rupee') {
							$fnl_prc  = $carttotal_amount - $coupan_value;
							$final_price = ceil($fnl_prc);

						}else{
							$fnl_prc =$carttotal_amount - (($carttotal_amount * $coupan_value)/100);
							$final_price = ceil($fnl_prc);
						}
						$disc = $carttotal_amount - $final_price; 
						$discount = ceil($disc);
						$coupan_session_id  = [
							'COUPON_ID'      => $coupan_id,
							'FINAL_PRICE'      => $final_price,
							'COUPON_VALUE'     => $discount,
							'COUPON_CODE'      => $coupan_code
						];
						$this->session->set($coupan_session_id);
						$jsonArr = array('is_error' => 'no', 'result' => $final_price, 'dd'=>$discount);
			    	}
    			}else{
    				$jsonArr = array('is_error' => 'yes', 'result'=>$carttotal_amount, 'dd' => 'This Coupon is Not Applied in that Restaurent');
    			}
    		}else{
    			$jsonArr = array('is_error' => 'yes', 'result'=>$carttotal_amount, 'dd' => 'Coupon is Expired');
    		}
    		
    	}else{
    		$jsonArr = array('is_error' => 'yes', 'result'=>$carttotal_amount, 'dd' => 'Invalid Coupan details');
    	}
    	echo json_encode($jsonArr);
	}

	public function trash_order($order_id){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			return redirect()->to(base_url()."/Home/login_register");
		}else{
			$args = [
				'order_id'  => $order_id
			];
			$data['trash_order'] = $this->mainmodel->fetch_rec_by_args_products('order_master', $args);
			if ($data['trash_order'][0]->delivery_boy_id !== "0") {
				$data['carts_pro'] = $this->get_session_carts_details();
				return view('Home/trash_order', $data);
			}else{
				$this->session->setTempdata('error', 'Sorry Unable to Track Order Delivery Boy is not Assign', 3);
				return redirect()->to(base_url()."/Home/order_history");
			}
			
		}
	}

	//Rating System Dish Section 
	public function update_dish_rating($id){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			return redirect()->to(base_url()."/Home/login_register");
		}else{
			$user_id    = $this->get_login_user_details();
			$dish_rate  = $this->request->getVar('dish_rate');
			$order_id   = $this->request->getVar('order_id');
			$data = [
				'dish_detail_id'  => $id,
				'rating'          => $dish_rate,
				'user_id'         => $user_id,
				'order_id'        => $order_id
			];
			$status = $this->mainmodel->Insertdata('dish_rating', $data);
		}
	
	}
	//Rating System Dish Section 

	//Support Message Script
	public function support_message(){
		$data = [];
		$data['validation'] = null;
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'name'             => 'required',
				'mobile'           => 'required|numeric|exact_length[10]',
				'subject'          => 'required|min_length[5]',
				'message'          => 'required|min_length[10]',
				'email'            => 'required|valid_email',
				
			];
			if ($this->validate($rules)) {
				$login_ip =  rand(888888,999999);
				$user_id  = $this->get_login_user_details();

				$data = [
					'name'            => $this->request->getVar('name',FILTER_SANITIZE_STRING),
					'email'           => $this->request->getVar('email',FILTER_SANITIZE_STRING),
					'mobile'          => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
					'subject'         => $this->request->getVar('subject',FILTER_SANITIZE_STRING),
					'message'         => $this->request->getVar('message',FILTER_SANITIZE_STRING),
					'mobile'          => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
					'login_ip'        => $login_ip,
					'user_id'         => $user_id,
					'added_on'        => date('Y-m-d h:i:s')
				];
				$status = $this->mainmodel->Insertdata('contact_us', $data);
				if ($status == true) {
					$support_message_session = [
						'SUPPORT_MSG_SESSION'  => $login_ip
					];
					$this->session->set($support_message_session );
					$this->session->setTempdata('success', 'Congratulation !Your Query Send Successfully Will response Comming Soon Thanku !', 3);
				}else{
					$this->session->setTempdata('error', 'Sorry ! Unable to Send Try Again ?', 3);
				}
				return redirect()->to(base_url().'/Home/contact_us');
			}else{
				$data['validation'] = $this->validator;
			}
		}
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/contact_us', $data);
	}
	//Support Message Script

	//Wallate Amount Section Script
	public function view_wallate_details(){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			return redirect()->to(base_url()."/Home/login_register");
		}else{
			$data['validation'] = null;
			$data['carts_pro'] = $this->get_session_carts_details();
			$data['user_id']   = $this->get_login_user_details();
			return view('Home/view_wallate_details', $data);
		}
	}


	//Paytm payemnt Integration 
	public function paytm_page_redirect(){
		return view('Home/paytm_page_redirect');
	}

	public function pgResponse(){
		include_once APPPATH . "libraries/lib/config_paytm.php";
		include_once APPPATH . "libraries/lib/encdec_paytm.php";

		$paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = "FALSE";

		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

		$isValidChecksum = verifychecksum_e($paramList, '0vGOHMa2M1JPXE%Z', $paytmChecksum); //will return TRUE or FALSE string.
		// $_POST["STATUS"]= "";
		if($isValidChecksum == "TRUE") {
			echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				$amount   = $_POST['TXNAMOUNT'];
				$order_id = $_POST['ORDERID'];
				$TXNID    = $_POST['TXNID'];
				if (session()->has('IS_WALLET')) {
					$user_id = $this->get_login_user_details();
					manage_user_wallet($user_id,$amount,'In','Added',$TXNID);
					session()->remove('IS_WALLET');
					$this->empty_cart_details();
					$this->remove_coupon_session();
					$this->session->setTempdata('success', "Your Wallate Money Added Successfully", 3);
					return redirect()->to(base_url()."/Home/view_wallate_details");
				}else{
					$args = [
						'order_id'  => $order_id
					];
					$data = [
						'payment_id'     => $TXNID,
						'payment_status' => 'SUCCESS',
						'order_date'     => date('Y-m-d')
					];
					$status = $this->mainmodel->update_rec_by_args('order_master', $args, $data);
					$this->session->setTempdata('success', "Order Placed Successfully ! Transiction Id, '".$TXNID."' and Payment Status is: SUCCESS ", 3);
					$this->empty_cart_details();
					$this->remove_coupon_session();
					return redirect()->to(base_url()."/Home/choose_restaurent");
				}
			}
			else {
				$order_id = $_POST['ORDERID'];
				$TXNID    = $_POST['TXNID'];
				$args = [
					'order_id'  => $order_id
				];
				
				$data = [
					'payment_id'     => $TXNID,
					'payment_status' => 'FAILED',
					'order_date'     => date('Y-m-d')
				];
				$status = $this->mainmodel->update_rec_by_args('order_master', $args, $data);
				$this->session->setTempdata('error', "Failed ! Your Transiction is Failed! Transiction Id, '".$TXNID."' and Payment Status is: FAILED , Try Again afer few seconds", 3);
				return redirect()->to(base_url()."/Home/choose_restaurent");
			}
		}else {
			$order_id = $_POST['ORDERID'];
			$TXNID    = $_POST['TXNID'];
			$args = [
				'order_id'  => $order_id
			];
			
			$data = [
				'payment_id'     => $TXNID,
				'payment_status' => 'FAILED'
			];
			$status = $this->mainmodel->update_rec_by_args('order_master', $args, $data);
			$this->session->setTempdata('error', "Failed ! Your Transiction is Failed! Transiction Id, '".$TXNID."' and Payment Status is: FAILED , Try Again afer few seconds", 3);
			return redirect()->to(base_url()."/Home/choose_restaurent");
		}
	}
	//Paytm payemnt Integration 


	public function add_money(){
		$amount = $this->request->getVar('money');
		if ($amount>0) {
			$order_id =  rand(444444,333333);
			$user_id   = $this->get_login_user_details();
			// $_SESSION['IS_WALLET'] = 'YES';
			$data = [
				'order_id'  => $order_id,
				'user_id'   => $user_id,
				'amount'    => $amount
			];
			$this->session->set('IS_WALLET','yes');
			return view('Home/add_wallat_money', $data);
		}else{
			$data['validation'] = 'Please Add Valid Amount';
		}
		$data['carts_pro'] = $this->get_session_carts_details();
		$data['user_id']   = $this->get_login_user_details();
		return view('Home/view_wallate_details', $data);
	}


	public function cancel_orders($order_id){
		$user_id  = $this->get_login_user_details();
		$cancel_at   = date('Y-m-d h:i:s');
		$db = \Config\Database::connect();
		$status = $db->query("UPDATE `order_master` SET `order_status`='Cancel', `cancel_by`='User', `cancel_at`='$cancel_at'  WHERE `order_id`='$order_id' AND `order_status`='Pending'AND `user_id`='$user_id'");
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Order Cancel Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Cancel Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Home/order_history');
	}

	public function find_office_location(){
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/find_office_location', $data);
	}

	public function technical_support(){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			return redirect()->to(base_url()."/Home/login_register");
		}else{
			$data['carts_pro'] = $this->get_session_carts_details();
			$data['user_id']   = $this->get_login_user_details();
			$args = [
				'user_id'  => $data['user_id']
			];
			$data['replay_msg'] =  $this->mainmodel->get_image_by_args('chating_customer', $args, '2');
			if (!$data['replay_msg']) {
				return redirect()->to(base_url()."/Home/choose_restaurent");
			}else{
				return view('Home/technical_support', $data);
			}
		}
	}


	public function sent_message($user_id){
		$data = [
			'user_id'     => $user_id,
			'message'     => $this->request->getVar('msg'),
			'sent_by'     => 'User',
			'time'        => date('h:i:s')
		];
		$status = $this->mainmodel->Insertdata('chating_customer', $data);
		if ($status) {
			$jsonArr = array();
			$args = [
				'user_id' => $user_id
			];
			$chat_message = $this->mainmodel->fetch_rec_by_args('chating_customer', $args);
			foreach ($chat_message as $chat_msg) {
				$jsonArr = array('is_error' => 'no', 'user_id'=>$chat_msg->user_id, 
					'user_message'=>$chat_msg->message, 'user_time' => $chat_msg->time, 'uername'=>$chat_msg->sent_by);
			}
			
		}else{
			$jsonArr = array('is_error'=>'yes','Something went Wrong');
		}
		echo json_encode($jsonArr);
	}

	//Delivery Boy Ratings
	public function rating_delivery_boy($order_id){
		$args  = [
			'order_id'  => $order_id
		];
		$data['ratings'] = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/rating_delivery_boy', $data);
	}

	public function update_deliboy_rating($id){
		if (!(session()->has('loggedin_user') || session()->has('google_user'))) {
			return redirect()->to(base_url()."/Home/login_register");
		}else{
			$user_id    = $this->get_login_user_details();
			$deliboy_rate  = $this->request->getVar('deliboy_rate');
			$order_id   = $this->request->getVar('order_id');
			$data = [
				'delivery_boy_id' => $id,
				'rating'          => $deliboy_rate,
				'user_id'         => $user_id,
				'order_id'        => $order_id,
				'date'            => date('Y-m-d h:i:s')
			];
			$status = $this->mainmodel->Insertdata('delivery_boy_rating', $data);
		}
	}

	public function type_your_review($order_id){
		$args = [
			'order_id'  => $order_id
		];
		$data = [
			'review'  => $this->request->getVar('type_your_review')
		];
		$status = $this->mainmodel->update_rec_by_args('delivery_boy_rating', $args, $data);
		if ($status == true) {
			$this->session->setTempdata('success', 'Thanks for your Feedback', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry !Unable to Response ?', 3);
		}
		return redirect()->to(base_url().'/Home/rating_delivery_boy/'.$order_id);
	}

	public function get_offer(){
		$args = [
			'status'      => 'Active',
			'expiry_on>=' => date('Y-m-d')
		];
		$data['coupon_master'] = $this->mainmodel->fetch_rec_by_args_products('coupon_master',$args);
		$data['carts_pro'] = $this->get_session_carts_details();
		return view('Home/get_offer', $data);
	}

	
	//Delivery Boy Ratings
	//-------------------------------LOGOUT-------------------------------------
	public function logout_users_account(){
		if(session()->has("loggedin_user") || session()->has('google_user')){

		}
		session()->remove('loggedin_user');
		session()->remove('google_user');
		session()->destroy();
		return redirect()->to(base_url()."/Home/login_register");
	}

}
