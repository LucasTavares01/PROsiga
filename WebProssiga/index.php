<?php
    require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/Controles/controleSessao.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title> Acelera Fatec </title>

</head>


<body>
    
    <div class="wpper">   
        <form method = "post" action="" >
            <h1>LOGIN</h1> 

            <div class="inputBox"> 
                <input type="text" name="email" placeholder="Email"
                required>
                <i class='bx bxs-user'> </i>
            </div>

            <div class="inputBox"> 
                <input type="text" name="password" placeholder="Senha"
                required>
                <i class='bx bxs-lock'></i>
            </div>

            <button type="submit" name="Entrar" class="btn">LOGIN</button> 

        </form>
        
        </div>

        <div class="background-container">
            <img class="background-image" src="https://bkpsitecpsnew.blob.core.windows.net/uploadsitecps/sites/1/2020/10/12248128_860886090694942_800204149398911298_o.jpg" alt="Imagem de Fundo">
        </div>
        <div class="content">
             <h1></h1>  
</body>
</html>

