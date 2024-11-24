<?php

require __DIR__ . '/vendor/autoload.php';

use WingPDF\WingPDF\WingPDF;

$html = "<h1>Welcome to WingPDF</h1><p>This is a basic library to generate PDFfiles.</p>";

$pdf = new WingPDF();
$pdf->addHtml($html);
$pdf->save(__DIR__ . '/wingpdf-output.pdf');

echo "PDF generated successfully!";
