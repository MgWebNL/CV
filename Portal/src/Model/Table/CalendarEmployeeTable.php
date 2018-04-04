<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;

class CalendarEmployeeTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_agenda_employee');
        $this->primaryKey('id');

        $this->hasOne('Employee', [
            'propertyName' => 'Employee',
            'foreignKey' => 'ORDMWNRINT',
            'bindingKey' => 'employee_nrint',
            'joinType' => 'INNER',
        ]);

    }

    public function getVisits($p_sNrint){
        return $this
            ->find()
            ->contain(["CalendarEmployee.Employee"])
            ->where(["FRbkhADRES_NRINT" => $p_sNrint, "cal_kind LIKE" => "visit_%"])->all();
    }

    public function makeVisitsCalendarProof($p_aVisitArray){
        $cal = [];
        foreach($p_aVisitArray as $item) {
            $row["type"] = 'visit';
            $row["id"] = $item->id;
            $row["title"] = $item->time_start->format('H:i') ." - ". __('Visit');
            $row["start"] = new Time($item->date_start);
            $row["date"] = $item->date_start->format('d-m-Y');
            $row["time"] = $item->time_start->format('H:i');
            $row["empl"] = [];
            $row["allDay"] = true;
            $row["className"] = "bgm-hodi";
            $row["description"] = $item->cal_shortdescription;
            $cal[] = $row;
        }
        return $cal;
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