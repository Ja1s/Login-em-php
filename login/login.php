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
<div class="title">CONECTE-SE</div> 
<div class="msg">
<?php
    include "bd.php";

    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $pdo = conexao();
        $sql = "SELECT id, hash_senha FROM usuarios WHERE email = :email ";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':email',$email);

        $consulta->execute();

            if($consulta->rowCount() > 0) {
                $resultado = $consulta->fetch();
                $idUsuario = $resultado['id'];
                $hash_senha = $resultado['hash_senha'];
                if (password_verify($senha,$hash_senha)){
                $_SESSION['idusuario'] = $idUsuario;
                header("location: inicial.php"); 
            } else {
            echo "<div class='msg' style='color: rgb(218, 49, 49);'>Senha incorreta</div>";
            }
        } else {
            echo "<div class='msg' style='color: rgb(218, 49, 49);'>Email incorreto</div>";
        }
    }
?>
</div> 
<div class="field"> 
<input type="text" name="email" placeholder="E-mail" id="email"> 
<i class="fa fa-user"></i> 
</div> 
<div class="field"> <input type="password" minlength="3" name="senha" placeholder="Senha" id="pass"> 
<i class="fa fa-lock"></i> 
</div> 
<div class="action centered-flex"> 
<label for="remember" class="centered-flex"> 
<input type="checkbox" id="remember"> Lembre de mim</label> 
<a href="#">Esqueceu a senha?</a> </div> 
<div class="btn-container">
<button id="btn">Conectar</button>
</div> 
<div class="signup">Não tem uma Conta?<a href="insere.php">Inscreva-se</a>
</div> 
</div> 
</div>
</form>
<script src="script.js"></script>
</body>
</html>
