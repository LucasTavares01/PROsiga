<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Login</title>
    <link rel="stylesheet" href="stylelogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="fundo">
        <div class="esquerda"></div>
        <div class="centro"></div>
        <div class="direita"></div>
    </div>

    <div class="blur"></div>

    <div class="wrapper">
        <form action="" method="post">
            <div class="logo"></div>
            <h1>Login</h1>            
            <div class="input-box">
                <input type="text" name="email" placeholder="E-mail" required>
                <i class='bx bxs-user'></i>                
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Senha" required> 
                <i class='bx bxs-lock-alt' ></i>               
            </div>

            <div class="lembrar-esqueceu">
                <label><input type="checkbox"> Lembrar</label>
                <a href="#">Esqueceu a senha?</a>
            </div>

            <button type="submit" name="Entrar" class="btn">ENTRAR</button>

            <div class="link-cadastro">
                <p>Não tem uma conta? <a href="#">Cadastrar</a></p>
            </div>
        </form>
    </div>
    
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/Controles/controleSessao.php');
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST['Entrar'])) {
        
            $sessao = new ControleSessao();
            ControleSessao::login($_POST['email'], $_POST['password']);
            if($_SESSION['professor']) {
                //Login Bem sucedido
                // echo "Login bem-sucedido. Você pode redirecionar para a página desejada.";
                header("Location: disciplinas.php");
                
            } else {
                //Erro no Login
                echo "Login falhou. Verifique suas credenciais.";
            }
        }
        
        // if (isset($_POST['EscolherMateria'])) {
        
        //     ControleSessao::selecionarMateria($_POST['materia']);
        //     header("Location: aulas.php");
        // }
        
        // if (isset($_POST['EscolherAula'])) {
        
        //     ControleSessao::selecionarAula($_POST['aula']);
        //     header("Location: chamada.php");
        // }
        
        // if (isset($_POST['SalvarChamada'])) {
        
        //     ControleSessao::salvarChamada();
        //     header("Location: aulas.php");
        // }
    }
?>
</body>
</html>