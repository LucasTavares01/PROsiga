<?php
require($_SERVER['DOCUMENT_ROOT'] . '/PROsiga/Backend/Controles/controleSessao.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['botaomateria'])) {
        $materias = $_SESSION['materias'];
        $cod = $_POST['cod'];
        $_SESSION['cod_mat'] = $cod;
        foreach ($materias as $materia) {
            if ($materia->cod_materia == $cod) {
                ControleSessao::selecionarMateria($materia);
                header("Location: aulas.php");
                exit(); // Importante sair do script depois do redirecionamento
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Disciplinas</title>
    <link rel="stylesheet" href="styleprincipal.css">
</head>

<body>

    <div class="avatar-container">
        <div class="fundoavatar"></div>
        <div class="imagemavatar"></div>
    </div>

    <header>
        <?php
        $professor = $_SESSION['professor'];
        echo "<h1> $professor->nome </h1>"; //NOME DO PROFESSOR AQUI
        ?>
    </header>

    <div class="uniaoasidemain">

        <aside>
            <nav>
                <ul>
                    <li><a class="disciplina" href="#">DISCIPLINAS</a></li>
                    <li><a class="materiais" href="#">MATERIAIS</a></li>
                    <li><a class="perfil" href="#">PERFIL</a></li>
                </ul>
            </nav>
        </aside>

        <main>
            <h2>Lista de Disciplinas</h2>
                <div class='caixabotao'>
                    <?php
                    $materias = $_SESSION['materias'];
                    foreach ($materias as $materia) {
                        $imagemCodificada = base64_encode($materia->icone);
                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='cod' value='$materia->cod_materia' />";
                        echo "<button type='submit' name='botaomateria' class='botaomateria'>";
                        echo "<img class='icone' src='data:image/svg+xml;base64,$imagemCodificada' />";
                        echo "<span class='nomebotao'>$materia->nome</span>";
                        echo "</button>";
                        echo "</form>";
                    }
                    ?>
                </div>            
        </main>

    </div>

    <footer>
        <div class="caixalogo">
            <div class="logocentropaula"></div>
            <div class="logogovernosp"></div>
        </div>
    </footer>
</body>

</html>

<?php
// if ($_SERVER["REQUEST_METHOD"] === "POST") {

//     if (isset($_POST['botaomateria'])) {
//         $materias = [];
//         $materias = $_SESSION['materias'];
//         $cod = $_POST['cod'];
//         $_SESSION['cod_mat'] = $cod;
//         foreach ($materias as $materia) {
//             if ($materia->cod_materia == $cod) {
//                 ControleSessao::selecionarMateria($materia);
//                 header("Location: aulas.php");
//                 break;
//             }
//         }
//     }
// }
?>