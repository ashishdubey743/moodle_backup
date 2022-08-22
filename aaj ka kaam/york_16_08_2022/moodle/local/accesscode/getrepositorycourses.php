<?php
require_once('../../config.php');
$records=$DB->get_records_sql("SELECT * FROM {course_categories} WHERE parent=2");

$array=array();
$json=array();
$array[]=2;//course repository category
function getsubcategories($pid){
	global $DB;
	global $array;
	$records=$DB->get_records_sql("SELECT * FROM {course_categories} WHERE parent=$pid and visible=1");
      foreach ($records as $key => $value) {
      	$array[]=$value->id;
        getsubcategories($key);
      	
      }
 
   return;
}
getsubcategories(2);
$options="";
$ids=implode(", ",$array);
$coursedata=$DB->get_records_sql("SELECT * FROM {course} WHERE visible=1 and category IN (".$ids.")");

$options='<option value="">please select course</option>';
	
	if($coursedata){
		foreach($coursedata as $value) {

		 $options.= '<option value="'.$value->id.'">'.$value->fullname.'</option>';
	     }

	}


$json["success"]=true;
$json["html"]=$options;
echo json_encode($json);
// print_r($array);die;

?>