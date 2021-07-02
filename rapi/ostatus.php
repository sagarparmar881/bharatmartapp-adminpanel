<?php
require 'db.php';
$getkey = $con->query("select * from setting")
    ->fetch_assoc();
define('ONE_KEY', $getkey['one_key']);
define('ONE_HASH', $getkey['one_hash']);

header('Content-Type: text/html; charset=utf-8');
$data = json_decode(file_get_contents('php://input') , true);

$oid = $data['oid'];
$status = $data['status'];
$rid = $data['rid'];

if ($oid == '' or $status == '' or $rid == '')
{
    $returnArr = array(
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went wrong  try again !"
    );
}
else
{

    $oid = strip_tags(mysqli_real_escape_string($con, $oid));
    $rid = strip_tags(mysqli_real_escape_string($con, $rid));
    $status = strip_tags(mysqli_real_escape_string($con, $status));
    $check = $con->query("select *  from orders where rid=" . $rid . " and id=" . $oid . "")->num_rows;
    $check2 = $con->query("select *  from orders where rid=" . $rid . " and id=" . $oid . "")->fetch_assoc();
    $sellerid = $check2['sellerid'];
    $sales = $check2['total'];
    if ($check != 0)
    {
        if ($status == 'accept')
        {

            $con->query("update orders set status='processing',a_status=2,r_status='Accepted' where id=" . $oid . "");
            $con->query("update rider set accept = accept+1 where id=" . $rid . "");
            //$con->query("update sellers_db set o_accepted = o_accepted + 1 where id=" . $sellerid . " ");

            $checks = $con->query("select * from orders where id=" . $oid . "")->fetch_assoc();
            $content = array(
                "en" => 'Your Order Has Been Accepted.'
                //mesaj burasi
                
            );
            $fields = array(
                'app_id' => ONE_KEY,
                'included_segments' => array(
                    "Active Users"
                ) ,
                'filters' => array(
                    array(
                        'field' => 'tag',
                        'key' => 'userId',
                        'relation' => '=',
                        'value' => $checks['uid']
                    )
                ) ,
                'contents' => $content
            );
            $fields = json_encode($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic ' . ONE_HASH
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            curl_close($ch);

            $returnArr = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Order Accepted Successfully!!!!!"
            );

        }
        else if ($status == 'reject')
        {
            $con->query("update orders set a_status=5,r_status='Rejected',rid=0 where id=" . $oid . "");
            $con->query("update rider set reject = reject+1 where id=" . $rid . "");
            //$con->query("update sellers_db set o_rejected = o_rejected + 1 where id=" . $sellerid . " ");
            $returnArr = array(
                "ResponseCode" => "200",
                "Result" => "false",
                "ResponseMsg" => "Order Rejected Successfully!!!!!"
            );
        }
        else if ($status == 'cancle')
        {
            $comment = $data['comment'];
            $con->query("update orders set a_status=4,r_status='Cancelled',status='cancelled',s_photo='" . $comment . "' where id=" . $oid . "");
            //$con->query("update sellers_db set cancelled = o_cancelled + 1 where id=" . $sellerid . " ");
            $checks = $con->query("select * from orders where id=" . $oid . "")->fetch_assoc();
            $content = array(
                "en" => 'Your Order Has Been Cancelled.'
                //mesaj burasi
                
            );
            $fields = array(
                'app_id' => ONE_KEY,
                'included_segments' => array(
                    "Active Users"
                ) ,
                'filters' => array(
                    array(
                        'field' => 'tag',
                        'key' => 'userId',
                        'relation' => '=',
                        'value' => $checks['uid']
                    )
                ) ,
                'contents' => $content
            );
            $fields = json_encode($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic ' . ONE_HASH
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            curl_close($ch);

            $returnArr = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Order Cancelled Successfully!!!!!"
            );
        }
        else if ($status == 'complete')
        {
            $sign = $data['sign'];
            $con->query("update orders set a_status=3,r_status='Delivered',status='completed',photo='" . $sign . "' where id=" . $oid . "");
            $con->query("update rider set complete = complete + 1 where id=" . $rid . "");
            //$con->query("update sellers_db set o_delivered = o_delivered + 1 where id=" . $sellerid . " ");
            //$con->query("update sellers_db set sales = sales + $sales where id=" . $sellerid . " ");
            $checks = $con->query("select * from orders where id=" . $oid . "")->fetch_assoc();
            $content = array(
                "en" => 'Your Order Has Been Delivered Successfully.'
            );
            $fields = array(
                'app_id' => ONE_KEY,
                'included_segments' => array(
                    "Active Users"
                ) ,
                'filters' => array(
                    array(
                        'field' => 'tag',
                        'key' => 'userId',
                        'relation' => '=',
                        'value' => $checks['uid']
                    )
                ) ,
                'contents' => $content
            );
            $fields = json_encode($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic ' . ONE_HASH
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            curl_close($ch);

            $returnArr = array(
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Order Completed Successfully!!!!!"
            );
        }
        else
        {
            $returnArr = array(
                "ResponseCode" => "401",
                "Result" => "false",
                "ResponseMsg" => "Something Went wrong  try again !"
            );
        }
    }
    else
    {
        $returnArr = array(
            "ResponseCode" => "401",
            "Result" => "false",
            "ResponseMsg" => "Sorry This Order Assign to Other Rider Or Cancelled!"
        );
    }
}
echo json_encode($returnArr);
mysqli_close($con);
?>
