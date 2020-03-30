<?php
session_start();
$painel_atual = "Portaria";
$painel = $_SESSION['painel'];

if (empty($_SESSION['cLogin'])) {
    header("Location: ../index.php");
} else if ($painel_atual != "$painel") {
    header("Location: ../index.php");
} else {
    ?>
    <html>
        <head>
            <title>Página Portaria</title>
            <link href="css/index.css" rel="stylesheet" type="text/css"/>
            <link rel="shortcut icon" href="../img/ico_escola.png" />
        </head>
        <body>
            <div id="box">
                <div id="porteiro">
                    <h1><strong><font color="red">Módulo Portaria</font></strong></h1>
                    <h1><Strong>Seu código é: <?php echo $_SESSION['cLogin']; ?></strong><a href="../sair.php"><strong>SAIR</strong></a></h1>
                </div> <!--DIV porteiro -->

                <div id="logo">
                    <img src="../img/logo.png" width="250px" />
                </div> <!--DIV Logo -->

                <div id="campo_busca">
                    <form name="" method="POST" action="" enctype="multipart/form-data">
                        <input type="text" name="cpf" value=""/>
                        <input class="input" type="submit" name="send" value="" />
                    </form>
                    <?php
                    require '../config.php';
                    if (isset($_POST['send'])) {
                        $_GET['pg'] = '';
                        $cpf = addslashes($_POST['cpf']);

                        if ($cpf == '') {
                            echo "<script language='javascript'> window.alert('Por favor, digite o número de matrícula ou CPF!');</script>";
                        } else {
                            $sql = "SELECT * from estudantes WHERE code = :cpf OR cpf = :cpf OR rg = :cpf OR nome = :cpf";
                            $sql = $pdo->prepare($sql);
                            $sql->bindValue(":cpf", $cpf);
                            $sql->bindValue(":cpf", $cpf);
                            $sql->bindValue(":cpf", $cpf);
                            $sql->bindValue(":cpf", $cpf);
                            $sql->execute();

                            if ($sql->rowCount() <= 0) {
                                echo "<br/><br/><br/><h2>Aluno não encontrado</h2>";
                            } else {
                                $aluno = $sql->fetch();

                                $nome = $aluno['nome'];
                                $cpf = $aluno['cpf'];
                                $rg = $aluno['rg'];
                                $code = $aluno['code'];

                                ?>
                                <br/><br/><br/>
                                <h3><strong>Aluno: </strong><?php echo $nome;
                                ?>
                                <strong>N. de Matrícula: </strong><?php echo $code; ?>
                                <strong>RG: </strong><?php echo $rg; ?>
                                <a href="index.php?pg=confirma&code_a=<?php echo $code; ?>"><img src="../img/confirma.png" title="Confirmar" border="0" width="22px"/></a>
                                <a href="index.php"><img src="../img/deleta.png" width="24px" title="Cancelar" /></a></h3>
                                <input type="hidden" name="codes" value="" />
                                <?php
                            }
                        }
                    }
              
                if(@$_GET['pg'] == 'confirma'){
                    $data = date('d/m/Y H:i:s');
                    $date = date('d/m/Y');
                    $code = $_SESSION['cLogin'];
                    $code_a = $_GET['code_a'];
                    
                    $sql = ("INSERT INTO confirma_entrada_de_alunos SET date = :data, data_hoje = :date, porteiro = :code, code_aluno = :code_a");
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":data", $data);
                    $sql->bindValue(":date", $date);
                    $sql->bindValue(":code", $code);
                    $sql->bindValue(":code_a", $code_a);
                    
                    $sql->execute();
                    echo "<script language='javascript'>window.alert('A entrada do aluno foi confirmada!!!');</script>";
                }
                ?>
            </div>
        </div>    
    </body>
</html>
<?php
}