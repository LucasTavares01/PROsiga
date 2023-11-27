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
    <link rel="stylesheet" href="stylelistapresenca.css">
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
            <h2>LISTA DE PRESENÇA</h2>
            <div class="cabecalhomateria">
                <div class="fundocabecalhomateria"></div>
                <?php
                $materia = $_SESSION['materia'];
                $imagemCodificada = base64_encode($materia->icone);
                echo "<img class='icone' src='data:image/svg+xml;base64,$imagemCodificada' />";
                echo "<span class='nomemateria'>$materia->nome - </span>";    
                $aula = $_SESSION['aula'];
                echo "<span class='dataaula'>Aula do dia $aula->data</span>";            
                ?>
                
            </div>

            <div class='caixatabela'>
                <table>
                    <thead>
                        <tr class=cabecalhotabela>
                        <th class="col-imagem">Imagem</th>
                        <th class="col-nome">Nome</th>
                        <th class="col-status">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $presencas = $_SESSION['presencas'];
                        $n_alunos = $_SESSION['n_alunos'];
                        $novas_pres = $_SESSION['novas_pres'];
                        echo "novas_pres: $novas_pres / ";
                        echo "numero: $n_alunos / ";  
                        $n = count($presencas);
                        echo "numero: $n";                      
                        foreach($presencas as $presenca) {
                            $aluno = $presenca->aluno;
                            $nome = $aluno->nome;
                            $img = base64_encode($aluno->img);
                            
                            echo "<tr class='linha'>";
                            echo "<td class='foto'><img src='data:image/svg+xml;base64,$img' alt='Imagem'></td>";
                            echo "<td class='nomealuno'>$nome</td>";
                            echo "<td class='status'>";
                            if($aluno->status == "PRESENTE") {
                                echo "<input type='checkbox' id=$presenca->id_matricula name='presenca' checked/>";
                            } else {
                                echo "<input type='checkbox' id=$presenca->id_matricula name='presenca' />";
                            }                            
                            echo "</td>";
                            echo "</tr>";
                        }
                        
                        ?>
                    </tbody>
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