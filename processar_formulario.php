<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recebe_dados</title>
</head>

<body>

    <?php

    // Configurações do banco de dados
    $host = 'localhost';
    $dbname = 'projeto';
    $username = 'root';
    $password = '';

    // Conectando ao banco de dados usando PDO
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexão com o banco de dados estabelecida com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
    ?>

    <?php
    // Recebendo os dados do formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $conteudo = $_POST['conteudo'];

    // Obtendo a data e hora atual
    $dataHora = date('d/m/y H:i:s');

    // Configurações do banco de dados
    $host = 'localhost';
    $dbname = 'projeto';
    $username = 'root';
    $password = '';

    // Conectando ao banco de dados usando PDO
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Inserindo os dados na tabela
        $stmt = $pdo->prepare("INSERT INTO conteudos (titulo, autor, data_edicao, conteudo) VALUES (:titulo, :autor, :data_edicao, :conteudo)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':data_edicao', $dataHora);
        $stmt->bindParam(':conteudo', $conteudo);
        $stmt->execute();

        echo "Dados inseridos no banco de dados com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao inserir os dados no banco de dados: " . $e->getMessage();
    }

    // Redirecionando o usuário para uma página de confirmação
    header('Location: cadastro_historia.html');
    ?>



</body>

</html>