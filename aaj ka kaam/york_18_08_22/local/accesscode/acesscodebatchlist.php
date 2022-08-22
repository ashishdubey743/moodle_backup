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
$PAGE->set_heading('Access Code Batchlist');
require_login();
if(!isloggedin()){

  return redirect(new moodle_url('/login'));
}
 GLOBAL $USER,$DB;
 if($USER->id!=2){
  return redirect(new moodle_url('/my'));
 }
$acesscodebatch = $DB->get_records_sql("SELECT {access_code}.*,{course}.fullname FROM {access_code} LEFT JOIN {course} on  {access_code}.course_id={course}.id ORDER BY {access_code}.id desc");
$schooldata = $DB->get_records_sql("select * from {school} WHERE visible=1");

$PAGE->set_pagelayout('standard');


  //--moodle pagination--

 $total_rows=sizeof($acesscodebatch);

$perpage      = optional_param('perpage', 10, PARAM_INT);
$page         = optional_param('page', 0, PARAM_INT);



$start = $page * $perpage;
if ($start > count($acesscodebatch)) {
    $page = 0;
    $start = 0;
}
$acesscodebatch = array_slice($acesscodebatch, $start, $perpage, true);
$baseurl = new moodle_url('/local/accesscode/acesscodebatchlist.php');



  //--------------------  
$jsondata=json_encode($acesscodebatch);

$count=0;
if($_GET['page']){
	$count=10*$_GET['page'];
}

function getno_used_code($batchid){
  $res=0;
  global $DB;
  $no_of_codes=$DB->get_records_sql("SELECT * FROM {access_code_data} WHERE batch_id=$batchid and used=1");
  $res=count($no_of_codes);
  return $res;
}

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Id Card</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
     
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
      <style>
         .box-shadow{
         box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
         padding: 20px;
         border-radius: 8px;
         }
         body{background: #f7f7f7;}
         td a{
         padding: 6px 32px;
         color: #fff;
         border-radius: 8px;
         white-space: nowrap;
         }
         td a:hover{
         color: #fff;
         text-decoration: none;
         }
         .button{
         background: #000;
         padding: 8px 30px;
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
         .heading-row {
  background: #000;
  color: #fff;
  border: 2px solid #ffe500;
  padding: 8px 0px;
  border-radius: 8px;
         }
              .select2-container--default{
            width:100% !important;
            
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
      </style>
   </head>
   <?php echo $OUTPUT->header(); ?>
   <body>
      <div class="container-fluid mt-5">

      <div class="row">
         <div class="col-md-12">
            <div class="box-shadow">
              <div class="row mb-4 heading-row">
                  <div class="col-md-12">
                     <h5 class="mb-0">Access Code Batchlist</h5>
                  </div>
               </div>
        <div class="row mb-3 py-3">
         <div class="col-md-5 d-flex">
            <label for="email" class="align-self-center" style="width:50%;"><b>Select School:</b></label>
           <!--  <input type="text" name="team" id="schname" list="school_list" autocomplete="off" placeholder="Select School" style="width:100%;"> -->
            <!-- <datalist id="school_list"> -->
            <select class="form-control select" id="schoolfilter">
               <option value="Select School">Select School</option>
               <?php foreach($schooldata as $sd){ ?>
                  <option  value="<?php echo $sd->id; ?>" ><?php echo $sd->name; ?></option>
              <?php } ?>
               
             </select> 
            <!-- </datalist> -->




<!-- etc... -->

         </div>
         <div class="col-md-7 align-self-center">
            <a href="#" class="button" id="filterdata">Filter</a>
            <a href="acesscodebatchlist.php" class="button">Clear Filter</a>
            <a href="index.php" class="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
Create Access Code</a>
         </div>
      </div>
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr class="bg-grey">
                        <th><input type="checkbox" name="" id="checkall"></th>
                        <th>S.No</th>
                        <th>Batch Name</th>
                        <th>School name</th>
                        <th>Course Name</th>
                        <th> End Date</th>
                        <th>Total</th>
                        <th>Claimed</th>
                        <th>Unclaimed</th>
                        <th style="text-align:center;">Action</th>
                     </tr>
                  </thead>
                  <tbody id="tbody">
                  	<?php foreach ($acesscodebatch as $key=>$value) {
                  		$count++;
                        $sid=$value->school_id;
                        $schoolname=$DB->get_record_sql("SELECT name FROM {school} WHERE id=$sid");
                       if($schoolname){
                        $sname=$schoolname->name;
                       }
                       else{
                        $sname="individual";
                       }
                        $status='';
                        if($value->status==0){
                          $status="(disabled)";

                        }
                        ?>
                       
                  	
                  	
                     <tr>
                        <td><input type="checkbox" name="" class="chck" data-value="<?php echo $value->id;?>"></td>
                        <td><?php echo $count?></td>
                        <td><?php echo $value->batch.' '.$status?></td>
                        <td><?php echo $sname?></td>
                        <td><?php echo $value->fullname?></td>
                        <td><?php echo date("m/d/y",$value->end_date)?></td>
                        <td><?php echo $value->no_of_codes?></td>
                        <td><?php echo getno_used_code($value->id)?></td>
                        <td><?php echo $value->no_of_codes-getno_used_code($value->id)?></td>
                        <td style="width: 175px;"><a href="editaccesscode.php?bid=<?php echo $value->id ?>" class="" style="padding:6px 10px;"><i class="fa fa-pencil" title="Edit" aria-hidden="true" style="color:#000;" id="yui_3_17_2_1_1657800997774_21"></i></a><a href="exportdata.php?id=<?php echo $value->id?>" class="" style="padding:6px 10px;"><i class="fa fa-download" title="Export" aria-hidden="true" style="color:#000;" id="yui_3_17_2_1_1657800997774_21"></i></a>
                        <?php if($value->status == 1) {?>
                        <a href="deactivateprocess.php?id=<?php echo $value->id; ?>&deactivate=1" class="" data-value="<?php echo $value->id; ?>" style="padding:6px 10px;"><i class="fa fa-eye" title="Disable" aria-hidden="true" style="color:#000;" id="yui_3_17_2_1_1657800997774_21"></i></a>
                        <?php }
                        else{
                           ?>
                           <a href="deactivateprocess.php?id=<?php echo $value->id; ?>" class="" data-value="<?php echo $value->id; ?>"   style="padding:6px 10px;"><i class="fa fa-eye-slash" title="Enable" aria-hidden="true" style="color:#000;" id="yui_3_17_2_1_1657800997774_21"></i></a>
                           <?php
                        }
                        ?>
                         <a href="batch-acesscodelist.php?id=<?php echo $value->id; ?>" class="" style="padding:6px 10px;"><i class="fa fa-list-alt" title="List" aria-hidden="true" style="color:#000;" id="yui_3_17_2_1_1657800997774_21"></i></a></td>
                     </tr>
                    <?php }?> 
                     
                  </tbody>
               </table>
               <div style="text-align: end;"><a href="#" class="button" style="padding: 8px 54px; margin-right: 12px;" onclick="Disablebulk();">Bulk Disable</a><a href="#" class="button" style="padding: 8px 54px; margin-right: 12px;" onclick="Enablebulk();">Bulk Enable</a></div>
            </div>
         </div>
      </div>
    </div>
   </body>
</html>
<script>
function Disablebulk(){
  
 var checkedValue = $('.chck:checked').val();
 
var checkedValue = []; 
var inputElements = document.querySelectorAll('.chck');
inputElements.forEach(function(item, index){
  if(item.checked){
   var dataval=item.getAttribute("data-value");
   checkedValue.push(dataval);
  }
});
if(checkedValue.length==0){
   alert('please make selection');
  

   
}

else{
   let isExecuted = confirm("Are you Sure to Disable Batch ?");
   if(isExecuted){

    $.ajax({
        type:"GET",
        url:"disablecodestatus.php",
        async:false,
        dataType:"json",
        data:{
          checkedValue:checkedValue
        },
        success:function(json){
            if(json.success){
              window.location.reload();
              alert(json.msg);

            }
        }

      });
   }
    

}

   
}

// Bulk Enable


function Enablebulk(){
  
  var checkedValue = $('.chck:checked').val();
  
 var checkedValue = []; 
 var inputElements = document.querySelectorAll('.chck');
 inputElements.forEach(function(item, index){
   if(item.checked){
    var dataval=item.getAttribute("data-value");
    checkedValue.push(dataval);
   }
 });
 if(checkedValue.length==0){
    alert('please make selection');
   
 
    
 }
 
 else{
    let isExecuted = confirm("Are you Sure to Enable Batch ?");
    if(isExecuted){
      var en = 1;
     $.ajax({
         type:"GET",
         url:"disablecodestatus.php",
         async:false,
         dataType:"json",
         data:{
           checkedValue:checkedValue,en:en
         },
         success:function(json){
             if(json.success){
               window.location.reload();
               alert(json.msg);
 
             }
         }
 
       });
    }
     
 
 }
 
    
 }

$("#filterdata").click(function(){
   var schlid=$("#schoolfilter").val();
   //
   // var shownVal = document.getElementById("schname").value;
   // var schlid = document.querySelector("#school_list option[value='"+shownVal+"']").dataset.value;


   //
   // alert(schlid);
    $.ajax({
        type:"POST",
        url:"filterbatch.php",
        async:false,
        dataType:"json",
        data:{
          schlid:schlid
        },
        success:function(json){
            if(json.success){
              // alert(json.msg);
             $("#tbody").html(json.html);
             $(".pagination").hide();
            }
        }

      });
})

</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $(".select").select2();
});
</script>   
<?php echo $OUTPUT->paging_bar($total_rows, $page, $perpage, $baseurl); ?>

<!-- alert for msg -->
<?php 
if(isset($_GET['msg'])){
if($_GET['msg'] == 0){
?>
<script>
    alert('Batch Deactivated Successfully!');
    </script>
<?php
}
else{
    ?>
<script>
    alert('Batch Activated Successfully!');
    </script>
    <?php
}
}
?>
<script>
   $("#checkall").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

});
   </script>

<?php  echo $OUTPUT->footer();?>