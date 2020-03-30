<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                <br/><br/>
                <a class="a2" href="cursos_e_disciplinas.php?pg=curso&cadastra=sim">Cadastrar Curso</a>
                <?php if (@$_GET['cadastra'] == 'sim') { ?>
                    <br/><br/>
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
                            echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
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
                if ($sql->rowCount() > 0) {
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
                                <td><a class="a" href="cursos_e_disciplinas.php?pg=curso&deleta=cur&id=<?php echo @$res['id']; ?>">
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
                    echo "<script language='javascript'>window.alert('Curso excluído com sucesso!');window.location='cursos_e_disciplinas.php?pg=curso';</script>";
                }
                ?>
                <br/><br/>
            </div><!-- box_curso -->

            <!--Cadastrar Disciplinas -->

            <?php if (@$_GET['pg'] == 'disciplina') {
            ?>
                <div id="box_disciplinas">
                    <a class="a2" href="cursos_e_disciplinas.php?pg=disciplina&cadastra=sim">Cadastrar Disciplina</a>
                    <?php if (@$_GET['cadastra'] == 'sim') {
                    ?>
                        <h1>Cadastrar nova Disciplina</h1>
                        <?php
                        if (isset($_POST['cadastra'])) {
                            $curso = addslashes($_POST['curso']);
                            $disciplina = addslashes($_POST['disciplina']);
                            $sala = addslashes($_POST['sala']);
                            $professor = addslashes($_POST['professor']);
                            $turno = addslashes($_POST['turno']);

                            if ($disciplina == '') {
                                echo "<script language='javascript'>window.alert('Digite o nome da disciplina!');</script>";
                            } else if ($sala == '') {
                                echo "<script language='javascript'>window.alert('Digite a n. da sala de aula!');</script>";
                            } else {
                                $sql_cad_disc = "INSERT INTO disciplinas SET curso = :curso, disciplina = :disciplina, professor = :professor, sala = :sala, turno = :turno";
                                $sql_cad_disc = $pdo->prepare($sql_cad_disc);
                                $sql_cad_disc->bindValue(":curso", $curso);
                                $sql_cad_disc->bindValue(":disciplina", $disciplina);
                                $sql_cad_disc->bindValue(":professor", $professor);
                                $sql_cad_disc->bindValue(":sala", $sala);
                                $sql_cad_disc->bindValue(":turno", $turno);
                                $sql_cad_disc->execute();

                                if ($sql_cad_disc->rowCount() <= 0) {
                                    echo "<script language='javascript'>window.alert('Ocorreu erro ao cadastrar!');</script>";
                                } else {
                                    echo "<script language='javascript'>window.alert('Disciplina cadastrada com sucesso!');window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
                                }
                            }
                            ?>
                            <form name="form1" method="POST" action="">
                            <table width="900" border="0">
                                <tr>
                                    <td width="134">Curso:</td>
                                    <td width="213">Disciplina:</td>
                                    <td>Professor:</td>
                                    <td width="128">Sala:<em>Apenas o número</em></td>
                                    <td width="128">Turno:</td>
                                    <td width="126">&nbsp;</td>
                                    <td width="0" colspan="2"</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="curso">
                                            <?php
                                            $sql_rec_curso = "SELECT * FROM cursos";
                                            $sql_rec_curso = $pdo->query($sql_rec_curso);
                                            $sql_rec_curso->execute();
                                            foreach ($sql_rec_curso as $cur):
                                                ?>
                                                <option value="<?php echo $cur['curso']; ?>"><?php echo $cur['curso']; ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="disciplina" id="textfield">
                                            <td width="143">
                                                <select name="professor">
                                                    <?php
                                                    $sql_rec_prof = "SELECT * FROM professores WHERE nome !=''";
                                                    $sql_rec_prof = $pdo->query($sql_rec_prof);
                                                    $sql_rec_prof->execute();
                                                    foreach ($sql_rec_prof as $pro):
                                                        ?>
                                                        <option value="<?php echo $pro['code']; ?>"><?php echo $pro['nome']; ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </td>    
                                    </td>
                                    <td>
                                        <input type="text" name="sala" id="textfield"></input>
                                    </td>
                                    <td>
                                        <select name="turno" size="1" id="turno">
                                            <option value="Manha">Manhã</option>
                                            <option value="Vespertino">Vespertino</option>
                                            <option value="Noturno">Noturno</option>
                                        </select>
                                    </td>
                                    <td width="126">
                                        <input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></input>
                                    </td>
                                </tr>
                            </table>
                            </form>
                            <?php
                        }
                    }
                    ?>
                    <br/>


                    <!-- Mostrar as disciplinas na tabela-->    
                    <br/><br/>
                    <h1>Disciplinas</h1>
                    <?php
                    $sql_buscar_disc = "SELECT * from disciplinas";
                    $sql_buscar_disc = $pdo->query($sql_buscar_disc);
                    $sql_buscar_disc->execute();
                    if ($sql_buscar_disc->rowCount() <= 0) {
                        echo "<h2>No momento não existe nenhuma disciplina cadastrada!</h2><br/><br/>";
                    } else {
                    ?>
                        <table width="900" border="0">
                        <tr>
                            <td><strong>Curso:</strong></td>
                            <td><strong>Disciplina:</strong></td>
                            <td><strong>Professor:</strong></td>
                            <td><strong>Sala:</strong></td>
                            <td><strong>Turno:</strong></td>
                        </tr>
                        <?php foreach ($sql_buscar_disc as $disc): ?>
                        <tr>
                            <td><h3><?php echo $disc['curso']; ?></h3></td>
                            <td><h3><?php echo $disc['disciplina']; ?></h3></td>
                            <td><h3>
                            <?php
                            $professor = $disc['professor'];
                            $sql_busca_prof = "SELECT * FROM professores WHERE code = :code";
                            $sql_busca_prof = $pdo->prepare($sql_busca_prof);
                            $sql_busca_prof->bindValue(":code", $professor);
                            $sql_busca_prof->execute();
                            $prof = $sql_busca_prof->fetch();
                            echo $prof['code'];
                            echo " - ";
                            echo $prof['nome'];
                            ?>
                            </td></h3>
                            <td><h3><?php echo $disc['sala']; ?></h3></td>
                            <td><h3><?php echo $disc['turno']; ?></h3></td>
                            <td><a class="a" href="cursos_e_disciplinas.php?pg=disciplina&deleta=sim&id=<?php echo @$disc['id']; ?>">
                                <img title="Excluir Disciplina" src="../img/deleta.jpg" width="18" height="18" border="0"/></a></td>
                            <?php endforeach; ?>    
                        </tr>
                        </table>
                        <?php
                    }
                    // Exclusao das Disciplinas
                    if (@$_GET['deleta'] == 'sim') {
                        $id = $_GET['id'];

                        $sql_del_disc = "DELETE FROM disciplinas WHERE id = '$id'";
                        $sql_del_disc = $pdo->query($sql_del_disc);
                        $sql_del_disc->execute();
                        echo "<script language='javascript'>window.alert('Disciplina excluida com sucesso!');window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
                    }
                    ?>
                    <br/><br/>
                </div> <!--Fecha a disciplina_box -->
                <?php
            }            
            ?>
            <?php if(@$_GET['pg'] == 'cursoedisciplinas') {
                ?>
                <div id="box_curso_e_disciplinas">
                    <h1>Cursos e Disciplinas</h1>
                    
                    <?php
                    $sql_ced = "SELECT * FROM cursos";
                    $sql_ced = $pdo->query($sql_ced);
                    $sql_ced->execute();
                    
                    if($sql_ced->rowCount() <= 0) {
                        echo "Não existe nenhum curso cadastrado no momento!";
                    } else {
                        ?>
                    <table width="620" border="0">
                        <?php
                        foreach($sql_ced as $cursos): ?>
                        <tr>
                            <td width="614">Curso: <?php echo $curso = $cursos['curso'];?></td>
                        </tr>
                        <tr>
                            <td>
                                <textarea disabled="disabled" name="textarea" cols="100" rows="5">
                                    <?php
                                    $sql_ced_prof = "SELECT * FROM disciplinas WHERE curso = '$curso'";
                                    $sql_ced_prof = $pdo->query($sql_ced_prof);
                                    $sql_ced_prof->execute();
                                    
                                    foreach($sql_ced_prof as $discipli):
                                        $professor = $discipli['professor'];
                                        echo $discipli['disciplina'];
                                        echo " - ";
                                        $sql_ced_cod = "SELECT * FROM professores WHERE code = '$professor'";
                                        $sql_ced_cod = $pdo->query($sql_ced_cod);
                                        $sql_ced_cod->execute();
                                        
                                        foreach($sql_ced_cod as $prof):
                                            echo $prof['nome'];
                                            echo " - ";
                                            echo $prof['code'];
                                        endforeach;
                                    endforeach;
                                    ?>
                                </textarea>
                            </td>
                        </tr>
                        <?php endforeach;
                        ?>
                    </table>
                    <br/>
                    <?php
                    }
                    ?>
                </div>
                <?php
            }?>
    <?php require "rodape.php";
    ?>
    </body>
</html>