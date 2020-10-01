<?php 
    $dsn = 'mysql:host=localhost;dbname=mercado';
    $user = 'root';
    $password = '03101995';

    try {
        $connect = new PDO($dsn, $user, $password);
    }catch (PDOException $ex){
        echo "Erro não esperado".$ex->getMessage();
    }catch (Exception $ex) {
        echo "Erro de tipo genérico".$ex->getMessage();
    }

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];

    // echo "$nome: $cpf: $email: $data_nascimento"
    try {

        $sql = $connect->prepare("INSERT INTO cliente(nome_cliente, cpf_cliente, email_cliente, data_nascimento_cliente)VALUES(:nc, :cpf, :ec, :dt)");
        $sql->bindParam(":nc", $nome);
        $sql->bindParam(":cpf", $cpf);
        $sql->bindParam(":ec", $email);
        $sql->bindParam(":dt", $data_nascimento);
    
        $result = $sql->execute();
        
        if($result) {
            echo "Cadastro realizado com sucesso!";
        }else {
            echo "Erro";
        }

    }catch(PDOException $ex){
        echo 'Erro'.$ex->getMessage();
    }catch(Exception $ex){
        echo $ex->getMessage();
    }


?>  