
<?php
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/controleSessao.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/controleProfessor.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/professor.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/controleMateria.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/materia.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/controleAula.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/aula.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/controlePresenca.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/presenca.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/controleAluno.php');
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/aluno.php');


    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST['Entrar'])) {

            $sessao = new ControleSessao();
            ControleSessao::login($_POST['email'], $_POST['password']);
            if($_SESSION['professor']) {
                echo "Login bem-sucedido. Você pode redirecionar para a página desejada.";
            } else {
                echo "Login falhou. Verifique suas credenciais.";
            }
        }


        
        /*
        // Conecte-se ao banco de dados (substitua as informações de conexão)
        $host = "seu_host";
        $username = "seu_usuario";
        $password = "sua_senha";
        $database = "Professores";

        $connection = new mysqli($host, $username, $password, $database);

        if ($connection->connect_error) {
            die("Erro na conexão com o banco de dados: " . $connection->connect_error);
        }

        // Receba os dados do formulário
        $email = $_POST['email'];
        $senha = $_POST['password'];

        // Consulta ao banco de dados
        $query = "SELECT * FROM professores WHERE email = '$email' AND senha = '$senha'";
        $result = $connection->query($query);

        if ($result->num_rows == 1) {
            // Login bem-sucedido
            echo "Login bem-sucedido. Você pode redirecionar para a página desejada.";
        } else {
            // Login falhou
            echo "Login falhou. Verifique suas credenciais.";
        }

        // Feche a conexão com o banco de dados
        $connection->close();
        */
    }
    ?>
