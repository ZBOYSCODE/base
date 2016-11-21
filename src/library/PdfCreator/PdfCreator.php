<?php
/**
 * Created by PhpStorm.
 * User: Jorge Cociña
 * Date: 22-09-2016
 * Time: 10:03
 */

namespace App\library\PdfCreator;

use Phalcon\Mvc\User\Component;
use App\library\Auth\Exception;
use Dompdf\Dompdf;

/**
 * Clase creada para renderisar pdf's
 * @author jcocina
 */
class PdfCreator extends Component
{
    private static $domPdf = null;

    private static function initialize() {
        if(!isset(self::$domPdf) or is_null(self::$domPdf))
        {
            self::$domPdf = new Dompdf();
            self::$domPdf->set_option('chroot', '/public/temp');
            self::$domPdf->set_base_path( __DIR__ ."../../../../public");
        }
    }

    /**
     * metodo para renderizar pdf con base en templates
     * @author jcocina
     * @param $template String  nombre del template
     *                          (debe existir en views/pdftemplates)
     *        $psram    array   array donde los keys son los tags del
     *                          template y el value el valor por el que
     *                          se deben reemplazar
     */
    public function createFromTemplate($template, $param, $pdfname) {
         
        /*
        //self::initialize();

        // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


        $html = '';
        try{
            $html = file_get_contents(  __DIR__ .
                '/../../views/templates/pdftemplates/' .
                $template .
                '.html');
            if ($html == false) {
               return false;
            }
        } catch (Exception $e) {
            return false;
        }
        $tags = array();
        $values = array();
        foreach ($param as $tag=>$value)
        {
            array_push($tags, '{{' . $tag . '}}');
            array_push($values, $value);
        }

        $html = str_replace($tags, $values, $html);
        

        // Print text using writeHTMLCell()
        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output($pdfname, 'I');



        
        self::$domPdf->setPaper('letter');
        self::$domPdf->load_html($html);
        self::$domPdf->render();
        self::$domPdf->stream($pdfname,array('Attachment'=>0));

        return true;
        */


        

    
    }



    /**
    * @author rsoto
    *         Genera un archivo pdf horizontal mediante un string html
    *         Tambien inserta el numero de pagina en el Footer
    *
    * @param string  $html: Contiene el codigo html a renderizar en pdf 
    *                       por la libreria
    *        string $pdfname: Captura el nombre del archivo pdf a crear
    *
    * @return void
    */

    public function mpdfCreatorHorizontal($html, $pdfname){
        
        $mpdf = new \mPDF('utf-8', 'A4-L');
        $mpdf->setFooter('{PAGENO}');
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfname,'I');

    }

    /**
    * @author rsoto
    *         Genera un archivo pdf vertical mediante un string html
    *         Tambien inserta el numero de pagina en el Footer
    *
    * @param string  $html: Contiene el codigo html a renderizar en pdf 
    *                       por la libreria
    *        string $pdfname: Captura el nombre del archivo pdf a crear
    *
    * @return void
    */


    public function mpdfCreatorVertical($html, $pdfname){
  
        
        $mpdf = new \mPDF('utf-8');
        $mpdf->setFooter('{PAGENO}');
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfname,'I');

    }




    public function pdfEjemplo(){


 // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


        // Set some content to print
        $html = <<<EOD

            <h1>Welcomesdasd to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
            <i>This is the first example of TCPDF library.</i>
            <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
            <p>Please check the source code documentation and other examples for further information.</p>
            <p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;


        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');


    }
}