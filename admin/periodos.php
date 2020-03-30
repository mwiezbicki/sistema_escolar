<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <title>Adminstração</title>
        <link href="../css/cursos_e_disciplinas.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php
        require 'topo.php';
        require '../config.php';
        ?>

        <div id="caixa_preta">
        </div>

        <?php if (@$_GET['pg'] == 'periodo') { ?>
            <div id="box_curso">
                <br /><br />
                <a class="a2" href="periodos.php?pg=periodo&cadastra=sim">Cadastrar Periodo</a>
                <br /><br />
                <hr />
                
                <?php if (@$_GET['cadastra'] == 'sim') { ?>
                <h1>Cadastrar Periodo</h1>
                    <?php
                    if (isset($_POST['cadastra'])) {
                        $periodo = addslashes($_POST['periodo']);

                        $sql_1 = "INSERT INTO periodos (periodos) VALUES ('$periodo')";
                        $sql_1 = $pdo->query($sql_1);

                        if ($sql_1->rowCount() > 0) {
                            echo "<script language='javascript'>window.alert('Periodo cadastrado com sucesso!!!');</script>";
                            echo "<script language='javascript'>window.location='periodos.php?pg=periodo';</script>";
                        } else {
                            echo "<script language='javascript'>window.alert('Periodo não cadastrado!!!');</script>";
                        }
                    }
                    ?>
                    <form name="form1" method="POST" action="">
                        <table width="900" border="0">
                            <tr>
                                <td width="134">Periodo</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="periodo" id="textfield"></td>
                                <td><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
                            </tr>
                            
                        </table>
                    </form>
                    <br/>

                    <?php
                    die;
                }
                ?>
                <!-- Visualizar os Periodos Cadastrados-->
                <h1>Periodos</h1>
                <?php
                $sql_2 = "SELECT * FROM periodos";
                $sql_2 = $pdo->query($sql_2);
                if ($sql_2->rowCount() == '') {
                    echo "<h2>Nenhum periodo cadastrado no momento!!</h2>";
                }else{
                    ?>

                    <table width="900" border="0">
                        <tr>
                            <td><strong>Periodo:</strong></td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php foreach ($sql_2 as $res_2): ?>
                        <tr>
                            <td><h3><?php echo $res_2['periodos']; ?></h3></td>
                            <td><a class="a" href="periodos.php?pg=periodo&deleta=per&id=<?php echo $res_2['id']; ?>">
                                <img title="Excluir Periodo" src="../img/deleta.jpg" width="18" height="18" border="0"/></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                <?php
                }
        }    

                // Exclusao dos Periodos
                if (@$_GET['deleta'] == 'per') {
                    $id = $_GET['id'];

                    $sql_3 = "DELETE FROM periodos WHERE id = '$id'";
                    $sql_3 = $pdo->query($sql_3);
                    $sql_3->execute();
                    echo "<script language='javascript'>window.alert('Periodo excluído com sucesso!');window.location='periodos.php?pg=periodo';</script>";
                }
                ?>
                <br/>
            </div><!-- box_curso -->
            <?php require 'rodape.php'; ?>
    </body>
</html>