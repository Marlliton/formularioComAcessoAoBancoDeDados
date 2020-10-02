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

/* VERIFICANDO SE JA POSSUI CADASTRO */
// $res = $pdo->query("select count(*) from cliente where email_cliente ='souza@gmail.com';");

// print_r($res);




$insert = $pdo->prepare("INSERT INTO cliente(nome, cpf, email_cliente, data_nascimento) VALUES(:n, :c, :e, :d)");
$insert->bindValue(":n", $nome);
$insert->bindValue(":c", $cpf);
$insert->bindValue(":e", $email);
$insert->bindValue(":d", $data);
$res = $insert->execute();


// ============================================================//
$dados = $pdo->query("SELECT * FROM cliente ORDER BY nome;");
$resultado = $dados->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resposta</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container" style="width: 70%;">
        <table class="tabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Data nascimento</th>
                </tr>
            </thead>

            <?php

                if($resultado > 0) {
                    for($i=0; $i<count($resultado); $i++){
                        echo "<tr>";
                        foreach($resultado[$i] as $key => $value) {
                            if ($key != "id") {
                                echo "<td>".$value."</td>";
                            }
                        }
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </div>
</body>

</html>