<?php
require('../relatorios/fpdf.php');
require('../config.php');
$id = $_GET['id'];
$code = $_GET['code'];

$sql_1 = "SELECT * FROM estudantes WHERE code = '$code'";
$sql_1 = $pdo->query($sql_1);


class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image('../img/logo1.png',10,5,30);
  $this->SetFont('Arial','B',15);
  $this->Ln(5);
  $this->Cell(70);
  $this->Cell(70,10,'Sossego da Mamae',5,0,'C');
  $this->Ln(5);
  $this->Cell(70);
  $this->Cell(70,10,'Boletim Escolar',5,0,'C');
  $this->Ln(10);
  $this->SetFont("Arial", "B", 10);
	$this->SetFillColor(170,190,200);
	$this->Cell(0, 6,'Boletim Escolar - 2018', 0, 2, 'L', true);
	//$this->Cell(0, 6,'Titulo', 1, 0, 'L');

}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
  $data=date('d/m/Y');
  $conteudo = "criado em ".$data;
  $texto="Sistema Escolar";
	$this->SetFont('Arial','I',8);
  $this->Cell(0,0,'',1,1,'L');
  $this->Cell(0,5,$texto,0,0,'L');
  $this->Cell(0,5,$conteudo,0,1,'R');
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class

$pdf = new PDF();
$id = $_GET['id'];
$code = $_GET['code'];

$sql_1 = "SELECT * FROM estudantes WHERE code = '$code'";
$sql_1 = $pdo->query($sql_1);
$sql_2 = "SELECT * FROM notas_bimestrais WHERE code = '$code' AND bimestre = '1'";
$sql_2 = $pdo->query($sql_2);
$sql_3 = "SELECT * FROM notas_bimestrais WHERE code = '$code' and bimestre = '2'";
$sql_3 = $pdo->query($sql_3);
$sql_4 = "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$code' AND presente = 'NAO'";
$sql_4 = $pdo->query($sql_4);
$total = $sql_4->rowCount();

$pdf->SetFont("Arial","B",6);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
foreach ($sql_1 as $res_1):
	$pdf->Cell(63, 10, strtoupper('Nome : ').$res_1['nome'], 'L, B', 0, 'L');
	$pdf->Cell(64, 10, strtoupper('Curso: ').$res_1['serie'], 'L, B', 0, 'L');
	$pdf->Cell(63, 10, strtoupper('Turma: ').$res_1['turno'], 'L, B, R', 1, 'L');
endforeach;
$pdf->Cell(190, 10, '1 BIMESTRE', 1, 1, 'L');
$pdf->Cell(63,10,strtoupper('disciplina'),'L, B',0,'L');
$pdf->Cell(64,10,strtoupper('nota'),'L, B',0,'L');
$pdf->Cell(63,10,strtoupper('falta'),'L, B, R',1,'L');
		foreach ($sql_2 as $res_2):
					$pdf->Cell(63, 10, strtoupper($res_2['disciplina']), 'L, B', 0, 'L');
					$pdf->Cell(64, 10, strtoupper($res_2['nota']), 'L, B', 0, 'L');
					$pdf->Cell(63,10, $total, 'L,B,R',1,'L');
		endforeach;
		$pdf->Cell(190, 10, '2 BIMESTRE', 1, 1, 'L');
		$pdf->Cell(63,10,strtoupper('disciplina'),'L, B',0,'L');
		$pdf->Cell(64,10,strtoupper('nota'),'L, B',0,'L');
		$pdf->Cell(63,10,strtoupper('falta'),'L, B, R',1,'L');
				foreach ($sql_3 as $res_3):
							$pdf->Cell(63, 10, strtoupper($res_3['disciplina']), 'L, B', 0, 'L');
							$pdf->Cell(64, 10, strtoupper($res_3['nota']), 'L, B', 0, 'L');
							$pdf->Cell(63,10, $total, 'L,B,R',1,'L');
				endforeach;
$pdf->Output();
?>
