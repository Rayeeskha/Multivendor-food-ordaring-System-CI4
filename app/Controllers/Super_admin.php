<?php namespace App\Controllers;
use \App\Models\Main_model;

class Super_admin extends BaseController
{
	public $session;
	public $mainmodel;
	public function __construct(){
		
		// helper(['form','Admin_helper','text','date','time']);
		$this->mainmodel  = new Main_model();
		$this->session   = session();
		$this->email = \Config\Services::email();
	}
	public function index() {
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['weather_data'] = null;
			$user_id = session()->get('loggedin_user');
			$data['userdata'] = $this->mainmodel->get_logged_in_user_data('admin_login',$user_id);
			//Dahboard Schart Script Start 

			$data['chart_data'] = $this->get_order_charts_reports();
			//Dahboard Schart Script End
			return view('Admin/dashboard', $data);
		}
	}




	public function add_category(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data  = [];
			$data['validation'] = null;
			if ($this->request->getMethod() == 'post') {

				$rules = [
						'order_number'  => [
						'rules'  => 'required',
						'errors'    => [
							'required' => 'Order Number is Manidatory'
						],
					],
					'category'  => [
						'rules'   => 'required|is_unique[category_master.category]',
						'errors'  => [
							'required'     => 'Category is Required',
							'is_unique'    => 'Category is Already Added Please Pickup another',
						],
					],
				];
				if($this->validate($rules)){
					$data = [
						'category'      => $this->request->getVar('category',FILTER_SANITIZE_STRING),
						'order_number'  => $this->request->getVar('order_number',FILTER_SANITIZE_STRING),
						'status'        => 'Active',
						'created_date'  => date('Y-m-d h:i:s')
					];
					$status= $this->mainmodel->Insertdata('category_master', $data);
					if ($status == true) {
						$this->session->setTempdata('success', 'Congratulation ! Category Added Successfully !', 3);
					}else{
						$this->session->setTempdata('error', 'Sorry ! Unable to Add Category Try Again ?', 3);
					}
					return redirect()->to(base_url().'/Super_admin/manage_category');
				}else{
					$data['validation'] = $this->validator;
				}
				$data['category'] = $this->mainmodel->fetch_all_records('category_master');
				$data['chart_data'] = $this->get_order_charts_reports();
				return view('Admin/manage_category', $data);
			}
		}
	}

	public function manage_category(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['validation'] = null;
			$data['category'] = $this->mainmodel->fetch_all_records('category_master');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/manage_category', $data);
		}
	}
	public function change_category_status($id, $status){
		$args = [
			'id'  => $id
		];
		$data = [
			'status'  => $status
		];
		$status = $this->mainmodel->update_rec_by_args('category_master', $args, $data);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Category Status Change Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Change Category Status Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_category');
	}

	public function edit_category_details($id){
		$args = [
			'id'  => $id
		];
		$data['category'] = $this->mainmodel->fetch_rec_by_args('category_master', $args);
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/edit_category', $data);
	}

	public function update_category($id){
		$args= [
			'id'  => $id
		];
		$data = [
			'category'  =>  $this->request->getVar('category',FILTER_SANITIZE_STRING),
			'order_number'  =>  $this->request->getVar('order_number',FILTER_SANITIZE_STRING),
		];
		$status = $this->mainmodel->update_rec_by_args('category_master', $args, $data);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Category Updated  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Updated Category Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_category');
	}

	public function delete_category($id){
		$args = [
			'id'  => $id
		];
		$status = $this->mainmodel->delete_records('category_master', $args);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Category Deleted  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Deleted Category Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_category');
	}

	public function manage_users(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['users'] = $this->mainmodel->fetch_all_records('users_master');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/manage_users', $data);
		}
	}

	public function manage_delivery_boy(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['validation'] = null;
			$data['delivery_boy'] = $this->mainmodel->fetch_all_records('delivery_boy_master');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/manage_delivery_boy', $data);
		}
	}


	public function filter_deli_boy($filter){
		$data['validation'] = null;
		if ($filter == 'new_verification') {
			$args = [
				'status'   => 'AdminVerification'
			];
			$order = [
				'column_name'  => 'id',
				'order'        => 'desc'
			];
		}else if ($filter == 'old_verification') {
			$args = [
				'status'   => 'AdminVerification'
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
		$data['delivery_boy'] = $this->mainmodel->filter_rec_by_args_with_type('delivery_boy_master', $order, $args);
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/manage_delivery_boy', $data);
	}




	public function add_delivery_boy(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data = [];
			$data['validation'] = null;
			if ($this->request->getMethod() == 'post') {
				$rules = [
					'name'             => 'required',
					'password'         => 'required|min_length[4]|max_length[20]',
					'mobile'           => 'required|numeric|exact_length[10]|is_unique[delivery_boy_master.mobile]',
					'aadhar_number'    => 'required|exact_length[12]',
					'email'            => 'required|valid_email|is_unique[delivery_boy_master.email]',
					'pincode'          => 'required',
					'state'            => 'required',
					'city'             => 'required',
				];
				if ($this->validate($rules)) {
					$data = [
						'name'            => $this->request->getVar('name',FILTER_SANITIZE_STRING),
						'email'           => $this->request->getVar('email',FILTER_SANITIZE_STRING),
						'mobile'          => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
						'aadhar_number'   => $this->request->getVar('aadhar_number',FILTER_SANITIZE_STRING),
						'pincode'         => $this->request->getVar('pincode',FILTER_SANITIZE_STRING),
						'state'           => $this->request->getVar('state',FILTER_SANITIZE_STRING),
						'city'            => $this->request->getVar('city',FILTER_SANITIZE_STRING),
						'password'        => md5($this->request->getVar('email',FILTER_SANITIZE_STRING)),
						'status'          => 'Active',
						'added_date'      => date('Y-m-d h:i:s')
					];
					$status = $this->mainmodel->Insertdata('delivery_boy_master', $data);
					if ($status == true) {
						$this->session->setTempdata('success', 'Congratulation ! Delivery Boy Added  Successfully !', 3);
					}else{
						$this->session->setTempdata('error', 'Sorry ! Unable to Add Deliver Boy Try Again ?', 3);
					}
					return redirect()->to(base_url().'/Super_admin/manage_delivery_boy');
				}else{
					$data['validation'] = $this->validator;
				}
				$data['delivery_boy'] = $this->mainmodel->fetch_all_records('delivery_boy_master');
				$data['chart_data'] = $this->get_order_charts_reports();
				return view('Admin/manage_delivery_boy', $data);
			}
		}
	}

	public function change_delivery_boy_status($id, $status){
		$args = [
			'id'  => $id
		];
		$data = [
			'status'  => $status
		];
		$status = $this->mainmodel->update_rec_by_args('delivery_boy_master', $args, $data);
		if ($status == true) {
			$args = [
				'id'  => $id
			];
			$deli = $this->mainmodel->fetch_rec_by_args('delivery_boy_master', $args);
			if ($deli[0]->status == 'Active') {
				$invice = $this->send_verifi_invoice_invoce($deli[0]->email,$deli[0]->name);
				if ($invice) {
					$this->session->setTempdata('success', 'Congratulation ! Delivery Boy Account Verified Successfully !', 3);
				}else{
					$this->session->setTempdata('error', 'Failed ! Delivery Boy Account Not Verified !', 3);
				}
			}
			
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Change Deliver Boy Status Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_delivery_boy');
	}


	public function send_verifi_invoice_invoce($email, $name){
		$subject   = 'Congratulation !  - Account Verified Successfully';
		$message   = 'Hi ' .$name.",<br><br>Thanks Your Account is Verified Successfully,  <br> Please Login your Account and Start your Journey<br><br><br>Thanks<br>khan Rayees Team"; 
		$this->email->setTo($email);
		$this->email->setFrom('khanrayeesq121@gmail.com', 'Food Ordaring System');
		$this->email->setSubject($subject);
		$this->email->setMessage($message);
		$filepath = 'public/images/ff.png';
		$this->email->attach($filepath);
		if ($this->email->send()) {
			return true;
		}else{
			return false;
		}
	}

	public function delete_Delivery_boy($id){
		$args = [
			'id'  => $id
		];
		$status = $this->mainmodel->delete_records('delivery_boy_master', $args);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Delivery Boy Deleted  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Deleted Delivery Boy Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_delivery_boy');
	}

	public function edit_delivery_boy($id){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$args = [
				'id'  => $id
			];
			$data['delivery_boy'] = $this->mainmodel->fetch_rec_by_args('delivery_boy_master', $args);
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/edit_delivery_boy', $data);
		}
	}

	public function update_delivery_boy($id){
		$args = [
			'id' => $id
		];
		$data = [
			'name'            => $this->request->getVar('delivery_boy',FILTER_SANITIZE_STRING),
			'email'           => $this->request->getVar('email',FILTER_SANITIZE_STRING),
			'mobile'          => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
			'aadhar_number'   => $this->request->getVar('aadhar_number',FILTER_SANITIZE_STRING),
			'pincode'         => $this->request->getVar('pincode',FILTER_SANITIZE_STRING),
			'state'           => $this->request->getVar('state',FILTER_SANITIZE_STRING),
			'city'            => $this->request->getVar('city',FILTER_SANITIZE_STRING),
			'status'          => 'Active',
			'added_date'      => date('Y-m-d h:i:s')
		];
		$status = $this->mainmodel->update_rec_by_args('delivery_boy_master', $args, $data);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Delivery Boy Updated  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Updated Delivery Boy Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_delivery_boy');
	}

	public function filter_users($filter){
		if ($filter == 'new_users') {
			$order = [
				'column_name'  => 'id',
				'order'        => 'desc'
			];
		}else if ($filter == 'old_users') {
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
		$data['users'] = $this->mainmodel->filter_rec_by_args('users_master', $order);
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/manage_users', $data);
	}

	public function change_users_status($id, $status){
		$args = [
			'id'  => $id
		];
		$data = [
			'status'  => $status
		];
		$status = $this->mainmodel->update_rec_by_args('users_master', $args, $data);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Users Status Change  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Change Users Status Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_users');
	}

	public function delete_users($id){
		$args = [
			'id'  => $id
		];
		$status = $this->mainmodel->delete_records('users_master', $args);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Users Deleted  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Delete Users Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_users');
	}

	public function coupon_master(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['validation'] = null;
			$data['coupons'] = $this->mainmodel->fetch_all_records('coupon_master');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/coupon_master', $data);
		}
	}

	public function add_coupon_code(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data  = [];
			$data['validation'] = null;
			if ($this->request->getMethod() == 'post') {
				$rules = [
						'couponCode'  => [
						'rules'  => 'required|is_unique[coupon_master.coupon_code]',
						'errors'    => [
							'required' => 'Coupon Code is Manidatory',
							'is_unique'    => 'Coupon Code is Already Exists',
						],
					],
					'coupon_type'  => [
						'rules'   => 'required',
						'errors'  => [
							'required'     => 'Coupon Type is Required'
						],
					],
					'coupon_value'  => [
						'rules'   => 'required',
						'errors'  => [
							'required'     => 'Coupon Value is Required'
						],
					],
					'cart_min_value'  => [
						'rules'   => 'required',
						'errors'  => [
							'required'     => 'Cart Min Value is Required'
						],
					],
					'expiry_date'  => [
						'rules'   => 'required',
						'errors'  => [
							'required'     => 'Expiry date is Required'
						],
					],
				];
				if ($this->validate($rules)) {
					$data= [
						'coupon_code'      => $this->request->getVar('couponCode',FILTER_SANITIZE_STRING),
						'coupon_type'      => $this->request->getVar('coupon_type',FILTER_SANITIZE_STRING),
						'coupon_value'     => $this->request->getVar('coupon_value',FILTER_SANITIZE_STRING),
						'cart_min_value'   => $this->request->getVar('cart_min_value',FILTER_SANITIZE_STRING),
						'expiry_on'        => $this->request->getVar('expiry_date',FILTER_SANITIZE_STRING),
						'added_on'         => date('Y-m-d h:i:s'),
						'status'           => 'Active',
						'restaurent_id'    => '0'
					];
					$status = $this->mainmodel->Insertdata('coupon_master', $data);
					if ($status == true) {
						$this->session->setTempdata('success', 'Congratulation !Coupon Added Successfully !', 3);
					}else{
						$this->session->setTempdata('error', 'Sorry ! Unable to Add Coupon Try Again ?', 3);
					}
					return redirect()->to(base_url().'/Super_admin/coupon_master');

				}else{
					$data['validation'] = $this->validator;
				}
				$data['coupons'] = $this->mainmodel->fetch_all_records('coupon_master');
				$data['chart_data'] = $this->get_order_charts_reports();
				return view('Admin/coupon_master', $data);
			} 
		}
	}

	public function change_coupon_status($id, $status){
		$args = [
			'id'  => $id
		];
		$data = [
			'status'  => $status
		];
		$status = $this->mainmodel->update_rec_by_args('coupon_master', $args, $data);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation !Coupon Status Change Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Change Coupon Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/coupon_master');
	}

	public function delete_coupn_master($id){
		$args = [
			'id'  => $id
		];
		$status = $this->mainmodel->delete_records('coupon_master', $args);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation !Coupon Deleted  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Deleted Coupon Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/coupon_master');
	}

	public function dish_master(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['validation'] = null;
			$data['dish_master'] = $this->mainmodel->fetch_all_records('dish_master');
			$data['category']   = $this->mainmodel->fetch_all_records('category_master');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/dish_master', $data);
		}
	}

	public function change_dish_status($id, $status){
		$args = [
			'id'  => $id
		];
		$data = [
			'status'  => $status
		];
		$status = $this->mainmodel->update_rec_by_args('dish_master', $args, $data);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Dish Status Change  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Change Dish Status Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/dish_master');
	}

	public function delete_dish($id){
		$args = [
			'id'  => $id
		];
		$dish_img = $this->mainmodel->fetch_rec_by_args('dish_master', $args);
		//delete image in folder
			unlink('public/uploads/dish_image/' .$dish_img[0]->image);
		//delete image in folder
		$status = $this->mainmodel->delete_records('dish_master', $args);
		if ($status == true) {
			$this->session->setTempdata('success', 'Congratulation ! Dish Deleted  Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Deleted Dish Try Again ?', 3);
		}
		return redirect()->to(base_url().'/Super_admin/dish_master');
	}

	public function upload_dish(){
		$data = [];
		$data['validation'] = null;
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'title'       => 'required',
				'dish_type'       => 'required',
				'category'         => 'required',
				'discription'         => 'required|min_length[4]|max_length[120]',
				'avatar' => [
	                'uploaded[avatar]',
	                'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]',
	                'max_size[avatar,4096]',
	            ],
			];
			if ($this->validate($rules)) {
				$dataInfo = array();
				if($imagefile = $this->request->getFileMultiple('avatar')) {
				    foreach($imagefile as $img) {
				      if ($img->isValid() && ! $img->hasMoved()){
				           $newName = $img->getRandomName();
				           $img->move('./public/uploads/dish_image', $newName); 
				           $dataInfo[] =  $img->getName();
				      }else{
				      	echo $file->getErrorString().'('.$file->getError().')';
				      }
				    }

                if (count($dataInfo) == 4) {
					$data = [
	                	'dish_title'      =>  $this->request->getVar('title',FILTER_SANITIZE_STRING),
	                	'dish_type'       =>  $this->request->getVar('dish_type',FILTER_SANITIZE_STRING),
	                	'category_id'     =>  $this->request->getVar('category',FILTER_SANITIZE_STRING),
	                	'dish_details'    =>  $this->request->getVar('discription',FILTER_SANITIZE_STRING),
	                	'image'           => $dataInfo[0],
						'image_two'       => $dataInfo[1],
						'image_three'     => $dataInfo[2],
						'image_four'      => $dataInfo[3],
	                	'status'          => 'Active',
	                	'added_on'        => date('Y-m-d h:i:s'),
	                	'restaurent_id'   => '0'
	                ];
	                $status = $this->mainmodel->Insertdata_return_id('dish_master', $data);
	                if ($status == true) {
	                	$attributeArr = $this->request->getVar('attribute',FILTER_SANITIZE_STRING);
						$priceArr     = $this->request->getVar('price',FILTER_SANITIZE_STRING);
						foreach ($attributeArr as $key => $val) {
							$data = [
								'attribute'  => $val,
							    'price'      => $priceArr[$key],
							    'dish_id'    => $status,
							    'status'     => 'Active',
							    'added_on'   => date('Y-m-d h:i:s')
							];
							$this->mainmodel->Insertdata('dish_details', $data);
						}
							$this->session->setTempdata('success', 'Congratulation ! Dish Uploded Successfully !', 3);
					}else{
						$this->session->setTempdata('error', 'Sorry ! Unable to Upload Dish Try Again ?', 3);
					}
					return redirect()->to(base_url().'/Super_admin/dish_master');
				}else{
				   	$this->session->setTempdata('error', 'Sorry ! Unable to Upload Please Select minimum Four Images', 3);
				}
				   	return redirect()->to(base_url().'/Super_admin/dish_master');
				 }
			}else{
				$data['validation'] = $this->validator;
			}
			$data['dish_master'] = $this->mainmodel->fetch_all_records('dish_master');
			$data['category']   = $this->mainmodel->fetch_all_records('category_master');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/dish_master', $data);
		}
	}

	public function edit_dish_details($id){
		$args = [
			'id'  => $id
		];
		$data['dish'] = $this->mainmodel->fetch_rec_by_args('dish_master', $args);
		$data['category']   = $this->mainmodel->fetch_all_records('category_master');
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/edit_dish_details', $data);
	}

	public function update_dish_details($id){
		$args = [ 'id'   => $id ];
		$image = $this->request->getFile('avatar');
		if ($image->isValid() &&  !$image->hasMoved()) {
			$old_data = $this->mainmodel->fetch_rec_by_args('dish_master', $args);
			//delete old  image
			unlink('public/uploads/dish_image/'. $old_data[0]->image);
			//delete old  image
			$newName = $image->getRandomName();
			$image->move('./public/uploads/dish_image', $newName); 
	        $dis_img = $image->getName();

	        $data = [
		        'dish_title'      =>  $this->request->getVar('dish_title',FILTER_SANITIZE_STRING),
		        'category_id'     =>  $this->request->getVar('category',FILTER_SANITIZE_STRING),
		        'dish_details'    =>  $this->request->getVar('dish_details',FILTER_SANITIZE_STRING),
		        'dish_type'       =>  $this->request->getVar('dish_type',FILTER_SANITIZE_STRING),
		        'image'           =>  $dis_img,
		        'status'          => 'Active',
		        'added_on'        => date('Y-m-d h:i:s'),
		        'restaurent_id'   => '0'
		    ];
		    $status = $this->mainmodel->update_rec_by_args('dish_master', $args, $data);
		    if ($status) {
		    	 //Logic if Attribute is already Taken Data Inserted other wise data Deleted
	        	$attributeArr = $this->request->getVar('attribute',FILTER_SANITIZE_STRING);
				$priceArr     = $this->request->getVar('price',FILTER_SANITIZE_STRING);
				$dish_id     = $this->request->getVar('dish_id',FILTER_SANITIZE_STRING);
				$dish_details_idArr     = $this->request->getVar('dish_details_id',FILTER_SANITIZE_STRING);
				foreach ($attributeArr as $key => $val) {
					if (isset($dish_details_idArr[$key])) {
						$args = [
							'id' => $dish_details_idArr[$key]
						];
						$data = [
							'attribute'  => $val,
							'price'      => $priceArr[$key],
							'dish_id'    => $dish_id,
							'status'     => 'Active',
							'added_on'   => date('Y-m-d h:i:s')
						];
						$this->mainmodel->update_rec_by_args('dish_details',$args, $data);
					}else{
						$data = [
							'attribute'  => $val,
							'price'      => $priceArr[$key],
							'dish_id'    => $dish_id,
							'status'     => 'Active',
							'added_on'   => date('Y-m-d h:i:s')
						];
						$this->mainmodel->Insertdata('dish_details', $data);
					}
				}
			    //Logic if Attribute is already Taken Data Inserted other wise data Deleted
				$this->session->setTempdata('success', 'Congratulation ! Dish Updated Successfully !', 3);
		    }else{
		    	$this->session->setTempdata('error', 'Sorry ! Unable to Updated Dish Try Again ?', 3);
		    }

		    return redirect()->to(base_url().'/Super_admin/dish_master');	
		}else{
	    	echo $image->getErrorString(). " " .$image->getError();
	    }
	}

	public function filter_dish($filter){
		$data['validation'] = null;
		if ($filter == 'veg') {
			$args = [
				'dish_type'  => 'Veg'
			];
			$order = [
				'column_name'  => 'dish_type',
				'order'        => 'desc'
			];
		}else if ($filter == 'non_veg') {
		    $args = [
				'dish_type'  => 'Non-Veg'
			];
			$order = [
				'column_name'  => 'dish_type',
				'order'        => 'asc'
			];
		}else{
			$order = [
				'column_name'  => 'dish_type',
				'order'        => 'desc'
			];
		}
		$data['dish_master'] = $this->mainmodel->filter_rec_by_args_with_type('dish_master', $order,$args);
		$data['category']   = $this->mainmodel->fetch_all_records('category_master');
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/dish_master', $data);
	}
	public function delete_attribute($id){
		$args = [
			'id'  => $id
		];
		$status = $this->mainmodel->delete_records('dish_details', $args);
		$jsonArr = array();
		if ($status) {
			$jsonArr = array('is_error' => 'no',  'dd'=> 'Attribute Deleted Successfully');
		}else{
			$jsonArr = array('is_error' => 'yes',  'dd'=> 'Attribute Not Deleted');
		}
		echo json_encode($jsonArr);
	}

	public function manage_slider(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['validation'] = null;
			$data['chart_data'] = $this->get_order_charts_reports();
			$data['slider_image'] = $this->mainmodel->fetch_all_records('slider_image');
			return view('Admin/manage_slider', $data);
		}
	}

	public function upload_slider(){
		$data = [];
		$data['validation'] = null;
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'heading'       => 'required',
				'subtitle'       => 'required',
				'avatar' => [
	                'uploaded[slider]',
	                'mime_in[slider,image/jpg,image/jpeg,image/gif,image/png]',
	                'max_size[slider,4096]',
	            ],
			];
			if ($this->validate($rules)) {
				$dataInfo = array();
				if($imagefile = $this->request->getFileMultiple('slider')) {
				    foreach($imagefile as $img) {
				      if ($img->isValid() && ! $img->hasMoved()){
				           $newName = $img->getRandomName();
				           $img->move('./public/uploads/sliders', $newName); 
				           $dataInfo[] =  $img->getName();
				      }else{
				      	echo $file->getErrorString().'('.$file->getError().')';
				      }
				    }
				    // print_r($dataInfo);
				    // die();
                	if (count($dataInfo) == 2) {
						$data = [
		                	'heading'      =>  $this->request->getVar('heading',FILTER_SANITIZE_STRING),
		                	'subtitle'       =>  $this->request->getVar('subtitle',FILTER_SANITIZE_STRING),
		                	'image'           => $dataInfo[0],
							'image_two'       => $dataInfo[1],
							'status'          => 'Active',
		                	'added_on'        => date('Y-m-d h:i:s')
		                ];
		                $status = $this->mainmodel->Insertdata('slider_image', $data);
		                if ($status == true) {
		                	$this->session->setTempdata('success', 'Congratulation ! Slider Image Uploded Successfully !', 3);
						}else{
							$this->session->setTempdata('error', 'Sorry ! Unable to Upload Slider Try Again ?', 3);
						}
						return redirect()->to(base_url().'/Super_admin/manage_slider');
					}else{
					   	$this->session->setTempdata('error', 'Sorry ! Unable to Upload Please Select  Two  Images', 3);
					}
				}
				return redirect()->to(base_url().'/Super_admin/manage_slider');
			}else{
				$data['validation'] = $this->validator;
			}
			
			$data['slider_image'] = $this->mainmodel->fetch_all_records('slider_image');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/manage_slider', $data);
		}
	}

	public function change_slider_status($id, $status){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
		$args = [
			'id'  => $id
		];
		$data = [
			'status'  => $status
		];
		$status = $this->mainmodel->update_rec_by_args('slider_image', $args, $data);
		if ($status) {
			$this->session->setTempdata('success', 'Congratulation ! Slider Status Change Successfully', 3);
		}else{
			$this->session->setTempdata('error', 'Sorry ! Unable to Change Status', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_slider');
	}

	public function delete_slider_images($id){
		$args = [
			'id'   => $id
		];
		$status = $this->mainmodel->delete_records('slider_image', $args);
		if ($status) {
			$this->session->setTempdata('success', 'Congratulation ! Slider Deleted Successfully', 3);
		}else{
			$this->session->setTempdata('error', 'Failed ! Sorry Unable to Deleted ', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_slider');
	}

	public function edit_slider($id){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
		$args = [
			'id'  => $id
		];
		$data['edit_slider'] = $this->mainmodel->fetch_rec_by_args('slider_image', $args);
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/edit_slider', $data);
	}

	public function update_slider_details($id){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
		$args = [
			'id'  => $id
		];

		//Image One Uploded Query
		$image_one = $this->request->getFile('image_one');
		$newNameimg1 = $image_one->getRandomName();
		$image_one->move('./public/uploads/sliders', $newNameimg1); 
	    $img_one_path = $image_one->getName();
	   
	    //Image Two Uploded Query
	    $image_two = $this->request->getFile('image_two');
	   	$newNameimg2 = $image_two->getRandomName();
		$image_two->move('./public/uploads/sliders', $newNameimg2); 
	    $img_two_path = $image_two->getName();

	    $data =  [
	    	'heading'   => $this->request->getVar('heading'),
	    	'subtitle'  => $this->request->getVar('subtitle'),
	    	'image'     => $img_one_path,
	    	'image_two' =>  $img_two_path,
	    	'status'    => 'Active',
	    	'added_on'  => date('Y-m-d h:i:s')
	    ];

	    $status = $this->mainmodel->update_rec_by_args('slider_image', $args, $data );
	    if ($status) {
	    	$this->session->setTempdata('success', 'Congratulation ! Slider Updated Successfully', 3);
	    }else{
	    	$this->session->setTempdata('error', 'Failed ! Sorry Unable to Updated', 3);
	    }
	    return redirect()->to(base_url().'/Super_admin/manage_slider');
	}

	public function order_master(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
		$data['validation'] = null;
		$data['order_master'] = $this->mainmodel->fetch_all_records('order_master');
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/order_master', $data);
	}

	public function filter_orders($filter){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
	
		if ($filter == 'pending_order') {
			$args = [
				'order_status'   => 'Pending'
			];
			$order = [
				'column_name'  => 'id',
				'order'        => 'desc'
			];
		}else if ($filter == 'processing_order') {
			$args = [
				'order_status'   => 'Accept'
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
		$data['validation'] = null;
		$data['order_master'] = $this->mainmodel->filter_rec_by_args_with_type('order_master', $order, $args);
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/order_master', $data);
	}



	public function add_order_status(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data = [];
			if ($this->request->getMethod() == 'post') {
				$rules = [
					    'order_status'  => [
						'rules'  => 'required|is_unique[order_status.order_status]',
						'errors'    => [
							'required'   => 'Order Status is Manidatory',
							'is_unique'  => 'Order Status is Already declaire'
						],
					],
				];
				if ($this->validate($rules)) {
					$data = [
						'order_status'  => $this->request->getVar('order_status',FILTER_SANITIZE_STRING)
					];
					$status = $this->mainmodel->Insertdata('order_status', $data);
					if ($status) {
			    		$this->session->setTempdata('success', 'Congratulation ! Order Status Added Successfully', 3);
				    }else{
				    	$this->session->setTempdata('error', 'Failed ! Sorry Unable to Add Order Status', 3);
				    }
				    return redirect()->to(base_url().'/Super_admin/order_master');
				}else{
					$data['validation']  = $this->validator;
				}
			}
			$data['order_master'] = $this->mainmodel->fetch_all_records('order_master');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/order_master', $data);
		}
		
	}

	public function view_order_details($order_id){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
		$args = [
			'order_id'  => $order_id
		];
		$data['ord_details'] = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$data['order_status'] = $this->mainmodel->fetch_order_status('order_status');
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/view_order_details', $data);
	}


	public function accept_order($order_id, $status){
		$args = [
			'order_id'  => $order_id
		];
		$data = [
			'order_status'    => $status,
			'ord_status_time' => date('h:i:s')
		];
		$status = $this->mainmodel->update_rec_by_args('order_master', $args, $data);
		if ($status) {
	    	$this->session->setTempdata('success', 'Congratulation ! Order Status Accepted Successfully', 3);
		}else{
		    $this->session->setTempdata('error', 'Failed ! Sorry Unable to Update Accept Order', 3);
		}
		return redirect()->to(base_url().'/Super_admin/view_order_details/'.$order_id);
	}

	public function change_order_status($order_id){
		$order_status = $this->request->getVar('order_status',FILTER_SANITIZE_STRING);
		$status = "";
		if ($order_status == 'Cancel') {
			$cancel_at   = date('Y-m-d h:i:s');
			$db = \Config\Database::connect();
			$status = $db->query("UPDATE `order_master` SET `order_status`='Cancel', `cancel_by`='Admin', `cancel_at`='$cancel_at'  WHERE `order_id`='$order_id'");
		}else{
			$args = [
				'order_id'  => $order_id
			];

			$check_status =  $this->request->getVar('order_status',FILTER_SANITIZE_STRING);
			if ($check_status == 'Accept') {
				$data=[
					'order_status'    => $check_status,
					'ord_status_time' => date('h:i:s')
				];
				$status = $this->mainmodel->update_rec_by_args('order_master', $args, $data);
			}
			$data = [
				'order_status'    => $this->request->getVar('order_status',FILTER_SANITIZE_STRING)
			];
			$status = $this->mainmodel->update_rec_by_args('order_master', $args, $data);

			if ($order_status == 'Delivered') {
				$ramount = get_website_settings();
				$referal_amount = $ramount[0]->referal_amount;
				if ($referal_amount > 0) {
					$order_details = get_order_details('order_master',$order_id);
					$order_user_id = get_user_detailsby_orderId($order_details[0]->user_id);
					$user_id = $order_user_id[0]->user_id;
					
					$ref_income = get_referal_income_in_first_order($user_id);
					
					$total_order = $ref_income[0]->total_order;
					if ($total_order == 1) {
						$getreferal_code =  get_user_details_user_id($user_id);
						if ($getreferal_code[0]->from_referal_code) {
							$referal_user = get_user_details($getreferal_code[0]->from_referal_code);
							$referal_user_id= $referal_user[0]->id;
							$msg = 'Referal First Order Cashback  Amount From :'.$order_user_id[0]->first_name;
							$status = manage_user_wallet($referal_user_id,$referal_amount, 'In',$msg);
						}
					}
				}
			}
		}
		if ($status) {
		    $this->session->setTempdata('success', 'Congratulation ! Order Status Updated Successfully', 3);
		}else{
			$this->session->setTempdata('error', 'Failed ! Sorry Unable to Update Order Status', 3);
		}
		return redirect()->to(base_url().'/Super_admin/view_order_details/'.$order_id);
	}



	public function add_order_del_boy($order_id){
		$args = [
			'order_id'  => $order_id
		];

		$data = [
			'delivery_boy_id' => $this->request->getVar('delivery_boy',FILTER_SANITIZE_STRING)
		];

		$status = $this->mainmodel->update_rec_by_args('order_master', $args, $data);
		if ($status) {
    		$this->session->setTempdata('success', 'Congratulation ! Delivery boy Assign Successfully in this Order', 3);
	    }else{
	    	$this->session->setTempdata('error', 'Failed ! Sorry Unable to Assign Delivery Boy', 3);
	    }
	    return redirect()->to(base_url().'/Super_admin/view_order_details/'.$order_id);
	}


	public function order_ringtone_open(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$args = [
				'order_date'    => date('Y-m-d'),
				'order_status'  => 'Pending'
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

	public function print_order_slip($order_id){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$args = [
				'order_id'  => $order_id
			];
			$data['print_order']  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/print_order_slip', $data);
		}
	}

	public function website_settings(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['validation'] = null;
			$data['web_setting'] = $this->mainmodel->fetch_all_records('settings');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/website_settings', $data);
		}
	}

	public function change_web_close_status($id, $status){
		$args = [
			'id'  => $id
		];
		$data = [
			'website_close'   => $status
		];
		$status = $this->mainmodel->update_rec_by_args('settings', $args, $data);
		if ($status) {
	    	$this->session->setTempdata('success', 'Congratulation ! Website Settings Updated Successfully', 3);
		}else{
		    $this->session->setTempdata('error', 'Failed ! Sorry Unable to Update Settings', 3);
		}
		return redirect()->to(base_url().'/Super_admin/website_settings');
	}

	public function edit_web_settings($id){
		$args = [
			'id' => $id
		];
		$data['web_setting'] = $this->mainmodel->fetch_rec_by_args('settings', $args);
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/edit_web_settings', $data);
	}

	public function update_web_settings($id){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$args = [
				'id'  => $id
			];
			$data = [
				'cart_min_price'       => $this->request->getVar('cart_min_price',FILTER_SANITIZE_STRING),
				'cart_min_price_msg'   => $this->request->getVar('cart_min_price_msg',FILTER_SANITIZE_STRING),
				'website_close'        => $this->request->getVar('website_close',FILTER_SANITIZE_STRING),
				'website_close_msg'    => $this->request->getVar('website_close_msg',FILTER_SANITIZE_STRING),
				'wallet_amt'           => $this->request->getVar('wallet_amt',FILTER_SANITIZE_STRING),
				'referal_amount'       => $this->request->getVar('referal_amt',FILTER_SANITIZE_STRING),
				'deli_boy_reg_cahback'       => $this->request->getVar('deli_reg_cash',FILTER_SANITIZE_STRING),
				'deliBoyPerOrderAmt'       => $this->request->getVar('deli_per_ord_amt',FILTER_SANITIZE_STRING)
			];
			$status = $this->mainmodel->update_rec_by_args('settings',$args, $data);
			if ($status) {
		    	$this->session->setTempdata('success', 'Congratulation ! Website Settings Updated Successfully', 3);
			}else{
			    $this->session->setTempdata('error', 'Failed ! Sorry Unable to Update Settings', 3);
			}
			return redirect()->to(base_url().'/Super_admin/website_settings');
		}
	}

	//Dashboard Section Start 


	public function count_admin_orders($type = 'all'){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			if ($type == 'all') {
				$orders = $this->mainmodel->fetch_all_records('order_master');
			}else if ($type == 'today') {
				$args = [
					'order_date'  => date('Y-m-d')
				];
				$orders = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			}else if ($type == 'yesterday') {
				$args = [
					'order_date'  => date('Y-m-d',strtotime("-1 day"))
				];
				$orders = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			}else if ($type == 'last_30_days') {
				$args = [
					'order_date>='  => date('Y-m-d',strtotime("-30 day")),
					'order_date<='   => date('Y-m-d') 
				];
				$orders = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			}else{
				$orders = $this->mainmodel->fetch_all_records('order_master');
				// print_r($orders);
			}
			$cod_orders =  count($orders);
			echo number_format($cod_orders);
		}
	}

	public function count_admin_income($type = 'all'){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			if ($type == 'all') {
				$args = [
					'order_status'   => 'Delivered' 
				];
				$income = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			}else if ($type == 'today') {
				$args = [
					'order_date'  => date('Y-m-d'),
					'order_status'   => 'Delivered' 
				];
				$income = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			}else if ($type == 'yesterday') {
				$args = [
					'order_date'  => date('Y-m-d',strtotime("-1 day")),
					'order_status'   => 'Delivered' 
				];
				$income = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			}else if ($type == 'last_30_days') {
				$args = [
					'order_date>='  => date('Y-m-d',strtotime("-30 day")),
					'order_date<='   => date('Y-m-d'),
					'order_status'   => 'Delivered'  
				];
				$income = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			}else{
				$income = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			}
			
			$total_income = 0;
			if($income){
				count($income);
				foreach($income as $all_income){
					$total_income += $all_income->final_price;
				}
			}else{
				$total_income = 0;
			}
			$cod_income = json_encode($total_income);
			echo number_format($cod_income);
		}
	}

	public function add_user_money($id){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$args  = [
				'id'  => $id
			];
			$data['user_details'] = $this->mainmodel->fetch_rec_by_args('users_master', $args);
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/add_user_money', $data);
		}
	}

	public function manage_user_money($uid){
		$money   = $this->request->getVar('money',FILTER_SANITIZE_STRING);
		$message = $this->request->getVar('message',FILTER_SANITIZE_STRING);
		$status = manage_user_wallet($uid,$money,'In', $message);
		if ($status) {
	    	$this->session->setTempdata('success', 'Congratulation ! Money Added Successfully', 3);
		}else{
		    $this->session->setTempdata('error', 'Failed ! Sorry Unable to Added Money', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_users');
	}


	//Dashboard Section Script Chart Data Start
	public function get_order_charts_reports(){
		$args  = [
			'order_date'   => date('Y-m-d')
		];
		$today_orders_data  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-1 day"))
		];
		$yesterday_orders_data  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-2 day"))
		];
		$last_3days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-3 day"))
		];
		$last_4days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-4 day"))
		];
		$last_5days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-5 day"))
		];
		$last_6days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-6 day"))
		];
		$last_7days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-7 day"))
		];
		$last_8days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-8 day"))
		];
		$last_9days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-9 day"))
		];
		$last_10days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-10 day"))
		];
		$last_11days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-11 day"))
		];
		$last_12days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-12 day"))
		];
		$last_13days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-13 day"))
		];
		$last_14days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-14 day"))
		];
		$last_15days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-15 day"))
		];
		$last_16days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-16 day"))
		];
		$last_17days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-17 day"))
		];
		$last_18days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-18 day"))
		];
		$last_19days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-19 day"))
		];
		$last_20days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-20 day"))
		];
		$last_21days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-21 day"))
		];
		$last_22days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-22 day"))
		];
		$last_23days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-23 day"))
		];
		$last_24days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-24 day"))
		];
		$last_25days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-25 day"))
		];
		$last_26days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-26 day"))
		];
		$last_27days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-27 day"))
		];
		$last_28days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-28 day"))
		];
		$last_29days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-29 day"))
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

	//Restaurent Script 
	public function manage_restaurent(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['restaurent'] = $this->mainmodel->fetch_all_records('restaurent');
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/manage_restaurent', $data);
		}
	}

	public function verfiy_restaurent($id, $status){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
		$args = [
			'restaurent_uid'  => $id
		];

		$data = [
			'status'  => $status
		];
		$status = $this->mainmodel->update_rec_by_args('restaurent',$args, $data);
		if ($status == true) {
			$args = [
				'restaurent_uid'  => $id
			];
			$res_data  = $this->mainmodel->fetch_rec_by_args('restaurent', $args);
			if ($res_data[0]->status == 'Active') {
				$invice = $this->send_verifi_invoice_invoce($res_data[0]->email,$res_data[0]->name);
				if ($invice) {
					$this->session->setTempdata('success', 'Congratulation ! Verification EmaiL Send Successfully', 3);
				}else{
					$this->session->setTempdata('error', 'Unable to Send Verification Email', 3);
				}
			}
			$this->session->setTempdata('success', 'Congratulation ! Restaurent Status Change Successfully', 3);
		}else{
		    $this->session->setTempdata('error', 'Failed ! Sorry Unable to Change', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_restaurent');
	}

	public function view_restaurent_details($uid){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
		$args = [
			'restaurent_uid'  => $uid
		];
		$data['restaurent'] = $this->mainmodel->fetch_rec_by_args('restaurent', $args);
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/view_res_details', $data);
	}

	public function delete_restaurent($uid){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
		$args = [
			'restaurent_uid'  => $uid
		];
		$status = $this->mainmodel->delete_records('restaurent', $args);
		if ($status) {
	    	$this->session->setTempdata('success', 'Congratulation ! Restaurent Deleted Successfully', 3);
		}else{
		    $this->session->setTempdata('error', 'Failed ! Sorry Unable to Deleted', 3);
		}
		return redirect()->to(base_url().'/Super_admin/manage_restaurent');
	}

	public function filter_restaurent($filter){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
	
		if ($filter == 'new_verification') {
			$args = [
				'status'   => 'AdminVerification'
			];
			$order = [
				'column_name'  => 'id',
				'order'        => 'desc'
			];
		}else if ($filter == 'old_verification') {
			$args = [
				'status'   => 'AdminVerification'
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
		$data['restaurent'] = $this->mainmodel->filter_rec_by_args_with_type('restaurent', $order, $args);
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/manage_restaurent', $data);
	}


	public function delivery_boy_pay_out(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['deli_boy_payout'] = $this->mainmodel->fetch_all_records('delivery_boy_wallate');
			$data['chart_data'] = $this->get_order_charts_reports();
			return vieW('Admin/delivery_boy_pay_out', $data);
		}
	}

	public function deliboypayout_details($id){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data['chart_data'] = $this->get_order_charts_reports();
		    $data['deli_boy_details'] = getDeliveryBoyWallateDetailsUsingUID($id);
		    return view('Admin/deliboypayout_details', $data);
		}
	}

	public function replay_message($user_id){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$args = [
				'user_id'  => $user_id
			];
			$data['replay_msg'] =  $this->mainmodel->fetch_rec_by_args('contact_us', $args);
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Admin/replay_message', $data);
		}
		echo "Under Construction Comming Soon";
	}

	public function sent_message($user_id){
		$data = [
			'user_id'     => $user_id,
			'message'     => $this->request->getVar('msg'),
			'sent_by'     => 'Admin',
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
				$jsonArr = array('is_error' => 'no', 'ipaddress'=>$chat_msg->ip_address, 'adminmessage'=>$chat_msg->message, 'adminmsg_time' => $chat_msg->time, 'adminname'=>$chat_msg->sent_by);
			}
			
		}else{
			$jsonArr = array('is_error'=>'yes','Something went Wrong');
		}
		echo json_encode($jsonArr);
	}

	public function view_del_boy_rating($id){
		$args = [
			'id'  => $id
		];
		$data['deli_boy_detail'] =  $this->mainmodel->fetch_order_status('delivery_boy_master', $args);
		$data['chart_data'] = $this->get_order_charts_reports();
		return view('Admin/view_del_boy_rating', $data);
	}





	//Dashboard Section End

	//-------------------------API Section-------------------------------------------
	public function api_get_pincode(){
		$pincode=$_POST['pincode'];
		$data=file_get_contents('http://postalpincode.in/api/pincode/'.$pincode);
		$data=json_decode($data);
		if(isset($data->PostOffice['0'])){
			$arr['city']=$data->PostOffice['0']->Taluk;
			$arr['state']=$data->PostOffice['0']->State;
			echo json_encode($arr);
		}else{
			echo 'no';
		}
	}

	//API GET WEATHER DATA USING API
	function get_weather_details_api(){
		$status="";
		$msg="";
		$city=$this->request->getVar('check_weather');
	    $url="http://api.openweathermap.org/data/2.5/weather?q=$city&APPID=8990848a1bcf3c022b7590878af79686";
	    $ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,$url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
	    curl_close($ch);
	    $result=json_decode($result,true);
	    if($result['cod']==200){
	        $status="yes";
	        $data['chart_data'] = $this->get_order_charts_reports();
	        $data['weather_data'] = $result;
	       	return view('Admin/dashboard',$data);
	    }else{
	        $msg=$result['message'];
	    }
	}



}
