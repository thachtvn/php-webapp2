<?php
require_once("db.php");
require_once("message.php");
session_start();
if($_POST["username"] != '')
{
    if($_POST["password"] != '')
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $select_query = "SELECT コード, 状態 FROM ユーザー WHERE ユーザーネーム = '" . $username . "' AND パスワード = '" . $password . "'";
        $result = mysqli_query($conn,$select_query);
        $row = mysqli_fetch_array($result);
        $status = $row['状態'];
        $total_row = $result->num_rows;
        if($total_row == 1)
        {
            if($status == 1)
            {
                $_SESSION["user_id"] = $row['コード'];
                $_SESSION["user_name"] = $username;
                $message = '';
                $error = 0;
            }
            else
            {
                $message = $message1;
                $error = 1;
            }
        }
        else
        {
            $message = $message2;
            $error = 1;
        }
    }
    else
    {
        $message = $message3;
        $error = 1;
    }
}
else
{
    $message = $message4;
    $error = 1;
}
$output = array(
    'error' =>	$error,
    'message'	=>	$message
);
echo json_encode($output);
?> 
