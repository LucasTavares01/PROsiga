<?php
require($_SERVER['DOCUMENT_ROOT'] . '/PROsiga/Backend/Controles/controleSessao.php');
session_start();



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['botaoaula'])) {
        $aulas = $_SESSION['aulas'];
        $cod = $_POST['cod2'];
        $_SESSION['id_aula'] = $cod;
        foreach ($aulas as $aula) {
            if ($aula->id_aula == $cod) {
                ControleSessao::selecionarAula($aula);
                header("Location: listapresenca.php");
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
    <link rel="stylesheet" href="styleaulas.css">
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
<!------------------------------------------------MAIN---------------------------------------->
        <main>
            <h2>AULAS</h2>
            <div class="cabecalhomateria">
                <div class="fundocabecalhomateria"></div>
                <?php
                $materia = $_SESSION['materia'];
                $imagemCodificada = base64_encode($materia->icone);
                echo "<img class='icone' src='data:image/svg+xml;base64,$imagemCodificada' />";
                echo "<span class='nomemateria'>$materia->nome</span>";
                ?>
            </div>

            <div class="cabecalhoitens">
                <p class="data">DATA</p>
                <p class="nome">NOME</p>
                <p class="status">STATUS</p>
            </div>

            <div class='caixabotaoaulas'>
                <?php
                $aulas = $_SESSION['aulas'];
                foreach ($aulas as $aula) {
                    echo "<form action='' method='post'>";

                    echo "<input type='hidden' name='cod2' value='$aula->id_aula' />";
                
                    echo "<button type='submit' name='botaoaula' class='botaoaula'>";
                    echo "<p class='datab'>$aula->data</p>";
                    echo "<p class='nomeb'>$aula->titulo</p>";
                    echo "<p class='statusb'>$aula->status</p>";
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

//     if (isset($_POST['botaoaulas'])) {
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