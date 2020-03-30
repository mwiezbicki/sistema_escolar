<?php $painel_atual = "admin"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        session_start();
        require "../config.php";
        $code = $_SESSION['code'];
        $nome = $_SESSION['nome'];
        $user = $_SESSION['code'];
        ?>
        <link href="../css/topo.css" rel="stylesheet" type="text/css" />
        <script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
        <script src="../js/lightbox.js"></script>
        <!--<link href="../css/lightbox.css" rel="stylesheet" />-->


        <link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

        <script type="text/javascript" src="../jquery.superbox-min.js"></script>
        <script type="text/javascript">

            $(function () {

                $.superbox.settings = {

                    closeTxt: "Fechar",

                    loadTxt: "Carregando...",

                    nextTxt: "Next",

                    prevTxt: "Previous"

                };

                $.superbox();

            });

        </script>
    </head>

    <body>
        <div id="box_topo">

            <div id="logo">
                <img src="../img/logo1.png" width="250"/>
            </div><!-- logo -->

            <div id="campo_busca">

                <form name="" method="post" action="" enctype="multipart/form-data">
                    <input type="text" name="key" /><input class="input" type="submit" name="search" value="" />
                </form>

                <?php if(isset($_POST['search'])){
                    $key = $_POST['key'];
                    if($key == ''){
                        echo "<script language='javascript'>window.alert('Digite algo para fazer a pesquisa');</script>";
                    }else{
                        echo "<script language='javascript'>window.location='resultado_da_pesquisa.php?q=$key';</script>";
                    }
                }?>
            </div><!-- campo_busca -->

            <div id="mostra_login">
                <h1>Seja Bem Vindo: <?php echo @$nome; ?> - Seu código de acesso é:<?php echo @$code; ?><a href="../sair.php">Sair</a></h1>
            </div><!-- mostra_login -->
        </div><!-- box_topo -->

        <div id="box_menu">

            <div id="menu_topo">
                <ul>
                    <img src="../img/separador_menu.png" />
                    <li><a href="index.php">HOME</a></li>
                    <img src="../img/separador_menu.png" />
                    <li><a href="">CURSOS E DISCIPLINAS</a>
                        <ul>
                            <li><a href="cursos.php?pg=curso">Cadastrar Curso</a></li>
                            <li><a href="periodos.php?pg=periodo">Cadastrar Periodo</a></li>
                            <li><a href="disciplinas.php?pg=disciplina">Cadastrar Disciplina</a></li>
                            <li><a href="historico.php?pg=historico">Cadastrar Histórico</a></li>
                            <li><a href="cursodisciplina.php?pg=cursoedisciplinas">Cursos & Disciplinas</a></li>
                        </ul>
                    </li>
                    <img src="../img/separador_menu.png" />
                    <li><a href="professores.php?pg=todos">PROFESSORES</a></li>
                    <img src="../img/separador_menu.png" />
                    <li><a href="estudantes.php">ESTUDANTES</a></li>
                    <img src="../img/separador_menu.png" />
                    <li><a href="setor_financeiro.php">SETOR FINANCEIRO</a></li>
                    <img src="../img/separador_menu.png" />
                    <li><a href="">RELATÓRIOS</a>
                        <ul>
                            <li><a href="relatorios.php?tipo=alunos">Alunos</a></li>
                            <li><a href="relatoriospro.php?tipo=professores">Professores</a></li>
                            <li><a href="fluxo_de_caixa.php?&s=<?php echo base64_encode("WHERE m = ".date("m")." AND a = ".date("Y").""); ?>">Fluxo de caixa</a></li>
                            <li><a href="relatorios_ani.php?tipo=aniversariantes">Aniversariantes</a></li>

                        </ul>
                    </li>
                    <img src="../img/separador_menu.png" />
                    <li><a href="suporte_tecnico.php">SUPORTE TECNICO</a></li>
                    <img src="../img/separador_menu.png" />
                    <li><a href="">EXTRAS</a>
                        <ul>
                            <li><a href="funcionarios.php?pg=todos">Funcionários</a></li>
                        </ul>
                    </li>
                    <img src="../img/separador_menu.png" />
                </ul>
            </div><!-- menu_topo -->

        </div><!-- box_menu -->
    </body>
</html>
