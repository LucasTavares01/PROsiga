<?php
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/Controles/controleSessao.php');
    session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main>
            <form action="" method="post">
                <div class="caixafundomain">
                    <h2>Lista de presença</h2>
                    <table id="minhaTabela">
                        <tr>
                            <th>Aluno</th>
                            <th>status</th>
                        </tr>
                        <tr>
                        <?php
                        $materias = $_SESSION['materias'];
                        foreach($materias as $materia) {
                            $id = $materia->cod_materia;
                            echo "<tr>";
                            echo "<td class='editarcolunaicone' name='id'>$materia->icone</td>";
                            echo "<td class='editarcolunanome'>$materia->nome</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tr>
                    </table>
                </div>
            </form>
        </main>        
</body>
</html>