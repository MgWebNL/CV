<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class QuotationTable extends Table
{

    public $m_oList;
    public $m_aConditions = [];
    public $m_aStatus = [
        0 => ["text" => "Pending", "color" => "blue"],
        1 => ["text" => "Ordered", "color" => "green"],
        2 => ["text" => "Canceled", "color" => "red"],
        3 => ["text" => "Partial ordered", "color" => "green"],
    ];

    public function initialize(array $config)
    {
        $this->table('FRordOFFERTE');
        $this->primaryKey('ORDOFNRINT');

        $this->hasOne('Address', [
            'propertyName' => 'Address',
            'foreignKey' => 'BKHADNRINT',
            'bindingKey' => 'ORDOF_BKHADNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Employee', [
            'propertyName' => 'Employee',
            'foreignKey' => 'ORDMWNRINT',
            'bindingKey' => 'ORDOF_ORDMWNRINT',
            'joinType' => 'INNER',
        ]);

        $this->hasOne('Contactperson', [
            'propertyName' => 'Contactperson',
            'foreignKey' => 'BKHCONRINT',
            'bindingKey' => 'ORDOF_BKHCONRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasOne('TempQuotationStatus', [
            'propertyName' => 'TempQuotationStatus',
            'foreignKey' => 'offerte_id',
            'bindingKey' => 'ORDOFNRINT',
            'joinType' => 'LEFT',
        ]);

        $this->hasMany('QuotationLine', [
            'propertyName' => 'QuotationLine',
            'foreignKey' => 'ORDFR_ORDOFNRINT',
            'bindingKey' => 'ORDOFNRINT',
            'joinType' => 'INNER',
        ]);

    }

    /**
     * @param $p_iCustomerNrint
     * @return $this
     *
     * BASISGEGEVENS OFFERTELIJST PORTAL !!
     *
     */
    public function getQuotationListCustomer($p_iCustomerNrint){
        return $this->find('all')
            ->select(["ORDOFNRINT", "ORDOFNR", "ORDOFOMS", "ORDOFDATUM", "ORDOFSTATUS", "ORDOFREFERENTIE", "TempQuotationStatus.new_status"])
            ->contain(["TempQuotationStatus"])
            ->where(["ORDOF_BKHADNRINT" => $p_iCustomerNrint])
            ->order(["ORDOFDATUM" => "DESC"]);
    }

    /**
     * @param $p_sQuotationNrint
     * @param $p_sCustomerNrint
     * @return mixed
     *
     * BASISGEGEVENS OFFERTE PORTAL !!
     *
     */
    public function getQuotationCustomer($p_sQuotationNrint, $p_sCustomerNrint){
        return $this->find('all')
            ->contain([
                "QuotationLine.Article.ArticleUnit" => function($q){ return $q->where(["QuotationLine.ORDFRTYPE" => 0]); },
                "QuotationLine.QuotationLinePrices",
                "Address.Country",
                "Employee",
                "Contactperson",
                "TempQuotationStatus"
            ])
            ->where(["ORDOF_BKHADNRINT" => $p_sCustomerNrint, "ORDOFNRINT" => $p_sQuotationNrint])
            ->first();
    }




    /****************************************************/
    /****************** EXTRA FUNCTIES ******************/
    /****************************************************/


    /**
     * @return array
     */
    public function getStatusArray(){
        return $this->m_aStatus;
    }


    /**
     * @param $aList
     * @return mixed
     */
    public function setStatusTextList($aList){
        if($aList->count() > 0){
            foreach($aList as $row){
                if(!is_null($row->TempQuotationStatus)){
                    $row->ORDOFSTATUSTEXT = $this->m_aStatus[$row->TempQuotationStatus->new_status];
                    $row->ORDOFSTATUS = $row->TempQuotationStatus->new_status;
                }else{
                    $row->ORDOFSTATUSTEXT = $this->m_aStatus[$row->ORDOFSTATUS];
                }

            }
        }
        return $aList;
    }


    /**
     * @param $aItem
     * @return mixed
     */
    public function setStatusText($aItem){
        if($aItem){
            if(!is_null($aItem->TempQuotationStatus)){
                $aItem->ORDOFSTATUSTEXT = $this->m_aStatus[$aItem->TempQuotationStatus->new_status];
                $aItem->ORDOFSTATUS = $aItem->TempQuotationStatus->new_status;
            }else{
                $aItem->ORDOFSTATUSTEXT = $this->m_aStatus[$aItem->ORDOFSTATUS];
            }

        }
        return $aItem;
    }




    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
    }

}

?>