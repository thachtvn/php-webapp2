<?php
require_once("db.php");
require_once("message.php");
$mailadrress = $_POST['mailadrress'];
$hash = $_POST['hash'];
$select_query = "SELECT コード FROM ユーザー WHERE メール = '" . $mailadrress . "' AND 認証コード = '" . $hash . "' AND 状態 = '0'";
$result = mysqli_query($conn,$select_query);
$row = mysqli_fetch_array($result);
$total_row = $result->num_rows;
if($total_row == 1)
{
    $update_query = "UPDATE ユーザー SET 状態='1' WHERE メール = '" . $mailadrress . "' AND 認証コード = '" . $hash . "' AND 状態 = '0'";
    if (mysqli_query($conn, $update_query)) {
        $message = $message10;
        $error = 0;
    } 
    else 
    {
        $message = mysqli_error($conn);
        $error = 1;
    }
}
else
{    
    $message = $message11;
    $error = 1;
}  
$output = array(
    'error' =>	$error,
    'message'	=>	$message
);
echo json_encode($output);
?> 
