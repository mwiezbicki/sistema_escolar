<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<link href="css/fazer_chamada.css" rel="stylesheet" type="text/css" />
<title>Chamada</title>
</head>
 
<body>
    <?php require 'topo.php'; ?>
    <div id="caixa_preta">
    </div>
    <div id="box">
        <h1>Abaixo está mostrando todos os alunos do (a) <strong><?php echo $curso = $_GET['curso']; ?> - <?php echo $dis = $_GET['dis'];?></strong> - Data de Hoje <strong><?php echo date("d/m/Y"); ?></strong></h1>
        <?php
        $date = date("d/m/Y H:i:s");
        $date_hoje = date("d/m/Y");
        $dis = $_GET['dis'];
        
        $sql_1 = "SELECT * FROM estudantes WHERE serie = '$curso'";
        $sql_1 = $pdo->query($sql_1);
        if($sql_1->rowCount() == ''){
            echo "<h2>Não existe nenhum aluno cadastrado nesta disciplina!</h2>";
        } else {
            foreach ($sql_1 as $alu):
                $code_aluno = $alu['code'];
            ?>
        <form name="button" method="POST" enctype="multipart/form-data" action="">
            <table width="955" border="0">
                <tr>
                    <td width="94"><strong>Código:</strong></td>
                    <td width="466"><strong>Nome:</strong></td>
                    <td colspan="2"><strong>Este aluno está presente?</strong></td>
                </tr>
                <tr>
                    <td><?php echo $alu['code']; ?><input type="hidden" name="code_aluno" value="<?php echo $alu['code']; ?>"</td>
                    <td><?php echo $alu['nome']; ?><input type="hidden" name="nome" value="<?php echo $alu['nome']; ?>"</td>
                    <td width="315">
                        <?php
                        $sql_2 = "SELECT * FROM chamadas_em_sala WHERE date_day = '$date_hoje' AND disciplina = '$dis' AND code_aluno = '$code_aluno'";
                        $sql_2 = $pdo->query($sql_2);
                        if($sql_2->rowCount() == ''){
                            ?>
                            <input type="radio" name="presenca" id="radio" value="SIM"/>
                            <label for="radio">SIM
                                <input type="radio" name="presenca" value="NAO"/>
                            </label>
                            NAO
                            <input type="radio" name="presenca" value="JUSTIFICADA"/>
                            FALTA JUSTIFICADA
                            <label for="filefield"></label>
                    </td>
                    <td width="62"><input type="submit" name="button" id="button" value="Guardar"/></td>
                    <?php
                        } else {
                            echo "Indisponível"; 
                        }
                        ?>
                </tr>
                <tr>
                    <?php if(isset($_POST['button'])){
                        $code_aluno = $_POST['code_aluno'];
                        $nome = $_POST['nome'];
                        @$presenca = $_POST['presenca'];
                        if($presenca == ''){
                            echo "<script language='javascript'>window.alert('Por favor informe se este aluno está presente ou não na sala de aula!');</script>";
                        } else {
                            $sql_3 = "SELECT * FROM confirma_entrada_de_alunos WHERE data_hoje = '$date_hoje' AND code_aluno = '$code_aluno'";
                            $sql_3 = $pdo->query($sql_3);
                            if($sql_3->rowCount() == '' && $presenca == 'SIM') {
                                echo "<script language='javascript'>window.alert('Este aluno não entrou na escola hoje!');</script>";
                            } else {
                                if($sql_3->rowCount() >=1 && $presenca == 'NAO' || $presenca == 'JUSTIFICADA'){
                                    ?>
                                    <td colspan="3">
                                        <h3><strong>Este aluno entrou na instituição hoje, tem certeza que ele não está na sala de aula?</strong></h3>
                                        <a href="fazer_chamada.php?curso=<?php echo $_GET['curso']; ?>&dis=<?php echo $_GET['dis']; ?>&confirmar_falta=sim&code_aluno=<?php echo $code_aluno; ?>&tipo=<?php echo $_POST['presenca']; ?>">CONFIRMAR FALTA</a>
                                        | <a href="">CANCELAR</a>
                                    </td>
                                    <?php
                                } else {
                                    $sql_4 = "INSERT INTO chamadas_em_sala (date, date_day, curso, disciplina, code_professor, code_aluno, presente) VALUES ('$date', '$date_hoje', '$curso', '$dis', '$code', '$code_aluno', '$presenca')";
                                    $sql_4 = $pdo->query($sql_4);
                                  
                                    echo "<script language='javascript'>window.location='';</script>";
                                    die;
                                }
                                
                            }
                        }
                    }?>
                </tr>
            </table>
        </form>
        <?php if(@$_GET['confirmar_falta'] == 'sim'){
            $code_aluno = $_GET['code_aluno'];
            $presenca = $_GET['tipo'];
            
            $sql_6 = "INSERT INTO chamadas_em_sala (date, date_day, curso, disciplina, code_professor, code_aluno, presente) VALUES ('$date', '$date_hoje', '$curso', '$dis', '$code', '$code_aluno', '$presenca')";
            $sql_6 = $pdo->query($sql_6);
            $curso = $_GET['curso'];
            $dis = $_GET['dis'];
            
            echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&dis=$dis';</script>";
            die;
        }?>
        <?php
            endforeach;
        }
        ?>
    </div>
    <?php require 'rodape.php'; ?>
</body>
</html>