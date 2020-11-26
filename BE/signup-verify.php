<?php
require_once("db.php");
require_once("message.php");
if($_POST["mail-address"] != '')
{
    $mail = $_POST['mail-address'];
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $message = $message6;
        $error = 1;
    }
    else
    {
        if($_POST["username"] != '')
        {
            if(preg_match("/^[0-9a-zA-Z_]{6,32}$/", $_POST["username"]) === 0)
            {
                $message = $message12;
                $error = 1;
            }
            else
            {
                if(preg_match("/^[0-9a-zA-Z_]{6,32}$/", $_POST["password"]) === 0)
                {
                    $message = $message13;
                    $error = 1;
                }
                else
                {
                    if($_POST["password"] == '' || $_POST["re-password"] == '')
                    {
                        $message = $message3;
                        $error = 1;
                    }
                    else
                    {
                        if($_POST["password"] != $_POST["re-password"])
                        {
                            $message = $message7;
                            $error = 1;
                        }
                        else
                        {
                            $username = $_POST['username'];
                            $select_query = "SELECT コード FROM ユーザー WHERE ユーザーネーム = '" . $username . "'";
                            $result = mysqli_query($conn,$select_query);
                            $row = mysqli_fetch_array($result);
                            $total_row = $result->num_rows;
                            if($total_row == 1)
                            {
                                $message = $message8;
                                $error = 1;
                            }
                            else
                            {    
                                $message = "";
                                $error = 0;
                            }  
                        } 
                    }  
                }  
            }
        }
        else
        {
            $message = $message4;
            $error = 1;
        }
    }    
}
else
{
    $message = $message5;
    $error = 1;
}
if($error == 0){
    $username = trim($_POST["username"]);
    $mailadrress = trim($_POST["mail-address"]);
    $password = trim($_POST["password"]);
    $hash = md5( rand(0,1000) );
    $query = "INSERT INTO ユーザー (ユーザーネーム, パスワード, メール, 認証コード) VALUES ('" . $username . "', '" . $password . "', '" . $mailadrress . "', '" . $hash . "')";
    if(mysqli_query($conn, $query)) 
    {
        require '../library/PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->SMTPAuth = true;
        $mail->Username = 'pelactapchat0011@gmail.com';
        $mail->Password = 'thach123456';
        $mail->SMTPSecure = 'ssl';
        $mail->CharSet = "iso-2022-jp";
        $mail->Encoding = "7bit";
        $mail->From = 'support_system@gmail.com';
        $mail->FromName = mb_encode_mimeheader('お客さまセンター'); 
        $mail->AddAddress($mailadrress);
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Subject = mb_encode_mimeheader('新規登録手続き完了のご案内（自動送信メール）'); 
        $message_body = '
        <p>登録していただきありがとうございます。</p>
        <p>アカウントが作成されました。以下のURLを押してアカウントを有効化した後、次の資格情報でログインできます。</p>
        <br>
        <p>------------------------</p>
        <p>ユーザー名: '.$username.'</p>
        <p>パスワード: '.$password.'</p>
        <p>------------------------</p>
        <br>
        <p>アカウントを有効にするには、以下のリンクをクリックしてください。</p>
        <a href="http://192.168.0.102/webapp/authentication.php?mail='.$mailadrress.'&hash='.$hash.'">http://www.verify.php?mail='.$mailadrress.'&hash='.$hash.'</a>
        <br>
        ';
        $mail->Body = $message_body;
        if($mail->Send())
        {
            $message = "";
            $error = 0;
        }
        else
        {
            $message = $message0.$mail->ErrorInfo;
            $error = 1;
        }
    } 
    else 
    {
        $message = $message0.mysqli_error($conn);
        $error = 1;
    }
}
$output = array(
    'error' =>	$error,
    'message'	=>	$message
);
echo json_encode($output);
?> 
