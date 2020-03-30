<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<link href="css/turmas_e_alunos.css" rel="stylesheet" type="text/css" />
</head>
 
<body>
    <?php require 'topo.php'; ?>
    <div id="caixa_preta">
        <div id="box">
            <h1>Abaixo mostra seu histórico de disciplinas e alunos!</h1>
            <?php
            $sql_1 = "SELECT * FROM disciplinas WHERE professor = '$code'";
            $sql_1 = $pdo->query($sql_1);
            if($sql_1->rowCount() <= 0){
                echo "<h3>Voce não ministra nenhuma disciplina!</h3>";
            } else {
                foreach ($sql_1 as $dis):
                    $curso = $dis['curso'];?>
            <table width="955" border="0">
                <tr>
                    <td width="400"><strong>Disciplina ministrada:</strong><?php echo $dis['disciplina']; ?></td>
                    <td width="300"><strong>Total de Alunos desta disciplina:</strong><?php $sql_2 = "SELECT count(*) as c FROM estudantes WHERE serie = '$curso'"; 
                    $sql_2 = $pdo->query($sql_2);
                    $sql_2->execute();
                    $alu = $sql_2->fetch();
                    echo $alu['c'];
                    ?>
                    </td>
                    <td width="123"><a href="fazer_chamada.php?curso=<?php echo $dis['curso']; ?>&dis=<?php echo $dis['disciplina']; ?>">Fazer Chamada</a></td>
                </tr>
            </table>
            <?php
                endforeach;
            }
            ?>
        </div>
    <?php require 'rodape.php'; ?>
</body>
</html>
