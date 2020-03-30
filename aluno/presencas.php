<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/ico_escola.png" />
<title>Presenças</title>
<link rel="stylesheet" type="text/css" href="css/precesencas.css"/>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1><strong>Frequência Escolar</strong></h1>
<table width="900" border="0">
  <tr>
    <td align="center" colspan="5">Frequência geral nas disciplinas e nos bimestres</td>
  </tr>
  <tr>
    <td align="center" colspan="5"><hr></td>
  </tr>
  <tr>
    <td width="242"><strong>DISCIPLINA</strong></td>
    <td width="179"><strong>Total de presença</strong></td>
    <td width="152"><strong>Total de faltas</strong></td>
    <td width="192"><strong>Falta(s) Justificada</strong></td>
    <td width="119"><strong>Resultado</strong></td>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE curso = '$serie'";
$sql_1 = $pdo->query($sql_1);
	foreach($sql_1 as $res_1):

?>  
  <tr>
    <td><?php echo $disciplina = $res_1['disciplina']; ?></td>
    <td><?php 
	$sql_2 = "SELECT * FROM chamadas_em_sala WHERE curso = '$serie' AND disciplina = '$disciplina' AND code_aluno = '$code' AND presente = 'SIM'";
	$sql_2 = $pdo->query($sql_2);
	$ver_result_2 = $sql_2->rowCount();
	echo $ver_result_2; ?></td>
    <td><?php $sql_3 = "SELECT * FROM chamadas_em_sala WHERE curso = '$serie' AND disciplina = '$disciplina' AND code_aluno = '$code' AND presente = 'NÃO'"; 
	$sql_3 = $pdo->query($sql_3);
	$ver_result_3 = $sql_3->rowCount();
	echo $ver_result_3;
	?></td>
    <td><?php $sql_4 = "SELECT * FROM chamadas_em_sala WHERE curso = '$serie' AND disciplina = '$disciplina' AND code_aluno = '$code' AND presente = 'JUSTIFICADA'"; 
	$sql_4 = $pdo->query($sql_4);
	$ver_result_4 = $sql_4->rowCount();
	echo $ver_result_4;
	?></td>
    <td>
    <?php
	$sql_5 = "SELECT * FROM chamadas_em_sala WHERE curso = '$serie' AND disciplina = '$disciplina'";
	$sql_5 = $pdo->query($sql_5);
	$conta_sql_5 = $sql_5->rowCount();
	
	$total = ($conta_sql_5*25)/100;
	
	if($ver_result_3 > $total){
		echo "Reprovado";
	}else{
		echo "Aprovado";
		}
	
	?>    
    </td>
  </tr>
  <tr>
    <td colspan="5"><img src="img/menu_topo.png" width="900" height="1"></td>
  </tr>
<?php endforeach; ?>  
</table> 

</div><!-- box -->

</body>
</html>