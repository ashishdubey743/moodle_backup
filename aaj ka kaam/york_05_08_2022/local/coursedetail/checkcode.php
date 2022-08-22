<?php
require_once('../../config.php');


$code=$_POST['cod23'];
if(isset($code))
{

    global $DB,$USER;

    $schooladmin = $DB->get_record("school_createduser",array("userid"=>$USER->id));

    $Allaccesscode=$DB->get_record_sql("SELECT mac.*,macd.id as updateid,macd.used,mac.school_id from {access_code_data} macd join {access_code} mac on macd.batch_id=mac.id where macd.accesscode LIKE '$code'");

    // print_r($Allaccesscode);die;
    if($Allaccesscode->school_id!=$schooladmin->schoolid){
    $json = array();
    $json['success'] = false;
    $json['msg'] = "Access Code is Invalid!";
    echo json_encode($json);
    exit; 
    }
    if($Allaccesscode->used=="1"){
    $json = array();
    $json['success'] = false;
    $json['msg'] = "Access Code already used!";
    echo json_encode($json);
    exit;
    }
   if($Allaccesscode)
   {
        if($Allaccesscode->role==1)
        {
            $role=4;
        }
        if($Allaccesscode->role==3)
        {
            $role=5;
        }
      $id=enrol_try_internal_enrol($Allaccesscode->course_id, $USER->id,$role, time());
// $used =0;
      if($id){
        $data = new stdClass();
        $data->id = $Allaccesscode->updateid;
        $data->used = 1;
        $DB->update_record("access_code_data", $data);

        // License changes 
        // $used = 1;
        $schoolid = $Allaccesscode->school_id;
        $courseid = $Allaccesscode->course_id;
        $DB->execute("update {license_count} set used = used+1 where schoolid='$schoolid' and courseid='$courseid'");
        // License changes 

      }

    $json = array();
    $json['success'] = true;
    $json['msg'] = "Enrol Successfully!";
    $json['id'] = $Allaccesscode->course_id;
    echo json_encode($json);
      
   }
   else{
    $json = array();
    $json['success'] = false;
    $json['msg'] = "Code is Invalid!";

    echo json_encode($json);
   }
   
}
?>