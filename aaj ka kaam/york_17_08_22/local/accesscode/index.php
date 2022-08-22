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
$PAGE->set_heading('Access Code');
require_login();
if(!isloggedin()){

  return redirect(new moodle_url('/login'));
}

 GLOBAL $USER,$DB;
 if($USER->id!=2){
  return redirect(new moodle_url('/my'));
 }
$school = $DB->get_records_sql("SELECT * FROM {school} WHERE visible=1");
$courses=$DB->get_records_sql("SELECT * FROM {course}");
// echo print_r($school);
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
         .err2{
          color: red;
        font-size: 150%;
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
         padding: 5px 0px;
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
         .form-control:disabled, .form-control[readonly]{
  background:inherit !important;
  
}
      </style>
      
   </head>
   <?php echo $OUTPUT->header();?>
   <!--<a href="acesscodelist.php">access code</a>&nbsp;&nbsp;
   <a href="acesscodebatchlist.php">status</a>-->
   <body>
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <div class="container">
         <div class="row mt-4">
            <div class="col-md-12 m-auto box-shadow bg-white">
               <div class="row mb-4 heading-row">
                  <div class="col-md-12">
                     <h5>Access Code</h5>
                  </div>
               </div>
               <div class="row" style="padding: 20px;">
                 <div class="col-md-12">
                    <form action="/action_page.php">
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">No. of Access Code <span class="err2">  *</span></label>
                      <select class="form-control col-md-8" id="noofcode">
                        <option value="">Enter Number of Codes </option>
                        <?php for($i=1;$i<=500;$i++){ ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?> </option>
                         <?php }?>
                       </select>
                    </div>
                    <div class="form-group row">
                      <label for="batch" class="col-md-4 p-0">Batch Name <span class="err2">  *</span></label>
                      <input type="text" class="form-control col-md-8" placeholder="Batch Name" id="batch_name">
                    </div>
                   <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Access Type <span class="err2">  *</span></label>
                      <select class="form-control col-md-8" id="access_type">
                        <option value="1">School</option>
                         <option value="2">Individual</option>
                        
                       </select>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">School Name <span class="err2">  *</span></label>
                      <select class="form-control col-md-8 select" id="school_name" >
                        <option value="0"> Select School</option>
                        <?php foreach ($school as $sch) {  ?>   
                         
                        <option value="<?php echo $sch->id ?>"><?php echo $sch->name ?></option>
                        <? }?>
                       </select>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Course Name <span class="err2">  *</span></label>
                      <select class="form-control col-md-8 select" id="course_name" disabled>
                        <option value=""> Select Course</option>
                         <?php foreach ($courses as $co) {  ?>   
                         
                        <option value="<?php echo $co->id ?>"><?php echo $co->fullname ?></option>
                        <? }?>
                       </select>
                    </div>
                    <div class="form-group row">
                     <div class="col-md-4 pl-0">
                      <label for="email" >Code Prefix:</label>
                      <input type="email" class="form-control " placeholder="" id="code_pref">
                     </div>
                     <div class="col-md-4 px-0">
                      <label for="email" class="">Code Suffix:</label>
                      <input type="email" class="form-control" placeholder="" id="code_suff">
                   </div>
                   
                   <div class="col-md-4 pr-0">
                      <label for="email" class="">Code Length:</label>
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

                       <!-- CHANGES HERE -->
                       <input type="text" class="form-control col-md-8" placeholder="" id="code_length">
                       <!-- CHANGES HERE -->

                     </div>
                    </div>

                     <div class="form-group row">
                     <div class="col-md-4 pl-0 d-flex">
                    <input type="checkbox" class="mr-2" id="digitval">
                      <label for="email" class="mb-0">Digits</label>
                     </div>
                     <div class="col-md-4 pl-0 d-flex">
                      <input type="checkbox" class="mr-2" id="upperval">
                      <label for="email" class="mb-0" >Uppercase</label>
                     </div>
                   
                   <div class="col-md-4 pl-0 d-flex">
                      <input type="checkbox" class="mr-2" id="specialval">
                      <label for="email" class="mb-0">Special Characters</label>
                     </div>
                    </div>

                    <div class="form-group row">
                      <label for="batch" class="col-md-4 p-0">Exclude Characters </label>
                      <input type="text" class="form-control col-md-8" placeholder="Exclude Characters" id="excludeval">
                    </div>


                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Code Validation Duration (Months) <span class="err2">  *</span></label>
                     <!-- <select class="form-control col-md-8" id="code_duration">
                        <option value=""> Select Duration</option>

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
                         <option value="11">11</option>
                         <option value="12">12</option>
                      
                       </select> -->
                       <!-- CHANGES HERE -->
                      <input type="text" class="form-control col-md-8" placeholder="Select Duration" id="code_duration">

                       <!-- CHANGES HERE -->
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">End Date <span class="err2">  *</span></label>
                      <div class="calendar col-md-8 p-0">
                      <input type="text" name="birthday" class="form-control end" readonly value="" id="end_date"/>
                      <i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Select Role <span class="err2">  *</span></label>
                      <select class="form-control col-md-8" id="role_id">
                        <option value="1">Teacher</option>
                         
                         <option value="3">Student</option>
                       </select>
                    </div>
                  </form>     
                 </div>
               </div>
               <div class="row mt-4">
                  <div class="col-md-12">
                     <a href="#" class="button" onclick="addaccess()">Save</a>
                     <a href="<?php echo $CFG->wwwroot;?>" class="button">Cancel</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
$(function() {
   
  $("#access_type").change(function(){
    var acctype=$("#access_type").val();
    if(acctype==2){
      var pid=2;
      
     $("#school_name").val("0");

       $("#school_name").attr('disabled', true);
      $.ajax({
          type:"POST",  
          url:"getrepositorycourses.php",
          dataType:"json",
          async:false,
          data:{pid:pid},
          success:function(json){
            if(json.success){
              $("#course_name").html(json.html);
              $("#course_name").prop('disabled', false);
            }
          }


      });



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
              $("#course_name").prop('disabled', false);
            }
        }

      });
  });
  var date=new Date();
var year=date.getFullYear(); //get year
var month=date.getMonth(); //get month
var da=date.getDate(); //get month
  $('.end').daterangepicker({
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
  function addaccess(){
    var no_ofcodes=$("#noofcode").val();
    var batch_name=$("#batch_name").val();
    var access_type=$("#access_type").val();
    var school_id=$("#school_name").val();
    var course_id=$("#course_name").val();
    var code_pref=$("#code_pref").val();
    var code_suff=$("#code_suff").val();
    var code_length=$("#code_length").val();
    var code_duration=$("#code_duration").val();
    var end_date=$("#end_date").val();
    var role_id=$("#role_id").val();
    var excludeval=$("#excludeval").val();
    var digitval='';
    var upperval='';
    var specialval='';
    if ($('#digitval').is(":checked"))
     {  
        digitval='yes';
     }
     if ($('#upperval').is(":checked"))
     {  
        upperval='yes';
     }
      if ($('#specialval').is(":checked"))
     {  
        specialval='yes';
     }
    
    
    if(no_ofcodes==''||batch_name==''||access_type==''||course_id=='' || code_length=='' || role_id==''){
    
     
      
        alert("Please enter all the Fields!");
      
      
     
      
    }
    else if(end_date == '' && code_duration == ''){
      alert("Please enter all the Fields!");
    }

    else{
      
      if(access_type==1 && school_id=='0'){
      alert("Please enter all the Fields!");
      }
      // CHANGES FROM HERE
      let code_len = Number(code_length);
      let code_du = Number(code_duration);

      if(isNaN(code_len) == true){
        
         alert("Please Enter Correct Values for Code Length!");
         }
      else if(isNaN(code_du) == true){
         alert("Please Enter Correct Values for Code Duration!");
         }
      // CHANGES FROM HERE
      else{
        $.ajax({
        type:"POST",
        url:"addaccesscode.php",
        async:false,
        dataType:"json",
        data:{
          no_ofcodes:no_ofcodes,batch_name:batch_name,access_type:access_type,school_id:school_id,course_id:course_id,code_pref:code_pref,code_suff:code_suff,code_length:code_length,code_duration:code_duration,end_date:end_date,role_id:role_id,digitval:digitval,upperval:upperval,specialval:specialval,excludeval:excludeval
        },
        success:function(json){
            if(json.success){
              if(json.action){
                alert(json.msg);
              }
              else{
                window.location.href="acesscodebatchlist.php";
              alert(json.msg);
              }
              
            }
        }

      });
      }
      
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
<script>
    function isNaN(x){
      return x !== x;
    };
    isNaN(NaN);//true
      </script>




   </body>
</html>
<?php  echo $OUTPUT->footer();?>