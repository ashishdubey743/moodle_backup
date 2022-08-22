<?php 
require_once('../../config.php');
global $DB,$USER;
$id = $_GET['id'];
$selected_courses=$_GET['selectedcourses'];
 
$Not_in=implode(', ',$selected_courses);

if(isset($_GET['selectedcourses'])){
  $coursedata=$DB->get_records_sql("SELECT {course}.* FROM {course} LEFT JOIN {school_courses} ON {course}.id={school_courses}.courseid left join {customfield_data} on {course}.id = {customfield_data}.instanceid WHERE {school_courses}.schoolid=$id and {customfield_data}.value=1 and {course}.id NOT IN (".$Not_in.")");
}
else{
  $coursedata=$DB->get_records_sql("SELECT {course}.* FROM {course} LEFT JOIN {school_courses} ON {course}.id={school_courses}.courseid left join {customfield_data} on {course}.id = {customfield_data}.instanceid WHERE {school_courses}.schoolid=$id and {customfield_data}.value=1");
}
$data = array();
$data['html'] = '<ul role="option" class="ul" id="coursedata1">';
foreach($coursedata as $cd){
$data['html'] .= '
<li class="list" data-value="'.$cd->id.'">'.$cd->fullname.'</li>';


}
$data['html'] .= '</ul>
<script>

$(".ul .list").click(function(){
 
     var val = $(this).attr("data-value");
      cars.push(val);
     console.log(cars);
     
   });
</script>
';
$data['span'] = '<input type="text" name="" class="form-control" id="myInput" placeholder="Select Course">';
echo json_encode($data);
?>