<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
header('Content-Type:text/html;charset=utf8');
date_default_timezone_set('Asia/Shanghai');

include 'config.php';

$version = $config['version'];
$customerid = $config['customerid'];
$userid = $config['userid'];
$sdorderno = time() + mt_rand(1000, 9999);
$total_fee = number_format($_POST['total_fee'], 2, '.', '');
if ($total_fee > 50000 || $total_fee < 100) {
    die('充值金额需大于100元小于50000元');
}
$paytype = $_POST['paytype'];
$bankcode = $_POST['bankcode'];
$notifyurl = 'http://' . $_SERVER['HTTP_HOST'] . '/demo/notify.php';
$returnurl = 'http://' . $_SERVER['HTTP_HOST'] . '/demo/return.php';
$remark = $_POST['remark'];
$key = $config['key'];

$sign = md5('version=' . $version . '&customerid=' . $customerid . '&userid=' . $userid . '&total_fee=' . $total_fee . '&sdorderno=' . $sdorderno . '&notifyurl=' . $notifyurl . '&returnurl=' . $returnurl . '&' . $key);

?>
<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <title>正在转到付款页</title>
</head>
<body onLoad="document.pay.submit()">
<form name="pay" action="https://aa.39team.com/apisubmit" method="post">
    <input type="hidden" name="version" value="<?php echo $version ?>">
    <input type="hidden" name="customerid" value="<?php echo $customerid ?>">
    <input type="hidden" name="userid" value="<?php echo $userid ?>">
    <input type="hidden" name="sdorderno" value="<?php echo $sdorderno ?>">
    <input type="hidden" name="total_fee" value="<?php echo $total_fee ?>">
    <input type="hidden" name="paytype" value="<?php echo $paytype ?>">
    <input type="hidden" name="notifyurl" value="<?php echo $notifyurl ?>">
    <input type="hidden" name="returnurl" value="<?php echo $returnurl ?>">
    <input type="hidden" name="remark" value="<?php echo $remark ?>">
    <input type="hidden" name="bankcode" value="<?php echo $bankcode ?>">
    <input type="hidden" name="sign" value="<?php echo $sign ?>">
</form>
</body>
</html>
