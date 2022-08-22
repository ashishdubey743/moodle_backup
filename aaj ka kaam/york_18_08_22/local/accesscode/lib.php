<?php


	function local_accesscode_extend_navigation(navigation_node $nav) {

       //
        global $CFG, $PAGE;
  
       if ($PAGE->theme->resolve_image_location('icon', 'local_accesscode', null)) {
        $icon = new pix_icon('online-course', '', 'local_accesscode', array('class' => 'icon pluginicon'));
        $icon1 = new pix_icon('online-course1', '', 'local_accesscode', array('class' => 'icon pluginicon'));
    } 
    else {
        $icon = new pix_icon('online-course', '', 'moodle', array(
            'class' => 'online',
            'width' => 5,
            'height' => 5
        ));
    }


        //

        if(has_capability('local/accesscode:accesscode',context_system::instance())){
   //
          $report=$nav->add('Accesscode Management');

        $report->add(
            'Create New Accesscode',
        new moodle_url($CFG->wwwroot . '/local/accesscode/index.php'),
        navigation_node::TYPE_SYSTEM,
        null,
        'local_accesscode',
        $icon
    )->showinflatnavigation = true;


    
        $report->add(
        'Access Code List',
        new moodle_url($CFG->wwwroot . '/local/accesscode/acesscodelist.php'),
        navigation_node::TYPE_SYSTEM,
        null,
        'local_accesscode',
        $icon
    )->showinflatnavigation = true;

    $report->add(
        'Batch List',
        new moodle_url($CFG->wwwroot . '/local/accesscode/acesscodebatchlist.php'),
        navigation_node::TYPE_SYSTEM,
        null,
        'local_accesscode',
        $icon
    )->showinflatnavigation = true;

//changesh
    $report->add(
        'Batch Access Code List',
        new moodle_url($CFG->wwwroot . '/local/accesscode/batch-acesscodelist.php'),
        navigation_node::TYPE_SYSTEM,
        null,
        'local_accesscode',
        $icon
    )->showinflatnavigation = true;



   //
}

   
   


// if(is_siteadmin()){
//         $nav->add(
//         'Access Code',
//         new moodle_url($CFG->wwwroot . '/local/accesscode/index.php'),
//         navigation_node::NODETYPE_BRANCH,
//         null,
//         'local_accesscode',
//         $icon
//     )->showinflatnavigation = true;



    
// }


	
	}
	
?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>

$(document).ready(function(){
    $(".columnleft a:contains('Batch Access Code List')").hide();
    $(".columnleft a:contains('Access Code List')").hide();
});
</script>


