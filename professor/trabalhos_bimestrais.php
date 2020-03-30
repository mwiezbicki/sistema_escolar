<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<link href="css/trabalhos_bimestral.css" rel="stylesheet" type="text/css"/>
<title>Trabalhos Bimestrais</title>
</head>
 
<body>
    <?php require 'topo.php'; ?>
    <div id="caixa_preta">
    </div>
    
    <div id="box">
        <br /><a class="a2" rel="superbox[iframe][680x400]" href="cadastrar_trabalho_bimestral.php?code=<?php echo $code; ?>">Postar trabalho</a>
    <p></p>
    <h1>Abaixo segue seu histórico de trabalhos bimestrais!</h1>
    
    <?php
    $sql_1 = "SELECT * FROM trabalhos_bimestrais WHERE professor = '$code' ORDER BY id DESC";
    $sql_1 = $pdo->query($sql_1);
    if($sql_1->rowCount() <= 0){
        echo "<h2>No momento não existe nenhum trabalho lançado no sistema!</h2>";
    } else {
        foreach ($sql_1 as $tra):
    ?>
    <table width="955" border="0">
        <tr>
            <td width="90">N trabalho</td>
            <td width="60">Status</td>
            <td width="131">Lançamento</td>
            <td width="187">Disciplina</td>
            <td width="323">Tema</td>
            <td width="129">Data de entrega</td>
        </tr>
        <tr>
            <td><h3><?php echo $tra['id']; ?></h3></td>
            <td><h3><?php echo $tra['status']; ?></h3></td>
            <td><h3><?php echo $tra['date']; ?></h3></td>
            <td><h3><?php echo $tra['disciplina']; ?></h3></td>
            <td><h3><?php echo $tra['tema']; ?></h3></td>
            <td><h3><?php echo $tra['data_entrega']; ?></h3></td>
        </tr>
        <tr>
            <td><a rel="superbox[iframe][680x400]" href="editar_trabalho_bimestral.php?id=<?php echo $tra['id']; ?>&code=<?php echo $code; ?>">Editar</a></td>
            <td colspan="3"><a href="alunos_que_mostraram_este_trabalho.php?id=<?php echo $tra['id']; ?>&pg=trabalhos_bimestrais">Alunos que entregaram este trabalho</a></td>
            <td></td>
            <td><a href="trabalhos_bimestrais.php?pg=excluir&code=<?php echo $code; ?>&id=<?php echo $tra['id']; ?>"><img border="0" src="../img/deleta.png" width="22"/></a></td>
    </table>
    <?php endforeach;
    }
    ?>
    </div>
    <?php if(@$_GET['pg'] == 'excluir'){
        $id = $_GET['id'];
        $code = $_GET['code'];
        
        $sql_2 = "DELETE FROM trabalhos_bimestrais WHERE id = '$id' AND professor = '$code'";
        $sql_2 = $pdo->query($sql_2);
        echo "<script language='javascript'>window.location='trabalhos_bimestrais.php';</script>";
    }?>
 
    <?php require 'rodape.php'; ?>
</body>
</html>