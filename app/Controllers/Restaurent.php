<?php namespace App\Controllers;
use \App\Models\Main_model;
use \App\Models\Dishes_model;
use \App\Models\Login_model;

class Restaurent extends BaseController
{
	public $session;
	public $mainmodel;
	public $dishmodel;
	public function __construct(){
		// helper(['form','Admin_helper','text','date','time']);
		$this->mainmodel  = new Main_model();
		$this->loginModel = new Login_model();
		$this->dishmodel  = new Dishes_model();
		$this->session   = session();
		$this->email = \Config\Services::email();
	}

	public function dashboard(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			$args = [
				'restaurent_id'  => $this->session->get('RESTAURENT_UID')
			];
			$data['total_orders'] = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			$args = [
				'restaurent_id'  => $this->session->get('RESTAURENT_UID')
			];
			$data['dishes'] = $this->mainmodel->fetch_rec_by_args('dish_master', $args);
			$data['chart_data'] = $this->get_order_charts_reports();
			return view('Restaurent/dashboard', $data);
		}
	}

	public function add_dish(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			$data['validation'] = null;
			$data['category']   = $this->mainmodel->fetch_all_records('category_master');
			return view('Restaurent/add_dish', $data);
		}
	}

	public function upload_dish(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
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

					    $restaurent_id = $this->session->get('RESTAURENT_UID');

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
		                	'restaurent_id'   => $restaurent_id
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
						return redirect()->to(base_url().'/Restaurent/add_dish');
					}else{
					   	$this->session->setTempdata('error', 'Sorry ! Unable to Upload Please Select minimum Four Images', 3);
					}
					   	return redirect()->to(base_url().'/Restaurent/add_dish');
					 }
				}else{
					$data['validation'] = $this->validator;
				}
				$data['category']   = $this->mainmodel->fetch_all_records('category_master');
				return view('Restaurent/add_dish', $data);
			}
		}
	}

	public function manage_dishes(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			$args = [
				'restaurent_id'  => $this->session->get('RESTAURENT_UID')
			];
			$data = [
		        'dishes' => $this->dishmodel->fetch_rec_with_pagination_by_args('dish_master', $args),
		        'pager'     => $this->dishmodel->pager
		    ];
			return view('Restaurent/manage_dishes', $data);
		}
	}

	public function change_dish_status($id, $status){
		$args = [
			'id' => $id
		];
		$data = [
			'status'  => $status
		];
		$status = $this->mainmodel->update_rec_by_args('dish_master', $args, $data);
		if ($status) {
			$this->session->setTempdata('success', 'Congratulation ! Dish Status Change Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Failed ! Sorry Unable to Change Status', 3);
		}
		return redirect()->to(base_url().'/Restaurent/manage_dishes');
	}

	public function edit_dish_details($id){
		$args = [
			'id' => $id
		];
		$data['dish'] = $this->mainmodel->fetch_rec_by_args('dish_master', $args);
		$data['category']   = $this->mainmodel->fetch_all_records('category_master');
		return view('Restaurent/edit_dish_details', $data);
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

	public function update_dish_details($id){
		$args = [
			'id'   => $id
		];
		$image = $this->request->getFile('avatar');
		if ($image->isValid() &&  !$image->hasMoved()) {
			$old_data = $this->mainmodel->fetch_rec_by_args('dish_master', $args);
			//delete old  image
			unlink('public/uploads/dish_image/'. $old_data[0]->image);
			//delete old  image
			$newName = $image->getRandomName();
			$image->move('./public/uploads/dish_image', $newName); 
	        $dis_img = $image->getName();
	        $restaurent_id = $this->session->get('RESTAURENT_UID');
	        $data = [
		        'dish_title'      =>  $this->request->getVar('dish_title',FILTER_SANITIZE_STRING),
		        'category_id'     =>  $this->request->getVar('category',FILTER_SANITIZE_STRING),
		        'dish_details'    =>  $this->request->getVar('dish_details',FILTER_SANITIZE_STRING),
		        'dish_type'       =>  $this->request->getVar('dish_type',FILTER_SANITIZE_STRING),
		        'image'           =>  $dis_img,
		        'status'          => 'Active',
		        'added_on'        => date('Y-m-d h:i:s'),
		        'restaurent_id'   => $restaurent_id
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

		    return redirect()->to(base_url().'/Restaurent/manage_dishes');	
		}else{
	    	echo $image->getErrorString(). " " .$image->getError();
	    }
	}

	public function delete_dish($id){
		$args = [
			'id' => $id
		];
		$status = $this->mainmodel->delete_records('dish_master', $args);
		if ($status) {
			$this->session->setTempdata('success', 'Congratulation ! Dish Deleted Successfully !', 3);
		}else{
			$this->session->setTempdata('error', 'Failed! Sorry Unable to Deleted', 3);
		}
		return redirect()->to(base_url().'/Restaurent/manage_dishes');	
	}

	public function search_dishes(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			$keyword = $this->request->getVar('dish_name');
			$args = [
				'restaurent_id'  => $this->session->get('RESTAURENT_UID') 
			];
			if ($keyword) {
			 	$result = $this->dishmodel->search_dish_title($keyword, $args);
			}else{
			 	$result = $this->dishmodel;
			}
			$data = [
		        'dishes'    => $this->dishmodel->fetch_rec_with_pagination_by_args('dish_master', $args),
		        'pager'     => $this->dishmodel->pager
		    ];
			return view('Restaurent/manage_dishes', $data);
		}
	}

	public function filter_dishes($filter){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			if ($filter == 'new_dishes') {
				$order = [
					'column_name'  => 'id',
					'order'        => 'desc'
				];
			}else if ($filter == 'old_dishes') {
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
			$args = [
				'restaurent_id' => $this->session->get('RESTAURENT_UID'),
			];
			$data = [
			    'dishes' => $this->dishmodel->filter_rec_by_args_with_pagination('dish_master',$order, $args),
			    'pager'  => $this->dishmodel->pager
			];
			return view('Restaurent/manage_dishes', $data);
		}
	}

	public function manage_orders(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			$args = [
				'restaurent_id'  => $this->session->get('RESTAURENT_UID')
			];
			$data['order_master'] = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			return view('Restaurent/manage_orders', $data);
		}
	}

	public function view_order_details($order_id){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			$args = [
				'order_id'  => $order_id
			];
			$data['ord_details'] = $this->mainmodel->fetch_rec_by_args('order_master', $args);
			$args = [
				'order_status!='  => 'Delivered'
			];
			$data['order_status'] = $this->mainmodel->fetch_order_status_by_args('order_status',$args);
		}
		return view('Restaurent/view_order_details', $data);
	}

	public function change_order_status($order_id){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			$order_status = $this->request->getVar('order_status',FILTER_SANITIZE_STRING);
			$restaurent_id = $this->session->get('RES_NAME');
			$status = "";
			if ($order_status == 'Cancel') {
				$cancel_at   = date('Y-m-d h:i:s');
				$db = \Config\Database::connect();
				$status = $db->query("UPDATE `order_master` SET `order_status`='Cancel', `cancel_by`='$restaurent_id', `cancel_at`='$cancel_at'  WHERE `order_id`='$order_id'");
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
			}
			if ($status) {
			    $this->session->setTempdata('success', 'Congratulation ! Order Status Updated Successfully', 3);
			}else{
				$this->session->setTempdata('error', 'Failed ! Sorry Unable to Update Order Status', 3);
			}
			return redirect()->to(base_url().'/Restaurent/view_order_details/'.$order_id);
		}
	}


	public function add_order_del_boy($order_id){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}
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
	    return redirect()->to(base_url().'/Restaurent/view_order_details/'.$order_id);
	}

	public function print_order_slip($order_id){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}
		$args = [
			'order_id'  => $order_id
		];
		$data['print_order']  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		return view('Restaurent/print_order_slip', $data);
	}

	public function today_sale(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}
		$args = [
			'order_status'  => 'Delivered',
			'order_date>='  => date('Y-m-d'),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$data['sale_reports'] = $this->mainmodel->fetch_all_sales('order_master',$args);
		return view('Restaurent/sale_reports', $data);
	}

	public function search_sales(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			$args = [
				'order_status'  => 'Delivered',
				'order_date>='  => $this->request->getVar('start_date'),
				'order_date<='  => $this->request->getVar('last_date'),
				'restaurent_id' => $this->session->get('RESTAURENT_UID')
			];
			$data['sale_reports'] = $this->mainmodel->fetch_all_sales('order_master',$args);
			return view('Restaurent/sale_reports', $data);
		}
	}

	public function all_sales(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}
		$args = [
			'order_status'  => 'Delivered',
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$data['sale_reports'] = $this->mainmodel->fetch_all_sales('order_master',$args);
		return view('Restaurent/sale_reports', $data);
	}

	public function restaurent_coupon_master(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}
		$data['validation'] = null;
		$args = [
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$data['coupons'] = $this->mainmodel->fetch_rec_by_args('coupon_master', $args);
		return view('Restaurent/coupon_master', $data);
	}

	public function add_coupon_code(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
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
					$restaurent_id = $this->session->get('RESTAURENT_UID');
					$data= [
						'coupon_code'      => $this->request->getVar('couponCode',FILTER_SANITIZE_STRING),
						'coupon_type'      => $this->request->getVar('coupon_type',FILTER_SANITIZE_STRING),
						'coupon_value'     => $this->request->getVar('coupon_value',FILTER_SANITIZE_STRING),
						'cart_min_value'   => $this->request->getVar('cart_min_value',FILTER_SANITIZE_STRING),
						'expiry_on'        => $this->request->getVar('expiry_date',FILTER_SANITIZE_STRING),
						'added_on'         => date('Y-m-d h:i:s'),
						'status'           => 'Active',
						'restaurent_id'    =>  $restaurent_id
					];
					$status = $this->mainmodel->Insertdata('coupon_master', $data);
					if ($status == true) {
						$this->session->setTempdata('success', 'Congratulation !Coupon Added Successfully !', 3);
					}else{
						$this->session->setTempdata('error', 'Sorry ! Unable to Add Coupon Try Again ?', 3);
					}
					return redirect()->to(base_url().'/Restaurent/restaurent_coupon_master');

				}else{
					$data['validation'] = $this->validator;
				}
					$args = [
						'restaurent_id' => $this->session->get('RESTAURENT_UID')
					];
					$data['coupons'] = $this->mainmodel->fetch_rec_by_args('coupon_master', $args);
				return view('Restaurent/coupon_master', $data);
			} 
		}
	}

	public function change_coupon_status($id, $status){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}
		$args = [
			'id'  => $id
		];
		$data = [
			'status' => $status
		];
		$status = $this->mainmodel->update_rec_by_args('coupon_master', $args, $data);
		if ($status) {
			$this->session->setTempdata('success','Congratulation !Coupon Status Change Successfully !',);
			
		}else{
			$this->session->setTempdata('errors', 'Failed ! Sorry Unable to Change Status', 3);
		}
		return redirect()->to(base_url().'/Restaurent/restaurent_coupon_master');
	}

	public function delete_coupn_master($id){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}
		$args = [
			'id'  => $id
		];
		$status = $this->mainmodel->delete_records('coupon_master', $args);
		if ($status) {
			$this->session->setTempdata('success','Congratulation !Coupon Deleted Successfully !',);
			
		}else{
			$this->session->setTempdata('errors', 'Failed ! Sorry Unable Deleted Coupon', 3);
		}
		return redirect()->to(base_url().'/Restaurent/restaurent_coupon_master');
	}



	//Dashboard Section Script Chart Data Start
	public function get_order_charts_reports(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}
		$args  = [
			'order_date'   => date('Y-m-d'),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$today_orders_data  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-1 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$yesterday_orders_data  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-2 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_3days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-3 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_4days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-4 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_5days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-5 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_6days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);

		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-6 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_7days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-7 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_8days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-8 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_9days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-9 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_10days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-10 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_11days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-11 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_12days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-12 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_13days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-13 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_14days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-14 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_15days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-15 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_16days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-16 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_17days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-17 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_18days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-18 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_19days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-19 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_20days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-20 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_21days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-21 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_22days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-22 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_23days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-23 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_24days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-24 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_25days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-25 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_26days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-26 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_27days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-27 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_28days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-28 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
		];
		$last_29days_orders  = $this->mainmodel->fetch_rec_by_args('order_master', $args);
		$args  = [
			'order_date'   => date('Y-m-d', strtotime("-29 day")),
			'restaurent_id' => $this->session->get('RESTAURENT_UID')
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

	//Order Ring tone Open
	public function order_ringtone_open(){
		if (!(session()->has('LOGGIED_IN_RESTAURENT'))) {
			return redirect()->to(base_url()."/Login/restaurent_login");
		}else{
			$args = [
				'order_date'    => date('Y-m-d'),
				'order_status'  => 'Pending',
				'restaurent_id' => $this->session->get('RESTAURENT_UID')
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
	//Order Ring tone Open

	public function accept_order($order_id, $status){
		$args = [
			'order_id'  => $order_id
		];
		$data = [
			'order_status'  => $status
		];
		$status = $this->mainmodel->update_rec_by_args('order_master', $args, $data);
		return redirect()->to(base_url().'/Restaurent/view_order_details/'.$order_id);
	}

	public function Logout_restaurent(){
		if (session()->has('LOGGIED_IN_RESTAURENT')) {
			$restaurent_id = session()->get('RESTAURENT_UID');
			$args = [
				'restaurent_id'  => $restaurent_id
			];
			$data = [
				'opening_status'  => 'Close',
				'logout_time'     => date('Y-m-d')
			];
			$this->loginModel->updateLogoutTime('restaurent_opening_status', $args, $data);
		}
		session()->destroy();
		return redirect()->to(base_url()."/Login/restaurent_login");
	}



}