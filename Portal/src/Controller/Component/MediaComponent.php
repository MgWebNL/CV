<?php
/**
 * Created by PhpStorm.
 * User: Ruud
 * Date: 13-7-2017
 * Time: 09:40
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class MediaComponent extends Component
{

    public $components = ["Flash"];

    public $m_sStartPath = 'http://www.hodi-groep.nl/documents/vm/';
    public $m_sPrintsUser = 'hodiuser';
    public $m_sPrintsPass = 'hodiuser';


    /**
     * @param $p_sModelname
     * START ELK COMPONENT MET DEZE FUNCTIE !!
     */
    public function loadModel($p_sModelname){
        $this->$p_sModelname = TableRegistry::get($p_sModelname);
    }

    public function downloadFile($p_sFileName, $p_sType){

        $context = stream_context_create(array(
            'http' => array(
                'header'  => "Authorization: Basic " . base64_encode("$this->m_sPrintsUser:$this->m_sPrintsPass")
            )
        ));

        switch ($p_sType){
            case 'invoice':
                $sFolder = 'PDF_PRINTS/RbkhFACTUUR/';
                break;
            case 'imageArticle':
                $sFolder = 'FotoArtikel/Artikel/';
                break;
            case 'imageGroup':
                $sFolder = 'FotoArtikel/Groep/';
                break;
        }

        $name = $this->m_sStartPath . $sFolder . $p_sFileName;
        //file_get_contents is standard function
        //$content = file_get_contents($name);
        $content = @file_get_contents($name, false, $context);
        if($content) {
            header('Content-Type: application/pdf');
            header('Content-Length: ' . strlen($content));
            header('Content-disposition: attachment; filename="' . $p_sFileName . '"');
            header('Cache-Control: public, must-revalidate, max-age=0');
            header('Pragma: public');
            header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            echo $content;
        } else {
//            $this->Flash->error(__('You do not have permissions to visit this page'));
//            return $this->_registry->getController()->redirect('/Home/');
            echo '';
        }
    }

    public function getProofPdf($p_sAddressCode, $p_sOrderNr){
//        $sFilePath = $this->m_sStartPath.'Documents/Debiteuren/'.$p_sAddressCode.'/Orders/'.$p_sOrderNr.'/artwork/';
//        $aFile = glob($sFilePath."PD-*.pdf");
//        return isset($aFile[0]) ? $aFile[0] : false;
    }

    // region Scrips voor afbeeldingen
    public function getProductImage($p_sArticleCode, $p_sProductGroupCode){
        $sMainGroup = substr($p_sProductGroupCode,0, -3);
        if($image = $this->getImageByArticleCode($p_sArticleCode)){
            return $image;
        }elseif($image = $this->getImageByProductGroupCode($p_sProductGroupCode)){
            return $image;
        }elseif($image = $this->getImageByProductGroupCode($sMainGroup)){
            return $image;
        }elseif($image = $this->getImageNoImage()){
            return $image;
        }else{
            return "http://www.placehold.it/300x300/?text=No Image";
        }
    }

    public function getCategoryImage($p_sProductGroupCode){
        $sMainGroup = substr($p_sProductGroupCode,0, -3);
        //return "http://www.placehold.it/300x300/?text=No Image";
        if($image = $this->getImageByProductGroupCode($p_sProductGroupCode)){
            return $image;
        }elseif($image = $this->getImageByProductGroupCode($sMainGroup)){
            return $image;
        }elseif($image = $this->getImageNoImage()){
            return $image;
        }else{
            return "http://www.placehold.it/300x300/?text=No Image";
        }
    }

    private function getImageByArticleCode($p_sCode){
        return @getimagesize($this->m_sStartPath.'/FotoArtikel/Artikel/'.$p_sCode.'.jpg') ? $this->m_sStartPath.'/FotoArtikel/Artikel/'.$p_sCode.'.jpg' : false;
    }

    private function getImageByProductGroupCode($p_sCode){
        return @getimagesize($this->m_sStartPath.'/FotoArtikel/Groep/'.$p_sCode.'.jpg') ? $this->m_sStartPath.'/FotoArtikel/Groep/'.$p_sCode.'.jpg' : false;
    }

    private function getImageNoImage(){
        return @getimagesize($this->m_sStartPath.'/FotoArtikel/noImage.jpg') ? $this->m_sStartPath.'/FotoArtikel/noImage.jpg' : false;
    }

    //endregion
    
}
?>