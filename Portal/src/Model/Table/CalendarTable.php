<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\I18n\Time;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class CalendarTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('hd_agenda');
        $this->primaryKey('id');

        $this->hasMany('CalendarEmployee', [
            'propertyName' => 'CalendarEmployee',
            'foreignKey' => 'hd_agenda_id',
            'bindingKey' => 'id',
            'joinType' => 'INNER',
        ]);

    }

    public function getVisits($p_sNrint){
        return $this
            ->find()
            ->contain(["CalendarEmployee.Employee"])
            ->where(["FRbkhADRES_NRINT" => $p_sNrint, "cal_kind LIKE" => "visit_%", "cal_not_ok <>" => '2'])->all();
    }

    public function makeVisitsCalendarProof($p_aVisitArray){
        $cal = [];
        foreach($p_aVisitArray as $item) {
            $aEmp = [];
            foreach($item->CalendarEmployee as $emp){
                $aEmp[] = $emp->Employee->ORDMWNAAM;
            }
            $row["type"] = 'visit';
            $row["id"] = $item->id;
            $row["title"] = $item->time_start->format('H:i') ." - ". __('Visit');
            $row["start"] = new Time($item->date_start);
            $row["date"] = $item->date_start->format('d-m-Y');
            $row["time"] = $item->time_start->format('H:i');
            $row["empl"] = implode(', ',$aEmp);
            $row["allDay"] = true;
            $row["className"] = ($item->cal_not_ok == 1) ? "bgm-hodi bgm-trans" : "bgm-hodi";
            $row["description"] = $item->cal_shortdescription;
            $cal[] = $row;
        }
        return $cal;
    }


    public function saveAppointment($p_aPost, $p_aSession){

        $this->Address = TableRegistry::get('Address');
        $aAddress = $this->Address->get($p_aSession["customer_nrint"]);

        $this->HdCustomerContactBezoek = TableRegistry::get('HdCustomerContactBezoek');
        $this->HdAgendaEmployee = TableRegistry::get('HdAgendaEmployee');

        // NEW CUST. VISIT
        $a = $this->HdCustomerContactBezoek->newEntity();
        $a->id = null;
        $a->user_id = 0;
        $a->date = date('Y-m-d');
        $a->FRbkhADRES_NRINT = $p_aSession["customer_nrint"];
        $a->bezoek_employee = $p_aSession["Accountmanager"]["ORDMWNRINT"];
        $a->bezoek_date = date('Y-m-d', strtotime($p_aPost["visit_date"]))." ".date('H:i:s', strtotime($p_aPost["visit_time"]));
        $a->bezoek_remarks = $p_aPost["visit_reason"];
        $id = $this->HdCustomerContactBezoek->save($a);
        unset($a);

        // NEW APPOINTMENT
        $a = $this->newEntity();
        $a->id = null;
        $a->FRbkhADRES_NRINT = $p_aSession["customer_nrint"];
        $a->date_created = date('Y-m-d');
        $a->time_created = date('H:i:s');
        $a->date_start = date('Y-m-d', strtotime($p_aPost["visit_date"]));
        $a->time_start = date('H:i:s', strtotime($p_aPost["visit_time"]));
        $a->createdby = $aAddress["BKHADCODE"];
        $a->cal_name = $aAddress["BKHADNAAM"];
        $a->cal_shortdescription = $p_aPost["visit_reason"];
        $a->cal_kind = 'visit_'.$id->id;
        $a->cal_not_ok = '1';
        $id = $this->save($a);
        unset($a);

        // SET EMPLOYEE TO APPOINTMENT
        $a = $this->HdAgendaEmployee->newEntity();
        $a->id = null;
        $a->hd_agenda_id = $id->id;
        $a->employee_nrint = $p_aSession["Accountmanager"]["ORDMWNRINT"];
        $this->HdAgendaEmployee->save($a);
        unset($a);

        return $id;

    }

}

?>