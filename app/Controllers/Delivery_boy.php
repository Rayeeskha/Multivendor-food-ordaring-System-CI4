<?php namespace App\Controllers;
use \App\Models\Login_model;
use \App\Models\Main_model;

class Delivery_boy extends BaseController
{
	public $session;
	public function __construct(){
		helper(['form','Admin_helper','text','date','time']);
		$this->loginModel = new Login_model();
		$this->mainmodel  = new Main_model();
		$this->session   = session();
		$this->email = \Config\Services::email();
		
	}

	public function index(){
		$data['validation'] = null;
		return view('Delivery_boy/index', $data);
	}

	public function dashboard(){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}else{
			// echo $this->session->get('deliboyimage');
			// echo $this->session->get('delivery_boy_id');
			$args = [
				'order_date'   => date('Y-m-d'),
                'pinCode'      => $this->session->get('deliboypincode'),
                'order_status' => 'Accept'
			];
			$data['pending_order'] = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			$args = [
				'pinCode'      => $this->session->get('deliboypincode'),
				'order_status' => 'Cancel'
			];
			$data['cancel_order'] = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			$args = [
				'pinCode'      => $this->session->get('deliboypincode'),
			];
			$data['total_order'] = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			//Dshboard Chart Callback Function 
			$data['chart_data'] = $this->get_order_charts_reports();
			//Dshboard Chart Callback Function 
			return view('Delivery_boy/dashboard', $data);
		}
	}

	public function order_master(){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}else{
			$args = [
				'delivery_boy_id'    => $this->session->get('delivery_boy_id')
			];
			$data['order_master'] = $this->mainmodel->fetch_rec_by_args_products('order_master', $args);
			return view('Delivery_boy/order_master', $data);
		}
	}

	public function view_order($order_id){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}else{
			$args = [
				'order_id'  => $order_id
			];
			$data['view_order'] = $this->mainmodel->fetch_rec_by_args_products('order_master', $args);
			return view('Delivery_boy/view_order', $data);
		}
	}

	public function print_order($order_id){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}else{
			$args = [
				'order_id'  => $order_id
			];
			$data['print_order'] = $this->mainmodel->fetch_rec_by_args_products('order_master', $args);
			return view('Delivery_boy/print_order', $data);
		}
	}

	public function order_ringtone_open(){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}else{
			$args = [
				'order_date'      => date('Y-m-d'),
				'order_status'    => 'Accept',
				'pinCode'         =>  $this->session->get('deliboypincode'),
				'delivery_boy_id' => '0',
			];
			$status = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			$arr = array();
			if ($status) {
				$arr = array("sound" => 'yes');
			}else{
				$arr = array("sound" => 'no');
			}
			echo json_encode($arr);
		}
	}



	public function accept_order($order_id){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}else{
			$args = [
				'order_id'  => $order_id
			];

			$data = [
				'delivery_boy_id'  => $this->session->get('delivery_boy_id')
			];

			$status = $this->mainmodel->update_rec_by_args('order_master', $args, $data);
			if ($status == true) {
				$deli_id = $this->session->get('delivery_boy_id');
				get_latitude_and_logitude_according_to_order($order_id, $deli_id);
				$this->session->setTempdata('success', 'Congratulation ! Order Accept  Successfully !', 3);
			}else{
				$this->session->setTempdata('error', 'Sorry ! Unable to  Accept  Order  Try Again ?', 3);
			}
			return redirect()->to(base_url().'/Delivery_boy/view_order/'.$order_id);
		}	
	}


	public function delivered_order($order_id){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}

		$args = [
			'order_id'         => $order_id,
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];

		$data = [
			'order_status'   => 'Delivered',
			'payment_status' => 'SUCCESS',
			'delivered_on'   => date('Y-m-d h:i:s')
		];
		$status =  $this->mainmodel->update_rec_by_args('order_master', $args, $data);
		if ($status == true) {
			$deliboy_id = $this->session->get('delivery_boy_id');
			$get_web_wallet  = get_website_settings();
			if ($get_web_wallet[0]->deliBoyPerOrderAmt !== "0") {
				$wallet_amount = $get_web_wallet[0]->deliBoyPerOrderAmt;
				manage_delivery_boy_wallet($deliboy_id,$wallet_amount,'In','Delivered Order Amount');
			}
			$this->session->setTempdata('success', 'Congratulation !Order Delivered  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to  Deliveryed Order  Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Delivery_boy/view_order/'.$order_id);
	}


	public function order_reports(){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}
		$args = [
			'order_status'  => 'Delivered',
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$data['sale_reports'] = $this->mainmodel->fetch_all_sales('order_master',$args);
		return view('Delivery_boy/order_reports', $data);
	}

	public function search_sales(){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}
		$args = [
			'order_status'  => 'Delivered',
			'order_date>='  => $this->request->getVar('start_date'),
			'order_date<='  => $this->request->getVar('last_date'),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$data['sale_reports'] = $this->mainmodel->fetch_all_sales('order_master',$args);
		return view('Delivery_boy/order_reports', $data);
	}

	public function view_wallate_details(){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}else{
			return view('Delivery_boy/view_wallate_details');
		}
	}

	public function track_users($order_id){
		$data['trach_user'] = get_order_location($order_id);
		return view('Delivery_boy/trach_user', $data);
	}



	//Dashboard Section Script Chart Data Start
	public function get_order_charts_reports(){
		if (!(session()->has('loggedin_delivery_boy'))) {
			return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
		}
		$args  = [
			'order_date'   => date('Y-m-d'),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$today_orders_data  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-1 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$yesterday_orders_data  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-2 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_3days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-3 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_4days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-4 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_5days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-5 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_6days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-6 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_7days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-7 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_8days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-8 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_9days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-9 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_10days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-10 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_11days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-11 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_12days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-12 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_13days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-13 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_14days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-14 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_15days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-15 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_16days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-16 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_17days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-17 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_18days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-18 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_19days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-19 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_20days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-20 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_21days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-21 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_22days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-22 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_23days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-23 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_24days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-24 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_25days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-25 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_26days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-26 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_27days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-27 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_28days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-28 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_29days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-29 day")),
			'delivery_boy_id'  => $this->session->get('delivery_boy_id')
		];
		$last_30days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);


	
		$chart_data  = [
			'ch_today_order'         => $today_orders_data ? count($today_orders_data):'0',
			'ch_yesterday_order'     => $yesterday_orders_data ? count($yesterday_orders_data):'0',
			'ch_last_3_days_order'   => $last_3days_orders ? count($last_3days_orders) : '0',
			'ch_last_4_days_order'   => $last_4days_orders ? count($last_4days_orders) : '0',
			'ch_last_5_days_order'   => $last_5days_orders ? count($last_5days_orders) : '0',
			'ch_last_6_days_order'   => $last_6days_orders ? count($last_6days_orders) : '0',
			'ch_last_7_days_order'   => $last_7days_orders ? count($last_7days_orders) : '0',
			'ch_last_8_days_order'   => $last_8days_orders ? count($last_8days_orders): '0',
			'ch_last_9_days_order'   => $last_9days_orders ? count($last_9days_orders): '0',
			'ch_last_10_days_order'  => $last_10days_orders ? count($last_10days_orders): '0',
			'ch_last_11_days_order'  => $last_11days_orders ? count($last_11days_orders): '0',
			'ch_last_12_days_order'  => $last_12days_orders ? count($last_12days_orders): '0',
			'ch_last_13_days_order'  => $last_13days_orders ? count($last_13days_orders): '0',
			'ch_last_14_days_order'  => $last_14days_orders ? count($last_14days_orders): '0',
			'ch_last_15_days_order'  => $last_15days_orders ? count($last_15days_orders): '0',
			'ch_last_16_days_order'  => $last_16days_orders ? count($last_16days_orders): '0',
			'ch_last_17_days_order'  => $last_17days_orders ? count($last_17days_orders): '0',
			'ch_last_18_days_order'  => $last_18days_orders ? count($last_18days_orders): '0',
			'ch_last_19_days_order'  => $last_19days_orders ? count($last_19days_orders): '0',
			'ch_last_20_days_order'  => $last_20days_orders ? count($last_20days_orders): '0',
			'ch_last_21_days_order'  => $last_21days_orders ? count($last_21days_orders): '0',
			'ch_last_22_days_order'  => $last_22days_orders ? count($last_22days_orders): '0',
			'ch_last_23_days_order'  => $last_23days_orders ? count($last_23days_orders): '0',
			'ch_last_24_days_order'  => $last_24days_orders ? count($last_24days_orders): '0',
			'ch_last_25_days_order'  => $last_25days_orders ? count($last_25days_orders): '0',
			'ch_last_26_days_order'  => $last_26days_orders ? count($last_26days_orders): '0',
			'ch_last_27_days_order'  => $last_27days_orders ? count($last_27days_orders): '0',
			'ch_last_28_days_order'  => $last_28days_orders ? count($last_28days_orders): '0',
			'ch_last_29_days_order'  => $last_29days_orders ? count($last_29days_orders): '0',
			'ch_last_30_days_order'  => $last_30days_orders ? count($last_30days_orders): '0'
		];
		return $chart_data;
	} 
//Dashboard Section Script Chart Data End




	public function logout_account(){
		if (session()->has('loggedin_delivery_boy')) {
		}
		session()->remove('loggedin_delivery_boy');
		session()->destroy();
		return redirect()->to(base_url()."/Login/login_delivery_boyaccount");
	}







}