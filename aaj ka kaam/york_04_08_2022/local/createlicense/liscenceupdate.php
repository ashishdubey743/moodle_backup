<?php
require_once('../../config.php');
global $DB,$USER;
$identifier1=$_GET['identifier1'];
$id=$_GET['id'];
$start1=$_GET['start1'];
$end1=$_GET['end1'];
$cutoff1=$_GET['cutoff1'];
$validity1=$_GET['validity1'];
$liscencecount1=$_GET['liscencecount1'];

$courseid1=$_GET['course1'];
// print_r($courseid1);die;
$arr_length = count($courseid1);

$schoolid1=$_GET['schoolname1'];
$edit =$_GET['edit'];
//edit
$identi_select = $DB->get_record_sql("select * from {liscence} where identifier ='$identifier1' AND identifier !='$edit' ");
$ide = $identi_select->identifier;

if($ide == $identifier1){
    $data = array();
    $data['alert'] = 'Identifier already exist!';
    $data['action'] = 'remain';
 echo json_encode($data);
}
else{
    
    for($i=0;$i<$arr_length;$i++){
    $co = $courseid1[$i];
    
    $check = $DB->get_records_sql("select * from {school_courses_contain} where schoolid ='$schoolid1' and identifier='$identifier1' and courseid='$co'");
    
    $checkcount = count($check);
    if($checkcount > 0){
        $DB->execute("update {school_courses_contain} set courseid='$co' where schoolid='$schoolid1' and identifier='$identifier1'");
        
    }
    else{
        $insert = new stdclass();
        $insert->schoolid = $schoolid1;
        $insert->courseid = $co;
        $insert->identifier = $identifier1;
        $DB->insert_record('school_courses_contain',$insert);
    }
    }
$schoolname1 = $DB->get_record_sql("select * from {school} where id = '$schoolid1'");
$course11 = $DB->get_record_sql("select * from {course} where id = '$courseid1'");
    $date_end=date_create($end1);
    $end_final = date_format($date_end,"d-m-Y");
    $new_end = strtotime($end_final);

    $date_start=date_create($start1);
    $start_final = date_format($date_start,"d-m-Y");
    $new_start = strtotime($start_final);

    $date_cutoff=date_create($cutoff1);
    $cutoff_final = date_format($date_cutoff,"d-m-Y");
    $new_cutoff = strtotime($cutoff_final);
$recordtoupdate = new stdclass();
$recordtoupdate->id = $id;
$recordtoupdate->identifier = $identifier1;

$recordtoupdate->startdate = $new_start;
$recordtoupdate->enddate = $new_end;
$recordtoupdate->cutoffdate = $new_cutoff;
$recordtoupdate->validity = $validity1;
$recordtoupdate->liscencecount = $liscencecount1;
$recordtoupdate->course = $course1->fullname;
$recordtoupdate->schoolname = $schoolname1->name;
$recordtoupdate->schoolid = $schoolid1;
// $recordtoupdate->courseid = $courseid1;
if($DB->update_record('liscence',$recordtoupdate, $bulk=false)){
    $data = "Liscence updated Successfully !";
    echo json_encode($data);
}
}
?>