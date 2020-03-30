<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/editar_trabalho.css" rel="stylesheet" type="text/css"/>
        <link href="css/editar_prova.css" rel="stylesheet" type="text/css"/>
        <title>Editar Prova</title>
        <?php
        require "../config.php";
        $date = date('d/m/Y H:m:i');
        $code = $_GET['code'];
        $id = $_GET['id'];
        ?>
    </head>
    <body>
        <div id="box"> 
            <?php if(isset($_POST['button'])){
                $dis = $_POST['dis'];
                $bimestre = $_POST['bimestre'];
                $aplicacao = $_POST['aplicacao'];
                $detalhes = $_POST['detalhes'];
                
                $sql_3 = "UPDATE provas_bimestrais SET disciplina = '$dis', detalhes = '$detalhes', bimestre = '$bimestre', data_aplicacao = '$aplicacao' WHERE id = '$id'";
                $sql_3 = $pdo->query($sql_3);
                
                echo "Esta prova foi atualizada no sistema com Sucesso!<br>Aperte em F5 em seu teclado.";
                die;   
            }?>
            <?php
            $sql_5 = "SELECT * FROM provas_bimestrais WHERE id = '$id'";
            $sql_5 = $pdo->query($sql_5);
            foreach ($sql_5 as $res_5):
            ?>
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
                                <option value="<?php echo $dis = $res_5['disciplina']; ?>"><?php echo $dis = $res_5['disciplina']; ?></option>
                                <option value=""></option>
                                <?php
                                $sql_1 = "SELECT * FROM disciplinas WHERE professor = '$code' AND disciplina != '$dis'";
                                $sql_1 = $pdo->query($sql_1);
                                foreach ($sql_1 as $res_1):
                                ?>
                                <option value="<?php echo $res_1['disciplina']; ?>"><?php echo $res_1['disciplina']; ?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                        <td>
                            <select name="bimestre" size="1">
                                <option value="<?php echo $res_5['bimestre']; ?>"><?php echo $res_5['bimestre']; ?> Bimestre</option>
                                <option value=""></option>
                                <option value="1">1&ordm; Bimestre</option>
                                <option value="2">2&ordm; Bimestre</option>
                                <option value="3">3&ordm; Bimestre</option>
                                <option value="4">4&ordm; Bimestre</option>
                            </select>
                        </td>
                        <td><input type="text" name="aplicacao" value="<?php echo $res_5['data_aplicacao']; ?>"/></td>
                    </tr>
                    <tr>
                        <td>Informações adicionais:</td>
                    </tr>
                    <tr>
                        <td colspan="3"><textarea name="detalhes" cols="" rows=""><?php echo $res_5['detalhes']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"/></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </form>
            <?php endforeach;?>
        </div>
    </body>
</html>