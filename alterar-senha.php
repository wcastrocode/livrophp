<!DOCTYPE html>

<html lang="">

    <head>
        <title>Dominando A Linguagem PHP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- COMPONENTES CSS -->
        <link rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" 
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" 
        crossorigin="anonymous">

        <!-- COMPONENTES JS -->
        <script src="verificar.js"></script> 
    </head>

    <body>
        <div class="container" style="margin-top:30px">

            <header class="jumbotron text-center row col-sm-14" style="margin-bottom:2px; background:linear-gradient(white, #0073e6); padding:20px;"> 
                
                <?php 
                    //-----------------------  Função include() para importar arquivo  -----------------------
                    //Exibir o Topo da Página
                    include('topo-admin.php'); 
                ?>
            </header>

            <div class="row" style="padding-left: 0px;">

                <nav class="col-sm-2">
                    <ul class="nav nav-pills flex-column">
                       
                        <?php 
                            //-----------------------  Função include() para importar arquivo  -----------------------
                            //Exibir o Menu da Navegação Página
                            include('nav.php'); 
                        ?> 
                    </ul>
                </nav>

                <?php
                    //-----------------------  Função para obter dados via POST na mesma página  -----------------------
                    //A variável $SERVER com REQUEST_METHOD está esperando o método POST ser executado para processar os dados o arquivo processo-alterar-senha.php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
                        //-----------------------  Função include() para importar arquivo  -----------------------     
                        //Executa o arquivo processo-alterar-senha.php
                        require('alterar-senha-processo.php');
                    }
                ?>

                <div class="col-sm-8">
                    <h2 class="h2 text-center">Alterar Senha</h2>

                    <form action="alterar-senha.php" method="POST" name="regform" id="regform" onsubmit="return verificar();">
                        
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">E-mail: </label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" maxlength="60" required value="<?php 
                                    //-----------------------  Função para manter os dados no campo após a execução do método POST  -----------------------
                                    //Mantem o dado no campo, caso o dado informado seja inválido.
                                    if (isset($_POST['email'])) 
                                        echo $_POST['email']; 
                                    ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="senha1" class="col-sm-4 col-form-label">Senha atual: </label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="senha1" name="senha1" placeholder="Senha" minlenght="4" maxlength="12" value="<?php
                                    //-----------------------  Função para manter os dados no campo após a execução do método POST  -----------------------
                                    //Mantem o dado no campo, caso o dado informado seja inválido.
                                    if(isset($_POST['senha1']))
                                        echo $_POST['senha1']; 
                                    ?>">
                            </div>
                        </div>
                        <div class="form-groud row">
                            <label for="senha2" class="col-sm-4 col-form-label">Nova Senha: </label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="senha2" name="senha2" placeholder="Senha" minlength="4" maxlength="12" required value="<?php 
                                    //-----------------------  Função para manter os dados no campo após a execução do método POST  -----------------------
                                    //Mantem o dado no campo, caso o dado informado seja inválido.
                                    if (isset($_POST['senha2'])) 
                                        echo $_POST['senha2']; 
                                    ?>">
                            <span id="mensagem">Entre 4 e 12 caracteres.</span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="senha3" class="col-sm-4 col-form-label">Confirmar Senha: </label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="senha3" name="senha3" placeholder="Confirmar Senha" minlength="4" maxlength="12" required value="<?php 
                                    //-----------------------  Função para manter os dados no campo após a execução do método POST  -----------------------
                                    //Mantem o dado no campo, caso o dado informado seja inválido.
                                    if(isset($_POST['senha3'])) 
                                        echo $_POST['senha3']; 
                                ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input id="enviar" class="btn btn-primary" type="submit" name="enviar" value="Alterar Senha">
                            </div>
                        </div>
                    </form>
                </div>


                <?php

                    if(isset($errostring)){
                        echo'<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px; padding-top:8px;">';
                    }else{
                        echo '<aside class="col-sm-2">';
                        //-----------------------  Função include() para importar arquivo  -----------------------
                        //Exibir o rodape da pagina
                        include('info-col.php');
                        echo '</aside>';
                        echo '</div>';
                        echo '<footer class="jumbotron text-center row col-sm-14"
                        style="padding-bottom:1px; padding-top:8px;">';
                    }

                    //-----------------------  Função include() para importar arquivo  -----------------------
                    //Exibir o rodape da pagina
                    include('rodape.php'); 
                 ?>
                </footer>
            </div>
        </div>
    </body>
</html>