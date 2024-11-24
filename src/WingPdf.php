<?php

namespace WingPDF\WingPDF;

class WingPDF
{
    private string $content;

    public function __construct()
    {
        $this->content = "%PDF-1.4\n";
        $this->content .= "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
        $this->content .= "2 0 obj\n<< /Type /Pages /Count 1 /Kids [3 0 R] >>\nendobj\n";
        $this->content .= "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>\nendobj\n";
        $this->content .= "5 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";
    }

    public function addText(string $text, int $x, int $y): void
    {
        $this->content .= "4 0 obj\n<< /Length " . strlen($text) . " >>\nstream\n";
        $this->content .= "BT /F1 12 Tf $x $y Td ($text) Tj ET\n";
        $this->content .= "endstream\nendobj\n";
    }

    public function addHtml(string $html): void
    {
        $text = strip_tags($html); 
        $lines = explode("\n", wordwrap($text, 60, "\n"));

        $y = 800;
        foreach ($lines as $line) {
            $this->addText($line, 50, $y);
            $y -= 20;
        }
    }

    public function save(string $filePath): void
    {
        $this->content .= "xref\n0 6\n0000000000 65535 f \n0000000010 00000 n \n0000000067 00000 n \n";
        $this->content .= "trailer\n<< /Root 1 0 R /Size 6 >>\nstartxref\n116\n%%EOF";

        file_put_contents($filePath, $this->content);
    }
}
