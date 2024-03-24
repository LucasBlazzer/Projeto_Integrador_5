<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de imagens</title>
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

    // Configurações do banco de dados
    $host = 'localhost';
    $dbname = 'projeto';
    $username = 'root';
    $password = '';

    // Conexão ao banco de dados
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $data_hora = $_POST['data_hora'];
        $imagem = $_FILES['imagem']['name'];
        $autor = $_POST['autor'];

        // Move a imagem para o diretório desejado
        move_uploaded_file($_FILES['imagem']['tmp_name'], 'caminho/do/diretorio/' . $imagem);

        // Insere os dados no banco de dados
        $stmt = $conn->prepare('INSERT INTO imagem (data_hora, imagem, autor) VALUES (?, ?, ?)');
        $stmt->execute([$data_hora, $imagem, $autor]);

        // Verifica se a inserção foi bem-sucedida
        if ($stmt->rowCount() > 0) {
            echo 'Dados inseridos com sucesso!';
            // Redireciona para a tela do formulário limpo
            header('Location: ../cadastro_imagens.html');
            exit;
        } else {
            echo 'Erro ao inserir os dados.';
        }
    }

    ?>

</body>

</html>