<?php
require_once('../../config.php');
require_once('lib.php');
GLOBAL $USER,$DB;
$data = new stdClass();
if($_POST['dvalue']){
	$json=array();
	$dataid=$_POST['dvalue'];
	$data->id=$dataid;
	
	$result=$DB->get_record_sql('select * from {access_code_data} where id='.$dataid.'');
  
	if($result->status==0){
		$data->status=1;

		$json["msg"]="enable successfully";
	}
	else{
		$data->status=0;
		$json["msg"]="disable successfully";
	}
    $DB->update_record('access_code_data', $data,$bulk=false);
    
    $json['success']=true;
    echo json_encode($json);
}
if($_GET['checkedValue'] && !isset($_GET['en'])){
	$wherein=implode(',',$_GET['checkedValue']);
	$DB->execute("UPDATE {access_code} SET status=0 WHERE id IN (".$wherein.")");
	$DB->execute("UPDATE {access_code_data} SET status=0 WHERE batch_id IN (".$wherein.")");
	$json=array();
	$json["success"]=true;
	$json['msg']="disabled successfully";
	echo json_encode($json);
}
elseif($_GET['checkedValue'] && isset($_GET['en'])){
	$wherein=implode(',',$_GET['checkedValue']);
	$DB->execute("UPDATE {access_code} SET status=1 WHERE id IN (".$wherein.")");
	$DB->execute("UPDATE {access_code_data} SET status=1 WHERE batch_id IN (".$wherein.")");
	$json=array();
	$json["success"]=true;
	$json['msg']="Enabled successfully";
	echo json_encode($json);
}



?>