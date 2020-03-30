<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/cadastrar_trabalho_bimestral.css" rel="stylesheet" type="text/css"/>
        <title>Editar Trabalho Bimestral</title>
        <?php
        require "../config.php";
        $code = $_GET['code'];
        $id = $_GET['id'];
        ?>
    </head>
    <body>
        <div id="box"> 
            <?php if(isset($_POST['button'])){
                $dis = $_POST['dis'];
                $encerramento = $_POST['encerramento'];
                $tema = $_POST['tema'];
                $detalhes = $_POST['detalhes'];
                $curso = $_POST['curso'];
                
                $sql_5 = "UPDATE trabalhos_bimestrais SET disciplina = '$dis', tema = '$tema', detalhes = '$detalhes', data_entrega = '$encerramento' WHERE id = '$id'";
                $sql_5 = $pdo->query($sql_5);
                $date = date('d/m/Y H:i:s');
                
                $sql_6 = "INSERT INTO mural_aluno (date, status, curso, titulo) VALUES ('$date', 'Ativo', '$curso', 'Foi alterado o trabalho bimestral de $dis com encerramento no dia $encerramento - Para ver mais detalhes vá em AVALIAÇÕES')";
                $sql_6 = $pdo->query($sql_6);
                
                echo "<br><br><br>Este trabalho foi atualizado no sistema com Sucesso!<br>Aperte em F5 em seu teclado.";
                die;   
            }?>
            <?php
            $sql_1 = "SELECT * FROM trabalhos_bimestrais WHERE id = '$id'";
            $sql_1 = $pdo->query($sql_1);
            foreach ($sql_1 as $res_1):
            ?>
        <form name="send" method="post" action="" enctype="multipart/form-data">
        <table width="700" border="0">
            <tr>
                <td width="198">N&ordm; Trabalho</td>
                <td width="216">Lançamento</td>
            </tr><input type="hidden" name="curso" value="<?php echo $res_1['curso']; ?>"/>
            <tr>
                <td><input disabled type="text" value="<?php echo $res_1['id']; ?>"/></td>
                <td><input disabled type="text" value="<?php echo $res_1['date']; ?>"/></td>
            </tr>
            <tr>
                <td>Disciplina</td>
            </tr>
            <tr>
                <td><label for="dis"></label>
                    <select name="dis" id="dis">
                        <option value="<?php echo $res_1['disciplina']; ?>"><?php echo $res_1['disciplina']; ?></option>
                        <option value=""></option>
                        <?php
                        $dis = $res_1['disciplina'];
                        $sql_2 = "SELECT * FROM disciplinas WHERE professor = '$code' AND disciplina != '$dis'";
                        $sql_2 = $pdo->query($sql_2);
                    
                        foreach ($sql_2 as $res_2):
                        ?>
                        <option value="<?php echo $res_2['disciplina']; ?>"><?php echo $res_2['disciplina']; ?></option>
                        <?php endforeach; ?> 
                    </select>
                </td>
                <tr>
                    <td width="216">Data de Entrega</td>
                    <td width="272">Tema</td>
                </tr>
                <tr>
                    <td><input type="text" name="encerramento" value="<?php echo $res_1['data_entrega']; ?>"/></td>
                    <td><input type="text" name="tema" value="<?php echo $res_1['tema']; ?>"/></td>
                </tr>
            <tr>
                <td>Mais detalhes sobre o trabalho:</td>
            </tr>
            <tr>
                <td colspan="3"><textarea name="detalhes" cols="" rows=""><?php echo $res_1['detalhes']; ?></textarea></td>
            </tr>
            <tr>
                <td><input class="input" type="submit" name="button" id="button" value="Editar"/></td>
                <td>&nbsp</td>
                <td>&nbsp</td>
            </tr>
        </table>
    </form>
    <?php endforeach;?>
        </div>
    </body>
</html>