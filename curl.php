<?php
	error_reporting(E_ALL);
     ini_set('display_errors', 1);  
	if(!empty($_REQUEST['reg_type']) && !empty($_REQUEST['name']) && !empty($_REQUEST['email'])
		 && !empty($_REQUEST['mobile_number'])){
			 $name = str_replace(' ', '%20', $_REQUEST['name']);
			$url = "https://103.209.147.133/users/v1.0/register?name=".$name."&email=".$_REQUEST['email']."&phone=".$_REQUEST['mobile_number']."&type=".$_REQUEST['reg_type'];
			
			$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);    
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
	curl_setopt($ch, CURLOPT_POST, true);                                                                
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
		'Accept: application/json',
		'Content-Type: application/json',
		'token: Vb4I7kR5DoQ+wIG9OzqWUijyG1mJrB8Yiuh+jOw3zEo=',
		'imei: 359208071547000',
		)                                                           
	);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0');     
	$authToken = curl_exec($ch);        
	$err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
	curl_close( $ch );
	
		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		if(!empty($err)){
			$data['responseType'] = 'fail';
			$data['message'] = implode(',',$header);
		}else{
			$authToken = json_decode($authToken,true);
			$data['responseType'] = 'fail';
			$data['message'] = $authToken['result'];
		}
			
	}else{
		$data['responseType'] = 'fail';
		$data['message'] = 'Please enter the required fields.';
	}
	print json_encode($data);
	exit;
?>
