<?php
include('../paypal.class.php');
if($_GET){
	$ipn=new paypal_ipn($_GET);
	$text=serialize($ipn);
	$var=fopen('report/order-'.$_GET['item_number'].'.txt','a+');
	fwrite($var, $text);
	fclose($var);
}
if($_POST){
	$ipn=new paypal_ipn($_POST);
	$text=serialize($ipn);
	$var=fopen('report/order-'.$_POST['item_number'].'.txt','a+');
	fwrite($var, $text);
	fclose($var);
}
?>