<?php
require('../relatorios/fpdf.php');

class PDF extends FPDF
{
// Page header
    function Header()
    {
        require '../config.php';
        $tipo = $_GET['tipo'];
        $mes = $_GET['mes'];
        $sql_2 = "SELECT nome, substring(nascimento,1,2) as dia FROM estudantes WHERE status = '$tipo' AND substring(nascimento,4,2) = '$mes' ORDER BY nome";
        $sql_2 = $pdo->query($sql_2);
        foreach ($sql_2 as $res_2):
            $serie = $res_2['nome'];
        endforeach;
        $this->Image('../img/logo1.png',10,4,30);
        $this->SetFont('Arial','B',15);
        $this->Ln(7);
        $this->Cell(70);
        $this->Cell(70,5,'Sossego da Mamae',5,0,'C');
        $this->Ln(7);
        $this->Cell(70);
        $this->Cell(70,5,'Relatorio Aniversariantes Mes - '.$mes,5,0,'C');
        $this->Ln(7);
        $this->SetFont("Arial", "B", 10);
	      $this->SetFillColor(170,190,200);
	      $this->Cell(0, 6,'Nome                                                                                           Dia',0, 2, 'L', true);
    }

    // Page footer
    function Footer()
    {
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
require '../config.php';
$tipo = $_GET['tipo'];
$mes = $_GET['mes'];
$sql_1 = "SELECT nome, substring(nascimento,1,2) as dia FROM estudantes WHERE status = '$tipo' AND substring(nascimento,4,2) = '$mes' ORDER BY nome";
$sql_1 = $pdo->query($sql_1);
$total = $sql_1->rowCount();


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
foreach ($sql_1 as $res_1):
    $pdf->Cell(95,10,$res_1['nome'],'L, B',0,'L');
    $pdf->Cell(95,10, $res_1['dia'], 'L, B, R', 1, 'L');
endforeach;
$pdf->Cell(0,10,'Total de Alunos: '.$total,0,1);
$pdf->Output();
?>
