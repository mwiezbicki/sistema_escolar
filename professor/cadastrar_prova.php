<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/cadastrar_prova.css" rel="stylesheet" type="text/css"/>
        <title>Cadastro de Provas</title>
        <?php 
        session_start();
        require "../config.php";
        $code = $_SESSION['code'];
        ?>
    </head>

    <body>
        <div id="box">
            <?php if($_GET['tipo'] == 'bimestral') { ?>
            <?php if(isset($_POST['button'])){
            
            $date = date('d/m/Y');    
            $dis = $_POST['dis'];
            $bimestre = $_POST['bimestre'];
            $aplicacao = $_POST['aplicacao'];
            $detalhes = $_POST['detalhes'];
            
            $sql_2 = "SELECT * FROM disciplinas WHERE disciplina = '$dis'";
            $sql_2 = $pdo->query($sql_2);
            foreach ($sql_2 as $res_2):
                $curso = $res_2['curso'];
            endforeach;
            
            $sql_3 = "INSERT INTO provas_bimestrais (date, status, professor, curso, disciplina, detalhes, bimestre, data_aplicacao)"
                    . "VALUES ('$date','Ativo','$code','$curso','$dis','$detalhes','$bimestre','$aplicacao')";
            $sql_3 = $pdo->query($sql_3);
            
            $sql_4 = "INSERT INTO mural_aluno (date, status, curso, titulo) VALUES ('$date','Ativo','$curso','As notas das provas bimestrais estão sendo divulgadas')";
            $sql_4 = $pdo->query($sql_4);
            
            echo "<script language='javascript'>window.alert('Prova cadastrada com sucesso! Click em OK para cadastrar outras');window.location='cadastrar_prova.php?tipo=bimestral';</script>";
            die;
            }?>
        <form name="send" method="post" action="" enctype="multipart/form-data">
            <table border="0">
                <tr>
                    <td width="272">Disciplina</td>
                    <td>Bimestre:</td>
                    <td width="216">Data de aplicação da prova</td>
                </tr>
                <tr>
                    <td>
                    <select name="dis" id="dis">
                        <?php
                        $sql_1 = "SELECT * FROM disciplinas WHERE professor='$code'";
                        $sql_1 = $pdo->query($sql_1);
                        
                        foreach ($sql_1 as $res_1):
                        ?>
                        <option value="<?php echo $res_1['disciplina']; ?>"><?php echo $res_1['disciplina']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    </td>
                    <td><select name="bimestre" size="1">
                            <option value="1">1&ordm; Bimestre</option>
                            <option value="2">2&ordm; Bimestre</option>
                            <option value="3">3&ordm; Bimestre</option>
                            <option value="4">4&ordm; Bimestre</option>
                    </select></td>
                    <td><input type="text" name="aplicacao" value="<?php echo date("d/m/Y"); ?>"/></td>
                </tr>
                <tr>
                    <td>Informações adicionais:</td>
                </tr>
                <tr>
                    <td colspan="3"><textarea name="detalhes" cols="" rows=""></textarea></td>
                </tr>
                <tr>
                    <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </div>
    </body>
</html>