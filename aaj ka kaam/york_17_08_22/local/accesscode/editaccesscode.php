<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Main login page.
 *
 * @package    core
 * @subpackage auth
 * @copyright  1999 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('lib.php');
$PAGE->set_heading('Edit Access Code batch');
require_login();
if(!isloggedin()){

  return redirect(new moodle_url('/login'));
}
 GLOBAL $USER,$DB;
$school = $DB->get_records_sql("SELECT * FROM {school} WHERE visible=1");
$courses=$DB->get_records_sql("SELECT * FROM {course}");
// echo print_r($school);
$batchid=$_GET["bid"];
$ifused=$DB->get_records_sql("SELECT * FROM {access_code_data} WHERE batch_id=$batchid AND used=1");
if($ifused){
  redirect("acesscodebatchlist.php","batch are already in use", null, \core\output\notification::NOTIFY_WARNING);
}
$Batchdata=$DB->get_record_sql("SELECT {access_code}.*, {school}.name  FROM  {access_code} LEFT JOIN {school} ON {access_code}.school_id={school}.id WHERE {access_code}.id=$batchid");
$ttype=(int)$Batchdata->acesstype;
if($ttype==1){
  $acesstype="School";
}
else{
  $acesstype="Individual";
}
$school2=json_encode($school);

$PAGE->set_pagelayout('standard');
$PAGE->set_title("accesscode");
// echo $OUTPUT->header();

?>


<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Create Accesscode</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <style>
         .box-shadow{
         box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
          padding: 0px 20px 20px; 
         border-radius: 8px;
         }
         .box-1{
         height: 400px;
         width: 100%;
         border-radius: 5px;
         border: 1px solid #bab4b4;
         padding: 10px;
         box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
         outline: 1px solid #bab4b4;
           outline-offset: 3px;
         }
         [type="checkbox"]:focus{
            box-shadow:none !important;
         }
         label{
          font-weight:700;
         }
         body{background: #f7f7f7;}
         .heading-row{  background: #000;
         color: #fff;
         border: 2px solid #ffe500;
         padding: 8px 0px;
         border-radius: 8px;}
         .button{
         background: #000;
         padding: 10px 15px;
         color: #fff;
         text-decoration: none !important;
         border-radius: 4px;
         border: 1px solid #ffe500;
         font-weight: 600;
           box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
         }
         .button:hover{
         color: #000;
         background: #ffe500;
         }
         .box-1 h5{
         font-weight: 700;
         }
         .box-heading{
            font-size: 17px;
            font-weight: bold;
         }
         .box-1 p{
            font-weight: 600;
         }
         .form-control:focus{
           box-shadow:none;
         }
         .form-group:focus{
           box-shadow:none;
         }
         ul{
            list-style: none;
            padding-left: 15px;
         }
         ul li a{
            
            text-decoration: none !important;
         }
         body{
           font-family:'ABeeZee', sans-serif !important;
         }
         .form-control{
            box-shadow: 0 1px 3px rgb(0 0 0 / 9%), 0 1px 2px rgb(0 0 0 / 9%);
         }
                         .applyBtn, .cancelBtn {
           background: black;
  border-color: #fbe700;
         }
         .applyBtn:hover,.cancelBtn:hover{
           background: #fbe700;
           color:#fff;
  border-color: #fbe700;
         }
         .daterangepicker td.active, .daterangepicker td.active:hover {
  background-color: #1d1d1b;
  border-color: transparent;
  color: #fff;
}
         .select2-container--default{
            width:66.6% !important;
            box-shadow:0 1px 3px rgb(0 0 0 / 9%), 0 1px 2px rgb(0 0 0 / 9%) !important;
         }
         .select2-container .select2-selection--single{
            height:38px !important;
            border:1px solid #ced4da;
         }
         .select2-container--default .select2-selection--single .select2-selection__rendered{
            line-height:38px !important;
         }
         .select2-container--default .select2-selection--single .select2-selection__arrow{
            height:38px !important;
         }
         .select2-container--default .select2-selection--single{
           border:1px solid #ced4da !important;
         }
         #page-local-accesscode-editaccesscode .breadcrumb{
           display:none;
         }
      </style>
      <script>
        // $('#noofcode').prop('disabled', true);
      </script>
   </head>
   <!--<a href="acesscodelist.php">access code</a>&nbsp;&nbsp;
   <a href="acesscodebatchlist.php">status</a>-->
   <?php echo $OUTPUT->header(); ?>
   <body>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <input type="hidden" name="batchvalue" id="batchval" value="<?php echo $batchid?>">
    <input type="hidden" name="batchoriginalname" id="batchoriginal" value="<?php echo $Batchdata->batch?>">
      <div class="container">
         <div class="row mt-4">
            <div class="col-md-12 m-auto box-shadow bg-white">
               <div class="row mb-4 heading-row">
                  <div class="col-md-12">
                     <h5 class="mb-0">Edit Access Code batch</h5>
                  </div>
               </div>
               <div class="row" style="padding: 20px;">
                 <div class="col-md-12">
                    <form action="/action_page.php">
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">No. of Access Code:</label>
                      <select class="form-control col-md-8" id="noofcode" disabled>
                        <option value="">please select no of codes </option>
                        <?php for($i=1;$i<=500;$i++){ ?>
                         <?php if($Batchdata->no_of_codes==$i){?> 
                          <option value="<?php echo $i;?>" selected><?php echo $i;?> </option>
                         <?php } else{?> 
                        <option value="<?php echo $i;?>"><?php echo $i;?> </option>

                         <?php }}?>
                       </select>
                    </div>
                    <div class="form-group row">
                      <label for="batch" class="col-md-4 p-0">Batch Name:</label>
                      <input type="text" class="form-control col-md-8" placeholder="Batch Name" id="batch_name" value="<?php echo $Batchdata->batch?>" >
                    </div>
                   <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Access Type:</label>
                      <input type="text" class="form-control col-md-8" id="access_type" value="<?php echo $acesstype?>" readonly>
                     <!--  <select class="form-control col-md-8" id="access_type" >
                        
                        <option value="1" <?php if($acesstype==1) echo "selected"?>>school</option>
                         <option value="2" <?php if($acesstype==2) echo "selected"?>>individual</option>
                         
                       </select> -->
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">School Name:</label>
                      <input type="text" class="form-control col-md-8" id="school_name" value="<?php echo $Batchdata->name?>" readonly>
                      <!-- <select class="form-control col-md-8 select" id="school_name">
                        <option value="">Please select a school</option>
                        <?php foreach ($school as $sch) {  ?>   
                         
                        <option value="<?php echo $sch->id ?>"><?php echo $sch->name ?></option>
                        <? }?>
                       </select> -->
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Course Name:</label>
                      <select class="form-control col-md-8 select" id="course_name" disabled>
                        <option value="" >Please Select Course</option>
                         <?php foreach ($courses as $co) {  ?>   
                         
                        <option value="<?php echo $co->id ?>" <?php if($co->id==$Batchdata->course_id) echo "selected"; ?>><?php echo $co->fullname ?></option>
                        <? }?>
                       </select>
                    </div>
                    <div class="form-group row">
                     <div class="col-md-4 pl-0">
                      <label for="email" >Code Prefix:</label>
                      <input type="email" class="form-control " placeholder="" id="code_pref" value="<?php echo $Batchdata->code_prefix?>" readonly>
                     </div>
                     <div class="col-md-4 px-0">
                      <label for="email" class="">Code Sufix:</label>
                      <input type="email" class="form-control" placeholder="" id="code_suff" value="<?php echo $Batchdata->code_suffix ?>" readonly>
                   </div>
                   
                   <div class="col-md-4 pr-0">
                      <label for="email" class="">Code Length:</label>
                      <input type="text" class="form-control" placeholder="" id="code_length" value="<?php echo $Batchdata->code_length ?>" readonly>
                      <!-- <select class="form-control" id="code_length">
                        <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="4">4</option>
                         <option value="5">5</option>
                         <option value="6">6</option>
                         <option value="7">7</option>
                         <option value="8">8</option>
                         <option value="9">9</option>
                         <option value="10">10</option>

                       </select> -->
                     </div>
                    </div>

                     <div class="form-group row">
                     <div class="col-md-4 pl-0 d-flex">
                    <input type="checkbox" class="mr-2" id="digitval" disabled>
                      <label for="email" class="mb-0">Digits:</label>
                     </div>
                     <div class="col-md-4 pl-0 d-flex">
                      <input type="checkbox" class="mr-2" id="upperval" disabled>
                      <label for="email" class="mb-0" >Uppercase:</label>
                     </div>
                   
                   <div class="col-md-4 pl-0 d-flex">
                      <input type="checkbox" class="mr-2" id="specialval" disabled>
                      <label for="email" class="mb-0">Special Characters:</label>
                     </div>
                    </div>

                    <div class="form-group row">
                      <label for="batch" class="col-md-4 p-0">Exclude Characters:</label>
                      <input type="text" class="form-control col-md-8" placeholder="Exclude Characters" id="excludeval" readonly>
                    </div>


                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Code Validation Duration(Months):</label>
                     <select class="form-control col-md-8" id="code_duration">
                        <option value="">please select duration</option>

                         <option value="1" <?php if($Batchdata->duration==1) echo "selected" ?>>1</option>
                         <option value="2" <?php if($Batchdata->duration==2) echo "selected" ?>>2</option>
                         <option value="3" <?php if($Batchdata->duration==3) echo "selected" ?>>3</option>
                         <option value="4" <?php if($Batchdata->duration==4) echo "selected" ?>>4</option>
                         <option value="5" <?php if($Batchdata->duration==5) echo "selected" ?>>5</option>
                         <option value="6" <?php if($Batchdata->duration==6) echo "selected" ?>>6</option>
                         <option value="7" <?php if($Batchdata->duration==7) echo "selected" ?>>7</option>
                         <option value="8" <?php if($Batchdata->duration==8) echo "selected" ?>>8</option>
                         <option value="9" <?php if($Batchdata->duration==9) echo "selected" ?>>9</option>
                         <option value="10" <?php if($Batchdata->duration==10) echo "selected" ?>>10</option>
                         <option value="11" <?php if($Batchdata->duration==11) echo "selected" ?>>11</option>
                         <option value="12" <?php if($Batchdata->duration==12) echo "selected" ?>>12</option>
                      
                       </select>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">End Date:</label>
                      <div class="calendar col-md-8 p-0">
                        <input type="text" name="birthday" class="form-control"  value="<?php echo date("m/d/y",$Batchdata->end_date);?>" id="end_date"/>
                        <i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Select Role:</label>
                      <select class="form-control col-md-8" id="role_id" disabled>
                        <option value="1" <?php if($Batchdata->role==1) echo "selected" ?>>Teacher</option>
                         <option value="2" <?php if($Batchdata->role==2) echo "selected" ?>>School Admin</option>
                         <option value="3" <?php if($Batchdata->role==3) echo "selected" ?>>Student</option>
                       </select>
                    </div>
                  </form>     
                 </div>
               </div>
               <div class="row mt-4">
                  <div class="col-md-12">
                     <a href="#" class="button" onclick="editaccess()">Save</a>
                     <a href="<?php echo $CFG->wwwroot;?>/local/accesscode/acesscodebatchlist.php" class="button">Cancel</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
$(function() {
   // $('#course_name').prop('disabled', true);
   
  $("#access_type").change(function(){
    var acctype=$("#access_type").val();
    if(acctype==2){
      $("#school_name").attr('disabled', true);
    }
    else{
      $("#school_name").attr('disabled', false);
    }
   
  });
  $("#school_name").change(function(){
     var schooliid=$("#school_name").val();
     // alert(schoolid);
      $.ajax({
        type:"POST",
        url:"getcourses.php",
        async:false,
        dataType:"json",
        data:{
          schooliid:schooliid
        },
        success:function(json){
            if(json.success){
              $("#course_name").html(json.html);
              // alert(json.msg);
            }
        }

      });
  });
  var date=new Date();
var year=date.getFullYear(); //get year
var month=date.getMonth(); //get month
var da=date.getDate(); //get month
  $('input[name="birthday"]').daterangepicker({
          autoUpdateInput: false,
drops: 'up',
    singleDatePicker: true,
    showDropdowns: true,
    changeYear: true,
        minDate: new Date(year, month, da),
        maxDate: new Date('2050', month, '01'),
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
  }).on("apply.daterangepicker", function (e, picker) {
        picker.element.val(picker.startDate.format(picker.locale.format));
    });
});
</script>
<script>
  function editaccess(){
    // var no_ofcodes=$("#noofcode").val();
    var batch_name=$("#batch_name").val();
    // var access_type=$("#access_type").val();
    // var school_id=$("#school_name").val();
    // var course_id=$("#course_name").val();
    // var code_pref=$("#code_pref").val();
    // var code_suff=$("#code_suff").val();
    // var code_length=$("#code_length").val();
    var code_duration=$("#code_duration").val();
    var end_date=$("#end_date").val();
    
    var batchid=$("#batchval").val();
    var originalbatch=$("#batchoriginal").val();
    // var role_id=$("#role_id").val();
    // var excludeval=$("#excludeval").val();
    // var digitval='';
    // var upperval='';
    // var specialval='';
    // if ($('#digitval').is(":checked"))
    //  {  
    //     digitval='yes';
    //  }
    //  if ($('#upperval').is(":checked"))
    //  {  
    //     upperval='yes';
    //  }
    //   if ($('#specialval').is(":checked"))
    //  {  
    //     specialval='yes';
    //  }
    
    
    if(batch_name==''||code_duration==''||end_date==''){
    
      
      alert("please enter all the feilds");
     
      
    }

    else{
      
        $.ajax({
        type:"POST",
        url:"updatebatch.php",
        async:false,
        dataType:"json",
        data:{
          batch_name:batch_name,code_duration:code_duration,end_date:end_date,batchid:batchid,originalbatch:originalbatch
        },
        success:function(json){
            if(json.success){
              window.location.href="acesscodebatchlist.php";
              alert(json.msg);
            }
        }

      });
      
      
    }

  }
</script> 

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $(".select").select2();
});
</script>  
 




   </body>
</html>
<?php  echo $OUTPUT->footer();?>