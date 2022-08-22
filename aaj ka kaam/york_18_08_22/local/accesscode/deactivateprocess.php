<?php
require_once('../../config.php');
global $DB,$USER;

if(isset($_GET['deactivate'])){
$id = $_GET['id'];
$dataobject = new stdClass();
$dataobject->id =$id;
$dataobject->status = 0;
 $DB->update_record('access_code', $dataobject, $bulk=false); 
 $DB->execute("update {access_code_data} set status = 0 where batch_id = $id");
header("location:acesscodebatchlist.php?msg=0"); 

}
else{

    $id = $_GET['id'];
    $dataobject = new stdClass();
$dataobject->id =$id;
$dataobject->status = 1;
// print_r($dataobject);die;    
 $DB->update_record('access_code', $dataobject, $bulk=false); 
 $DB->execute("update {access_code_data} set status = 1 where batch_id = $id");

header("location:acesscodebatchlist.php?msg=1"); 
}


?>