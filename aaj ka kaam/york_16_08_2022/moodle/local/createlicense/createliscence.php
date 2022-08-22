<?php 
require_once('../../config.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading('Create License');
$PAGE->set_title('Create License');
global $DB,$USER;
if(isloggedin()){
$coursedata = $DB->get_records_sql("select * from {course} limit 3");
$schooldata = $DB->get_records_sql("select * from {school} where visible=1");
$json_data = json_encode($schooldata);
$json_cdata = json_encode($coursedata);

?>


<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Create License</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
     
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
<script>
    $(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $("#coursedata").select2();
   $("#countrydata").select2();

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
         body{background: #f7f7f7;}
         .heading-row{  background: #000;
         color: #fff;
         border: 2px solid #ffe500;
         padding: 8px 0px;
         border-radius: 8px;
     
        }
        .err3{
         color: red;
        font-size: 150%;
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
   </head>

                    <?php if(!isset($_GET['id'])){

                    ?>
                    <body>
                     <?php echo $OUTPUT->header();?>
      <div class="container">
         <div class="row mt-4">
            <div class="col-md-12 m-auto box-shadow bg-white">
               <div class="row mb-4 heading-row">
                  <div class="col-md-12">
                     <h5 class="mb-0">Create License</h5>
                  </div>
               </div>
               <div class="row" style="padding: 20px;">
                 <div class="col-md-12">


                    <form>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License Identifier <span class="err3">  *</span></label>
                      
                      <input type="text" class="form-control col-md-8" placeholder="" id="identifier" >
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License Start Date <span class="err3">  *</span></label>
                      <div class="calendar col-md-8 p-0">
                        <input type="text"  class="form-control abc" readonly value="" id="startdate" />
                        <i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div>
                   <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License End Date <span class="err3">  *</span></label>
                      <div class="calendar col-md-8 p-0">
                        <input type="text"  class="form-control end" readonly value="" id="enddate" />
                        <i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div>
                    <!-- <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Course Cut-Off Date <span class="err3">  *</span></label>
                      <div class="calendar col-md-8 p-0">
                        <input type="text"  class="form-control abc" readonly value="" id="coutoffdate" />
                        <i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div> -->                                                                                                         
                    <!-- <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License is Valid for (days) <span class="err3">  *</span></label>
                      <input type="text" class="form-control col-md-8" placeholder="" id="validity" >
                    </div> -->
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Number of Licenses to Allocate <span class="err3">  *</span></label>
                      <input type="text" class="form-control col-md-8" placeholder="" id="liscencecount" >

                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Select a School for License <span class="err3">  *</span></label>
                      <select id="countrydata" style="width:200px;" class="operator"> 
         <option value="">Select School</option>
         <?php
         foreach($schooldata as $sd){ ?>
               <option value="<?php echo $sd->id; ?>"><?php echo $sd->name; ?></option> 
        <?php }
         ?>
         
         
  </select>
                      <!-- <select class="form-control col-md-8" id="course" >
                      <option value="">Select Course</option>
                        <?php foreach($coursedata as $cd){
                            ?>
                            <option value="<?php echo $cd->id; ?>" ><?php echo $cd->fullname; ?></option>
                            <?php
                        } ?>
                         
                       </select> -->
                    </div>
                    <div class="row hide">
                      <div class="col-md-4"></div>
                      <div class="col-md-8 ml-auto pl-0">
                      	<div class="test"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Select a Course for License <span class="err3">  *</span></label>
                    	<div class="div">
		<span id="myInputContainer">


      </span>
	<input type="text" name="" class="form-control" id="myInput" placeholder="Select Course" disabled>
   <section id="section1">
   
	<ul role="option" class="ul" id="coursedata1">
  
  <?php 
      foreach($coursedata as $cd){ 
         
         ?>
      
      <li class="list" data-value="<?php echo $cd->id; ?>"><?php echo $cd->fullname; ?></li>
            
     <?php }
      ?>
</ul>
</section>
                    </div>
                      </div>
                    <div class="row mt-4">
                  <div class="col-md-12">
                     <button type="button" class="button" id="create">Create License</button>
                     <a style="color:white;" href="<?php echo $CFG->wwwroot.'/my/'; ?>" ><button type="button" class="button">Cancel</button></a>
                  </div>
               </div>
                  </form>  
                  </div>
               </div>
               
            </div>
         </div>
      </div>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    </body>
                  <?php } else{
                    // UPDATE CODE IN THIS FORM
                    $id =$_GET['id'];
                    $lis = $DB->get_record_sql("select * from {liscence} where id ='$id'");
                    ?>
                   <body>
      <div class="container">
         <div class="row mt-4">
            <div class="col-md-12 m-auto box-shadow bg-white">
               <div class="row mb-4 heading-row">
                  <div class="col-md-12">
                     <h5>Update License</h5>
                  </div>
               </div>
               <div class="row" style="padding: 20px;">
                 <div class="col-md-12">
                    <form>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License identifier:</label>
                      <input type="hidden" value="<?php echo $id;?>" id="id"/>
                      <input type="text" class="form-control col-md-8" placeholder="" id="identifier1" value="<?php echo $lis->identifier; ?>"  required>
                      <input type="hidden" id="edit" value="<?php echo $_GET['edit']; ?>">
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License Start Date:</label>
                      <input type="text" class="form-control col-md-8" readonly value="<?php echo date("d-m-Y",$lis->startdate); ?>" id="startdate1" required/>
                    </div>
                   <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">License End Date:</label>
                      <input type="text" class="form-control col-md-8" readonly value="<?php $date12 = $lis->enddate; echo date("d-m-Y",$date12); ?>" id="enddate1" required/>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Course Cut of Date:</label>
                      <input type="text" class="form-control col-md-8" readonly value="<?php echo date("d-m-Y",$lis->cutoffdate); ?>" id="coutoffdate1" required/>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Licence is Valid for(days):</label>
                      <input type="text" class="form-control col-md-8" placeholder="" id="validity1" value="<?php echo $lis->validity; ?>" required>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Number of License to Allocate:</label>
                      <input type="text" class="form-control col-md-8" placeholder="" id="liscencecount1" value="<?php echo $lis->liscencecount; ?>" required>

                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Select a Course for License:</label>
                      <select class="form-control col-md-8" id="course1" required>
                      <option value="">Select Course</option>
                        <?php foreach($coursedata as $cd){
                            if($cd->fullname == $lis->course){
                            ?>
                            <option value="<?php echo $cd->id; ?>" selected><?php echo $cd->fullname; ?></option>
                            <?php }
                            else{ ?>

                            <option value="<?php echo $cd->id; ?>"><?php echo $cd->fullname; ?></option>
                                <?php 
                        } }?> 
                         
                       </select>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-md-4 p-0">Select School Name:</label>
                      <select class="form-control col-md-8" id="schoolname1" required>
                         <option value="">Select School</option>
                         <?php foreach($schooldata as $sd){
                            if($sd->name == $lis->schoolname){
                            ?>
                            <option value="<?php echo $sd->id; ?>" selected><?php echo $sd->name; ?></option>
                            <?php }
                            else{ ?>

                                <option value="<?php echo $sd->id; ?>"><?php echo $sd->name; ?></option>
                                    <?php 
                        } }?>
                        
                       </select>
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
                    <?php } ?>
             
      <script>
         var cars = [];
         $(".ul .list").click(function(){
     
     var val = $(this).attr('data-value');
      cars.push(val);
     console.log(cars);
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
  $('.abc').daterangepicker({
            autoUpdateInput: false,
drops: 'up',
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),11)
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
  }).on("apply.daterangepicker", function (e, picker) {
        picker.element.val(picker.startDate.format(picker.locale.format));
    });
});

$(function() {
  $('.end').daterangepicker({
    autoUpdateInput: false,
    drops: 'up',
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),11)
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
  }).on("apply.daterangepicker", function (e, picker) {
        picker.element.val(picker.startDate.format(picker.locale.format));
    });
});


//code here

$(document).ready(function(){
  

   $("#school_listing").keyup(function(){
      
         var listing = $("#school_listing").val();
         $.ajax({
          
          url:"schoollisting.php",
          type:"GET",
          
          data:{
            listing:listing
          },
          dataType : "JSON",
          
          async:false,
          success:function(json){
            
            // alert("text"+deact);
            //   $("#text"+deact).html(json.text);
            // alert(json.list);
              $("#countrydata").html(json.list);
            
          }
  });
      });
      $("#course_listing").keyup(function(){
      
      var listing = $("#course_listing").val();
      $.ajax({
       
       url:"courselisting.php",
       type:"GET",
       
       data:{
         listing:listing
       },
       dataType : "JSON",
       
       async:false,
       success:function(data){
         
         
           $("#coursedata11").html(data.list);
         
       }
});
   });
    
   // cars['coursid'] = '';
   
    $("#c1").click(function(){
      alert(33);
    });
    $("#create").click(function(){
 
      // var shownVal = document.getElementById("school_listing").value;
      // var value2send = document.querySelector("#countrydata option[value='"+shownVal+"']").dataset.value;
      // var shownVal1 = document.getElementById("course_listing").value;
      // var value2send1 = document.querySelector("#coursedata11 option[value='"+shownVal1+"']").dataset.value;
        var identifier = $("#identifier").val();
        var start = $("#startdate").val();
        var end = $("#enddate").val();
        var cutoff = $("#coutoffdate").val();
        var validity = $("#validity").val();
        var liscencecount = $("#liscencecount").val();
        var course = cars;
        var schoolname = $("#countrydata").val();
      //  alert(course1);
      //   var coursename = value2send1;
      
        if(identifier == '' || start == '' || end == '' || cutoff == '' || validity == '' || course == '' || liscencecount == '' || schoolname == ''){
         alert('Please fill all the fields !');
         
         }
      
         else{

            let v1 = Number(validity);
       let l1 = Number(liscencecount);
      //  if(isNaN(v1) == true){
      //    alert("Please Enter Correct Values for Validity!");
      //    }
      if(isNaN(l1) == true){
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
        var course1 = $("#course1").val();
        var schoolname1 = $("#schoolname1").val();
        var edit = $("#edit").val();
        if(identifier1 == '' || start1 == '' || end1 == '' || cutoff1 == '' || validity1 == '' || liscencecount1 == '' || course1 == '' || schoolname1 == ''){
         alert('Please fill all the fields !');
         }
         else{
            
            let v11 = Number(validity1);
       let l11 = Number(liscencecount1);
       if(isNaN(v11) == true){
         alert("Please Enter Correct Values for Validity!");
         }
      else if(isNaN(l11) == true){
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
        
    });
    var incre = 0;
   
    
    $("#countrydata").change(function(){
     
        var id = $("#countrydata").val();
        
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
               // $("#myInputContainer").html(data.span);
               // $("#myInput").css("display", "none");

               $("#myInput").prop('disabled', false);
               
                
            }
    });
        }

        
    });


});

    
</script>
  <script>
         $(document).ready(function(){
            var li = '';
         $(".hide").css("display","none");
          $(document).on("click",".ul li",function(){
            $(".hide").css("display","block");
          	var text = $(this).text();
         
          	$(".test").append("<span class='span ml-0'>"+text+"</span>");
            li = $(this).attr("data-value");
            
          	 $(this).remove();
          });
         
           $("#myInput").on("keyup", function() {
             var value = $(this).val().toLowerCase();
             $(".ul li").filter(function() {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
             });
           });
         
          	$("#myInput").click(function(event){
          		$(".ul").css("display","block");
          		event.stopPropagation();
          	});
         
         $("body").click(function(){
          		$(".ul").css("display","none");
          	});
         
         $(".test").on("click", ".span", function(){
             $(this).remove();
             $(".ul").append("<li class='list' data-value='"+li+"'>"+$(this).text()+"</li>");
             // $(".ul li").append($(this).text());
             // console.log($(this).text());
         }); 	
         });
      </script>
   </body>
   <?php echo $OUTPUT->footer();
   
   
   ?>

<?php  }
   else{
      $url = $CFG->wwwroot.'/login/index.php';
      redirect($url);
   }
   ?>
</html>