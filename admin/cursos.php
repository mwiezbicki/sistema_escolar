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

        <?php if (@$_GET['pg'] == 'curso') { ?>
            <div id="box_curso">
                <br /><br />
                <a class="a2" href="cursos.php?pg=curso&cadastra=sim">Cadastrar Curso</a>
                <br /><br />
                <hr />
                
                <?php if (@$_GET['cadastra'] == 'sim') { ?>
                <h1>Cadastrar Curso</h1>
                    <?php
                    if (isset($_POST['cadastra'])) {
                        $curso = addslashes($_POST['curso']);

                        $sql = ("INSERT INTO cursos SET curso = :curso");
                        $sql = $pdo->prepare($sql);
                        $sql->bindValue(":curso", $curso);
                        $sql->execute();

                        if ($sql->rowCount() > 0) {
                            echo "<script language='javascript'>window.alert('Curso cadastrado com sucesso!!!');</script>";
                            echo "<script language='javascript'>window.location='cursos.php?pg=curso';</script>";
                        } else {
                            echo "<script language='javascript'>window.alert('Curso não cadastrado!!!');</script>";
                        }
                    }
                    ?>
                    <form name="form1" method="POST" action="">
                        <table width="900" border="0">
                            <tr>
                                <td width="134">Curso</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="curso" id="textfield"></td>
                                <td><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
                            </tr>
                            
                        </table>
                    </form>
                    <br/>

                    <?php
                    die;
                }
                ?>
                <!-- Visualizar os Cursos Cadastrados-->
                <h1>Cursos</h1>
                <?php
                $sql = "SELECT * FROM cursos";
                $sql = $pdo->query($sql);
                if ($sql->rowCount() == '') {
                    echo "<h2>Nenhum curso cadastrado no momento!!</h2>";
                }else{
                    ?>

                    <table width="900" border="0">
                        <tr>
                            <td><strong>Curso:</strong></td>
                            <td><strong>Total de disciplinas deste curso:</strong></td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php foreach ($sql->fetchAll() as $res): ?>
                        <tr>
                            <td><h3><?php echo $res['curso']; ?></h3></td>
                            <?php
                            $curso = $res['curso'];
                            $sql_2 = "SELECT count(*) as c FROM disciplinas WHERE curso = :curso";
                            $sql_2 = $pdo->prepare($sql_2);
                            $sql_2->bindValue(":curso", $curso);
                            $sql_2->execute();
                            if ($sql_2->rowCount() > 0) {
                                $resul = $sql_2->fetch();
                                ?>
                                <td><h3><?php echo $resul['c']; ?></h3></td>
                                <td><a class="a" href="cursos.php?pg=curso&deleta=cur&id=<?php echo @$res['id']; ?>">
                                    <img title="Excluir curso" src="../img/deleta.jpg" width="18" height="18" border="0"/></a></td>
                                <?php
                            }
                        ?></tr><?php endforeach;
                }
                ?>

                </table>
            <?php
            }

                // EXclusao dos Cursos
                if (@$_GET['deleta'] == 'cur') {
                    $id = $_GET['id'];

                    $sql_3 = "DELETE FROM cursos WHERE id = '$id'";
                    $sql_3 = $pdo->query($sql_3);
                    $sql_3->execute();
                    echo "<script language='javascript'>window.alert('Curso excluído com sucesso!');window.location='cursos.php?pg=curso';</script>";
                }
                ?>
                <br/>
            </div><!-- box_curso -->
            <?php require 'rodape.php'; ?>
    </body>
</html>