<?php
require("includes/strings.php");
require("includes/config.php");
session_start();
if (isset($_SESSION["username"])) {
  header("Location: home.php");
}

if (!empty($_POST)) {
  $email = mysqli_real_escape_string($db,$_POST["email"]);
  $pass = mysqli_real_escape_string($db,$_POST["pass"]);
  $pass_cipher = md5($pass);
  $check = "SELECT id FROM admin WHERE email='$email' AND pass='$pass_cipher'";
  $res = $db->query($check);
  $registro = $res->num_rows;
  if ($registro > 0) {
    $reg = $res->fetch_assoc();
    $_SESSION["username"] = $reg["email"];
    $msg = "<div class='alert alert-success text-center'>Bienvenid@</div>";
    header("Location: home.php");
  }else{
    $msg = "<div class='alert alert-danger text-center'>Usuario o contraseña incorrectos</div>";
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
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><?php echo _APPNAME; ?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?php echo _SIGNINMESS; ?></p>
      <?php if(isset($msg)) { echo $msg; } ?>
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="<?php echo _USEREMAIL; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="icofont-robot"></i>
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
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"><?php echo _SIGNIN; ?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <hr>
      <p class="mb-1">
        <a href="rpass.php"><?php echo _FORGOTPASS; ?></a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center"><?php echo _REGISTER; ?></a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
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
