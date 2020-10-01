<?php

$dsn = 'mysql:host=localhost;dbname=mercado';
$user = 'root';
$pass = '03101995';

try {
    //  $pdo é uma variável de conexão que eu mesmo criei e usarei ela como uma instância 
    $pdo = new PDO($dsn, $user, $pass);
    
} catch (PDOException $ex) {
    echo 'Erro ' . $ex->getMessage();
} catch (Exception $ex) {
    echo "Erro genérico" . $ex->getMessage();
}

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$data = date('Y-m-d', strtotime($_POST['data_nascimento']));

//==================================================== //
/* INSERT DE  DADOS */

$insert = $pdo->prepare("INSERT INTO cliente(nome_cliente, cpf_cliente, email_cliente, data_nascimento) VALUES(:n, :c, :e, :d)");
$insert->bindValue(":n", $nome);
$insert->bindValue(":c", $cpf);
$insert->bindValue(":e", $email);
$insert->bindValue(":d", $data);
$res = $insert->execute();

if ($res) {
    echo "Cadastro realizado com sucesso";
}else {
    echo "Erro no cadastro";
}

?>