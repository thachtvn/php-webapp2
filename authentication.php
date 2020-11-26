<?php
if($_GET["mail"] == '' || $_GET["hash"] == '' )
{
    header("location:index.php");
}
$mailadrress = trim($_GET["mail"]);
$hash = trim($_GET["hash"]);
?>
<html>
<head>
    <title>認証</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/load-styles.css">
</head>
<body>
    <div id="load" class="lds-dual-ring"></div>
    </br>  
    <h3 class=text-center id="successMessage">確認中...少々お待ちください。</h3>
    <div class="wrapper">
        <h3 class=text-center>
            <img src="./assets/warning.png" height="0px" id="errorImage">
        </h3>
        <br>
        <h3 class=text-center><span id="errorMessage" class="text-danger"></span></h3>
    </div>    
</body>
</html>
<script>
$(document).ready(function(){
    $.ajax({
    	url:"BE/authentication-verify.php",
    	method:"POST",
    	data: { 
            mailadrress: '<?php echo $mailadrress; ?>',
            hash: '<?php echo $hash; ?>'
        },
    	dataType:"json",
    	success:function(data)
    	{
            if(data.error == 0)
            {
                setTimeout(function(){ 
                    $('#successMessage').text(data.message);
                }, 3000);
                setTimeout(function(){ 
                    window.location.replace("index.php");
                }, 6000);
            } 
            else
            {
                setTimeout(function(){ 
                    $('#successMessage').css("display","none");
                    $('#errorMessage').text(data.message);
                }, 1000);
                setTimeout(function(){ 
                    $('#load').css("display","none");
                    $('body').css("background","#fff");
                    $('#errorImage').css("height","100px");
                }, 2000);
                setTimeout(function(){ 
                    window.location.replace("index.php");
                }, 10000);
            }
    	},
        error:function (error) {
            $('body').css("background","#fff");
            $('#load').css("display","none");
            $('#successMessage').css("display","none");
            $('#errorImage').css("height","100px");
            $('#errorMessage').text(error);
            setTimeout(function(){ 
                window.location.replace("index.php");
            }, 10000);
        }
    });
});
</script>