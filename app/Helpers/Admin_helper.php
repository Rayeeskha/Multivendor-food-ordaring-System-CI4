<?php 

	function get_category_details($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_user_support_message($tablename){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select("*");
		$builder->orderBy('id', 'DESC');
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_user_support_mesg_using_status($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select("*");
		$builder->where($args);
		$builder->orderBy('id', 'DESC');
		$builder->limit(2);
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}
	function get_message_details($tablename, $ip, $limit){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('user_id', $ip);
		$result = $builder->orderBy('id', 'DESC');
		$result = $builder->limit($limit)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_user_details($code){
		$db = \Config\Database::connect();
		$builder = $db->table('users_master');
		$builder->select('*');
		$result = $builder->where('referal_code', $code)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_user_details_user_id($user_id){
		$db = \Config\Database::connect();
		$builder = $db->table('users_master');
		$builder->select('*');
		$result = $builder->where('id', $user_id)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_total_all_records($tablename){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$builder->orderBy('id', 'DESC');
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}


	function get_website_settings(){
		$db = \Config\Database::connect();
		$builder = $db->table('settings');
		$builder->select('*');
		$result = $builder->where('id', '1')
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}





	function get_delivery_boy($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('pincode', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_total_delivery_boy(){
		$db = \Config\Database::connect();
		$builder = $db->table('delivery_boy_master');
		$builder->select("*");
		$builder->orderBy('id', 'DESC');
		$result = $builder->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_dish_details($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('dish_id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_order_details($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('order_id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}


	function get_user_detailsby_orderId($user_id){
		$db = \Config\Database::connect();
		$builder = $db->table('order_master');
		$builder->select('*');
		$result = $builder->where('user_id', $user_id)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_restaurent_details($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('restaurent_uid', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}
	function get_restaurent_opn_status($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$builder->orderBy('id', 'DESC');
		$result = $builder->where('restaurent_id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_today_orders($args){
		$db = \Config\Database::connect();
		$builder = $db->table('order_master');
		$builder->select("*");
		$builder->orderBy('id', 'DESC');
		$result = $builder->where($args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	//Dish Rating Script
	function getDishRatingList($dis_id, $order_id){
		$arr = array('Bad','Below Average','Average','Good','Very Good');
		$html = '<select class="form-control" onchange=update_dish_rating("'.$dis_id.'","'.$order_id.'") id="dish_rate'.$dis_id.'" >';
		$html .= '<option value="">Select Rating </option>';
		foreach ($arr as $key => $val) {
			$next_id = $key+1;
			$html .= "<option value='$next_id'>$val</option>";
		}
		$html .= '</select>';
		return $html;
	}

	function getRating($dis_id,$order_id){
		$db = \Config\Database::connect();
		$query = $db->query("SELECT  * FROM `dish_rating` WHERE `order_id`='$order_id' AND `dish_detail_id`='$dis_id'");
		if (count($query->getResultArray())> 0) {
			$row = $query->getResult();
			$rating = $row[0]->rating;
			$arr = array('','Bad','Below Average','Average','Good','Very Good');
			echo "<div class='set_ratings'>".$arr[$rating]."</div>";
		}else{
			echo getDishRatingList($dis_id, $order_id);
		}
	}

	function getDelivery_boy_Rating($deliboy_id,$order_id){
		$db = \Config\Database::connect();
		$query = $db->query("SELECT  * FROM `delivery_boy_rating` WHERE `order_id`='$order_id' AND `delivery_boy_id`='$deliboy_id'");
		if (count($query->getResultArray())> 0) {
			$row = $query->getResult();
			$rating = $row[0]->rating;
			$arr = array('','Bad','Below Average','Average','Good','Very Good');
			echo "<div class='set_ratings'>".$arr[$rating]."</div>";
		}else{
			echo getDeliveryBoyRatingList($deliboy_id, $order_id);
		}
	}

	function getDeliveryBoyRatingList($deliboy_id, $order_id){
		$arr = array('Bad','Below Average','Average','Good','Very Good');
		$html = '<select class="form-control" onchange=update_deliboy_rating_rating("'.$deliboy_id.'","'.$order_id.'") id="deliboy_rate'.$deliboy_id.'" >';
		$html .= '<option value="">Select Rating </option>';
		foreach ($arr as $key => $val) {
			$next_id = $key+1;
			$html .= "<option value='$next_id'>$val</option>";
		}
		$html .= '</select>';
		return $html;
	}

	function getRatingByDishId($id){
		$db = \Config\Database::connect();
		$query = $db->query("SELECT  sum(rating) as dish_rating, count(*) as total  FROM `dish_rating` WHERE `dish_detail_id`='$id'");
		$arr = array('','Bad','Below Average','Average','Good','Very Good');
		if (count($query->getRowArray())> 0) {
			$row = $query->getRowArray();
			if ($row['total'] > 0) {
				$totaRate = $row['dish_rating']/$row['total'];
				echo "<span class='rating'>(" .$arr[round($totaRate)]. ":Rated by: ".round($row['total'])."users)</span>";
			}
		}else{
			
		}
	}

	function getRatingByDeliveryBoy($id){
		$db = \Config\Database::connect();
		$query = $db->query("SELECT  sum(rating) as deliboy_rating, count(*) as total   FROM `delivery_boy_rating` WHERE `delivery_boy_id`='$id'");
		// $arr = array('','Bad','Below Average','Average','Good','Very Good');
		if (count($query->getRowArray())> 0) {
			$row = $query->getRowArray();
			if ($row['total'] > 0) {
				$totaRate = $row['deliboy_rating']/$row['total'];
				echo "<span class='rating'>(" .round($totaRate). ":Star Rated by: ".round($row['total'])."users )</span>";
			}
		}else{
			
		}
	}


	function get_rated_dish_details($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('dish_detail_id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function get_rated_deliveryboy_details($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('delivery_boy_id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}
	//Dish Rating Script


	//Walet Query 
	function getWallateDetailsUsingUID($args){
		$db = \Config\Database::connect();
		$builder = $db->table('wallet');
		$builder->select('*');
		$builder->orderBy('id', 'DESC');
		$result = $builder->where('user_id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function getDeliveryBoyWallateDetailsUsingUID($args){
		$db = \Config\Database::connect();
		$builder = $db->table('delivery_boy_wallate');
		$builder->select('*');
		$builder->orderBy('id', 'DESC');
		$result = $builder->where('delivery_boy_id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}


	function get_wallate_amount($uid){
		$db = \Config\Database::connect();
		$query = $db->query("SELECT  * FROM `wallet` WHERE `user_id`='$uid'");
		$result   = $query->getResult();
		$in = 0;
		$out =0;
		foreach($result as $amountdata){
			if ($amountdata->type == 'In') {
				$in += $amountdata->amount;
			}
			if ($amountdata->type == 'Out') {
				$out  += $amountdata->amount;
			}
		}
		return $in-$out;
	}


	function get_deliboy_wallate_amount($uid){
		$db = \Config\Database::connect();
		$query = $db->query("SELECT  * FROM `delivery_boy_wallate` WHERE `delivery_boy_id`='$uid'");
		$result   = $query->getResult();

		$in = 0;
		$out =0;
		foreach($result as $amountdata){
			if ($amountdata->type == 'In') {
				$in += $amountdata->amount;
			}
			if ($amountdata->type == 'Out') {
				$out  += $amountdata->amount;
			}
		}
		return $in-$out;
	}

	function manage_delivery_boy_wallet($deli_id, $amt,$type, $msg, $payment_id= ""){
		$db = \Config\Database::connect();
		$data =  [
			'delivery_boy_id'    => $deli_id,
			'amount'     => $amt,
			'type'       => $type,
			'message'    => $msg,
			'payment_id' => $payment_id,
			'added_on'   => date('Y-m-d h:i:s')
		];
		$builder = $db->table('delivery_boy_wallate');
		$builder->insert($data);
		if ($db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}


	function manage_user_wallet($user_id, $amt,$type, $msg, $payment_id= ""){
		$db = \Config\Database::connect();
		$data =  [
			'user_id'    => $user_id,
			'amount'     => $amt,
			'type'       => $type,
			'message'    => $msg,
			'payment_id' => $payment_id,
			'added_on'   => date('Y-m-d h:i:s')
		];
		$builder = $db->table('wallet');
		$builder->insert($data);
		if ($db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	function get_referal_income_in_first_order($user_id){
		$db = \Config\Database::connect();
		$query = $db->query("SELECT  count(*) as total_order FROM `order_master` WHERE `user_id`='$user_id' AND `order_status`='Delivered'");
		if (count($query->getResultArray())) {
			return $query->getResult();
		}else{
			return false;
		}
	}

	function verify_db_detatime_to_current_time_stamp($db_time){
		// $current_time  = time();
		$diff      = abs(time() - $db_time);
	    //Count Year
	    $years = floor($diff / (365*60*60*24));  
		//Count Months
        $months = floor(($diff - $years * 365*60*60*24) 
                                       / (30*60*60*24));  
         //Count days 
        $days = floor(($diff - $years * 365*60*60*24 -  
                     $months*30*60*60*24)/ (60*60*24)); 
          //Count year 
        $hours = floor(($diff - $years * 365*60*60*24  
               - $months*30*60*60*24 - $days*60*60*24) 
                                           / (60*60));  
         //Count Months  
        $minutes = floor(($diff - $years * 365*60*60*24  
                 - $months*30*60*60*24 - $days*60*60*24  
                                  - $hours*60*60)/ 60); 
        return $minutes;
	}

    function get_all_customer($order_date){
    	$args = [
    		'order_date'    => $order_date,
    		'order_status'  => 'Delivered'
    	];
		$db = \Config\Database::connect();
		$builder = $db->table('order_master');
		$builder->select('*');
		$builder->orderBy('id', 'DESC');
		$result = $builder->where($args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	//Get Latitude and Logitude accourding to order
	function get_latitude_and_logitude_according_to_order($order_id, $deli_id = ""){
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$result=curl_exec($ch);
		$result=json_decode($result);

		if($result->status=='success'){
			if(isset($result->lat) && isset($result->lon)){
				$db = \Config\Database::connect();
				$data = [
					'order_id'           => $order_id,
					'locationLatitude'   => $result->lat,
					'locationLongitude'  => $result->lon,
					'delivery_boy_id'    => $deli_id
				];
				$builder = $db->table('order_tracking');
				$builder->insert($data);
				if ($db->affectedRows() == 1) {
					return true;
				}else{
					return false;
				}
			}
		}
	}

	function get_order_location($order_id){
		$db = \Config\Database::connect();
		$builder = $db->table('order_tracking');
		$builder->select('*');
		$result = $builder->where('order_id', $order_id)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResultArray();
		}else{
			return false;
		}
	}

	







?>