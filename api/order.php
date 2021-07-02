<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);

if($data['uid'] == '')
{

 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    

}

else
{
//echo($data[0]);
$uid =  $data['uid'];
$ddate = $data['ddate'];
$a = explode('-',$ddate);
$ddate = $a[2].'-'.$a[1].'-'.$a[0];
$timesloat = $data['timesloat'];
$oid ='#'.uniqid();
$pname = $data['pname'];
$status = 'pending'; 
$p_method = $data['p_method'];
$address_id = $data['address_id'];
$tax = $data['tax'];
$coupon_id = $data['coupon_id'];
$cou_amt = $data['cou_amt'];
$timestamp = date("Y-m-d");
//$tid = $data['tid'];
$tid = "0";
$total = number_format((float)$data['total'], 2, '.', '');
$e= array();
$p = array();
$w=array();
$pp = array();
$q = array();
for($i=0;$i<count($pname);$i++)
{
	$e[] = mysqli_real_escape_string($con,$pname[$i]['title']);
	$p[] = $pname[$i]['pid'];
	$w[] = $pname[$i]['weight'];
	$pp[] = $pname[$i]['cost'];
	$q[] = $pname[$i]['qty'];
}

$pname = implode('$;',$e);
$pid = implode('$;',$p);
$ptype = implode('$;',$w);
$pprice = implode('$;',$pp);
$qty = implode('$;',$q);

/*$getsellername = $con->query("select * from product where id=".$pid."");

if ($getsellername->num_rows > 0) {
  while($row = $getsellername->fetch_assoc()) {
    $seller_id = $row["sellerid"];
  }
}


$sellerchatid = $con->query("select * from sellers_db where id=$seller_id");

if ($sellerchatid->num_rows > 0) {
  while($row = $sellerchatid->fetch_assoc()) {
    $seller_chat_id = $row["telegram_chat_id"];
  }
}
*/

$seller_id = 3;
$seller_chat_id = 1661999754;


$con->query("insert into orders(`oid`,`uid`,`pname`,`pid`,`ptype`,`pprice`,`ddate`,`timesloat`,`order_date`,`status`,`qty`,`total`,`p_method`,`address_id`,`tax`,`tid`,`cou_amt`,`coupon_id`,`sellerid`)values('".$oid."',".$uid.",'".$pname."','".$pid."','".$ptype."','".$pprice."','".$ddate."','".$timesloat."','".$timestamp."','".$status."','".$qty."',".$total.",'".$p_method."',".$address_id.",".$tax.",'".$tid."',".$cou_amt.",".$coupon_id.",".$seller_id.")");



$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Placed Successfully!!!");
/*
//API Url
$url = 'https://api.t-a-a-s.ru/client';
 
//Initiate cURL.
$ch = curl_init($url);
 
//The JSON data.
$order_details = "Hey, You have received a new order!\n\n--- Order Details ---\n\n"."Order ID : "."$oid"."\nProduct : ".$pname."\nPrice : ".$pprice."\nQuantity : ".$qty."\nTotal : ".$total."\n\n--- Payment Details ---\n\nDelivery Date : "."$ddate"."\nDelivery Time : ".$timesloat."\nPayment Mode : "."$p_method";
$jsonData =  array (
  'api_key' => '1577662641:AAFO2HAnxFv8RxamHraV0_uCOyKJkRUq8Rc:jX-Bt73_QVWvNV56pYy6cmyFi9QsKmJyBsUBY2z5',
  '@type' => 'sendMessage',
  'chat_id' => $seller_chat_id,
  'disable_notification' => false,
  'input_message_content' => 
  array (
    '@type' => 'inputMessageText',
    'disable_web_page_preview' => false,
    'text' => 
    array (
      '@type' => 'formattedText',
      'text' => $order_details,
    ),
  ),
);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
 
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
 
//Execute the request
// grab URL and pass it to the browser
//curl_setopt($ch, CURLOPT_TIMEOUT, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
curl_exec($ch); 
*/
// close cURL resource, and free up system resources
//curl_close($ch);

/*$con->query("insert into orders(`oid`,`uid`,`pname`,`pid`,`ptype`,`pprice`,`ddate`,`timesloat`,`order_date`,`status`,`qty`,`total`,`p_method`,`address_id`,`tax`,`tid`,`cou_amt`,`coupon_id`)values('".$oid."',".$uid.",'".$pname."','".$pid."','".$ptype."','".$pprice."','".$ddate."','".$timesloat."','".$timestamp."','".$status."','".$qty."',".$total.",'".$p_method."',".$address_id.",".$tax.",'".$tid."',".$cou_amt.",".$coupon_id.")");
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Placed Successfully!!!");
*/

}

echo json_encode($returnArr);

//echo json_encode($returnArr); 