<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/correcao_prova.css" rel="stylesheet" type="text/css"/>
        <title>Correção de Provas</title>
    </head>
    <body>
        <?php require 'topo.php'; ?>
        <div id="caixa_preta">
        </div>
    
        <div id="box">
            <h1>Abaixo segue a lista dos alunos desta disciplina!</h1>
            
            <?php if(isset($_POST['button'])){
                $code_aluno = $_POST['code_aluno'];
                $nota = $_POST['nota'];
                $bimestre = $_POST['bimestre'];
                $disciplina = $_POST['disciplina'];
                $prova = $_FILES['prova']['name'];
                
                if(file_exists("../trabalhos/alunos/$prova")){
                    $a = 1;
                    while(file_exists("../trabalhos_alunos/[$a]$prova")){
                       $a++; 
                }
                    $prova = "[".$a."]".$prova;
                }
                
                $sql_3 = "INSERT INTO notas_provas (code, bimestre, disciplina, nota, prova) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', '$prova')";
                $sql_3 = $pdo->query($sql_3);
                (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
                echo "<script language='javascript'>window.location='';</script>";
            }
            ?>
            
            <?php
            
            $id = $_GET['id'];
            $sql_1 = "SELECT * FROM provas_bimestrais WHERE id = '$id'";
            $sql_1 = $pdo->query($sql_1);

            foreach ($sql_1 as $res_1):
                $curso = $res_1['curso'];
                $professor = $res_1['professor'];
                $bimestre = $res_1['bimestre'];

                //verificar curso esta vindo errado aqui *******
            $sql_2 = "SELECT * FROM estudantes WHERE serie = '$curso'";
            $sql_2 = $pdo->query($sql_2);
//            echo $sql_2 ->queryString;
//            exit;
            if($sql_2->rowCount() <= 0){
                echo "<h2>Nem um aluno cadastrado neste curso</h2>";
            } else {
                foreach ($sql_2 as $res_2):
            ?>
            <form name="" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="bimestre" value="<?php echo $res_1['bimestre']; ?>"/>
                <input type="hidden" name="disciplina" value="<?php echo $res_1['disciplina']; ?>"/>
                <input type="hidden" name="code_aluno" value="<?php echo $res_2['code']; ?>"/>
                <table width="955" border="0">
                    <tr>
                        <td width="107">Código:</td>
                        <td width="302">Nome do aluno:</td>
                        <td width="200">D. aplicação:</td>
                        <td width="144">Bimestre:</td>
                        <td width="200">Prova Scaneada:</td>
                        <td width="156">Nota:</td>
                    </tr>
                    <tr>
                        <td><h3><?php echo $code_aluno = $res_2['code']; ?></h3></td>
                        <td><h3><?php echo $res_2['nome']; ?></h3></td>
                        <td><h3><?php echo $res_1['data_aplicacao']; ?></h3></td>
                        <td><h3><?php echo $bimestre = $res_1['bimestre']; ?>.</h3></td>
                        <?php
                        $sql_4 = "SELECT * FROM notas_provas WHERE code = '$code_aluno' AND bimestre = '$bimestre'";
                        $sql_4 = $pdo->query($sql_4);
                        
                        if($sql_4->rowCount() <= 0){
                            ?>
                        <td><input type="file" name="prova" size="5"/></td>
                        <td><input name="nota" type="text" id="textfield" size="6"/></td>
                        <td><input type="submit" name="button" id="button" value="Concretizar"/></td>
                        <?php
                        } else {
                        foreach ($sql_4 as $res_4) :
                        ?>
                        <td><a target="_blank" href="../trabalhos_alunos/<?php echo $res_4['prova']; ?>">Ver prova</a></td>
                        <td><h3><?php echo $res_4['nota']; ?></h3></td>
                        <td><a href="alterar_nota_trabalho.php?pg=prova_bimestral&id=<?php echo $res_4['id']; ?>&aluno=<?php echo $res_2['code']; ?>&disciplina=<?php echo $res_1['disciplina']; ?>&bimestre=<?php echo $res_1['bimestre']; ?>&professor=<?php echo $res_1['professor']; ?>&nota=<?php echo $res_4['nota']; ?>" rel="superbox[iframe][400x100]"><img src="../img/ico-editar.png" border="0" title="Alterar a nota" /></a></td>
                        <?php
                        endforeach;
                        }
                        ?>
                    </tr>
                </table>
            </form>
            <?php
                endforeach;
            }
            endforeach;
            ?>
        </div>
        <?php require 'rodape.php';?>
    </body>
</html>