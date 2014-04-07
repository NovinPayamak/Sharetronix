<?php
	/*
	ALTER TABLE `users` ADD `mobile_sms` VARCHAR( 255 ) NOT NULL AFTER `is_network_admin` ,
ADD `mobile_actived` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `mobile_sms` ,
ADD `mobile_active_code` INT( 10 ) NOT NULL AFTER `mobile_actived` ,
ADD `mobile_active_time` VARCHAR( 255 ) NOT NULL AFTER `mobile_active_code`

	*/
	
	
	
/*
	
	MADE BY ARASH TAVANAEI 09130246374 - http://forum.bolur.ir
	
	ONLY FOR novinpayamak.com 
	
	
	
	*/
	if( !$this->network->id ) {
		$this->redirect('home');
	}
		if( !$this->user->is_logged ) {
		$this->redirect('signup');
	}
$u = $D->u = $this->network->get_user_by_id($this->user->id,true);
	$this->load_langfile('inside/global.php');
	$this->load_langfile('inside/user.php');
	$D->error=false;
	$D->error_message = "";
	$D->submit = false;
    $D->ok_message = "";
	
	$again_time = 60*60 ; //now is set to 1 hours ** TIME FOR SEND NEXT CODE *** SET TO SECOUND ** 60 MEANS 1 MIN//
    $exp_time = 60*60*24; // EXPIRE CODE FOR CODE //

	if(isset($_POST['OK'])){
	
	$code_enter = intval($_POST['CODE']);
	
	if(!$code_enter){
	$D->error=TRUE;
	$D->error_message = "کد وارد شده صحیح نیست  <br>";
	$this->load_template('mobile-active.php');
	exit;
	}
	if($code_enter != $u->mobile_active_code){
	$D->error=TRUE;
	$D->error_message = "کد وارد شده صحیح نیست <br>";
	$this->load_template('mobile-active.php');
	exit;
	}
	if( $u->mobile_actived ){
	$D->error=TRUE;
	$D->error_message = "شماره موبایل شما با مقدار ".decode_mobile_num($u->mobile_sms)." فعال است <br>";
	$this->load_template('mobile-active.php');
	exit;
	}
	if ( time() - $u->mobile_active_time > $exp_time ){
	$D->error=TRUE;
	$D->error_message = "تاریخ انقضای کد تولیدی تمام شده است<br>";
	$this->load_template('mobile-active.php');
	exit;
	}
	
	if($code_enter == $u->mobile_active_code &&  !(time() - $u->mobile_active_time > $exp_time)){
	$db2->query("UPDATE users SET mobile_actived='1'  ,mobile_active_code='' WHERE id='".$u->id."' LIMIT 1");
	$this->network->get_user_by_id($this->user->id,true);
	$D->submit = true;
    $D->ok_message = "شماره موبایل شما تایید شد";
	}
	
	
	
	
	
	}
	
	
	if(isset($_POST['SEND_CODE'])){
	
	$num = isset($_POST["MYNUM"]) ?$_POST["MYNUM"]:"" ;

	
	if(!valid_mobile_num($num)){
	$D->error=TRUE;
	$D->error_message = "شماره موبایل فرمت صحیحی ندارد <br>";
	$this->load_template('mobile-active.php');
	exit;
	}
	if($db2->fetch_field('SELECT COUNT(id) FROM users WHERE mobile_sms="'.encode_mobile_num($num).'" LIMIT 1')>0){
	$D->error=TRUE;
	$D->error_message = "شماره موبایل وارد شده قابل ذخیره سازی نیست <br>";
	$this->load_template('mobile-active.php');
	exit;
	}
	if( ( time() - $u->mobile_active_time < $again_time ) ){
	$D->error=TRUE;
	$D->error_message = "زمان بین ارسال هر کد 2 ساعت است <br>";
	$this->load_template('mobile-active.php');
	exit;
	}
	
	$num = encode_mobile_num($num);
	
	$rand = rand(10000,90000);


	if(SEND_SMS(decode_mobile_num($num),$rand)){
	$db2->query("UPDATE users SET mobile_actived='0' , mobile_sms='".$num."' , mobile_active_code='".$rand."',mobile_active_time='".time()."' WHERE id='".$u->id."' LIMIT 1");
	$D->submit = true;
    $D->ok_message = "کد فعال ساز برای موبایل شما ارسال شد";
	
	
	}else{
	$D->error=TRUE;
	$D->error_message = "مجدد امتحان کنید ... خطا روی داده است <br>";

	
	}
	
	$this->network->get_user_by_id($this->user->id,true);
	
	
	}
	
	
	
	$this->load_template('mobile-active.php');
	
?>