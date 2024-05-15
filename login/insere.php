<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="interface.css">
<title>Interface de Cadastro</title>
</head>
<body>
<form method="post">
<div id="main-container" class="centered-flex"> 
<div class="form-container"> 
<div class="icon centered-flex">
<i class="fa fa-user"></i>
</div> 
<div class="title">CADASTRE-SE</div> 
<div class="msg">
<?php
include "bd.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $senhaConfirm = $_POST["senhaConfirm"];

    if ($senha !== $senhaConfirm) {
        echo "<div class='msg' style='color: rgb(218, 49, 49);'>As senhas não coincidem!</div>";
    } else {
        $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

        $pdo = conexao();

        $sql_verifica = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $consulta_verifica = $pdo->prepare($sql_verifica);
        $consulta_verifica->bindParam(':email', $email);
        $consulta_verifica->execute();
        $num_rows = $consulta_verifica->fetchColumn();

        if ($num_rows > 0) {
            echo "<div class='msg' style='color: rgb(218, 49, 49);'>Este e-mail já está cadastrado!</div>";
        } else {
            $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (email, hash_senha) VALUES (:email, :hash_senha)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':hash_senha', $hashSenha);

            if ($consulta->execute()) {
                echo "<div class='msg' style='color: #92ff92;'>Cadastro inserido!</div>";
            } else {
                echo "<div class='msg' style='color: rgb(218, 49, 49);'>Erro ao inserir cadastro!</div>";
            }
        }
    }
}
?>
</div> 
<div class="field"> 
<input type="text" name="email" placeholder="E-mail" id="email"> 
<i class="fa fa-user"></i> 
</div> 
<div class="field"> 
<input type="password" minlength="3" name="senha" placeholder="Senha" id="pass"> 
<i class="fa fa-lock"></i> 
</div> 
<div class="field"> 
<input type="password" minlength="3" name="senhaConfirm" placeholder="Confirme a senha" id="passConfirm"> 
<i class="fa fa-lock"></i> 
</div> 
<div class="btn-container">
<button id="btn">Criar</button>
</div> 
<div class="signin">Já tem uma Conta?<u><a href="login.php">Entre já</a></u>.
</div> 
</div> 
</div>
</form>
<script src="script.js"></script>
</body>
</html>
