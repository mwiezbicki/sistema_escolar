<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/cadastrar_trabalho.css" rel="stylesheet" type="text/css"/>
        <title>Cadastrar Trabalhos</title>
        <?php
        session_start();
        require "../config.php";
        $code = $_SESSION['code'];
        ?>
    </head>

    <body>
        <div id="box">
            <?php
            if (isset($_POST['button'])) {
                $date = date('d/m/Y H:i:s');
                $dis = $_POST['dis'];
                $pontos = $_POST['pontos'];
                $encerramento = $_POST['encerramento'];
                $tema = $_POST['tema'];
                $detalhes = $_POST['detalhes'];

                $sql_3 = "SELECT * FROM disciplinas WHERE disciplina = '$dis'";
                $sql_3 = $pdo->query($sql_3);
                foreach ($sql_3 as $res_3):
                    $curso = $res_3['curso'];
                    $sql_4 = "INSERT INTO trabalhos_extras (date, status, professor, curso, disciplina, tema, detalhes, data_entrega, pontos) "
                            . "VALUES ('$date','Ativo','$code','$curso','$dis','$tema','$detalhes','$encerramento','$pontos')";
                    $sql_4 = $pdo->query($sql_4);
                    $sql_5 = "INSERT INTO mural_aluno (date, status,curso,titulo) VALUES ('$date','Ativo','$curso','Trabalho extra da disciplina $dis com encerramento no dia $encerramento - Para ver mais detalhes vá em AVALIAÇÕES')";
                    $sql_5 = $pdo->query($sql_5);

                    echo "Este trabalho foi lançado no sistema com sucesso!<br>Aperte em F5 em seu teclado.";
                    die;
                endforeach;
            }
            ?>

            <form name="send" method="post" action="" enctype="multipart/form-data">
                <table border="0">
                    <tr>
                        <td width="198">N&ordm; trabalho</td>
                        <td width="216">Lançamento</td>
                        <td width="272">Disciplina</td>
                        <td width="100"></td>
                    </tr>
                    <tr>
                        <td>
                            <input disabled type="text" value="<?php
                            $sql_1 = "SELECT * FROM trabalhos_extras ORDER BY id DESC LIMIT 1";
                            $sql_1 = $pdo->query($sql_1);
                            if ($sql_1->rowCount() <= 0) {
                                echo "1";
                            } else {
                                foreach ($sql_1 as $res_1):
                                    echo $res_1['id'] + 1;
                                endforeach;
                            }
                            ?>"/>
                        </td>
                        <td><input disabled type="text" value="<?php echo date('d/m/Y H:i:s'); ?>"/></td>
                        <td>
                            <select name="dis" id="dis">
                                <?php
                                $sql_2 = "SELECT * FROM disciplinas WHERE professor = '$code'";
                                $sql_2 = $pdo->query($sql_2);
                                foreach ($sql_2 as $res_2):
                                    ?>
                                    <option value="<?php echo $res_2['disciplina']; ?>"><?php echo $res_2['disciplina']; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Total de pontos:</td>
                        <td width="216">Data de entrega</td>
                        <td width="272">Tema</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="pontos" value=""></td>
                        <td><input type="text" name="encerramento" value=""></td>
                        <td><input type="text" name="tema" value=""></td>
                    </tr>
                    <tr>
                        <td>Mais detalhes sobre o trabalho:</td>
                    </tr>
                    <tr>
                        <td colspan="3"><textarea name="detalhes" cols="" rows=""></textarea></td>
                    </tr>
                    <tr>
                        <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>