<?php 
require_once('../../config.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Update License');
$PAGE->set_heading('Edit License Details');
global $DB,$USER;
if(isloggedin()){
$coursedata = $DB->get_records_sql("select * from {course}");
$schooldata = $DB->get_records_sql("select * from {school}");
echo $OUTPUT->header();
// UPDATE CODE IN THIS FORM
                    $id =$_GET['id'];
                    $lis = $DB->get_record_sql("select * from {liscence} where id ='$id'");
                    ?>
<head>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />




<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
  .box-shadow{
         box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
         padding: 0px 20px 20px;
         border-radius: 8px;
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
          .heading-row{  background: #000;
         color: #fff;
         border: 2px solid #ffe500;
         padding: 8px 0px;
         border-radius: 8px;}
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
         .form-control:focus{
           border:1px solid #8f959e !important;
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
.form-control:disabled, .form-control[readonly]{
  background:inherit !important;
}
#myInput {
  position: relative;
}



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
         body{background: #f7f7f7;}
         .heading-row{  background: #000;
         color: #fff;
         border: 2px solid #ffe500;
         padding: 8px 0px;
         border-radius: 8px;
     
        }
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
         ul{
            list-style: none;
            padding-left: 15px;
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
         ul li a{
            color: #000;
            text-decoration: none !important;
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
.form-control:disabled, .form-control[readonly]{
  background:inherit !important;
}
		.ul{list-style: none; margin: 0; padding: 0; border: 1px solid #ced4da;}
		.ul li:hover{
			background: #000;
			color: #fff;
		}
		/*.div{
			width: 177px;
		}*/
		.ul{display: none;}
		.span{
			  background: red;
  color: #fff;
  padding: 15px;
  margin: 0px 10px;
		}
		.span{
			  background: #000;
  color: #fff;
  padding: 10px 20px;
  margin: 0px 10px;
		}

.test {
  margin: 20px 0px;
  }

		#myInput {
  position: relative;
}
.ul {
   position: absolute;
  width: 221px;
  height: auto;
  background: #fff;

  z-index: 999 !important;
}
.span{
	position: relative;
}
.span::before{
	position: absolute;
	content: "\f00d";
	  font: normal normal normal 14px/1 FontAwesome;
	top: 12px;
	left: 5px;
}
.span:hover::before{
	cursor: pointer;
}


    </style>
    
<script>
   $(document).ready(function(){
      $("#myInput").keyup(function(){
      var course =$("#myInput").val();
      if(course != ''){
         $.ajax({
            
            url:"coursefilterkey.php",
            type:"GET",
            
            data:{
               course:course
            },
            dataType : "JSON",
            
            async:false,
            success:function(data){
               if(data.action){
                  alert(data.alert);
               }
                else{
                  alert(data);
                  window.location.href='liscencelist.php';
                }
                
            }
    });
      }
   });
   });

</script>
                    
      </head>
                   <body>
      <div class="container">
         <div class="row mt-4">
            <div class="col-md-12 m-auto box-shadow bg-white">
               <div class="row mb-4 heading-row">
                  <div class="col-md-12">
                     <h5 class="mb-0">Edit License Details</h5>
                  </div>
               </div>
               <div class="row" style="padding: 20px;">
                 <div class="col-md-12">
                    <form>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License Identifier:</label>
                      <input type="hidden" value="<?php echo $id;?>" id="id"/>
                      <input type="text" class="form-control col-md-8" placeholder="" id="identifier1" value="<?php echo $lis->identifier; ?>"  required>
                      <input type="hidden" id="edit" value="<?php echo $_GET['edit']; ?>">
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License Start Date:</label>
                      <div class="calendar col-md-8 p-0">
                      <input type="text" class="form-control abc " readOnly   value="<?php echo date("d-m-Y",$lis->startdate); ?>" id="startdate1" required/>
                      <i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div>

                    
                   <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License End Date:</label>
                      <div class="calendar col-md-8 p-0">
                      <input type="text" class="form-control end" value="<?php echo date("d-m-Y",$lis->enddate); ?>" id="enddate1" required/>
                      
                      <i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div>
                    <!-- <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Course Cut of Date:</label>
                      <div class="calendar col-md-8 p-0">
                      <input type="text" class="form-control abc" readOnly value="< ?php  echo date("d-m-Y",$lis->cutoffdate); ?>" id="coutoffdate1" required/>
                      <i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Licence is Valid for(days):</label>
                      <input type="text" class="form-control col-md-8" placeholder="" id="validity1" value=" < ?php echo $lis->validity; ?>" required>
                    </div>  --> 
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Number of Licenses to Allocate:</label>
                      <input type="text" class="form-control col-md-8" placeholder="" id="liscencecount1" value="<?php echo $lis->liscencecount; ?>" required>

                    </div>
                    <div class="form-group row mb-0">
                      <label for="email" class="col-md-4 p-0">Select a School for License:</label>
                      <select id="schoolname1" style="width:200px;" class="operator"> 
                      <option value="">Select School</option>
         <?php
         foreach($schooldata as $sd){ 
           
            ?>
            <?php if($sd->name == $lis->schoolname){ ?>
               <option value="<?php echo $sd->id; ?>" selected><?php echo $sd->name; ?></option> 
               <?php } else{?>

                  <option value="<?php echo $sd->id; ?>"><?php echo $sd->name; ?></option>
               <?php 
                  
               } ?>
            <?php } ?>

         
         
  </select>
                    </div>
                    <div class="row">
                     <div class="col-md-4"></div>
                     <div class="col-md-6 pl-0 test1">
                        <div class="my-3">
                        <?php 
  $licensedata = $DB->get_records_sql("select * from {liscence} where id='$id'");
  foreach($licensedata as $li){
   $schid = $li->schoolid;
   $iden = $li->identifier;
   $datanew = $DB->get_records_sql("select * from {school_courses_contain} where identifier='$iden' and schoolid='$schid'");
   foreach($datanew as $dat){

      $schoolid = intval($dat->schoolid);
      // $courseid = intval($li->courseid);

      $courseid = $dat->courseid;
      
      $coursename = $DB->get_record_sql("select * from {course} where id='$courseid'");
      ?>
<!-- <li class="list" data-value="<?php echo $coursename->id; ?>"><?php echo $coursename->fullname; ?></li> -->
<span class="span ml-0" data-value="<?php echo $coursename->id; ?>"><?php echo $coursename->fullname; ?>
      <input type="hidden" value="<?php echo $coursename->id; ?>" class="courseselected"></input>
</span>
<?php
     }
  }
  ?>
                        </div>

                     </div>
                     <div class="col-md-2"></div>
                    </div>
                    
                    <div class="row hide">
                      <div class="col-md-4"></div>
                      <div class="col-md-8 ml-auto pl-0">
                        
                      	<div class="test">

                        

                        </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Select a Course for License:</label>
                      <!-- <select id="course1" style="width:200px;" class="operator"> 
                      <option value="">Select Course</option>
      <?php 
      foreach($coursedata as $cd){ ?>
      <?php if($cd->fullname == $lis->course){ ?>
            <option value="<?php echo $cd->id; ?>" selected><?php echo $cd->fullname; ?></option> 
            <?php }else{ ?>
               <option value="<?php echo $cd->id; ?>"><?php echo $cd->fullname; ?></option>
            <?php } ?>
     <?php }
      ?>
  </select> -->
  <div class="div">
		
	<input type="text" name="" class="form-control" id="myInput" placeholder="Select Course">
   <section id="section1">
   
	<ul role="option" class="ul" id="coursedata1">
  <!--edit-->
  
  <!--edit-->
  <!-- <?php 
      foreach($coursedata as $cd){ 
         
         ?>
      
      <li class="list" data-value="<?php echo $cd->id; ?>"><?php echo $cd->fullname; ?></li>
            
     <?php }
      ?> -->
</ul>
</section>
                    </div>
                    </div>
                    <div class="row mt-4">
                  <div class="col-md-12">
                     <button type="button" class="button" id="update">Update License</button>
                     <a style="color:white;" href="<?php echo $CFG->wwwroot.'/local/createliscence/liscencelist.php'; ?>" ><button type="button" class="button">Cancel</button></a>
                  </div>
               </div>
                  </form> 
                  </div>
               </div>
               
            </div>
         </div>
      </div>
                   
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

      <script>
          var cars = [];
          var newarray = [];
         $(".ul .list").click(function(){
     
     var val = $(this).attr('data-value');
      cars.push(val);
     console.log(cars);
   });
   $(".span input").each(function(){
      var val1 = $(this).val();
      cars.push(val1);
          });


   
         function isNaN(x) {
   return x !== x;
};
isNaN(NaN);//true
// var v ='q1';
// let v1 = Number(v);
// if(isNaN(v1) == true){
// alert("string");
// }
$(function() {
  $('.end').daterangepicker({
    autoUpdateInput: false,
    drops: 'up',
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),11),
    locale: {
            format: 'DD-MM-YYYY' // this one too
    },
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
  }).on("apply.daterangepicker", function (e, picker) {
        picker.element.val(picker.startDate.format(picker.locale.format));
    });
});


$(function() {
  $('.abc').daterangepicker({
    autoUpdateInput: false,
    drops: 'up',
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),11),
    locale: {
            format: 'DD/MM/YYYY' // this one too
    },
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
  }).on("apply.daterangepicker", function (e, picker) {
        picker.element.val(picker.startDate.format(picker.locale.format));
    });
    
}); 




//code here

$(document).ready(function(){
 
    $("#create").click(function(){
        
        var identifier = $("#identifier").val();
        var start = $("#startdate").val();
        var end = $("#enddate").val();
        var cutoff = $("#coutoffdate").val();
        var validity = $("#validity").val();
        var liscencecount = $("#liscencecount").val();
      //   var course = $("#course").val();
      var course = cars;
        var schoolname = $("#schoolname").val();

        if(identifier == '' || start == '' || end == '' || cutoff == '' || validity == '' || liscencecount == '' || course == '' || schoolname == ''){
         alert('Please fill all the fields !');
         
         }
      
         else{

            let v1 = Number(validity);
       let l1 = Number(liscencecount);
       if(isNaN(v1) == true){
         alert("Please Enter Correct Values for Validity!");
         }
      else if(isNaN(l1) == true){
         alert("Please Enter Correct Values for Number of Liscence!");
      }
         else{
                 $.ajax({
            
            url:"liscenceprocess.php",
            type:"GET",
            
            data:{
                identifier:identifier,start:start,end:end,cutoff:cutoff,validity:validity,liscencecount:liscencecount,course:course,schoolname:schoolname
            },
            dataType : "JSON",
            
            async:false,
            success:function(data){
               if(data.action){
                  alert(data.alert);
               }
                else{
                  alert(data);
                  window.location.href='liscencelist.php';
                }
                
            }
    });
   }

         }
 
   
        
    });

    $("#update").click(function(){
       
        var id = $("#id").val();
        var identifier1 = $("#identifier1").val();
        var start1 = $("#startdate1").val();
        var end1 = $("#enddate1").val();
        var cutoff1 = $("#coutoffdate1").val();
        var validity1 = $("#validity1").val();
        var liscencecount1 = $("#liscencecount1").val();
        var carslength = cars.length;
      //   alert(end1);
      //   alert(newarr);die();
      
      //   alert(newarray);
      //   var course1 = $("#course1").val();
      var course1 = cars;

      // $(".test .span").click(function(){
      //    alert(234);
      // });

      // alert(course1);die();



        var schoolname1 = $("#schoolname1").val();
        var edit = $("#edit").val();


            //DELETING COURSE FROM HERE

            if(newarray.length != 0){
        var delcourse = newarray;
        var schid = schoolname1;
         

         $.ajax({
            
            url:"deletecourse.php",
            type:"GET",
            
            data:{
               id:id,delcourse:delcourse,schid:schid
            },
            dataType : "JSON",
            
            async:false,
            success:function(data){
               if(data.action){
                  alert(data.alert);
               }
               else{
                  alert(data);
                  window.location.href='liscencelist.php';
                }
                
            }
    });





        }
        else{
            //DELETING COURSE FROM HERE


        
        if(identifier1 == '' || start1 == '' || end1 == '' || cutoff1 == '' || validity1 == '' || liscencecount1 == '' || course1 == '' || schoolname1 == ''){
         alert('Please fill all the fields !');
         }
         else{
            
            let v11 = Number(validity1);
       let l11 = Number(liscencecount1);
      //  if(isNaN(v11) == true){
      //    alert("Please Enter Correct Values for Validity!");
      //    }
      if(isNaN(l11) == true){
         alert("Please Enter Correct Values for Number of Liscence!");
      }

      else{
       
            $.ajax({
            
            url:"liscenceupdate.php",
            type:"GET",
            
            data:{
                id:id,identifier1:identifier1,start1:start1,end1:end1,cutoff1:cutoff1,validity1:validity1,liscencecount1:liscencecount1,course1:course1,schoolname1:schoolname1,edit:edit
            },
            dataType : "JSON",
            
            async:false,
            success:function(data){
               if(data.action){
                  alert(data.alert);
               }
               else{
                  alert(data);
                  window.location.href='liscencelist.php';
                }
                
            }
    });

   }
         }

      }
        
    });
    $("#schoolname1").change(function(){
     
     var id = $("#schoolname1").val();
     if(id != ''){
      $.ajax({
         
         url:"coursefilter.php",
         type:"GET",
         
         data:{
             id:id
         },
         dataType : "JSON",
         
         async:false,
         success:function(data){
            $("#course1").html(data.html);
             
         }
 });
     }

     
 });
});
</script>
<script >
    $(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $("#course1").select2();
   $("#schoolname1").select2();
});
  </script>
  <script>
    $(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $("select").select2();
});
  </script>
  <script>

         $(document).ready(function(){
            var li = '';
         $(".hide").css("display","none");
          $(document).on("click",".ul li",function(){
            $(".hide").css("display","block");
          	var text = $(this).text();
            var dataval=$(this).attr("data-value");
            $(".my-3").append("<input type='hidden' value="+dataval+" class='courseselected'>");
          	$(".test").append("<span class='span ml-0' data-value="+dataval+">"+text+"</span>");

            $(this).remove();
            li = $(this).attr("data-value");
            
          	 
          });
         
           $("#myInput").on("keyup", function() {
             var value = $(this).val().toLowerCase();
             $(".ul li").filter(function() {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
             });
           });
         
          	$("#myInput").click(function(event){
             
             var selectedcourses=[];
              $(".courseselected").each(function() {
            
             selectedcourses.push($(this).val());
            });

              
               var id = $("#schoolname1").val();
               var courses = cars;
               
          		$(".ul").css("display","block");
               //  $(".test1 .span").hide();
                
                $.ajax({
         
         url:"coursefilter.php",
         type:"GET",
         
         data:{
             id:id,courses:courses,selectedcourses:selectedcourses
         },
         dataType : "JSON",
         
         async:false,
         success:function(data){
            
            $("#section1").html(data.html);
            $(".ul").css("display","block"); 
         }
 });
          		event.stopPropagation();
               
          	});
         
         $("body").click(function(){
          		$(".ul").css("display","none");
          	});
         
         $(".test").on("click", ".span", function(){
            var value11 = $(this).val();
            cars.pop(value11);
          
             $(this).remove();

             $(".ul").append("<li class='list' data-value='"+li+"'>"+$(this).text()+"</li>");
             // $(".ul li").append($(this).text());
             // console.log($(this).text());
         }); 	
         $(".test1").on("click", ".span", function(){
            var value11 = $(this).attr("data-value");
            var index = cars.indexOf(value11);
            // alert(cars[index]);die();
            cars.splice(index,1);
            // alert(cars);die();
            // var n = cars.pop(value11);
            newarray.push(value11);
            
            // var newarray = [];
            // newarray.push(n);
         //   alert(newarray);die();
             $(this).remove();
             $(".ul").append("<li class='list' data-value='"+li+"'>"+$(this).text()+"</li>");
             // $(".ul li").append($(this).text());
             // console.log($(this).text());
         }); 
         });

      </script>
      <script>
         $(document).ready(function(){
            $("#schoolname1").change(function(){
     $(".test1").hide();
     var id = $("#schoolname1").val();
     
     if(id != ''){
      $.ajax({
         
         url:"coursefilter.php",
         type:"GET",
         
         data:{
             id:id
         },
         dataType : "JSON",
         
         async:false,
         success:function(data){
            
            $("#section1").html(data.html);
             
         }
 });
     }

     
 });
         });
         </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
   </body>
   <?php echo $OUTPUT->footer();
   
   
   ?>

<?php  }
else{
      $url = $CFG->wwwroot.'/login/index.php';
      redirect($url);
   }
   ?>