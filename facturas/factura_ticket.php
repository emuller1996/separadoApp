<?php 
require "./fpdf.php";
$peticionAjax = true;
$id = $_GET['id'];
require_once "../controllers/facturaControlador.php";
$ins_factura = new facturaControlador();
$datos_factura = $ins_factura->get_factura_by_id_controlador($id);
$detalles_factura = $ins_factura->get_detalles_factura_controlador($id);


$pdf = new FPDF('P','mm',array(80,120));
	$pdf->SetMargins(3,3,3);
	$pdf->AddPage();
	$pdf->Image('../views/img/logo_empresa2.png',5,5,50,20,'PNG');

	

	$pdf->Ln(5);

	$pdf->SetFont('Arial','',15);
	$pdf->SetTextColor(0,107,181);
	$pdf->Cell(0,20,utf8_decode(""),0,0,'C');
	$pdf->SetFont('Arial','',15);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(-25,15,utf8_decode("FT - ".$datos_factura['factura_id']),'',0,'C');
	
	$pdf->Ln(15);

	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(27,8,utf8_decode('Fecha de emisión:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(20,8,utf8_decode(date("d/m/Y", strtotime($datos_factura['factura_fecha']))),0,0);
	$pdf->Cell(11,8,utf8_decode('HORA:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(20,8,utf8_decode(date("h:m", strtotime($datos_factura['factura_hora']))),0,0);
	
	$pdf->Ln(4);

	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(12,8,utf8_decode('Cliente:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(50,8,utf8_decode($datos_factura['cliente_nombre']),0,0);
	$pdf->Ln(5);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(7,8,utf8_decode('DNI:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(25,8,utf8_decode($datos_factura['cliente_cedula']),0,0);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(15,8,utf8_decode('Teléfono:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,8,utf8_decode($datos_factura['cliente_telefono']),0,0);
	$pdf->SetTextColor(33,33,33);
	
	$pdf->Ln(8);

	$pdf->SetFillColor(191,191,191);
	$pdf->SetDrawColor(0,0,0);
	$pdf->SetTextColor(33,33,33);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(10,10,utf8_decode('Cant.'),1,0,'L',true);
	$pdf->Cell(32,10,utf8_decode('Descripción'),1,0,'L',true);
	$pdf->Cell(16,10,utf8_decode('Subtotal'),1,0,'L',true);
	$pdf->Cell(16,10,utf8_decode('Total'),1,0,'L',true);

	$pdf->Ln(10);

	$pdf->SetTextColor(97,97,97);
	
	foreach($detalles_factura as $detalle) {
	$pdf->Cell(10,8,utf8_decode($detalle['detalle_cantidad']),1,0,'C');
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(32,8,utf8_decode($detalle['producto_descripcion']),1,0,'L');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(16,8,utf8_decode('$'.number_format($detalle['detalle_valor_unitario'],0,'','.')),1,0,'L');
	$pdf->Cell(16,8,utf8_decode('$'.number_format($detalle['detalle_valor_total'],0,'','.')),1,0,'L');
	$pdf->Ln(8);
	}
	$pdf->Cell(10,8,utf8_decode(''),'T',0,'C');
	$pdf->Cell(32,8,utf8_decode(''),'T',0,'L');
	$pdf->Cell(16,8,utf8_decode('Total'),1,0,'C');
	$pdf->Cell(16,8,utf8_decode('$'.number_format($datos_factura['factura_total'],0,'','.')),1,0,'L');
	$pdf->Ln(8);
	
	




	$pdf->Output("I","Factura_1.pdf",true);


?>