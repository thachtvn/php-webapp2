<?php
session_start();
if(!isset($_SESSION["user_id"]))
{
	header("location:login.php");
}

?>
<html>
<head>
    <title>トップ</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script defer src="assets/fontawesome/js/all.js"></script>
    <link rel="stylesheet" href="css/home-styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-custom ">
  <a class="navbar-brand" href="index.php" ><img src="assets/logo.png" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> HOME</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">ソリューション</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">製品情報</a>
      </li>  
      <li class="nav-item">
        <a class="nav-link disabled" href="#">サポート</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">お問合せ</a>
      </li>    -->
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a data-toggle="modal" data-target="#logoutModal" class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> ログアウト</a>
      </li>  
    </ul>
  </div>  
</nav>

<div id="content">
  <div class="row">
    <div id="sidenav" class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
      <h5><i class="fas fa-user"></i> マイアカウント</h5>
      <p>ユーザー名：<?php echo $_SESSION["user_name"];?></p>
      <ul id="user-menu" class="nav nav-pills flex-column">
        <li class="nav-item">
          <a id="1" class="nav-link click active" href="#"><i class="fas fa-chevron-right"></i> アカウントの情報</a>
        </li>
        <li class="nav-item">
          <a id="2" class="nav-link click" href="#"><i class="fas fa-chevron-right"></i> 会員情報のご変更</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#"><i class="fas fa-chevron-right"></i> Link3</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#"><i class="fas fa-chevron-right"></i> Link4</a>
        </li>
      </ul>
      <br>
      <h5><i class="fas fa-tools"></i> 社内ツール</h5>
      <p>(Internal Tools)</p>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="../functions" target="_blank"><i class="fas fa-chevron-right"></i> 一番星V8レファレンス</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#"><i class="fas fa-chevron-right"></i> 一番星V8</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#"><i class="fas fa-chevron-right"></i> 一番星V7</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#"><i class="fas fa-chevron-right"></i> 倉一郎</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div id="layout" class="col-xl-9 col-lg-8 col-md-7 col-sm-6">
      <!-- <?php include 'FE/index1.php';?> -->
      <iframe id="frame" src="FE/index1.php" height="100%" width="100%" style="border:none;" ></iframe>
    </div>
  </div> 
</div>

<!-- <footer class="text-center" style="margin-bottom:0">
  <p><?php date_default_timezone_set("Asia/Tokyo"); echo date("H:i");?> <?php echo date("Y/m/d");?></p>
</footer> -->
</body>
<!-- Modal -->
<div id="logoutModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">確認</h4>
      </div>
      <div class="modal-body">
        <p>ログアウトを実行しませんか？</p>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-primary" href="logout.php">確認</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
      </div>
    </div>
  </div>
</div>
</html>
<script>
$('#user-menu li a.click').click(function(){
  document.getElementById("frame").setAttribute("src", "FE/index"+ $(this).attr('id')+".php");
  $('#user-menu li a').removeClass('active');
  $(this).addClass('active');
})
</script>