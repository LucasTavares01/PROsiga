<?php
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/Controles/controleSessao.php');
    session_start();
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
            
                <div class="caixafundomain">
                    <h2>Lista de Disciplinas</h2>
                    <table id="minhaTabela">
                        <tr>
                        <?php
                        $materias = $_SESSION['materias'];
                        foreach($materias as $materia) {
                            echo "<tr>";
                                echo "<form action='' method='post'>";                            
                                    echo "<input type='hidden' name='cod' value='$materia->cod_materia' />";
                                    echo "<button type='submit' name='EscolherMateria' class='btn'>$materia->nome</button>";                            
                                echo "</form>";
                            echo "</tr>";
                        }
                        ?>
                        </tr>
                    </table>
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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($_POST['EscolherMateria'])) {
        $materias = [];
        $materias = $_SESSION['materias'];
        $cod = $_POST['cod'];
        $_SESSION['cod_mat'] = $cod;
        foreach($materias as $materia) {
            if($materia->cod_materia == $cod) {
                ControleSessao::selecionarMateria($materia);
                header("Location: aulas.php");                
                break;
            }
        }  
    }
}
?>
