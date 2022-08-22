<?php
require_once('../../config.php');
require_once('lib.php');
$scid=$_POST["schooliid"];
if($scid){
	$coursedata=$DB->get_records_sql("SELECT {course}.* FROM {course} LEFT JOIN {school_courses} ON {course}.id={school_courses}.courseid WHERE {school_courses}.schoolid=$scid");


	$coursedata=$DB->get_records_sql("SELECT {course}.* FROM {course} LEFT JOIN {school_courses} ON {course}.id={school_courses}.courseid LEFT JOIN {customfield_data} ON {course}.id={customfield_data}.instanceid WHERE {school_courses}.schoolid=$scid AND {customfield_data}.value=1");

	// print_r($coursedata);die;
	
	$options='<option value="">Select course</option>';
	if($coursedata){
		foreach($coursedata as $value) {

		 $options.= '<option value="'.$value->id.'">'.$value->fullname.'</option>';
	     }

	}
	
	$json=array();
	$json['html']=$options;
	$json['success']=true;
	echo json_encode($json);
}

?>