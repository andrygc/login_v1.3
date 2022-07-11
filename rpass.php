<?php
require("includes/strings.php");
require("includes/config.php");

if (isset($_POST["rpass"])) {
  $email = mysqli_real_escape_string($db,$_POST["email"]);
  $check = "SELECT * FROM admin WHERE email='$email'";
  $resultado = $db->query($check);
  if ($resultado->num_rows > 0) {
    $rpass = mysqli_fetch_array($resultado);
    $db_id = $rpass["id"];
    $db_email = $rpass["email"];
    $token = uniqid(md5(time()));
    $sql = "INSERT INTO rpass(id,email,token) VALUES (NULL,'$email','$token')";
    if ($db->query($sql)) {
      $to = $db_email;
      $subject = "Restablecer contraseña";
      $message = "De click <a href='http://0.0.0.0:8080/DESARROLLO/login/login_v1.3/npass.php?token=$token'>aquí</a> para restablecer su contraseña";
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: <andrynoilien@gmail.com' . "\r\n";
      //mail($to,$subject,$message,$headers);
      $msg = "<div class='alert alert-info text-center'>Se ha enviado un enlace a su dirección de correo para restablecer su contraseña</div>";
    }
  }else{
    $msg = "<div class='alert alert-danger text-center'>Dirección de correo no registrada</div>";
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo _SITENAME; ?></title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Icofont -->
  <link rel="stylesheet" href="assets/css/icofont.css">
  <link rel="stylesheet" href="assets/css/icofont.min.css">
  <!-- Fonts -->
  <link rel="stylesheet" href="assets/css/fonts.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><?php echo _APPNAME; ?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?php echo _FORGOTMESS; ?></p>
      <?php if(isset($msg)) { echo $msg; } ?>
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="<?php echo _USEREMAIL; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="rpass" class="btn btn-primary btn-block"><?php echo _REQUESTLINK; ?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <hr>
      <p class="mb-1">
        <a href="index.php"><?php echo _SIGNIN; ?></a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center"><?php echo _REGISTER; ?></a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
</body>
</html>
