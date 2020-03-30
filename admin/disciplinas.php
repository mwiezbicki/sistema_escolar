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

        <?php if (@$_GET['pg'] == 'disciplina') { ?>
            <div id="box_disciplinas">
                <br/><br/>
                <a class="a2" href="disciplinas.php?pg=disciplina&cadastra=sim">Cadastrar Disciplina</a>
                <br/><br/>
                <hr/>
                <?php if (@$_GET['cadastra'] == 'sim') { ?>
                    <h1>Cadastrar nova Disciplina</h1>
                    <?php
                    if (isset($_POST['cadastra'])) {
                        $curso = addslashes($_POST['curso']);
                        $disciplina = addslashes($_POST['disciplina']);
                        $sala = addslashes($_POST['sala']);
                        $professor = addslashes($_POST['professor']);
                        $turno = addslashes($_POST['turno']);
                        $ano_letivo = date('Y');
                        if ($disciplina == '') {
                            echo "<script language='javascript'>window.alert('Digite o nome da disciplina!');</script>";
                        } else if ($sala == '') {
                            echo "<script language='javascript'>window.alert('Digite a n. da sala de aula!');</script>";
                        } else {
                            $sql_cad_disc = "INSERT INTO disciplinas SET curso = :curso, disciplina = :disciplina, professor = :professor, sala = :sala, turno = :turno, ano_letivo = :ano_letivo";
                            $sql_cad_disc = $pdo->prepare($sql_cad_disc);
                            $sql_cad_disc->bindValue(":curso", $curso);
                            $sql_cad_disc->bindValue(":disciplina", $disciplina);
                            $sql_cad_disc->bindValue(":professor", $professor);
                            $sql_cad_disc->bindValue(":sala", $sala);
                            $sql_cad_disc->bindValue(":turno", $turno);
                            $sql_cad_disc->bindValue(":ano_letivo", $ano_letivo);
                            $sql_cad_disc->execute();
                            if ($sql_cad_disc->rowCount() <= 0) {
                                echo "<script language='javascript'>window.alert('Ocorreu erro ao cadastrar!');</script>";
                            } else {
                                echo "<script language='javascript'>window.alert('Disciplina cadastrada com sucesso!');window.location='disciplinas.php?pg=disciplina';</script>";
                            }
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
                                            <?php
                                            $sql_per = "SELECT * FROM periodos WHERE periodos !=''";
                                            $sql_per = $pdo->query($sql_per);
                                            foreach ($sql_per as $per):
                                            ?>
                                            <option value="<?php echo $per['periodos']; ?>"><?php echo $per['periodos'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td width="126">
                                        <input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></input>
                                    </td>
                                </tr>
                            </table>
                            </form>
                            <br/><br/>
                            <?php die;
                        }
                       ?>
                <!-- Mostrar as disciplinas na tabela-->    
                <h1>Disciplinas</h1>
                <?php
                $sql_buscar_disc = "SELECT * from disciplinas";
                $sql_buscar_disc = $pdo->query($sql_buscar_disc);
                $sql_buscar_disc->execute();
                if ($sql_buscar_disc->rowCount() <= 0) {
                    echo "<h2>No momento não existe nenhuma disciplina cadastrada!</h2>";
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
                        <td><a class="a" href="disciplinas.php?pg=disciplina&deleta=sim&id=<?php echo @$disc['id']; ?>">
                            <img title="Excluir Disciplina" src="../img/deleta.jpg" width="18" height="18" border="0"/></a></td>
                        <?php endforeach; ?>    
                    </tr>
                </table>
                <?php
                }
        }
                // Exclusao das Disciplinas
                if (@$_GET['deleta'] == 'sim') {
                    $id = $_GET['id'];
                    $sql_del_disc = "DELETE FROM disciplinas WHERE id = '$id'";
                    $sql_del_disc = $pdo->query($sql_del_disc);
                    $sql_del_disc->execute();
                    echo "<script language='javascript'>window.alert('Disciplina excluida com sucesso!');window.location='disciplinas.php?pg=disciplina';</script>";
                }
                ?>
                <br/><br/>
            </div> <!--Fecha a disciplina_box -->
  
       <?php require "rodape.php"; ?>
    </body>
</html>