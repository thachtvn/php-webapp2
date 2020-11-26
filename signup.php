<?php
session_start();
if(isset($_SESSION["user_id"]))
{
	header("location:index.php");
}
?>
<html>
<head>
    <title>登録</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent" style="max-width: 635px;">
            <div class="fadeIn first">
                <img src="./assets/logo.png" alt="システムギア">
            </div>
            <p class="text-left"><b id="errorMessage" class="text-danger"></b></p>
            <p class="text-left"><b id="successMessage" class="text-success fadeIn"></b></p>
            <form method="post" id="signup_form">
                <b>メールアドレス</b>
                <input
                id="mail-address"
                name="mail-address"
                class="fadeIn second" 
                type="text"
                >
                <br>
                <b>ユーザー名</b>
                <input
                id="username"
                name="username"
                class="fadeIn second" 
                type="text"
                >
                <br>
                <b>パスワード</b>
                <input
                id="password"
                name="password"
                class="fadeIn second" 
                type="password"
                >
                <br>
                <b>パスワード（確認）</b>
                <input
                id="re-password"
                name="re-password"
                class="fadeIn second" 
                type="password"
                >
                <input id="submit" type="submit" class="fadeIn second" value="登録">
            </form>
            <div id="formFooter">
                アカウントをお持ち方　<a class="btn btn-custom" href="./login.php"">ログイン</a>
            </div>
        </div>
    </div>
</body>
</html>
<script>
$(document).ready(function(){
    $('#signup_form').on('submit', function(event){    
        event.preventDefault();
        $('#submit').attr("disabled","true");
        $('#errorMessage').addClass("fadeIn");
        setTimeout(function(){ 
            $('#errorMessage').removeClass("fadeIn");
        }, 1000);
        $.ajax({
			url:"BE/signup-verify.php",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			success:function(data)
			{
                if(data.error == 0)
                {
                    document.getElementById("signup_form").reset();
                    $('#successMessage').text("　●　アカウントが作成されました。有効化メールを確認してください。");

                    setTimeout(function(){ 
                        $('#successMessage').text("");
                        $('#submit').removeAttr( "disabled" );
                    }, 10000);

                }
                else
                {
                    $('#errorMessage').text(data.message);
                    $('#submit').removeAttr( "disabled" );
                }
			},
            error:function (error) {
                $('#errorMessage').text(error);
                $('#submit').removeAttr("disabled");
            }
		})
    });
});
</script>