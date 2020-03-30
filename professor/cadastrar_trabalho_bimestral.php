<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<link href="css/cadastrar_trabalho_bimestral.css" rel="stylesheet" type="text/css"/>
<title>Cadastro de Trabalhos</title>
<?php 
session_start();
require "../config.php";
$code = $_SESSION['code'];
?>
</head>
 
<body>
    <div id="box">
        <?php if(isset($_POST['button'])){
            
          $date = date("d/m/Y");  
          $bimestre = $_POST['bimestre'];
          $dis = $_POST['dis'];
          $encerramento = $_POST['encerramento'];
          $tema = $_POST['tema'];
          $detalhes = $_POST['detalhes'];
          
          $sql_3 = "SELECT * FROM disciplinas WHERE disciplina = '$dis'";
          $sql_3 = $pdo->query($sql_3);
          foreach ($sql_3 as $cur):
              $curso = $cur['curso'];
          $sql_4 = "SELECT * FROM trabalhos_bimestrais WHERE curso = '$curso' AND disciplina = '$dis' AND bimestre = '$bimestre'";
          $sql_4 = $pdo->query($sql_4);
          
          if($sql_4->rowCount() >= '1'){
              echo "<br><br><br>O trabalho para este bimestre para esta mesma disciplina e curso já foi lançado no sistema!";
              die;
          } else {
              $sql_5 = "INSERT INTO trabalhos_bimestrais (date,status,professor,curso,disciplina,tema,detalhes,data_entrega,bimestre) VALUES "
                      . "('$date','Ativo','$code','$curso','$dis','$tema','$detalhes','$encerramento','$bimestre')";
              $sql_5 = $pdo->query($sql_5);
              $sql_6 = "INSERT INTO mural_aluno (date,status,curso,titulo) VALUES ('$date','Ativo','$curso','Trabalho bimestral de $dis com encerramento no dia $encerramento - Para ver mais detalhes vá em AVALIAÇÕES')";
              $sql_6 = $pdo->query($sql_6);
              
              echo "<br><br>Este trabalho foi lançado no sistema com sucesso!";
              die;
        }
          endforeach;
        }
        ?>
    <form name="send" method="post" action="" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td width="198">N. trabalho</td>
                <td width="216">Lançamento</td>
            </tr>
            <tr>
                <td><input disabled type="text" value="<?php
                $date = date('d/m/Y');
                $sql_1 = "SELECT * FROM trabalhos_bimestrais ORDER BY id DESC LIMIT 1";
                $sql_1 = $pdo->query($sql_1);
                if($sql_1->rowCount() <= 0) {
                    echo "1";
                } else {
                    foreach ($sql_1 as $tra):
                        echo $id = $tra['id']+1;
                    endforeach;
                }
                ?>
                "</td>
                <td><input disabled type="text" value="<?php echo $date; ?>"></td>
            </tr>
            <tr>
                <td width="198">Selecione o bimestre</td>
                <td width="272">Disciplina</td>
            </tr>
            <tr>
                <td>
                    <select name="bimestre" id="dis">
                        <option value="">Selecione o Bimestre</option>
                        <option value="1">1 Bimestre</option>
                        <option value="2">2 Bimestre</option>
                        <option value="3">3 Bimestre</option>
                        <option value="4">4 Bimestre</option>
                    </select>
                </td>
                <td><label for="dis"></label>
                <select name="dis" id="dis">
                    
                    <?php
                    $sql_2 = "SELECT * FROM disciplinas WHERE professor = '$code'";
                    $sql_2 = $pdo->query($sql_2);
                    if($sql_2->rowCount() <= 0){
                        ?><option value=""><?php echo "Nenhuma Disciplina"; ?></option>
                    <?php 
                    } else {
                        ?>
                        <option value="">Selecione uma Disciplina</option>
                        <?php
                    foreach ($sql_2 as $disc):
                    ?>
                    <option value="<?php echo $disc['disciplina']; ?>"><?php echo $disc['disciplina']; ?></option>
                    <?php endforeach; } ?> 
                </select></td>
            </tr>
            <tr>
                <td width="216">Data de entrega</td>
                <td width="272">Tema</td>
            </tr>
            <tr>
                <td><input type="text" name="encerramento" value=""/></td>
                <td><input type="text" name="tema" value=""/></td>
            </tr>
            <tr>
                <td>Mais detalhes sobre o trabalho:</td>
            </tr>
            <tr>
                <td colspan="3"><textarea name="detalhes" cols="" rows=""></textarea></td>
            </tr>
            <tr>
                <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"/></td>
                <td>&nbsp</td>
                <td>&nbsp</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>