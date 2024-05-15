<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="interface.css">
<title>Interface de Login</title>
</head>
<body>
<form method="post">
<div id="main-container" class="centered-flex"> 
<div class="form-container"> 
<div class="icon centered-flex">
<i class="fa fa-user"></i>
</div> 
    <?php
session_start();
$idUsuario = $_SESSION['idusuario'];

if (!($idUsuario > 0)) {
    header("location: login.php");
}

echo "<div class='insere'>Página para cadastrar usuários <u><a href=insere.php>Aqui</a></u></div>";
?>
</div>
</form>
<script src="script.js"></script>
</body>
</html>