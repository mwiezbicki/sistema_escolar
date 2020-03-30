<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="../img/ico_escola.png" />
        <link href="css/trabalhos_extras.css" rel="stylesheet" type="text/css"/>
        <title>Notas / Observações</title>
    </head>

    <body>
        <?php require 'topo.php'; ?>
        <div id="caixa_preta">

        </div>
        <div id="box">
            <br /><a class="a2" rel="superbox[iframe][850x350]" href="cadastrar_nota_observacao.php?code=<?php echo $code; ?>">Cadastrar Nota</a>
            <p></p>
            <h1>Abaixo segue seu histórico de notas de observações bimestrais de suas turmas!</h1>
            <?php
            $sql_1 = "SELECT * FROM notas_de_observacoes WHERE professor = '$code' ORDER BY id DESC";
            $sql_1 = $pdo->query($sql_1);
            
            if($sql_1->rowCount() <=0){
                echo "<h2>No momento não existe nenhuma nota de observação lançada no sistema!</h2>";
            } else {
                foreach($sql_1 as $res_1):
                ?>
            <table width="955" border="0">
                <tr>
                    <td width="60">Status</td>
                    <td width="250">Curso</td>
                    <td width="250">Disciplina</td>
                    <td width="250">Bimestre</td>
                    <td width="131">Lançamento</td>
                </tr>
                <tr>
                    <td><h3><?php echo $res_1['status']; ?></h3></td>
                    <td><h3><?php echo $res_1['curso']; ?></h3></td>
                    <td><h3><?php echo $res_1['disciplina']; ?></h3></td>
                    <td><h3><?php echo $res_1['bimestre']; ?>&ordm; Bimestre</h3></td>
                    <td><h3><?php echo $res_1['date']; ?></h3></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="incluir_notas_de_observacoes.php?id=<?php echo $res_1['id']; ?>&curso=<?php echo $res_1['curso']; ?>">Incluir notas</a></td>
                    <td></td>
                    <td><a href="notas_observacoes.php?pg_e=excluir&id=<?php echo $res_1['id']; ?>"><img src="../img/deleta.png" width="22" border="0"/></a></td>
                </tr>
            </table>
                <?php endforeach;
            }
            ?>
        </div>
        <?php if(@$_GET['pg_e'] == 'excluir'){
            $id = $_GET['id'];
            
            $sql_2 = "DELETE FROM notas_de_observacoes WHERE id='$id'";
            $sql_2 = $pdo->query($sql_2);
            echo "<script language='javascript'>window.location='notas_observacoes.php';</script>";
        }?>
        <?php require 'rodape.php'; ?>
    </body>
</html>