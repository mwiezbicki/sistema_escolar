<?php
require('../relatorios/fpdf.php');

class PDF extends FPDF
{
// Page header
    function Header()
    {
        require '../config.php';
        $tipo = $_GET['tipo'];
        $serie = $_GET['serie'];
        $turno = $_GET['turno'];
        $sql_2 = "SELECT * FROM estudantes WHERE status = '$tipo' AND serie = '$serie' AND turno = '$turno' ORDER BY nome";
        $sql_2 = $pdo->query($sql_2);
        foreach ($sql_2 as $res_2):
            $serie = $res_2['serie'];
        endforeach;
        // Logo
        $this->Image('../img/logo1.png',10,5,30);
        $this->SetFont('Arial','B',15);
        $this->Ln(5);
        $this->Cell(70);
        $this->Cell(70,5,'Sossego da Mamae',5,0,'C');
        $this->Ln(5);
        $this->Cell(70);
        $this->Cell(70,5,'Relatorio Escolar',5,0,'C');
        $this->Ln(5);
        $this->Cell(70);
        $this->Cell(70,5,$serie.' - '.$turno,5,1,'C');
        $this->Ln(5);
        $this->SetFont("Arial", "B", 10);
	    $this->SetFillColor(170,190,200);
	    $this->Cell(0, 6,'Relatorio Escolar - 2018', 0, 2, 'L', true);
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
$serie = $_GET['serie'];
$turno = $_GET['turno'];
$sql_1 = "SELECT * FROM estudantes WHERE status = '$tipo' AND serie = '$serie' AND turno = '$turno' ORDER BY nome";
$sql_1 = $pdo->query($sql_1);
$total = $sql_1->rowCount();


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
foreach ($sql_1 as $res_1):
    $pdf->Cell(0,10,$res_1['nome'],1,1);
endforeach;
$pdf->Cell(0,10,'Total de Alunos: '.$total,0,1);
$pdf->Output();
?>
