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
                                        ?>
                                        
                                    <?php
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

