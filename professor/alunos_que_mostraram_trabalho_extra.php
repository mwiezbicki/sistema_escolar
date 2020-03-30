<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/alunos_que_mostraram_este_trabalho.css" rel="stylesheet" type="text/css"/>
        <title>Entrega Trabalho Extra</title>
    </head>

    <body>
        <?php require 'topo.php'; ?>
        <div id="caixa_preta">

        </div>
        <div id="box">
            <h1>Abaixo segue a lista dos alunos que enviaram o trabalho!</h1>
            <?php
            if (isset($_POST['button'])) {
                $code_aluno = $_POST['code_aluno'];
                $nota = $_POST['nota'];
                $id_trabalho = $_POST['id_trabalho'];
                $disciplina = $_POST['disciplina'];

                $sql_3 = "UPDATE envio_de_trabalhos_extras SET status = 'Aceito', nota = '$nota' WHERE aluno = '$code_aluno' AND id_trabalho = '$id_trabalho' AND disciplina = '$disciplina'";
                $sql_3 = $pdo->query($sql_3);
//                echo $sql_3->queryString;
//                die;

                $sql_4 = "INSERT INTO notas_trabalhos (code, bimestre, disciplina, nota) VALUES ('$code_aluno', 'Trabalho Extra',  '$disciplina', '$nota')";
                $sql_4 = $pdo->query($sql_4);

                $sql_5 = "SELECT * FROM pontos_extras WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
                $sql_5 = $pdo->query($sql_5);

                if ($sql_5->rowCount() <= 0) {
                    $sql_6 = "INSERT INTO pontos_extras (code, disciplina, nota) VALUES ('$code_aluno','$disciplina','$nota')";
                    $sql_6 = $pdo->query($sql_6);

                    echo "<script language='javascript'>window.window.location='';</script>";
                } else {
                    foreach ($sql_5 as $res_5):
                        $nova_nota = $res_5['nota']+$nota;
                        $sql_7 = "UPDATE pontos_extras SET nota = '$nova_nota' WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
                        $sql_7 = $pdo->query($sql_7);
                        echo "<script language='javascript'>window.window.location='';</script>";
                    endforeach;
                }
            }?>
            <?php
                $id = $_GET['id'];
                $sql_1 = "SELECT * FROM envio_de_trabalhos_extras WHERE id_trabalho = '$id'";
                $sql_1 = $pdo->query($sql_1);
                if($sql_1->rowCount() <=0) {
                    echo "<h2>No momento não existe nenhum trabalho enviado para ser corrigido!</h2>";
                }else{
                    foreach ($sql_1 as $result):
                        $sql_extra = "SELECT * FROM trabalhos_extras WHERE id = '$id'";
                        $sql_extra = $pdo->query($sql_extra);

                        foreach ($sql_extra as $res_extra):
                            ?>    

                            <form name="" method="post" action="" enctype="multipart/form-data">
                                <table width="955" border="0">
                                    <tr>
                                        <td width="107">Código:</td>
                                        <td width="302">Nome do Aluno:</td>
                                        <td width="100">Trabalho:</td>
                                        <td width="144">Data de Envio:</td>
                                        <td width="156">Nota máxima(<strong><em><?php echo $res_extra['pontos']; ?></em></strong>):</td>
                                        <td width="170">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="code_aluno" value="<?php echo $result['aluno']; ?>" />
                                        <input type="hidden" name="disciplina" value="<?php echo $result['disciplina']; ?>" />
                                        <input type="hidden" name="id_trabalho" value="<?php echo $result['id_trabalho']; ?>" />
                                        <input type="hidden" name="bimestre" value="<?php echo $result['aluno']; ?>" />
                                        <td><?php echo $code_aluno = $result['aluno']; ?></td>
                                        <td>
                                            <?php
                                            $sql_2 = "SELECT * FROM estudantes WHERE code = '$code_aluno'";
                                            $sql_2 = $pdo->query($sql_2);
                                            foreach ($sql_2 as $res_2):
                                                echo $res_2['nome'];
                                            endforeach;
                                            ?>
                                        </td>
                                        <td><a href="../trabalhos_alunos/<?php echo $result['trabalho']; ?>" target="_blank">Ver</a></td>
                                        <td><h3><?php echo $result['date']; ?></h3></td>
                                        <?php if($result['nota'] == '') { ?>
                                            <td><input name="nota" type="text" id="textfield" size="2"/></td>
                                            <td><input type="submit" name="button" id="button" value="Concretizar"/></td>
                                            <td><a href="alunos_que_mostraram_trabalho_extra.php?pg=excluir&id=<?php echo $result['id']; ?>&id_t=<?php echo $_GET['id']; ?>"><img src="../img/deleta.png" width="22" border="0" title="Excluir trabalho" /></a></td>
                                            <?php
                                        } else {
                                            $nota = $result['nota'];
                                            echo "<td>Corrigido - <strong>$nota</strong></td>";
                                            ?>
                                            <td><a href="alterar_nota_trabalho.php?pg=trabalho_extra&id=<?php echo $result['id']; ?>&id_trabalho=<?php echo $_GET['id']; ?>&aluno=<?php echo $result['aluno']; ?>&disciplina=<?php echo $result['disciplina']; ?>&nota=<?php echo $result['nota']; ?>" rel="superbox[iframe][400x100]"><img border="0" src="../img/ico-editar.png" title="Alterar a nota deste trabalho" /></a></td>
                                        <?php } ?>
                                    </tr>
                                </table>
                            </form>
                        <?php
                        endforeach;
                    endforeach;
                }
                ?>
            <?php
            if (@$_GET['pg'] == 'excluir') {
                $id_t = $_GET['id_t'];
                $id = $_GET['id'];
                $sql_excluir = "DELETE FROM envio_de_trabalhos_extras WHERE id = '$id' AND id_trabalho = '$id_t'";
                $sql_excluir = $pdo->query($sql_excluir);
                echo "<script language='javascript'>window.location='alunos_que_mostraram_trabalho_extra.php?id=$id_t&pg=trabalhos_bimestrais';</script>";
            }
            ?>
        </div>
        <?php require 'rodape.php'; ?>
    </body>
</html>    