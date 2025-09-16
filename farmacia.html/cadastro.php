<?php
session_start(); 
require 'contact_bd.php'; 

$conn = new mysqli($host, $username, $pasword, $bdbname);

// Verifica conexão 
if ($conn->connect_error) {
    die("Falha de conexão: " . $conn->connect_error);
}

// Coleta dados do POST
$nome    = $conn->real_escape_string($_POST['nome']); 
$login   = $conn->real_escape_string($_POST['Login']); 
$celular = $conn->real_escape_string($_POST['Telefone']); 
$senha   = $conn->real_escape_string($_POST['Senha1']); 

// Validação adicional opcional
if (empty($nome) || empty($login) || empty($celular) || empty($senha)) {
    $_SESSION['mensagem'] = "Todos os campos são obrigatórios!";
    header('location: formulario.html');
    exit();
}

// Insere no banco
$sql = "INSERT INTO Cliente (Nome, Telefone, Login, Senha) 
        VALUES ('$nome', '$celular', '$login', md5('$senha'))";

if ($conn->query($sql) === TRUE) {
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
    header('location: index1.html'); // redireciona para página inicial ou login
    exit();
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar: " . $conn->error;
    header('location: formulario.html');
    exit();
}

$conn->close();