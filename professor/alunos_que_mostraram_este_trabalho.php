<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/alunos_que_mostraram_este_trabalho.css" rel="stylesheet" type="text/css"/>
        <title>Alunos / Trabalhos</title>
    </head>

    <body>
        <?php require 'topo.php'; ?>
        <div id="caixa_preta">

        </div>
        <div id="box">
            <h1>Abaixo segue a lista dos alunos que enviaram o trabalho!</h1>
            <?php if($_GET['pg'] == 'trabalhos_bimestrais') { ?>
                <?php
                if (isset($_POST['button'])) {
                    $code_aluno = $_POST['code_aluno'];
                    $nota = $_POST['nota'];
                    $id_trabalho = $_POST['id_trabalho'];
                    $disciplina = $_POST['disciplina'];
                    $bimestre = $_POST['bimestre'];

                    $sql_3 = "UPDATE envio_de_trabalhos_bimestrais SET status = 'Aceito', nota = '$nota' WHERE id = '$id_trabalho'";
                    $sql_3 = $pdo->query($sql_3);

                    $sql_4 = "INSERT INTO notas_trabalhos (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre',  '$disciplina', '$nota')";
                    $sql_4 = $pdo->query($sql_4);

                    echo "<script language='javascript'>window.window.location='';</script>";
                }
                ?>

                <?php
                $id = $_GET['id'];
                $sql_1 = "SELECT * FROM envio_de_trabalhos_bimestrais WHERE id_trabalho = '$id'";
                $sql_1 = $pdo->query($sql_1);
                if($sql_1->rowCount() <= 0) {
                    echo "<h2>No momento não existe nenhum trabalho enviado para ser corrigido!</h2>";
                } else {
                    foreach ($sql_1 as $result):
                        $sql_1_extra = "SELECT * FROM trabalhos_bimestrais WHERE id = '$id'";
                        $sql_1_extra = $pdo->query($sql_1_extra);

                        foreach ($sql_1_extra as $result_2):
                            ?>    

                            <form name="" method="post" action="" enctype="multipart/form-data">
                                <table width="955" border="0">
                                    <tr>
                                        <td width="107">Código:</td>
                                        <td width="302">Nome do Aluno:</td>
                                        <td width="100">Trabalho:</td>
                                        <td width="144">Data de Envio:</td>
                                        <td width="156">Nota:</td>
                                        <td width="170">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="code_aluno" value="<?php echo $result['aluno']; ?>" />
                                        <input type="hidden" name="disciplina" value="<?php echo $result['disciplina']; ?>" />
                                        <input type="hidden" name="id_trabalho" value="<?php echo $result['id']; ?>" />
                                        <input type="hidden" name="bimestre" value="<?php echo $result_2['bimestre']; ?>" />
                                        <td><h3><?php echo $code_aluno = $result['aluno']; ?></h3></td>
                                        <td>
                                            <h3>
                                                <?php
                                                $sql_2 = "SELECT * FROM estudantes WHERE code = '$code_aluno'";
                                                $sql_2 = $pdo->query($sql_2);
                                                foreach ($sql_2 as $res_2):
                                                    echo $res_2['nome'];
                                                endforeach;
                                                ?>
                                            </h3>
                                        </td>
                                        <td><a href="../trabalhos_alunos/<?php echo $result['trabalho']; ?>" target="_blank">Ver</a></td>
                                        <td><h3><?php echo $result['date']; ?></h3></td>
                <?php
                if ($result['status'] != 'Aguarda') {
                    $nota = $result['nota'];
                    echo "<td><h3>Corrigido - Nota: $nota</h3></td>";
                } else {
                    ?>
                    <td><input name="nota" type="text" id="textfield" size="2"/></td>
                    <td><input type="submit" name="button" id="button" value="Concretizar"/></td>
                <?php }
                ?>
                    <td> <a href="alunos_que_mostraram_este_trabalho.php?pg=excluir&id=<?php echo $result['id']; ?>&id_t=<?php echo $result['id_trabalho']; ?>"><img src="../img/deleta.png" width="22" border="0" title="Excluir trabalho" /></a></td>

                <?php if($result['status'] != 'Aguarda') { ?>
                        <td><a href="alterar_nota_trabalho.php?pg=trabalho_bimestral&id=<?php echo $result['id']; ?>&aluno=<?php echo $result['aluno']; ?>&disciplina=<?php echo $result['disciplina']; ?>&nota=<?php echo $result['nota']; ?>&bimestre=<?php echo $result_2['bimestre']; ?>" rel="superbox[iframe][400x100]"><img border="0" src="../img/ico-editar.png" title="Alterar a nota deste trabalho" /></a></td>
                <?php } ?>
                     </tr>
            </table>
        </form>
            <?php endforeach;
        endforeach;
    }
    ?>
    <?php } ?>
    <?php
        if (@$_GET['pg'] == 'excluir') {
            $id_t = $_GET['id_t'];
            $id = $_GET['id'];
            $sql_2 = "DELETE FROM envio_de_trabalhos_bimestrais WHERE id = '$id'";
            $sql_2 = $pdo->query($sql_2);
            echo "<script language='javascript'>window.location='alunos_que_mostraram_este_trabalho.php?id=$id_t&pg=trabalhos_bimestrais';</script>";
       }
       ?>
       </div>
<?php require 'rodape.php'; ?>
    </body>
</html>    