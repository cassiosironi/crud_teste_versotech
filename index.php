<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css.map" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossor />
</head>

<body>
    <div class="container py-5">
        <h1>CRUD de Usuários</h1>

        <?php
        // Conexão com o banco de dados SQLite
        $db = new PDO('sqlite:database/db.sqlite');

        // Verifica se o formulário de adição foi submetido
        if (isset($_POST['add_user'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];

            // Insere o novo usuário no banco de dados
            $stmt = $db->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
            $stmt->execute(array(':name' => $name, ':email' => $email));
        }

        // Verifica se o formulário de edição foi submetido
        if (isset($_POST['edit_user'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];

            // Atualiza os dados do usuário no banco de dados
            $stmt = $db->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
            $stmt->execute(array(':name' => $name, ':email' => $email, ':id' => $id));
        }

        // Verifica se a ação de exclusão foi solicitada
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];

            // Exclui o usuário do banco de dados
            $stmt = $db->prepare('DELETE FROM users WHERE id = :id');
            $stmt->execute(array(':id' => $id));
        }
        ?>

        <!-- Formulário para adicionar novo usuário -->
        <div class="jumbotron mb-4">
            <h4>Adicionar Novo Usuário</h4>
            <form action="" method="post">
                <label for="name">Nome:</label>
                <input class="form-control" type="text" name="name" id="name" required><br>
                <label for="email">E-mail:</label>
                <input class="form-control" type="email" name="email" id="email" required><br>
                <button class="btn btn-success" type="submit" name="add_user"><i class="fa fa-plus "></i> Adicionar Usuário</button>
            </form>
        </div>
        <!-- Lista de usuários -->
        <h4>Lista de Usuários</h4>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
            <?php
            // Seleciona todos os usuários do banco de dados
            $stmt = $db->query('SELECT * FROM users');
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td><a class="btn btn-primary" href="edit.php?id=' . $row['id'] . '"><i class="fa fa-edit"></i></a> | <a class="btn btn-danger" href="?delete=' . $row['id'] . '"><i class="fa fa-trash"></i></a></td>';
                echo '</tr>';
            }
            ?>
        </table>

    </div>
</body>

</html>