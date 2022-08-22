<?php 
require_once('../../config.php');
global $USER,$DB;
$identifier = $_GET['id'];
$schoolid = $_GET['schid'];
$courseid =$_GET['delcourse'];

$arr_length = count($courseid);
// print_r($arr_length);die;
for($i=0;$i<$arr_length;$i++){
$coid = $courseid[$i];
$iden = $DB->get_record_sql("select * from {liscence} where id = '$identifier'");
$iden1 = $iden->identifier;
$DB->execute("delete from {school_courses_contain} where schoolid = '$schoolid' and courseid = '$coid' and identifier = '$iden1'");

}
$data = "License Updated Successfully!";
echo json_encode($data);

?>