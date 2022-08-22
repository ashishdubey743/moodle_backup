<?php 

require_once('../config.php');
global $USER,$DB;
$id=$USER->id;
$data = array();
$code = $_GET['code'];
$courseid= $_GET['courseid'];

// $schoolid = $_SESSION['schoolid'];
$codedata = $DB->get_records_sql("select * from {access_code_data} where accesscode = '$code'");
//var_Dump($codedata);
$count = count($codedata);
$coursecodedata = $DB->get_records_sql("select ac.* from {access_code_data} acd left join {access_code} ac on acd.batch_id = ac.id where acd.accesscode='$code'");
// print_r($coursecodedata);die;

$data['msg'] = '';

// $co_count = count($coursecodedata);


 if($count == 0){
    $data['msg'] = 'Invalid Access Code!';
echo json_encode($data);
}
else{
//   $sc_id = $DB->get_record_sql("select ac.* from {access_code_data} acd left join {access_code} ac on acd.batch_id = ac.id where acd.accesscode = '$code'");
$sc_id = $DB->get_record_sql("select * from {school_createduser} where userid='$id'");
  $schoolid = $sc_id->schoolid;
// print_r($schoolid);die;
 
  
    $codedata1 = $DB->get_record_sql("select * from {access_code_data} where accesscode = '$code'");
    $isexpired=false;
    // if($codedata1){
    //     $batch_id=$codedata1->batch_id;
    //     $expirydate=$DB->get_record_sql("SELECT end_date FROM {access_code} WHERE id=$batch_id");
    //     $currenttime=strtotime("now");
    //     $endtime=$expirydate->end_date;
    //     if($currenttime>$endtime){
    //          $isexpired=true;
    //     }

    // }
     if($codedata1){
      $isexpired=checkcode_expired($code);
  
    }
    if($codedata1->status == 0 || $codedata1->used == 1||$isexpired){
        $data['msg'] = 'Invalid Access Code!';
        if($isexpired){
          $data['msg'] = 'Access Code Expired!';  
        }
        echo json_encode($data);
    }
  
    else{
        $temp =0;
    foreach($coursecodedata as $co){
        $co_courseid = $co->course_id; 
        $co_schoolid = $co->school_id; 
        if($co->course_id != $courseid){
            $temp =0;
        }
        elseif($co->school_id != $schoolid){
            $temp =0;
        }
        else{
            $temp =1;
        }
    }
    if($temp == 0){
        $data['msg'] = 'Invalid Access Code!';
        echo json_encode($data);
    }
else{
    //  LICENSE EXPIRY FROM HERE
                $get_course = $DB->get_record_sql("select * from {course} where id='$courseid'");
                $coursename = $get_course->fullname;
                $license_expiry = $DB->get_record_sql("select * from {liscence} where schoolid='$schoolid' and course='$coursename'");
            
                $date = strtotime("now");
                if($date > $license_expiry->enddate){
                        
                    $data['msg'] = 'License has Expired';
                    echo json_encode($data);
                    die;
                }
    //  LICENSE EXPIRY TILL HERE


    $lis_count = $DB->get_record_sql("select * from {license_count} where schoolid=$schoolid and courseid='$courseid'");
    $total = intval($lis_count->license_count);
    // print_r($USER->id);die;
    if($total>0){
        // die(var_dump($schoolid));
        $minus = 1;
        $new_total = $total-$minus;
    //    $useddata = $DB->get_record_sql("select * from {license_count} where schoolid=$schoolid and courseid='$courseid'");
    $useddata = $lis_count->used;
    $useddata = $useddata + $minus;
        $DB->execute("update {license_count} set used=$useddata where schoolid=$schoolid and courseid=$courseid");
        $data['msg'] = 'Enrolled Successfully!';
    $data['msg1']= 'success';
	//$DB->set_debug(true);
    $codedata_usertype = $DB->get_record_sql("select * from {access_code} where id = '".$codedata1->batch_id."'");
	//$DB->set_debug(false);

    $resource = $DB->get_record('school_courses', array('schoolid'=>$schoolid, 'courseid'=>$courseid), '*');
     if($resource->resourseid>0){
	 $rcid=$resource->resourseid;
	 if($codedata_usertype->role==1)
		enrol_try_internal_enrol($rcid, $USER->id,3, time());
		else
    enrol_try_internal_enrol($rcid, $USER->id,5, time());
	 } 
	if($codedata_usertype->role==1)
		enrol_try_internal_enrol($courseid, $USER->id,3, time());
		else
    enrol_try_internal_enrol($courseid, $USER->id,5, time());
    // redirect("course.php?id=$courseid","enroll Successfully");
    $DB->execute("update {access_code_data} set used = 1 where accesscode='$code'");
    echo json_encode($data);
    }
    else{
        $data['msg'] = 'All Licenses are used!';
        echo json_encode($data);
    }
    
}
    }
    


}

function checkcode_expired($code){
    global $DB;
     $codedata1 = $DB->get_record_sql("select * from {access_code_data} where accesscode = '$code'");
       $isexpired=false;
    
        $batch_id=$codedata1->batch_id;
        $expirydate=$DB->get_record_sql("SELECT * FROM {access_code} WHERE id=$batch_id");
        $currenttime=strtotime("now");
        $endtime=$expirydate->end_date;
        if($currenttime>$endtime){
             return true;
        }
        $datecreated=$expirydate->date_created;
        $dateto=date("m/d/y",$datecreated);
        $duratiion=30*($expirydate->duration);
        $res=strtotime($dateto. ' + '.$duratiion.' day');
        if($res<$currenttime){
            $isexpired=true;
        }

        return $isexpired;

}
 

?>