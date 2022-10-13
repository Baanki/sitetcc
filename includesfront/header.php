<?php
session_start();
include('../includesback/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Meta tags Obrigatórias -->
    <link rel="stylesheet" type="text/css" href="../styles/header.css">
    <script type="text/javascript" src="../scripttcc.js" defer  ></script>
    <script type="text/javascript" src="../api/cep.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="../jquery.mask.js"></script>
    
    <script>$(document).ready(function(){
                $('#telefone_cadastro').mask('(99) 99999-9999');
                $('#data_cadastro').mask('99/99/9999');
                $('#cpf_cadastro').mask('999.999.999-99');
                $('#cep_cadastro').mask('99999-999');
            }); </script>
    <title>Drip</title>
</head>
<body bgcolor="white"> 
    <!-- MENU -->
    
    <header>
        <a href="../pags/index.php"><img id="logo" src="../img/logotcc2.jpg" alt=""></a>
        <nav class="menu_header">
            <a href="../pags/camisetas.php" class="botoes_header">CAMISETAS</a>
            <a href="#" class="botoes_header">JAQUETAS</a>
            <a href="#" class="botoes_header">MOLETOM</a>
            <a href="#" class="botoes_header">CALÇAS</a>
            <a href="#" class="botoes_header">CALÇADOS</a>
        </nav>
        <div class="div_login_carrinho">
            <?php
                if(isset($_SESSION['login_completo'])):              
            ?>
                <style>#botao_login{display: none;}</style>
                <button id="botao_login_cliente"><?php echo "Olá " . $_SESSION['usuario_cli']?></button>
            <?php
                endif;
                unset($_SESSION['login_completo']);//desativar isso pra manter logado
            ?>
            <button id="botao_login"><b>Login</b> ou <b>Cadastre-se</b></button>
            <a href="#"><img src="../img/cart_header_white.png" onmouseover="effect_market_cartover()" onmouseout="effect_market_cartout()" id="botao_carrinho" alt=""></a>
        </div>

    <!-- Tela de login/cadastro -->

            <div class="tela_login">
                <div class="form_tela_login">
                    <p class="texto_login">LOGIN</p>
                    <?php
                    if(isset($_SESSION['login_incompleto'])):
                    ?>
                        <style>.tela_login{display: block;}</style>
                        <div class="login_incompleto">Erro: E-mail ou senha incorreto</div>
                    <?php
                    endif;
                    unset($_SESSION['login_incompleto']);
                    ?>
                        <form action="../includesback/login.php" method="POST">
                            <label for="email_login" class="texto_campo">E-mail:
                                <input class="login_campo" type="email" name="email_login">
                            </label>
                            <label for="senha_login" class="texto_campo">Senha:
                                <input class="login_campo" type="password" name="senha_login">
                            </label>
                            <input class="submit_campo" type="submit" name="entrar_login" value="Entrar">
                        </form>
                        <p class="texto_cadastro">Novo no site? <button class="botao_cadastro">Clique aqui para cadastrar</button></p>
                </div>          
            </div>

            <!-- Form Cadastro -->                   
            
            <div class="tela_cadastro">

            <p class="texto_login">CADASTRO</p>  
        
            <!-- Usuário existe -->  
            <?php
                if(isset($_SESSION['usuario_existe'])):
            ?>              
                <style>.tela_cadastro{display: block;}</style>
                <div class="cadastro_concluido_tela"  style="position: relative;">
                    <p class="texto_cadastro_concluido">E-mail já existente, escolha outro</p>
                </div>
            <?php
                endif;
                unset($_SESSION['usuario_existe'])
            ?>
            <!-- Usuário existe -->  
                <form id="form_concluido" action="../includesback/cadastrar.php" method="POST"> 
                    <div class="cadastro_ladoa">        
                        <label for="nome_cadastro" class="texto_campo">Nome:</label>
                            <input class="cadastro_campo" type="text" name="nome_cadastro" id="nome_cadastro">       
                        <label for="email_cadastro" class="texto_campo">E-mail:</label>
                            <input class="cadastro_campo" type="email" name="email_cadastro" id="email_cadastro">
                        <label for="telefone_cadastro" class="texto_campo">Telefone:</label>
                            <input class="cadastro_campo" type="text" name="telefone_cadastro" id="telefone_cadastro">
                        <div class="cadastro_ladoin_a">
                            <label for="cpf_cadastro" class="texto_campo">CPF:</label>
                                <input class="cadastro_campo2" type="text" name="cpf_cadastro" id="cpf_cadastro">
                            <label for="senha_cadastro" class="texto_campo">Senha:</label>
                                <input class="cadastro_campo" type="password" name="senha_cadastro">
                        </div>
                        <div class="cadastro_ladoin_b">
                            <label for="data_cadastro" class="texto_campo">Data de Nascimento:</label>
                                <input class="cadastro_campo" type="text" name="data_cadastro" id="data_cadastro";>
                            <label for="senha_cadastro2" class="texto_campo">Confirmar Senha:</label>
                                <input class="cadastro_campo" type="password" name="senha_cadastro2">
                        </div>
                    </div>
                        <div class="cadastro_ladob">
                        <label for="cep_cadastro" class="texto_campo">CEP:</label>
                            <input class="cadastro_campo2" type="text" name="cep_cadastro" id="cep_cadastro" value="" onblur="pesquisacep(this.value);">
                        <label for="logradouro_cadastro" class="texto_campo">Logradouro:</label>
                            <input class="cadastro_campo" type="text" name="logradouro_cadastro" id="logradouro_cadastro">
                        <div class="cadastro_ladoin_a">
                            <label for="numero_casa_cadastro" class="texto_campo">Número:</label>
                                <input class="cadastro_campo" type="text" name="numero_casa_cadastro">
                            <label for="bairro_cadastro" class="texto_campo">Bairro:</label>
                                <input class="cadastro_campo" type="text" name="bairro_cadastro" id="bairro_cadastro"> 
                            <label for="estado_cadastro" class="texto_campo">Estado:</label>
                                <input class="cadastro_campo" type="text" name="estado_cadastro" id="estado_cadastro">   
                        </div>
                        <div class="cadastro_ladoin_b">
                            <label for="complemento_cadastro" class="texto_campo">Complemento:</label>
                                <input class="cadastro_campo" type="text" name="complemento_cadastro" id="complemento_cadastro">
                            <label for="cidade_cadastro" class="texto_campo">Cidade:</label>
                                <input class="cadastro_campo" type="text" name="cidade_cadastro" id="cidade_cadastro">  
                                <input class="submit_campo" style="margin-top: 15px; width: 90%;" type="submit" name="entrar_cadastro" value="Cadastrar"> 
                        </div> 
                    </div>        
                </form>
                
            </div>
    </header>
    <!-- Aparecer tela de login -->
    <script>
        
        const tela_login = document.querySelector('.tela_login')
        const botao_login = document.getElementById('botao_login')
        botao_login.addEventListener('click', function(){
            tela_login.style.display = 'block';
        })
        const botao_cadastro = document.querySelector('.botao_cadastro')
        const tela_cadastro = document.querySelector('.tela_cadastro')
        botao_cadastro.addEventListener('click', function(){
            tela_login.style.display = 'none';
            tela_cadastro.style.display = 'block';
        })

        const botao_aqui_cad_conc = document.querySelector('.texto_cadastro_concluido_aqui')
        botao_aqui_cad_conc.addEventListener('click', function(){
            tela_cadastro.style.display = 'none';
            tela_login.style.display = 'block';
        })
        
    </script>
    <!-- Aparecer tela de login -->
</body>
</html>
<?php

?> 