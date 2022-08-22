<?php 
require_once('../../config.php');
global $DB,$USER;
$id = $_GET['id'];

$coursedata=$DB->get_records_sql("SELECT {course}.* FROM {course} LEFT JOIN {school_courses} ON {course}.id={school_courses}.courseid left join {customfield_data} on {course}.id = {customfield_data}.instanceid WHERE {school_courses}.schoolid=$id and {customfield_data}.value=1");
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
echo json_encode($data);
?>