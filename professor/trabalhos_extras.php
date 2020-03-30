<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<link href="css/trabalhos_extras.css" rel="stylesheet" type="text/css"/>
<title>Trabalhos Extras</title>
</head>
 
<body>
    <?php require 'topo.php'; ?>
    <div id="caixa_preta">
    </div>
    
    <div id="box">
        <br /><a class="a2" rel="superbox[iframe][850x350]" href="cadastrar_trabalho.php?code=<?php echo $code; ?>">Postar Trabalho</a>
        <p></p>
        <h1>Abaixo segue seu histórico de trabalhos de suas turmas!</h1>
        
        <?php
        $sql_1 = "SELECT * FROM trabalhos_extras WHERE professor = '$code' ORDER BY id DESC LIMIT 10";
        $sql_1 = $pdo->query($sql_1);
        if($sql_1->rowCount() <=0){
            echo "<h2>No momento não existe nenhum trabalho lançado no sistema!</h2>";
        } else {
            foreach ($sql_1 as $res_1):
        ?>
        <table width="955" border="0">
            <tr>
                <td width="90">Nº trabalho</td>
                <td width="60">Status</td>
                <td width="131">Lançamento</td>
                <td width="187">Disciplina</td>
                <td width="323">Tema</td>
                <td width="129">Data de entrega</td>
                <td width="">Pontos</td>
            </tr>
            <tr>
                <td><h3><?php echo $res_1['id']; ?></h3></td>
                <td><h3><?php echo $res_1['status']; ?></h3></td>
                <td><h3><?php echo $res_1['date']; ?></h3></td>
                <td><h3><?php echo $res_1['disciplina']; ?></h3></td>
                <td><h3><?php echo $res_1['tema']; ?></h3></td>
                <td><h3><?php echo $res_1['data_entrega']; ?></h3></td>
                <td><h3><?php echo $res_1['pontos']; ?></h3></td>
            </tr>
            <tr>
                <td><a rel="superbox[iframe][850x350]" href="editar_trabalho_extra.php?id=<?php echo $res_1['id']; ?>&code=<?php echo $code; ?>">Editar</a></td>
                <td colspan="3"><a href="alunos_que_mostraram_trabalho_extra.php?id=<?php echo $res_1['id']; ?>">Alunos que entregaram este trabalho</a></td>
                <td></td>
                <td><a href="trabalhos_extras.php?pg=excluir&id=<?php echo $res_1['id']; ?>&code=<?php echo $code; ?>"><img src="../img/deleta.png" width="22" border="0" /></a></td>
            </tr>  
        </table>
        <?php
            endforeach;
        }
        ?>
        <?php if(@$_GET['pg'] == 'excluir'){

            $id = $_GET['id'];
            $sql_2 = "DELETE FROM trabalhos_extras WHERE id = '$id'";
            $sql_2 = $pdo->query($sql_2);

            echo "<script language='javascript'>window.location='trabalhos_extras.php';</script>";

        }?>
    </div>
    <?php require 'rodape.php'; ?>
</body>
</html>