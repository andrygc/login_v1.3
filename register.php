<?php
require("includes/strings.php");
require("includes/config.php");

if (isset($_POST["registrar"])) {
  $user = mysqli_real_escape_string($db,$_POST["user"]);
  $email = mysqli_real_escape_string($db,$_POST["email"]);
  $pass = mysqli_real_escape_string($db,$_POST["pass"]);
  $pass_cipher = md5($pass);
  $check_user = "SELECT id FROM admin WHERE email='$email'";
  $res = $db->query($check_user);
  $registros = $res->num_rows;
  if ($registros > 0) {
    $msg = "<div class='alert alert-danger text-center'>La dirección de correo ya existe</div>";
  
  }else{
    //insertar registro
    $insert = "INSERT INTO admin(user,email,pass) VALUES ('$user','$email','$pass_cipher')";
    $resultado = $db->query($insert);
    if ($resultado > 0) {
      $msg = "<div class='alert alert-success text-center'>Registro realizado correctamente. Por favor, inicie sesión</div>";
    }else{
      $msg = "<div class='alert alert-danger text-center'>Fallo en el registro</div>";
    }
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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><?php echo _APPNAME; ?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?php echo _REGISTER; ?></p>
      <?php if(isset($msg)) { echo $msg; } ?>
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" id="user" name="user" class="form-control" placeholder="<?php echo _USERNAME; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" id="email" name="email" class="form-control" placeholder="<?php echo _USEREMAIL; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="pass" name="pass" class="form-control" placeholder="<?php echo _USERPASS; ?>">
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
            <button type="submit" name="registrar" class="btn btn-primary btn-block"><?php echo _SIGNUP; ?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <hr>
      <p class="mb-1">
        <a href="index.php"><?php echo _SIGNIN; ?></a>
      </p>
      <p class="mb-0">
        <a href="rpass.php" class="text-center"><?php echo _FORGOTPASS; ?></a>
      </p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
</body>
</html>
