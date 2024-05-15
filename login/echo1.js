if ($consulta.rowCount() > 0) {
    $resultado = $consulta.fetch();
    $idUsuario = $resultado['id'];
    $hash_senha = $resultado['hash_senha'];
    if (password_verify($senha, $hash_senha)) {
        $_SESSION['idusuario'] = $idUsuario;
        header("location: inicial.php");
    } else {
        msg.innerText = "senha incorreta";
        msg.style.color = 'rgb(218 49 49)';
        btn.disabled = true;
    }
} else {
    msg.innerText = "email incorreto";
    msg.style.color = 'rgb(218 49 49)';
    btn.disabled = true;
}
