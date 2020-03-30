<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php // aqui faz o encerramento dos trabalhos bimestrais
$sql_1 = "SELECT * FROM trabalhos_bimestrais WHERE status = 'Ativo'";
$sql_1 = $pdo->query($sql_1);
if($sql_1->rowCount() == ''){
}else{
    foreach ($sql_1 as $res_1):
                $data = $res_1['data_entrega'];
                $dataFinal = explode("/", $data);
                $dataFim = $dataFinal[1]."/".$dataFinal[0]."/".$dataFinal[2];
                $date = date('m/d/Y');
                if($dataFim < $date){
		$sql_2 = "UPDATE trabalhos_bimestrais SET status = 'Encerrado' WHERE id = ".$res_1['id']."";
                $sql_2 = $pdo->query($sql_2);
                }
    endforeach;
}
// aqui fecha o trabalho bimestral
?>

<?php // aqui faz o encerramento dos trabalhos extra
$sql_3 = "SELECT * FROM trabalhos_extras WHERE status = 'Ativo'";
$sql_3 = $pdo->query($sql_3);
if($sql_3->rowCount() == ''){
    }else{
	foreach ($sql_3 as $res_3):
                $data = $res_3['data_entrega'];
                $dataFinal = explode("/", $data);
                $dataFim = $dataFinal[1]."/".$dataFinal[0]."/".$dataFinal[2];
                $date = date('m/d/Y');
                if($dataFim < $date){
                    $sql_4 = "UPDATE trabalhos_extras SET status = 'Encerrado' WHERE id = ".$res_3['id']."";
                    $sql_4 = $pdo->query($sql_4);
                }
        endforeach;
}
// aqui fecha o trabalho bimestral
?>
</body>
</html>