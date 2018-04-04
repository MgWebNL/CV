<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Database\Schema\Table;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class HTML2PDFComponent extends Component
{
    private $m_sTitle = "Naamloos document";

    /********* DIT DEEL IS VOOR ALLE PDF-BESTANDEN ***********/

    public function makePDF($p_sTitle, $p_sHTML, $p_sType = "D", $p_sFolder = ""){

        // Include the main TCPDF library (search for installation path).
                //echo dirname(__FILE__).'\pdf\tcpdf_include.php'; die();
                require_once(dirname(__FILE__).DS.'pdf'.DS.'tcpdf.php');

        // create new PDF document
                $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Hodi International');
        $pdf->SetTitle($p_sTitle);

// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
                $pdf->SetFont('helvetica', '', 9);

        // add a page
                $pdf->AddPage();

        // create some HTML content
                $html = $p_sHTML;

        // output the HTML content
                $pdf->writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
                $pdf->lastPage();

        // ---------------------------------------------------------

        //Close and output PDF document
        $this->m_sTitle = str_replace(" ", "_", $this->m_sTitle);
        if($p_sType == "F"){
            if(!is_dir(ROOT.'/webroot/pdf/'.$p_sFolder.'/')){
                mkdir(ROOT.'/webroot/pdf/'.$p_sFolder.'/');
            }
            $pdf->Output(ROOT.'/webroot/pdf/'.$p_sFolder.'/'.$this->m_sTitle.'.pdf', $p_sType);
            return ROOT.'/webroot/pdf/'.$p_sFolder.'/'.$this->m_sTitle.'.pdf';
        }elseif($p_sType == "print") {
            $pdf->IncludeJS("print();");
            $pdf->Output($this->m_sTitle.'.pdf', "I");
        }else{
            $pdf->Output($this->m_sTitle.'.pdf', $p_sType);
            return $this->m_sTitle.'.pdf';
        }

        //============================================================+
        // END OF FILE
        //============================================================+

    }

    public function loadTemplate($p_sFileName, $p_aData = array()){
        $sContent = file_get_contents(ROOT."/webroot/pdf/html_templates/".$p_sFileName.".html");

        foreach($p_aData as $k => $v){
            $sContent = str_replace("[[".$k."]]", $v, $sContent);
        }

        return $sContent;
    }

    public function setTitle($p_sTitle){
        $this->m_sTitle = $p_sTitle;
    }

    public function getTitle(){
        return $this->m_sTitle;
    }







    /********* DIT DEEL IS VOOR DE LIJSTEN DRUKKERIJ/VERPAKKER ***********/
    public function convertDataToRows($p_aData){
        $sPrio = "";
        $sGeneral = "";

        $this->HdIntPrplNapkins = TableRegistry::get('HdIntPrplNapkins');

        foreach($p_aData as $aOrder){

            $aNapkin = $this->HdIntPrplNapkins->getNapkinByNrint($aOrder["HdIntPrplGeneral"]["napkin_nrint"]);

            $var = $aOrder["HdIntPrplGeneral"]['priority'] == 1 ? "sPrio" : "sGeneral";
            $var0 = $var."Color";
            @$$var0 = $$var0 == "FFFFFF" ? "EEEEEE" : "FFFFFF";
            $$var .= '<tr style="background-color: #'.$$var0.';">
                        <td>'.$aOrder["order_nr"].'</td>
                        <td>'.$aOrder["ledger_name"].'</td>
                        <td>'.$aOrder["product_code"].'</td>
                        <td>'.$aNapkin["napkin_name"].'</td>
                        <td class="text-right">'.number_format($aOrder["end_quantity"],0,",",".").'</td>
                        <td class="text-right">'.date('d-m-Y', strtotime($aOrder["end_date"])).'</td>
                    </tr>
                    <tr style="background-color: #'.$$var0.';">
                        <th>Omschrijving</th>
                        <td colspan="4">'.$aOrder["order_description"].'</td>
                    </tr>';
            $var2 = $var."Sum";
            @$$var2 += $aOrder["end_quantity"];
        }

        if($sPrio != ""){
            $sPrio = $this->addTableToRows($sPrio, "Spoedorders", $sPrioSum);
        }
        if($sGeneral != ""){
            $sGeneral = $this->addTableToRows($sGeneral, "Reguliere orders", $sGeneralSum);
        }
        $aReturn = array('prio' => $sPrio, 'general' => $sGeneral);
        return $aReturn;

    }

    private function addTableToRows($p_sRows, $p_sTitle, $p_iSum){
        $sHeader = '<br />&nbsp;
                    <h2>'.$p_sTitle.'</h2>
                    <table border="0" cellpadding="4" cellspacing="0">
                        <thead>
                        <tr style="background-color: #D52824; color: #FFF;">
                            <th>Ordernr.</th>
                            <th>Soort</th>
                            <th>Artikelnr.</th>
                            <th>Napkin</th>
                            <th class="text-right">Aantal</th>
                            <th class="text-right">Leverdatum</th>
                        </tr>
                        </thead>


                        <tbody>';

        $sFooter = '</tbody>

                        <tfoot>
                        <tr style="background-color:#D52824; color: #FFF;">
                            <th colspan="4">Totaal</th>
                            <th class="text-right">'.number_format($p_iSum,0,",",".").'</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>';

        $sContent = $sHeader.$p_sRows.$sFooter;
        //echo $sContent; die();
        return $sContent;
    }








    /********* DIT DEEL IS VOOR DE PAKBONNEN ***********/
    public function getDataPackagingList($p_aData){
        $this->HdIntPrplViewItem = TableRegistry::get('HdIntPrplViewItem');
        $this->FRbkhADRES = TableRegistry::get('FRbkhADRES');
        $this->FRbkhADRESAFLEVER = TableRegistry::get('FRbkhADRESAFLEVER');
        $this->HdIntPrplViewDeliveryTime = TableRegistry::get('HdIntPrplViewDeliveryTime');
        $aOrder = $this->HdIntPrplViewItem->getOrder($p_aData["order_nrint"]);

        $aAfleveradres = $this->FRbkhADRESAFLEVER->get($aOrder->afleveradres_id, ["contain" => ["FRbkhLAND"]]);
        $aAdres = $this->FRbkhADRES->get($aOrder->adres_id, ["contain" => ["FRbkhLAND"]]);
        $aDelivery = $this->HdIntPrplViewDeliveryTime->get($p_aData["order_nrint"]);

        $aRes = array();
        $now = Time::now();

        // DATA ORDER
        if($aOrder->HdIntPrplGeneral->deliver_hodi == 1){
            $aRes["BKHORAFLEVERADRES"]  = "Hodi International<br />Kernreactorstraat 1<br />3903 LG Veenendaal<br />The Netherlands";
        }elseif(trim($aAfleveradres["BKHAAFADRESGROOT"]) == ""){
            $aRes["BKHORAFLEVERADRES"]  = $aAdres["BKHADNAAM"]."<br />".$aAdres["BKHADADRES_W"]."<br />".$aAdres["BKHADPOSTCODE"]." ".$aAdres["BKHADPLAATS"];
            $aRes["BKHORAFLEVERADRES"] .= "<br />".$aAdres->FRbkhLAND->BKHLAOMS;
        }else{
            $aRes["BKHORAFLEVERADRES"]  = nl2br($aAfleveradres["BKHAAFADRESGROOT"]);
            $aRes["BKHORAFLEVERADRES"] .= "<br />".$aAfleveradres->FRbkhLAND->BKHLAOMS;
        }




        $aRes["BKHORNR"]            = $aOrder["order_nr"];
        $aRes["BKHORDATUM"]         = $aOrder["order_date"]->format('d-m-Y');
        $aRes["BKHOROMS"]           = $aOrder["order_description"];
        $aRes["BKHADTELEFOON"]      = $aAdres["BKHADTELEFOON"];
        $aRes["ADVMWNAAM"]          = $aOrder["ADVMWNAAM"];
        $aRes["BKHORLEVERDATUM"]    = $now->modify('+5 days')->format('d-m-Y');
        $aRes["BKHORREFERENTIE"]    = $aOrder["employee_name"];

        $aRes["BKHORVENSTERTIJDEN_MA_LA"] = date('H:i', strtotime($aDelivery["deliverytime_ma_lo"]));
        $aRes["BKHORVENSTERTIJDEN_MA_HO"] = date('H:i', strtotime($aDelivery["deliverytime_ma_hi"]));

        $aRes["BKHORVENSTERTIJDEN_DI_LA"] = date('H:i', strtotime($aDelivery["deliverytime_di_lo"]));
        $aRes["BKHORVENSTERTIJDEN_DI_HO"] = date('H:i', strtotime($aDelivery["deliverytime_di_hi"]));

        $aRes["BKHORVENSTERTIJDEN_WO_LA"] = date('H:i', strtotime($aDelivery["deliverytime_wo_lo"]));
        $aRes["BKHORVENSTERTIJDEN_WO_HO"] = date('H:i', strtotime($aDelivery["deliverytime_wo_hi"]));

        $aRes["BKHORVENSTERTIJDEN_DO_LA"] = date('H:i', strtotime($aDelivery["deliverytime_do_lo"]));
        $aRes["BKHORVENSTERTIJDEN_DO_HO"] = date('H:i', strtotime($aDelivery["deliverytime_do_hi"]));

        $aRes["BKHORVENSTERTIJDEN_VR_LA"] = date('H:i', strtotime($aDelivery["deliverytime_vr_lo"]));
        $aRes["BKHORVENSTERTIJDEN_VR_HO"] = date('H:i', strtotime($aDelivery["deliverytime_vr_hi"]));

        $aRes["ORDORREMARKS"] = $aDelivery["extra_instructions"];

        $aRes["BKHORTAV"]           = "";

        // DATA REGEL
        $aRes["BKHARCODE"]          = $aOrder["product_code"];
        $aRes["BKHAROMS"]           = nl2br($aOrder["order_description"]);
        $aRes["BKHARAANTAL"]        = number_format($p_aData["quantity"],0,",",".");
        return $aRes;
    }

    public function makeArrayPDF($p_sTitle, $p_aHTML, $p_sType = "D", $p_sFolder = ""){

        // Include the main TCPDF library (search for installation path).
        //echo dirname(__FILE__).'\pdf\tcpdf_include.php'; die();
        require_once(dirname(__FILE__).DS.'pdf'.DS.'tcpdf.php');

        // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Hodi International');
        $pdf->SetTitle($p_sTitle);

// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', '', 9);

        foreach($p_aHTML as $page){
            // add a page
            $pdf->AddPage();

            // create some HTML content
            $html = $page;

            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');
        }

        // reset pointer to the last page
        $pdf->lastPage();

        // ---------------------------------------------------------

        //Close and output PDF document
        $this->m_sTitle = str_replace(" ", "_", $this->m_sTitle);
        if($p_sType == "F"){
            if(!is_dir(ROOT.'/webroot/pdf/'.$p_sFolder.'/')){
                mkdir(ROOT.'/webroot/pdf/'.$p_sFolder.'/');
            }
            $pdf->Output(ROOT.'/webroot/pdf/'.$p_sFolder.'/'.$this->m_sTitle.'.pdf', $p_sType);
            return ROOT.'/webroot/pdf/'.$p_sFolder.'/'.$this->m_sTitle.'.pdf';
        }else{
            $pdf->Output($this->m_sTitle.'.pdf', $p_sType);
            return $this->m_sTitle.'.pdf';
        }

        //============================================================+
        // END OF FILE
        //============================================================+

    }


    public function makePalletslips($p_sTitle, $p_aDataLines, $p_aPallets, $p_sType = "D", $p_sFolder = ""){

        //region Basics Pakbon

        // Include the main TCPDF library (search for installation path).
        //echo dirname(__FILE__).'\pdf\tcpdf_include.php'; die();
        require_once(dirname(__FILE__).DS.'pdf'.DS.'tcpdf.php');

        // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Hodi International');
        $pdf->SetTitle($p_sTitle);

// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', '', 9);

        //endregion

        // GEGEVENS TOMPAK
        $this->FRbkhADRES = TableRegistry::get('FRbkhADRES');
        $adres = $this->FRbkhADRES->get('C86OEET2');

        $this->HdIntPrplNapkins = TableRegistry::get('HdIntPrplNapkins');

        // MAAK GEGEVENS
        $sTablePakbon = "";
        foreach($p_aDataLines as $v){

            $aNapkin = $this->HdIntPrplNapkins->getNapkinByNrint($v['HdIntPrplViewItem']["HdIntPrplGeneral"]["napkin_nrint"]);

            $style = $v['HdIntPrplViewItem']["HdIntPrplGeneral"]["priority"] == 1 ? 'style="font-weight: bold;"' : '';

            $sTablePakbon .= "<tr>";
                $sTablePakbon .= "<td $style width=\"15%\">".$v['HdIntPrplViewItem']["order_nr"]."</td>";
                $sTablePakbon .= "<td $style width=\"55%\">".$v['HdIntPrplViewItem']["product_code"]."</td>";
                $sTablePakbon .= "<td $style width=\"15%\" align=\"right\">".number_format($v["quantity"],0,",",".")."</td>";
                $sTablePakbon .= "<td $style width=\"15%\" align=\"right\">".$v["pallets"]."</td>";
            $sTablePakbon .= "</tr>";
            $sTablePakbon .= "<tr>";
                $sTablePakbon .= "<td $style width=\"15%\"></td>";
                $sTablePakbon .= "<td $style colspan=\"3\"><em>".$v['HdIntPrplViewItem']["order_description"]."</em></td>";
            $sTablePakbon .= "</tr>";
            $sTablePakbon .= "<tr>";
                $sTablePakbon .= "<td $style width=\"15%\"></td>";
                $sTablePakbon .= "<td $style colspan=\"3\"><strong>Napkin:</strong> <em>".$aNapkin["napkin_name"]."</em></td>";
            $sTablePakbon .= "</tr>";
            $sTablePakbon .= "<tr>";
                $sTablePakbon .= "<td colspan=\"4\"></td>";
            $sTablePakbon .= "</tr>";
        }

        foreach($p_aPallets as $kk => $pal){
            $palletno = $kk;
            $sTablePalletbon[$palletno] = "";
            foreach($pal as $k => $vv){
                if(isset($p_aDataLines[$vv])){
                    $v = $p_aDataLines[$vv];

                    $aNapkin = $this->HdIntPrplNapkins->getNapkinByNrint($v['HdIntPrplViewItem']["HdIntPrplGeneral"]["napkin_nrint"]);

                    $style = $v['HdIntPrplViewItem']["HdIntPrplGeneral"]["priority"] == 1 ? 'style="font-weight: bold;"' : '';
                    if($v['HdIntPrplViewItem']["HdIntPrplGeneral"]["priority"] == 1){
                        $prio[$palletno] = 1;
                    }

                    $sTablePalletbon[$palletno].= "<tr>";
                        $sTablePalletbon[$palletno] .= "<td $style width=\"15%\">".$v['HdIntPrplViewItem']["order_nr"]."</td>";
                        $sTablePalletbon[$palletno] .= "<td $style width=\"70%\">".$v['HdIntPrplViewItem']["product_code"]."</td>";
                        $sTablePalletbon[$palletno] .= "<td $style width=\"15%\" align=\"right\">".number_format($v["quantity"],0,",",".")."</td>";
                    $sTablePalletbon[$palletno] .= "</tr>";

                    $sTablePalletbon[$palletno] .= "<tr>";
                        $sTablePalletbon[$palletno] .= "<td $style width=\"15%\"></td>";
                        $sTablePalletbon[$palletno] .= "<td $style colspan=\"2\"><em>".$v['HdIntPrplViewItem']["order_description"]."</em></td>";
                    $sTablePalletbon[$palletno] .= "</tr>";

                    $sTablePalletbon[$palletno] .= "<tr>";
                        $sTablePalletbon[$palletno] .= "<td $style width=\"15%\"></td>";
                        $sTablePalletbon[$palletno] .= "<td $style colspan=\"3\"><strong>Napkin:</strong> <em>".$aNapkin["napkin_name"]."</em></td>";
                    $sTablePalletbon[$palletno] .= "</tr>";

                    $sTablePalletbon[$palletno] .= "<tr>";
                        $sTablePalletbon[$palletno] .= "<td colspan=\"3\"></td>";
                    $sTablePalletbon[$palletno] .= "</tr>";
                }
            }
        }

        // MAAK PAKBON
        $aVar["tableContent"] = $sTablePakbon;
        $aVar["PACKNAAM"] = $adres->BKHADNAAM;
        $aVar["PACKADRES"] = nl2br($adres->BKHADADRES_P);

        // add a page
        $pdf->AddPage();

        // create some HTML content
        $html = $this->loadTemplate('pakbonPrinter', $aVar);

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // MAAK PALLETBONNEN
        foreach($sTablePalletbon as $k => $page){
            // add a page
            $pdf->AddPage();

            // CREATE VARS
            $aVar["tableContent"] = $page;
            $aVar["i"] = $k;
            $aVar["PRIORITY"] = isset($prio[$k]) ? 'PRIORITY' : '';

            // create some HTML content
            $html = $this->loadTemplate('palletbonPrinter', $aVar);

            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');
        }


        // reset pointer to the last page
        $pdf->lastPage();

        // ---------------------------------------------------------
        $title = date('YmdHis');
        $this->setTitle($title."_".$p_sTitle);

        //Close and output PDF document
        $this->m_sTitle = str_replace(" ", "_", $this->m_sTitle);
        if($p_sType == "F"){
            if(!is_dir(ROOT.'/webroot/pdf/'.$p_sFolder.'/')){
                mkdir(ROOT.'/webroot/pdf/'.$p_sFolder.'/');
            }
            $pdf->Output(ROOT.'/webroot/pdf/'.$p_sFolder.'/'.$this->m_sTitle.'.pdf', $p_sType);
            return ROOT.'/webroot/pdf/'.$p_sFolder.'/'.$this->m_sTitle.'.pdf';
        }else{
            $pdf->Output($this->m_sTitle.'.pdf', $p_sType);
            return $this->m_sTitle.'.pdf';
        }

        //============================================================+
        // END OF FILE
        //============================================================+

    }

}
?>