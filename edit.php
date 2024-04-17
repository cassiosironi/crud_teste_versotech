<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css.map" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossor />
</head>

<body>
    <div class="container py-5">
        <h1>Editar Usuário</h1>

        <?php
        // Conexão com o banco de dados SQLite
        $db = new PDO('sqlite:database/db.sqlite');

        // Verifica se o formulário de edição foi submetido
        if (isset($_POST['edit_user'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];

            // Atualiza os dados do usuário no banco de dados
            $stmt = $db->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
            $stmt->execute(array(':name' => $name, ':email' => $email, ':id' => $id));

            // Redireciona de volta para a página inicial após a edição
            header('Location: index.php');
            exit;
        }

        // Obtém o ID do usuário da URL
        $id = $_GET['id'];

        // Seleciona os dados do usuário específico do banco de dados
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <!-- Formulário preenchido com os dados do usuário para edição -->
        <div class="jumbotron mb-4">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <label for="name">Nome:</label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required><br>
                <label for="email">E-mail:</label>
                <input class="form-control" type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required><br>
                <button class="btn btn-info" type="submit" name="edit_user"><i class="fa fa-save "></i> Salvar alterações</button>
            </form>
        </div>
    </div>
</body>

</html>