<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php

$d = date("d");
$m = date("m");
$a = date("Y");
$date = date("d/m/Y H:i:s");
$d_m_y = date("d/m/Y");

if($d == 02){
$sql_1 = "SELECT * FROM professores WHERE status = 'Ativo' AND code != ''";
$sql_1 = $pdo->query($sql_1);
if($sql_1->rowCount() == ''){
}else{
	foreach($sql_1 as $res_1):
			$code = $res_1['code'];	
			$nome = $res_1['nome'];
			$salario = $res_1['salario'];
			
	$sql_2 = "SELECT * FROM fluxo_de_caixa WHERE date = '$d_m_y' AND codigo = '$code'";
        $sql_2 = $pdo->query($sql_2);
	if($sql_2->rowCount() >=1){
	}else{
		$sql_3 = "INSERT INTO fluxo_de_caixa (status, tipo, d, m, a, date_completo, date, codigo, descricao, valor, form_pag) VALUES ('Ativo', 'DEBITO', '$d', '$m', '$a', '$date', '$d_m_y', '$code', 'Pagamento do professor (a) $nome', '$salario', 'Transferência Bancaria')";
                $sql_3 = $pdo->query($sql_3);
				
   }
  endforeach;
 }
}
?>


<?php

$d = date("d");
$m = date("m");
$a = date("Y");
$date = date("d/m/Y H:i:s");
$d_m_y = date("d/m/Y");

if($d == 02){
$sql_1 = "SELECT * FROM funcionarios WHERE status = 'Ativo' AND code != ''";
$sql_1 = $pdo->query($sql_1);
if($sql_1->rowCount() == ''){
}else{
	foreach($sql_1 as $res_1):
		$code = $res_1['code'];	
		$nome = $res_1['nome'];
		$salario = $res_1['salario'];
			
	$sql_2 = "SELECT * FROM fluxo_de_caixa WHERE date = '$d_m_y' AND codigo = '$code'";
        $sql_2 = $pdo->query($sql_2);
	if($sql_2->rowCount() >=1){
	}else{
		$sql_3 = "INSERT INTO fluxo_de_caixa (status, tipo, d, m, a, date_completo, date, codigo, descricao, valor, form_pag) VALUES ('Ativo', 'DEBITO', '$d', '$m', '$a', '$date', '$d_m_y', '$code', 'Pagamento do funcionário (a) $nome', '$salario', 'Transferência Bancaria')";
                $sql_3 = $pdo->query($sql_3);
				
   }
  endforeach;
 }
}
?>

</body>
</html>