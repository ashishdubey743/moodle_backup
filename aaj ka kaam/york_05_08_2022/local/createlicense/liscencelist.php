<?php 
require_once('../../config.php');
$perpage      = optional_param('perpage', 10, PARAM_INT);
$PAGE->set_heading('License List');
$page         = optional_param('page', 0, PARAM_INT);

global $DB,$USER;
if(isloggedin()){
$coursedata = $DB->get_records_sql("select * from {course}");
$schooldata = $DB->get_records_sql("select * from {school} where visible =1");

$json_data = json_encode($schooldata);
// print_r($json_data);die;
// $dataj =json_decode($json_data);
// foreach($dataj as $js){
// echo $js->id;
// }


$liscencedata = $DB->get_records_sql("select * from {liscence} order by id desc");
$count=count($liscencedata);
$PAGE->set_pagelayout('standard');
$PAGE->set_title('License List');
$start = $page * $perpage;
if ($start > count($liscencedata)) {
    $page = 0;
    $start = 0;
}
$liscencedata = array_slice($liscencedata, $start, $perpage, true);

?>
    

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>License List</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $("select").select2();
});
  </script>
<script>
    $(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $("select").select2();
});
  </script>
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
         .form-control:focus{
           border-color:#000 !important;
         }
         a:not([class]):focus{
           background:inherit !important;
           box-shadow:inherit !important;
         }
 

         select {
    display: none !important;
}

.dropdown-select {
    background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0) 100%);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#40FFFFFF', endColorstr='#00FFFFFF', GradientType=0);
    background-color: #fff;
    border-radius: 6px;
    border: solid 1px #eee;
    box-shadow: inherit;
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    float: left;
    font-size: 14px;
    font-weight: normal;
    height: 42px;
    line-height: 40px;
    outline: none;
    padding-left: 18px;
    padding-right: 30px;
    position: relative;
    text-align: left !important;
    transition: all 0.2s ease-in-out;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    white-space: nowrap;
    width: auto;

}

.dropdown-select:focus {
    background-color: #fff;
}

.dropdown-select:hover {
    background-color: #fff;
}

.dropdown-select:active,
.dropdown-select.open {
    background-color: #fff !important;
    border-color: #bbb;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05) inset;
}

.dropdown-select:after {
    height: 0;
    width: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 4px solid #777;
    -webkit-transform: origin(50% 20%);
    transform: origin(50% 20%);
    transition: all 0.125s ease-in-out;
    content: '';
    display: block;
    margin-top: -2px;
    pointer-events: none;
    position: absolute;
    right: 10px;
    top: 50%;
}

.dropdown-select.open:after {
    -webkit-transform: rotate(-180deg);
    transform: rotate(-180deg);
}
#myInput {
  position: relative;
}
.dropdown-select.open .list {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
    pointer-events: auto;
}

.dropdown-select.open .option {
    cursor: pointer;
}

.dropdown-select.wide {
    width: 100%;
}

.dropdown-select.wide .list {
    left: 0 !important;
    right: 0 !important;
}

.dropdown-select .list {
    box-sizing: border-box;
    transition: all 0.15s cubic-bezier(0.25, 0, 0.25, 1.75), opacity 0.1s linear;
    -webkit-transform: scale(0.75);
    transform: scale(0.75);
    -webkit-transform-origin: 50% 0;
    transform-origin: 50% 0;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.09);
    background-color: #fff;
    border-radius: 6px;
    margin-top: 4px;
    padding: 3px 0;
    opacity: 0;
    overflow: hidden;
    pointer-events: none;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 999;
    max-height: 250px;
    overflow: auto;
    border: 1px solid #ddd;
}

.dropdown-select .list:hover .option:not(:hover) {
    background-color: transparent !important;
}
.dropdown-select .dd-search{
  overflow:hidden;
  display:flex;
  align-items:center;
  justify-content:center;
  margin:0.5rem;
}

.dropdown-select .dd-searchbox{
  width:100%;
  padding:0px;
  border:1px solid #999;
  border-color:#999;
  border-radius:4px;
  outline:none;
}
.dropdown-select .dd-searchbox:focus{
  /*border-color:#12CBC4;*/
}

.dropdown-select .list ul {
    padding: 0;
}

.dropdown-select .option {
    cursor: default;
    font-weight: 400;
    line-height: 40px;
    outline: none;
    padding-left: 18px;
    padding-right: 29px;
    text-align: left;
    transition: all 0.2s;
    list-style: none;
}

.dropdown-select .option:hover,
.dropdown-select .option:focus {
    background-color: #f6f6f6 !important;
}

.dropdown-select .option.selected {
    font-weight: 600;
    /*color: #12cbc4;*/
}

.dropdown-select .option.selected:focus {
    background: #f6f6f6;
}

.dropdown-select a {
    color: #aaa;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
}

.dropdown-select a:hover {
    color: #666;
}
.heading-row {
  background: #000;
  color: #fff;
  border: 2px solid #ffe500;
  padding: 8px 0px;
  border-radius: 8px;
}
/*@media screen and (max-width: 1450px) {
  .clear {
    max-width:21.666667%  !important;
    flex:21.666667%  !important;
  }
}
@media screen and (max-width: 1380px) {
  .create {
    max-width:40%  !important;
    flex:40%  !important;
  }
}
@media screen and (max-width: 1200px) {
  .clear {
    max-width:40%  !important;
    flex:40%  !important;
  }
}*/
      </style>
   </head>
   <body>
      <?php echo $OUTPUT->header(); ?>
      <div class="container-fluid">
      
      <div class="row">
         <div class="col-md-12">
           
            <div class="box-shadow">
              <div class="row mb-4 heading-row">
                  <div class="col-md-12">
                     <h5 class="mb-0">License List</h5>
                  </div>
               </div>
              <div class="row mb-3 py-3">
                <div class="row mb-3 w-100">
         <div class="col-md-5 d-flex">


            <label for="email" class="align-self-center" style="width:50%;"><b>Select School:</b></label>
               <!-- <select name="">
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
      <option value="4">Four</option>
  </select> -->
                      <!-- <input list="countrydata" id="school_listing" name="country" size="50" autocomplete="off" /> -->


        <select id="countrydata" style="width:200px;" class="operator"> 
         <option value="">Select a School</option>
         <?php foreach($schooldata as $sd){ ?>
                  <option  value="<?php echo $sd->id; ?>"><?php echo $sd->name; ?></option>
              <?php } ?>
  </select>



  <!-- must be first element after input and use <option>value</option> format -->
  <!-- <datalist id="countrydata" style="">


    <?php foreach($schooldata as $sd){ ?>
                  <option  value="<?php echo $sd->name; ?>"><?php echo $sd->name; ?></option>
              <?php } ?>
        </datalist> -->
           <!-- <select class="form-control " id="schoolfilter">
               <option value="">Select Schoool</option>
               <?php foreach($schooldata as $sd){ ?>
                  <option value="<?php echo $sd->id; ?>"><?php echo $sd->name; ?></option>
              <?php } ?>
               
            </select> -->
         </div>
         <div class="col-md-7 align-self-center filter">
            <a href="#" class="button" id="filterdata">Filter</a>
         

            <a href="liscencelist.php" class="button" style="padding:8px 25px;">Clear Filter</a>
         
                 <a href="createliscence.php" class="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
 Create New License</a>
  
      </div>
               </div>
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr class="bg-grey">
                        <th>License Identifire</th>
                        <th>Allocated Courses</th>
                        <th>School Name</th>
                        <th>License End Date</th>
                        <th>Max</th>
                        <th>Used</th>
                        <th class="text-center">Action</th>
                     </tr>
                  </thead>
                  <tbody id="tablebody">
                    <?php
                   
                    foreach($liscencedata as $li){
                    $schid = $li->schoolid;
                    $iden = $li->identifier;
                    $coname = $li->course;
                    $coid = $DB->get_record_sql("select * from {course} where fullname = '$coname'");
                    
                    $coid1 = $coid->id;
                    
                    $coid1 = intval($coid1);
                    
                    $total1 = $DB->get_record_sql("select * from {license_count} where schoolid = '$schid' and courseid = $coid1");
                    // echo $total1;die;
                        $total = $total1->license_count;

                        // $used = $DB->get_record_sql("select * from {license_count} where schoolid = $schoolid and courseid = $courseid");

                        $used1 = $total1->used;
                    
                    $datanew = $DB->get_records_sql("select * from {school_courses_contain} where identifier='$iden' and schoolid='$schid'");
                    
                        // $total = $li->liscencecount;
                        // $schoolid = intval($li->schoolid);
                        // $courseid = intval($li->courseid);
                        // $used = $DB->get_record_sql("select * from {license_count} where schoolid = $schoolid and courseid = $courseid");
                        // $used1 = $used->license_count;
                        
                          
                        
                        
                    ?>
                     <tr>
                        <td><?php echo $li->identifier; ?></td>
                        <td><?php 
                       foreach($datanew as $dat){

                        $schoolid = intval($dat->schoolid);
                        // $courseid = intval($li->courseid);

                        $courseid = $dat->courseid;
                        
                        $coursename = $DB->get_record_sql("select * from {course} where id='$courseid'");
                        echo $coursename->fullname.',  ';
                       }
                        ?></td>
                        <td><?php echo $li->schoolname; 
                        $date = $li->enddate;
                        $date1 = date("d-m-Y",$date);
                        ?></td>
                        <td><?php echo $date1;?></td>
                        <td><?php echo $li->liscencecount; ?></td>
                        <td>
                        <?php
                       
                        
                        echo $used1; ?></td>
                        <td class="text-center d-flex align-items-center"><a href="updateliscence.php?id=<?php echo $li->id; ?>&edit=<?php echo $li->identifier; ?>" style="padding:6px 10px;"><i class="fa fa-pencil" title="Edit" aria-hidden="true" style="color:#000;"></i></a><text id="text<?php echo $li->id;?>">
                        <?php if($li->status == 1){ ?>
                           
                        <a href="deactivateprocess.php?id=<?php echo $li->id; ?>&deactivate=1" class="deactivateclass" data-value="<?php echo $li->id; ?>" style="padding:6px 10px;">
                        <i class="fa fa-eye" aria-hidden="true" title="Deactivate" style="color:#000;"></i></a>
                        <?php } else{?>
                        
                           <a href="deactivateprocess.php?id=<?php echo $li->id; ?>" class=" Activated" data-value="<?php echo $li->id; ?>" style="padding:6px 10px;">
                        <i class="fa fa-eye-slash" aria-hidden="true" title="Activate" style="color:#000;"></i></a>
                        <?php } ?>
                     </text></td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
    </div>
   </body>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   <script>
      $(document).ready(function(){
         $("#filterdata").click(function(){
          
            var school = $("#countrydata").val();
            
            if(school != ''){
               $.ajax({
            
            url:"schoolfilter.php",
            type:"GET",
            
            data:{
                school:school
            },
            dataType : "JSON",
            
            async:false,
            success:function(json){
                
                $("#tablebody").html(json.record);
                $(".pagination").hide();
            }
    });
            }
         });
         $(".deactivateclass").click(function(){
          
          var deact = $(this).attr("data-value");
          
          
             $.ajax({
          
          url:"deactivateprocess.php",
          type:"GET",
          
          data:{
              deact:deact
          },
          dataType : "JSON",
          
          async:false,
          success:function(json){
            // alert("text"+deact);
            //   $("#text"+deact).html(json.text);
        //  alert("License Deactivated Successfully!");
          }
  });
         
       });

      $("#txtSearchValue").keyup(function(){
         var listing = $("#txtSearchValue").val();
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
      });
   </script>

<script>
    //script to confirm
function myconfirm() {
  let text;
  if (confirm("Press a button!") == true) {
    text = "You pressed OK!";
  } else {
    text = "You canceled!";
  }
  document.getElementById("demo").innerHTML = text;
}
</script>
<script>
  function create_custom_dropdowns() {
    $('select').each(function (i, select) {
        if (!$(this).next().hasClass('dropdown-select')) {
            $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
            var dropdown = $(this).next();
            var options = $(select).find('option');
            var selected = $(this).find('option:selected');
            dropdown.find('.current').html(selected.data('display-text') || selected.text());
            options.each(function (j, o) {
                var display = $(o).data('display-text') || '';
                dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
            });
        }
    });

    $('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
}

// Event listeners

// Open/close
$(document).on('click', '.dropdown-select', function (event) {
    if($(event.target).hasClass('dd-searchbox')){
        return;
    }
    $('.dropdown-select').not($(this)).removeClass('open');
    $(this).toggleClass('open');
    if ($(this).hasClass('open')) {
        $(this).find('.option').attr('tabindex', 0);
        $(this).find('.selected').focus();
    } else {
        $(this).find('.option').removeAttr('tabindex');
        $(this).focus();
    }
});

// Close when clicking outside
$(document).on('click', function (event) {
    if ($(event.target).closest('.dropdown-select').length === 0) {
        $('.dropdown-select').removeClass('open');
        $('.dropdown-select .option').removeAttr('tabindex');
    }
    event.stopPropagation();
});

function filter(){
    var valThis = $('#txtSearchValue').val();
    $('.dropdown-select ul > li').each(function(){
     var text = $(this).text();
        (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();         
   });
};
// Search

// Option click
$(document).on('click', '.dropdown-select .option', function (event) {
    $(this).closest('.list').find('.selected').removeClass('selected');
    $(this).addClass('selected');
    var text = $(this).data('display-text') || $(this).text();
    $(this).closest('.dropdown-select').find('.current').text(text);
    $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
});

// Keyboard events
$(document).on('keydown', '.dropdown-select', function (event) {
    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
    // Space or Enter
    //if (event.keyCode == 32 || event.keyCode == 13) {
    if (event.keyCode == 13) {
        if ($(this).hasClass('open')) {
            focused_option.trigger('click');
        } else {
            $(this).trigger('click');
        }
        return false;
        // Down
    } else if (event.keyCode == 40) {
        if (!$(this).hasClass('open')) {
            $(this).trigger('click');
        } else {
            focused_option.next().focus();
        }
        return false;
        // Up
    } else if (event.keyCode == 38) {
        if (!$(this).hasClass('open')) {
            $(this).trigger('click');
        } else {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            focused_option.prev().focus();
        }
        return false;
        // Esc
    } else if (event.keyCode == 27) {
        if ($(this).hasClass('open')) {
            $(this).trigger('click');
        }
        return false;
    }
});

$(document).ready(function () {
    create_custom_dropdowns();
});
</script>
<?php 
if(isset($_GET['msg'])){
if($_GET['msg'] == 0){
?>
<script>
    alert('License Deactivated Successfully!');
    </script>
<?php
}
else{
    ?>
<script>
    alert('License Activated Successfully!');
    </script>
    <?php
}
}
?>
   <?php
  
   // $perpage = optional_param('perpage', 30, PARAM_INT);
   $totalcount = $count;
   // print_r($count);die;
   
   $baseurl = new moodle_url('/local/createliscence/liscencelist.php');
   // $baseurl = $CFG->wwwroot.'/local/createliscence/liscencelist.php';
   // $pagingbar = new paging_bar($data->totalcount, $page, $perpage, $baseurl, 'page');
   

   echo $OUTPUT->paging_bar($count, $page, $perpage, $baseurl);
   // echo $output->render($pagingbar);
   // echo $output->perpage_selector($perpage);
   echo $OUTPUT->footer(); ?>
   <?php  }
   else{
      $url = $CFG->wwwroot.'/login/index.php';
      redirect($url);
   }
   ?>
</html>