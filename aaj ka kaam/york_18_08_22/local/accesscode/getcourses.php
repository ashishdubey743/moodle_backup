<?php
require_once('../../config.php');
require_once('lib.php');
$scid=$_GET["schooliid"];
$json=array();
$json['html'] = '<option value="">Select course</option>';
if($scid){
	// $coursedata=$DB->get_records_sql("SELECT {course}.* FROM {course} LEFT JOIN {school_courses} ON {course}.id={school_courses}.courseid WHERE {school_courses}.schoolid=$scid");


	$coursedata=$DB->get_records_sql("SELECT {course}.* FROM {course} LEFT JOIN {school_courses} ON {course}.id={school_courses}.courseid LEFT JOIN {customfield_data} ON {course}.id={customfield_data}.instanceid WHERE {school_courses}.schoolid=$scid AND {customfield_data}.value=1");

	// print_r($coursedata);die;
	
	// $options='<option value="">Select course</option>';
	if($coursedata){
		foreach($coursedata as $value) {

			$json['html'] .= '<option value="'.$value->id.'">'.$value->fullname.'</option>';
	     }
		 $json['success']=true;
		 
	}
	
	// $json['html'] .= $options;
	
	
}

echo json_encode($json);
?>