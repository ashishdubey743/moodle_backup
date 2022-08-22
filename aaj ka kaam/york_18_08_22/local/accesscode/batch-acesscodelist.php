<?php
require_once('../../config.php');
require_once('lib.php');
$PAGE->set_heading('Batch Access Code List');
require_login();
if(!isloggedin()){

  return redirect(new moodle_url('/login'));
}
 GLOBAL $USER,$DB;
 $id =$_GET['id'];
 $codedata=$DB->get_records_sql("select acd.* from {access_code_data} acd left join {access_code} ac on ac.id = acd.batch_id where ac.id = $id");

  if(!is_siteadmin()){
 $schooladmin = $DB->get_record("school_user",array("userid"=>$USER->id));
 $codedata=$DB->get_records_sql("SELECT acd.* FROM {access_code_data} acd LEFT JOIN {access_code} ac ON acd.batch_id=ac.id WHERE school_id=$schooladmin->schoolid");
 }
 $PAGE->set_pagelayout('standard');


 // echo $OUTPUT->header();
  $count=1;
function getschoolname($bid){
  global $DB;
  $record=$DB->get_record_sql("SELECT {school}.* FROM {access_code} LEFT JOIN {school} ON {access_code}.school_id={school}.id WHERE {access_code}.id=$bid");
  return $record->name;


}
 
$pgno=$_GET["page"];
$count=($pgno*10)+1;
  //--moodle pagination--

 $total_rows=sizeof($codedata);

$perpage      = optional_param('perpage', 10, PARAM_INT);
$page         = optional_param('page', 0, PARAM_INT);



$start = $page * $perpage;
if ($start > count($codedata)) {
    $page = 0;
    $start = 0;
}
$codedata = array_slice($codedata, $start, $perpage, true);
$baseurl = new moodle_url('/local/accesscode/batch-acesscodelist.php');



  //--------------------  
?> 
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Id Card</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
      <style>
         .box-shadow{
         box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
         padding: 0px 20px 20px;
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
         padding: 10px 30px;
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
         .pagination{
           margin:50px auto 0px;
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
                     <h5 class="mb-0">Batch Access Code List</h5>
                  </div>
               </div>
                <div class="d-flex">
                  
                  
                
        </div>
         <div class="col-md-12">
            <div class="box-shadow">
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr class="bg-grey">
                        <th>S.No</th>
                        <th>Batch Name</th>
                        <th>School Name</th>
                        <th>Course Name</th>
                        <th>Access Type</th>
                        <th>Role</th>
                        <th>Date Created</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="tbdy">
                  	<?php
         foreach($codedata as $cd){
	       $batch=(int)$cd->batch_id;
	       $details=$DB->get_record_sql("SELECT {access_code}.*,{course}.fullname FROM {access_code} LEFT JOIN {course} ON {access_code}.course_id={course}.id WHERE {access_code}.id=$batch");


			if($details->acesstype==1){
				$type="school";
			}
			else{
				$type="individual";
			}
			if($details->role==1){
				$role="teacher";
			}
			else if($details->role==2){
				$role="School Admin";
			}
			else{
				$role="Student";
			} 
      //class 
      if($cd->status==1){
        $eclass='fa-eye';
      }
      else{
         $eclass='fa-eye-slash';
      }
      $usedstatus=$cd->used?"Used":"Unused";
      ?>          
                <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo $details->batch;?></td>
                        <td><?php echo getschoolname($cd->batch_id);?></td>
                        <td><?php echo $details->fullname;?></td>
                        <td><?php echo $type;?></td>
                        <td><?php echo $role;?></td>
                        <td><?php echo date("m/d/y",$details->date_created);?></td>
                        <td><?php echo $cd->accesscode;?></td>
                        <td><?php echo $usedstatus?></td>
                        <td><i class="fa <?php echo $eclass?>" aria-hidden="true" onclick=disablecode(<?php echo $cd->id?>); id="ebtn-<?php echo $cd->id ?>"></i></td>
                 </tr>
                
           <?php $count++; } ?>
                    
                  </tbody>
               </table>
            </div>
         </div>
      </div>
    </div>
   
   </body>
</html>
<script type="text/javascript">
	function disablecode(dvalue){
    $("#ebtn-"+dvalue).toggleClass("fa-eye fa-eye-slash");

		
		 $.ajax({
        type:"POST",
        url:"disablecodestatus.php",
        async:false,
        dataType:"json",
        data:{
          dvalue:dvalue,
        },
        success:function(json){
            if(json.success){
              alert(json.msg);
            }
        }

      });
	}
</script>
<script>
 
   function filtertable(){
      var vall=$("#accessfilter").val();
      var vall2=$("#myInput").val();
      var schoolid=$("#schoolid").val();
      if(vall2=='' && vall==1){
        alert("please enter batch to filter");
      }
      else if(vall2=='' && vall==2){
        alert("please enter course to filter");

      }
      else{

        $.ajax({
        type:"POST",
        url:"getaccesslist.php",
        async:false,
        dataType:"json",
        data:{
          vall:vall,vall2:vall2,schoolid:schoolid
        },
        success:function(json){
            if(json.success){
              $("#tbdy").html(json.tabledata);
              $(".pagination").hide();
            }
        }

      });
      }
      
    }
</script>  

<?php 

echo $OUTPUT->paging_bar($total_rows, $page, $perpage, $baseurl);
?>
<?php echo $OUTPUT->footer();?>