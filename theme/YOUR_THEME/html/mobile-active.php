<?php
	
	$this->load_template('header.php');
	
?>


	
	<style>
	
	input[type=submit].TAEED{
	cursor:pointer;
	-moz-box-shadow:inset 0px 1px 0px 0px #f9eca0;
	-webkit-box-shadow:inset 0px 1px 0px 0px #f9eca0;
	box-shadow:inset 0px 1px 0px 0px #f9eca0;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f0c911), color-stop(1, #f2ab1e) );
	background:-moz-linear-gradient( center top, #f0c911 5%, #f2ab1e 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f0c911', endColorstr='#f2ab1e');
	background-color:#f0c911;
	-webkit-border-top-left-radius:7px;
	-moz-border-radius-topleft:7px;
	border-top-left-radius:7px;
	-webkit-border-top-right-radius:7px;
	-moz-border-radius-topright:7px;
	border-top-right-radius:7px;
	-webkit-border-bottom-right-radius:7px;
	-moz-border-radius-bottomright:7px;
	border-bottom-right-radius:7px;
	-webkit-border-bottom-left-radius:7px;
	-moz-border-radius-bottomleft:7px;
	border-bottom-left-radius:7px;
	text-indent:0px;
	border:1px solid #e65f44;
	display:inline-block;
	color:#c92200;
	font-family:tahoma;
	font-size:15px;
	font-weight:bold;
	font-style:normal;
	height:40px;
	line-height:40px;
	width:auto;
	text-decoration:none;
	text-align:center;
	text-shadow:-3px 2px 3px #ded17c;
	
}
input[type=submit].TAEED:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f2ab1e), color-stop(1, #f0c911) );
	background:-moz-linear-gradient( center top, #f2ab1e 5%, #f0c911 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f2ab1e', endColorstr='#f0c911');
	background-color:#f2ab1e;
}
input[type=submit].TAEED:active {
	position:relative;
	top:1px;
}
	
	input[type=submit].AGAIN{
	cursor:pointer;
	-moz-box-shadow:inset 0px 1px 0px 0px #caefab;
	-webkit-box-shadow:inset 0px 1px 0px 0px #caefab;
	box-shadow:inset 0px 1px 0px 0px #caefab;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #77d42a), color-stop(1, #5cb811) );
	background:-moz-linear-gradient( center top, #77d42a 5%, #5cb811 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#77d42a', endColorstr='#5cb811');
	background-color:#77d42a;
	-webkit-border-top-left-radius:7px;
	-moz-border-radius-topleft:7px;
	border-top-left-radius:7px;
	-webkit-border-top-right-radius:7px;
	-moz-border-radius-topright:7px;
	border-top-right-radius:7px;
	-webkit-border-bottom-right-radius:7px;
	-moz-border-radius-bottomright:7px;
	border-bottom-right-radius:7px;
	-webkit-border-bottom-left-radius:7px;
	-moz-border-radius-bottomleft:7px;
	border-bottom-left-radius:7px;
	text-indent:0px;
	border:1px solid #268a16;
	display:inline-block;
	color:#306108;
	font-family:tahoma;
	font-size:15px;
	font-weight:bold;
	font-style:normal;
	height:40px;
	line-height:40px;
	width:auto;
	text-decoration:none;
	text-align:center;
	text-shadow:-3px 2px 3px #aade7c;
}
input[type=submit].AGAIN:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5cb811), color-stop(1, #77d42a) );
	background:-moz-linear-gradient( center top, #5cb811 5%, #77d42a 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5cb811', endColorstr='#77d42a');
	background-color:#5cb811;
}
input[type=submit].AGAIN:active {
	position:relative;
	top:1px;
	}
	
	
	</style>

	<? if($D->error){
	echo errorbox('خطا',$D->error_message);
	} elseif($D->submit){
	echo okbox('خطا',$D->ok_message);
	}
	
	?>
	
<div align="center" style="width:100%;height:500px;">
<?if($D->u->mobile_actived == 1){?>
<?= okbox("با تشکر:","شماره موبایل شما تایید شده است",false);?>
<?php
	
	$this->load_template('footer.php');
	exit;
?>

<?}?>
<form action="<?=$C->SITE_URL?>mobile-active" method="post">
<?

$erc = '<table>
<tr>
<td>
<input type="submit" name="SEND_CODE" class="AGAIN" value="ارسال کد به شماره من"/>
</td>
<td>
<input type="text"  placeholder="0912" name="MYNUM" style="text-align:left;border:solid 1px #c5c5c5;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;height:35px;width:230px;font-size:25px;font-weight:bold;" value=""/>
</td>
</tr>
</table>'
;
?>

<?= msgbox("توضیحات:","برای فعالیت در سایت نیاز به ثبت شماره و تایید آن دارید<br> بدین منظور شماره خود را وارد تا کدی برای شما ارسال شود و سپس آن کد را در فیلد جلوی دکمه زرد رنگ وارد کنید <br><br>".$erc,false);?>
<? 
$tace ='<table>
<tr>
<td>
<input type="submit" name="OK" class="TAEED" value="تایید کد"/>
</td>
<td>
<input type="text"  placeholder="# # # # #" name="CODE" style="text-align:left;border:solid 1px #c5c5c5;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;height:35px;width:108px;font-size:25px;font-weight:bold;" value=""/>
</td>
</tr>
</table>
';
echo msgbox("توضیحات:","کدی که برای موبایل شما ارسال شد را در اینجا وارد کنید و تایید را بزنید<br><br>".$tace,false);
?>
</form>
</div>	
	

	
	
	
	
	
	
	
<?php
	
	$this->load_template('footer.php');
	
?>