<?php 
require "./fpdf.php";
require_once "../config/APP.php";
$peticionAjax = true;
$id = $_GET['id'];
require_once "../controllers/facturaControlador.php";
require_once "../controllers/empresaControlador.php";

$ins_factura = new facturaControlador();
$ins_empresa = new empresaControlador();


$datos_factura = $ins_factura->get_factura_by_id_controlador($id);
$datos_empresa = $ins_empresa->getEmpresa();
$detalles_factura = $ins_factura->get_detalles_factura_controlador($id);

session_start(['name' => 'SPM']);

if(empty($_SESSION['id_spm'])){
	header('location:' . SERVERURL);
}


$pdf = new FPDF('P','mm',array(80,120));
	$pdf->SetMargins(3,3,3);
	$pdf->AddPage();
	$pdf->Image('../'.$datos_empresa['empresa_url_imagen'],5,5,30,30,'PNG');
	
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,107,181);
	$pdf->Cell(0,5,utf8_decode($datos_empresa['empresa_razon_social']),0,0,'R');
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(0,15,utf8_decode("Nit : ".$datos_empresa['empresa_nit']),0,0,'R');
	$pdf->Cell(0,21,utf8_decode($datos_empresa['empresa_representante']),0,0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(0,28,utf8_decode($datos_empresa['empresa_direccion']),0,0,'R');
	$pdf->Cell(0,34,utf8_decode($datos_empresa['empresa_departamento']),0,0,'R');
	$pdf->Cell(0,40,utf8_decode($datos_empresa['empresa_cuidad']),0,0,'R');



	

	$pdf->Ln(20);

	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(0,107,181);
	$pdf->Cell(0,-10,utf8_decode(""),0,0,'C');
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
	$pdf->Cell(20,8,utf8_decode(date("h:i A", strtotime($datos_factura['factura_hora']))),0,0);
	
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
	
	




	$pdf->Output("I","Factura_".$datos_factura['factura_id'].".pdf",true);


?>