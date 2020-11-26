<?php
session_start();

if(isset($_SESSION["user_id"]))
{
	header("location:index.php");
}
elseif(isset($_SESSION["user_name"]))
{
    $user_name = $_SESSION["user_name"];
    unset($_SESSION['user_name']);    
}
?>
<html>
<head>
    <title>ログイン</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <img src="./assets/logo.png" alt="システムギア">
            </div>
            <form method="post" id="login_form">
                <p class="text-left"><b id="errorMessage" class="text-danger "></b></p>
                <b>ユーザー名</b>
                <input
                id="username"
                name="username"
                class="fadeIn second" 
                type="text"
                value="<?php
                if(isset($user_name))
                {
                    echo $user_name;
                }
                ?>">
                <br>
                <b>パスワード</b>
                <input
                id="password"
                name="password"
                class="fadeIn second" 
                type="password">
                <input type="submit" class="fadeIn second" id="loginButton" value="ログイン" >
            </form>
            <div id="formFooter">
                アカウントをお持ちでない方　<a class="btn btn-custom" href="./signup.php">登録</a>
            </div>
        </div>
    </div>
</body>
</html>

<script>
$(document).ready(function(){
    $('#login_form').on('submit', function(event){    
        event.preventDefault();
        $('#errorMessage').addClass("fadeIn");
        setTimeout(function(){ 
            $('#errorMessage').removeClass("fadeIn");
        }, 1000);
        $.ajax({
			url:"BE/login-verify.php",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			success:function(data)
			{
                if(data.error == 0)
                {
                    window.location.replace("index.php");
                }
                else
                {
                    $('#errorMessage').text(data.message);
                }
			},
            error:function (error) {
                $('#errorMessage').text(error);
            }
		})
    });
});
</script>