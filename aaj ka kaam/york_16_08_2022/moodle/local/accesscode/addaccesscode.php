<?php

require_once('../../config.php');
require_once('lib.php');
GLOBAL $USER,$DB;

$data = new stdClass();
$data->no_of_codes=(int)$_POST['no_ofcodes'];
$data->batch=$_POST['batch_name'];
$data->acesstype=$_POST['access_type'];
$data->school_id=(int)$_POST['school_id'];
$data->course_id=(int)$_POST['course_id'];
$data->code_prefix=$_POST['code_pref'];
$data->code_suffix=$_POST['code_suff'];
$data->code_length=$_POST['code_length'];
$data->duration=(int)$_POST['code_duration'];
$data->status=1;
$date=$_POST['end_date'];
$data->date_created=strtotime('now');
$schoolid = (int)$_POST['school_id'];
$courseid = (int)$_POST['course_id'];
///
$date_from=date_create($date);
$from_final = date_format($date_from,"d-m-Y");
$new_date1 = strtotime($from_final);

///
$data->end_date=$new_date1;
$data->role=(int)$_POST['role_id'];

//check if batch name already there
$batch_nam=$_POST['batch_name'];
$bach_get=$DB->get_record_sql("SELECT * FROM {access_code} WHERE batch='$batch_nam'");
$prefixval=$_POST['code_pref'];
$suffixval=$_POST['code_suff'];
$code_len=$_POST['code_length'];
$no_ofcodes=(int)$_POST['no_ofcodes'];


if($bach_get){
   $json = array();
   $json['success'] = true;
   $json['msg'] = "Batch name already exist";

}else{
  $record = $DB->get_records_sql("select * from {license_count} where schoolid = '$schoolid' and courseid = '$courseid'");
  $record1 = count($record);
  if($record1 == 0){
    $json = array();
   $json['success'] = true;
   $json['msg'] = "License does not Exist for this Course!";
   $json['action'] = "stay";
  }
  else{

  
	 $inserted=$DB->insert_record('access_code', $data,$returnid=true);
     
   if($inserted){
   $json = array();
   $json['success'] = true;
   $json['msg'] = "Access Code Created Successfully!";

   }
   for($i=0;$i<$no_ofcodes;$i++){
   	$datatoinsert=new stdClass();
   	 $datatoinsert->accesscode=$prefixval.RandomString($code_len).$suffixval;
     
	 $datatoinsert->batch_id=$inserted;
	 $datatoinsert->status=1;
     $DB->insert_record('access_code_data', $datatoinsert);
    }
  }
}

 echo json_encode($json);

function randomNumber($length) {
    $result = '';
    
    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

 function RandomString($length)
    {   if($_POST['digitval'] && $_POST['upperval'] && $_POST['specialval']){
           $characters='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&()*+@{~}';
 
         }
         else if($_POST['digitval'] && $_POST['upperval']){
            $characters='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
         }
         else if($_POST['upperval'] && $_POST['specialval']){
             $characters='ABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&()*+@{~}';
         }
          else if($_POST['digitval'] && $_POST['specialval']){
             $characters='0123456789#$%&()*+@{~}';
         }
        else if($_POST['digitval']){
          $characters='0123456789';
        }
        else if($_POST['upperval']){
          $characters='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        else if($_POST['specialval']){
          $characters='!#$%&()*+@{~}';
        }
        else{
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        }
        if($_POST['excludeval']){
          $characters2=$characters;
          $datas=$_POST['excludeval'];
          $data=str_split($datas);
          foreach($data as $dt){
          $pos=strpos($characters2,$dt);
            if($pos>=0){
            $characters2[$pos]='/';
            }

          }
      
          $characters= str_replace("/","","$characters2");
        }
        $randstring = '';
       for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randstring .= $characters[$index];
        }
        return $randstring;
    }

//example code
// $strw="Ilovephp,!";
// $datas="Ipo,!";
// $data=str_split($datas);
// foreach($data as $dt){
// $pos=strpos($strw,$dt);
// if($pos>=0){
// $strw[$pos]='/';
// }

// }
// echo $strw;
// $new= str_replace("/","","$strw");
// echo "<br>";
// echo $new;


?>