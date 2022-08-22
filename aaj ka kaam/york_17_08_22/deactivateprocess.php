<?php
require_once('../../config.php');
global $DB,$USER;

if(isset($_GET['deactivate'])){
$id = $_GET['id'];
$dataobject = new stdClass();
$dataobject->id =$id;
$dataobject->status = 0;
 $DB->update_record('liscence', $dataobject, $bulk=false); 
header("location:liscencelist.php?msg=0"); 

}
else{

    $id = $_GET['id'];
    $dataobject = new stdClass();
$dataobject->id =$id;
$dataobject->status = 1;
// print_r($dataobject);die;    
 $DB->update_record('liscence', $dataobject, $bulk=false); 
header("location:liscencelist.php?msg=1"); 
}


?>