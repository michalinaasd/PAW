<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 */
class Employee extends AppModel {
   var $validate = array('nazwisko'=>array('rule'=>'notBlank'),
                  'etat'=>array('rule'=>'notBlank'), 'placa_pod'=>array('rule'=>array('comparison', '<=', 2000), 'message'=>'Wartość od 0 do 2000'));
   public function limit($check){
      if($check < 2000){
         return true;
      }
      else{
         return false;
      }
   }
}
