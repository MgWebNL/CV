<?php
if(is_null($this->request->session()->read($session_var_name['name']))) {
    require_once(ROOT . DS . 'vendor' . DS . 'external_usermodule' . DS . 'Authentication' . DS . 'login.ctp');
//    require_once  'C:\xampp\htdocs\stageprojecten\dennis\public_html\usermodule' . DS . 'vendor' . DS . 'external_usermodule' . DS . 'Authentication' . DS . 'login.ctp';




}
?>
