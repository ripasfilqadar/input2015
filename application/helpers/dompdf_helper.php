<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper('a4', 'landscape'); // change 'a4' to whatever you want 
    $dompdf->render();
    if ($stream) {
        
        $option['Attachment'] = 1;
        $option['Accept-Ranges'] = 0;
        $option['compress'] = 1;
        $dompdf->stream($filename.".pdf", $option);
    } else {
        return $dompdf->output();
    }
}

function pdf_create_landscape($html, $filename='', $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper('a4', 'landscape'); // change 'a4' to whatever you want 
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}
?>  