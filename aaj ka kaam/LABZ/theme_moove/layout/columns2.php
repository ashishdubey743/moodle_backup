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
 * A two column layout for the moove theme.
 *
 * @package   theme_moove
 * @copyright 2017 Willian Mano - http://conecti.me
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
user_preference_allow_ajax_update('sidepre-open', PARAM_ALPHA);

require_once($CFG->libdir . '/behat/lib.php');
// require_once($CFG->wwwroot . '/config.php');
global $DB,$USER;
$hasdrawertoggle = false;
$navdraweropen = false;
$draweropenright = false;

if (isloggedin()) {
   
    $hasdrawertoggle = true;
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
    $draweropenright = (get_user_preferences('sidepre-open', 'true') == 'true');
    
}

$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;

$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}

if ($draweropenright && $hasblocks) {
    $extraclasses[] = 'drawer-open-right';
}

$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'hasdrawertoggle' => $hasdrawertoggle,
    'navdraweropen' => $navdraweropen,
    'draweropenright' => $draweropenright,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'mypagenew' => $CFG->wwwroot.'/my/',
    // 'report_path2' => $CFG->wwwroot.'/local/hierarchy/reports/user_table.php',
    'training' => $CFG->wwwroot.'/my/training.php',
    'calenderpage' => $CFG->wwwroot.'/calendar/view.php?view=month',
];
if (user_has_role_assignment($USER->id, 9)){ 
    $templatecontext['admin'] = $CFG->wwwroot.'/admin/search.php';
    $templatecontext['mypage']=$CFG->wwwroot.'/my';
    $templatecontext['calenderpage']=$CFG->wwwroot.'/calendar/view.php?view=month';
    $templatecontext['course_catalog_path']=$CFG->wwwroot.'/my/course_catalog.php?sess=1';
    $templatecontext['training']=$CFG->wwwroot.'/my/training.php';
    $templatecontext['courses_path2']=$CFG->wwwroot.'/my/courses.php';
    // $templatecontext['report_path2'] = $CFG->wwwroot.'/local/hierarchy/reports/user_table.php';
}
if(is_siteadmin()){
    $templatecontext['admin'] = $CFG->wwwroot.'/admin/search.php';
    $templatecontext['report_path'] = $CFG->wwwroot.'/local/hierarchy/reports/user_table.php';
    // $templatecontext['report_path'] = 'http://3.141.184.21/lbsdes2/local/hierarchy/reports/user_table.php';
    $templatecontext['analatical_path2'] = $CFG->wwwroot.'/my/analatical.php';
    $templatecontext['admin_search_consle']=$CFG->wwwroot.'/admin/search.php';
    //http://labz.in/my/
    $templatecontext['mypage']=$CFG->wwwroot.'/my';
    $templatecontext['calenderpage']=$CFG->wwwroot.'/calendar/view.php?view=month';
    $templatecontext['course_catalog_path']=$CFG->wwwroot.'/my/course_catalog.php?sess=1';
    $templatecontext['training']=$CFG->wwwroot.'/my/training.php';
    $templatecontext['courses_path2']=$CFG->wwwroot.'/my/courses.php';
    $templatecontext['report_path2'] = $CFG->wwwroot.'/local/hierarchy/reports/user_table.php';
}
$themecolor = $DB->get_record_sql("select * from {buttoncolor}");
$templatecontext['buttoncolor'] = $themecolor->scheme_color;
// print_r($themecolor->scheme_color);die;
// Improve boost navigation.
theme_moove_extend_flat_navigation($PAGE->flatnav);
$templatecontext['flatnavigation'] = $PAGE->flatnav;

$themesettings = new \theme_moove\util\theme_settings();

$templatecontext = array_merge($templatecontext, $themesettings->footer_items());

echo $OUTPUT->render_from_template('theme_moove/columns2', $templatecontext);
