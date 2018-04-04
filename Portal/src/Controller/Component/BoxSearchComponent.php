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

class BoxSearchComponent extends Component
{

    public $m_iMarge = 0.1;

    public function loadModel($p_sTablename){
        $this->$p_sTablename = TableRegistry::get($p_sTablename);
    }

    public function getSubGroups($p_sGroupNrint, $p_bTree = true){
        $result = [];
        $this->loadModel("ArticleGroup");
        $aGroups = $this->ArticleGroup->find()->where(["BKHAG_BKHAGNRINT" => $p_sGroupNrint]);

        foreach($aGroups as $group){
            $groups = [];

            if($p_bTree === false){
                $result[] = $group["BKHAGNRINT"];
                foreach($groups as $g){
                    $result[] = $g["BKHAGNRINT"];
                }
            }else{
                $result[$group["BKHAGNRINT"]] = [];
                foreach($groups as $g){
                    $result[$group["BKHAGNRINT"]][] = $g["BKHAGNRINT"];
                }
            }
        }
        return $result;
    }

    public function findBox(&$p_iLength, &$p_iWidth, $p_iHeight){
        // CHECK LENGTE BREEDTE!
        if($p_iLength < $p_iWidth){
            $i = $p_iWidth;
            $p_iWidth = $p_iLength;
            $p_iLength = $i;
            unset($i);
        }

        // SET MARGE
        $iLengthMin = $p_iLength * (1-$this->m_iMarge);
        $iLengthMax = $p_iLength * (1+$this->m_iMarge);
        $iWidthMin = $p_iWidth * (1-$this->m_iMarge);
        $iWidthMax = $p_iWidth * (1+$this->m_iMarge);
        $iHeightMin = $p_iHeight * (1-$this->m_iMarge);
        $iHeightMax = $p_iHeight * (1+$this->m_iMarge);

        // GET ALL SUBGROUPS!
        $aGroups = $this->getSubGroups(HD_BOXSEARCH_CAT_NRINT, false);

        // QUERY!
        $this->loadModel("Article");
        $a = $this->Article->find()
            ->where([
                "BKHAR_BKHAGNRINT IN" => $aGroups,
                "BKHAR_LENGTE >=" => $iLengthMin,
                "BKHAR_LENGTE <=" => $iLengthMax,
                "BKHAR_BREEDTE >=" => $iWidthMin,
                "BKHAR_BREEDTE <=" => $iWidthMax,
                "BKHAR_HOOGTE >=" => $iHeightMin,
                "BKHAR_HOOGTE <=" => $iHeightMax,
                "BKHARVOORRAAD" => 1
            ]);
        return $a;

    }
}
?>