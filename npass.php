<?php
require("includes/strings.php");
require("includes/config.php");

if (isset($_GET["token"])) {
  $token = mysqli_real_escape_string($db,$_GET["token"]);
  $sql = "SELECT * FROM rpass WHERE token='$token'";
  $resultado = $db->query($sql);
  if ($resultado->num_rows > 0) {
    $row = mysqli_fetch_array($resultado);
    $token = $row["token"];
    $email = $row["email"];
  }else{
    header("Location: index.php");
  }
}

if (isset($_POST["npass"])) {
  $pass = mysqli_real_escape_string($db,$_POST["pass"]);
  $cpass = mysqli_real_escape_string($db,$_POST["cpass"]);
  $pass_cipher = md5($pass);
  if ($pass != $cpass) {
    $msg = "<div class='alert alert-danger text-center'>Las contraseñas no coinciden</div>";
  }elseif (strlen($pass)<6) {
    $msg = "<div class='alert alert-danger text-center'>La contraseña debe tener más de 6 caracteres</div>";
  }else{
    $update = "UPDATE admin SET pass='$pass_cipher' WHERE email='$email'";
    $db->query($update);
    $delete = "DELETE FROM rpass WHERE email='$email'";
    $db->query($delete);
    $msg = "<div class='alert alert-success text-center'>Contraseña actualizada correctamente. Por favor, inicie sesión</div>";
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
      <p class="login-box-msg"><?php echo _RECOVERMESS; ?></p>
      <?php if(isset($msg)) { echo $msg; } ?>
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" readonly>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pass" class="form-control" placeholder="<?php echo _USERPASS; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="cpass" class="form-control" placeholder="<?php echo _USERCPASS; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="npass" class="btn btn-primary btn-block"><?php echo _UPDATEPASS; ?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <hr>
      <p class="mt-3 mb-1">
        <a href="index.php"><?php echo _SIGNIN; ?></a>
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
