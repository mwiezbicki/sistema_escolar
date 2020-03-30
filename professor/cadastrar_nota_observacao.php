<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/cadastrar_trabalho.css" rel="stylesheet" type="text/css"/>
        <title>Cadastrar Notas de Observações</title>
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

                $dis = $_POST['dis'];
                $bimestre = $_POST['bimestre'];
                $detalhes = $_POST['detalhes'];
                $date = date("d/m/Y H:i:s");

                $sql_2 = "SELECT * FROM disciplinas WHERE disciplina = '$dis'";
                $sql_2 = $pdo->query($sql_2);
                foreach ($sql_2 as $res_2):
                    $curso = $res_2['curso'];

                    $sql_3 = "INSERT INTO notas_de_observacoes (date, status, professor, curso, disciplina, detalhes, bimestre) VALUES ('$date', 'Ativo', '$code', '$curso', '$dis', '$detalhes', '$bimestre')";
                    $sql_3 = $pdo->query($sql_3);

                    $sql_4 = "INSERT INTO mural_aluno (date, status, curso, titulo) VALUES ('$date', 'Ativo', '$curso', 'As notas bimestrais foram lançadas no sistema')";
                    $sql_4 = $pdo->query($sql_4);

                    echo "Esta informação foi lançado no sistema com sucesso!<br>Aparte em F5 em seu teclado.";
                    die;
                endforeach;
            }
            ?>
            <form name="send" method="post" action="" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td width="272">Disciplina</td>
                        <td>Bimestre:</td>
                    </tr>
                    <tr>
                        <td>
                            <select name="dis" id="dis">
                                <?php
                                $sql_1 = "SELECT * FROM disciplinas WHERE professor = '$code'";
                                $sql_1 = $pdo->query($sql_1);
                                foreach ($sql_1 as $res_1):
                                    ?>
                                    <option value="<?php echo $res_1['disciplina']; ?>"><?php echo $res_1['disciplina']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select name="bimestre" size="1">
                                <option value="1">1&ordm; Bimestre</option>
                                <option value="2">2&ordm; Bimestre</option>
                                <option value="3">3&ordm; Bimestre</option>
                                <option value="4">4&ordm; Bimestre</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Informações adicionais:</td>
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