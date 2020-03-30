<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/correcao_prova.css" rel="stylesheet" type="text/css"/>
        <title>Notas de Observações</title>
    </head>
    <body>
        <?php require "topo.php"; ?>
        <div id="caixa_preta">
        </div>

        <div id="box">
            <h1>Abaixo segue a lista dos alunos desta disciplina!</h1>
            
            <?php if(isset($_POST['button'])){

            echo $code_aluno = $_POST['code_aluno'];
            $nota = $_POST['nota'];
            $disciplina = $_POST['disciplina'];
            $date = date("d/m/Y H:i:s");
            $bimestre = $_POST['bimestre'];
            
            $sql_3 = "SELECT * FROM notas_provas WHERE code = '$code_aluno' AND disciplina = '$disciplina' AND bimestre = '$bimestre'";
            $sql_3 = $pdo->query($sql_3);
            if($sql_3->rowCount() <= 0){
                echo "<script language='javascript'>window.alert('A nota da prova bimestral deste aluno ainda não foi lançada no sistema, necessitamos dela para calcular média do aluno');</script>";
            }else{
                foreach ($sql_3 as $res_3):
                $sql_4 = "SELECT * FROM notas_trabalhos WHERE code = '$code_aluno' AND disciplina = '$disciplina' AND bimestre = '$bimestre'";
                $sql_4 = $pdo->query($sql_4);
                if($sql_4->rowCount() <= 0){
                    echo "<script language='javascript'>window.alert('A nota do trabalho bimestral deste aluno ainda não foi lançada no sistema, necessitamos dela para calcular média do aluno');</script>";
                }else{
                    foreach($sql_4 as $res_4):
                    $sql_5 = "SELECT * FROM pontos_extras WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
                    $sql_5 = $pdo->query($sql_5);
                    if($sql_5->rowCount() <= 0){
                        $media = ($res_3['nota']+$res_4['nota']+$nota)/3;
		
                        if($media >10){
                                $media = 10;
                        }else{
                                $media = $media;
                        }
                        $sql_6 = "INSERT INTO notas_observacao (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota')"; 
                        $sql_6 = $pdo->query($sql_6);
 
                        $sql_7 = "INSERT INTO notas_bimestrais (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$media')";
                        $sql_7 = $pdo->query($sql_7);

                        $sql_8 = "DELETE FROM pontos_extras WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
                        $sql_8 = $pdo->query($sql_8);
                        
                        echo "<script language='javascript'>window.location='';</script>";
                    }else{
                        foreach($sql_5 as $res_5):
                            $pontos_extras = $res_5['nota'];		
                            $media = ($res_3['nota']+$res_4['nota']+$pontos_extras+$nota)/3;
                            //Sistema coloca ponto extra sem a divisao por ser ponto extra por isso 3 caso queira
                            // ue ponto extra entre na divisao dividir por 4
                            if($media >10){
                                $media = 10;
                            }else{
                                $media = $media;
                            }
                            $sql_9 = "INSERT INTO notas_observacao (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota')"; 
                            $sql_9 = $pdo->query($sql_9);

                            $sql_10 = "INSERT INTO notas_bimestrais (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$media')";
                            $sql_10 = $pdo->query($sql_10);

                            $sql_11 = "DELETE FROM pontos_extras WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
                            $sql_11 = $pdo->query($sql_11);

                            echo "<script language='javascript'>window.location='';</script>";
                        endforeach;
                    }
                    endforeach;
                }
                endforeach;
            }                  
            }
            ?>
            <?php
            $id = $_GET['id'];
            $sql_1 = "SELECT * FROM notas_de_observacoes WHERE id = '$id'";
            $sql_1 = $pdo->query($sql_1);

//         echo $sql ->queryString - Mostra na tela o sql com as alteracoes da variavel
            foreach ($sql_1 as $res_1):
                $curso = $res_1['curso'];

                $sql_2 = "SELECT * FROM estudantes WHERE status = 'Ativo' AND serie = '$curso'";
                $sql_2 = $pdo->query($sql_2);

                foreach ($sql_2 as $res_2):
                    ?>
                    <form name="" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="code_aluno" value="<?php echo $res_2['code']; ?>" />
                        <input type="hidden" name="bimestre" value="<?php echo $res_1['bimestre']; ?>" />
                        <input type="hidden" name="disciplina" value="<?php echo $res_1['disciplina']; ?>" />
                        <table width="955" border="0">
                            <tr>
                                <td width="107"><strong>Código:</strong></td>
                                <td width="302"><strong>Nome do aluno:</strong></td>
                                <td width="302"><strong>Disciplina:</strong></td>
                                <td width="156"><strong>Nota:</strong></td>
                                <td width="170">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><h3><?php echo $res_2['code']; ?></h3></td>
                                <td><h3><?php echo $res_2['nome']; ?></h3></td>
                                <td><h3><?php echo $res_1['disciplina']; ?></h3></td>
                                <?php
                                $code_aluno = $res_2['code'];
                                $disciplina = $res_1['disciplina'];
                                $bimestre = $res_1['bimestre'];
                                $sql_9 = "SELECT * FROM notas_observacao WHERE code = '$code_aluno' AND disciplina = '$disciplina' AND bimestre = '$bimestre'";
                                $sql_9 = $pdo->query($sql_9);
                                if($sql_9->rowCount() == ''){
                                    ?>
                                <td><input name="nota" type="text" id="textfield" size="6"/></td>
                                <td><input type="submit" name="button" id="button" value="Concretizar"></td>
                                <?php
                                } else {
                                    foreach($sql_9 as $res_9):
                                        echo "<td><h3>Indisponível - Nota: ".$res_9['nota']."</h3></td>";
                                    endforeach;
                                }    
                                ?>
                            </tr>
                        </table>
                    </form>    
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
        <?php require "rodape.php"; ?>
</body>
</html>