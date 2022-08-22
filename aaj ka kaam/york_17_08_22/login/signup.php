
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
 * user signup page.
 *
 * @package    core
 * @subpackage auth
 * @copyright  1999 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../config.php');
require_once($CFG->dirroot . '/user/editlib.php');
require_once($CFG->libdir . '/authlib.php');
require_once('lib.php');
$baseurl = $CFG->wwwroot;
global $DB;

echo $OUTPUT->header();

if (!$authplugin = signup_is_enabled()) {
    print_error('notlocalisederrormessage', 'error', '', 'Sorry, you may not use this page.');
}

$PAGE->set_url('/login/signup.php');
$PAGE->set_context(context_system::instance());

// If wantsurl is empty or /login/signup.php, override wanted URL.
// We do not want to end up here again if user clicks "Login".
if (empty($SESSION->wantsurl)) {
    $SESSION->wantsurl = $CFG->wwwroot . '/';
} else {
    $wantsurl = new moodle_url($SESSION->wantsurl);
    if ($PAGE->url->compare($wantsurl, URL_MATCH_BASE)) {
        $SESSION->wantsurl = $CFG->wwwroot . '/';
    }
}

if (isloggedin() and !isguestuser()) {
    // Prevent signing up when already logged in.
    echo $OUTPUT->header();
    echo $OUTPUT->box_start();
    $logout = new single_button(new moodle_url('/login/logout.php',
        array('sesskey' => sesskey(), 'loginpage' => 1)), get_string('logout'), 'post');
    $continue = new single_button(new moodle_url('/'), get_string('cancel'), 'get');
    echo $OUTPUT->confirm(get_string('cannotsignup', 'error', fullname($USER)), $logout, $continue);
    echo $OUTPUT->box_end();
    // echo $OUTPUT->footer();
    exit;
}

// If verification of age and location (digital minor check) is enabled.
if (\core_auth\digital_consent::is_age_digital_consent_verification_enabled()) {
    $cache = cache::make('core', 'presignup');
    $isminor = $cache->get('isminor');
    if ($isminor === false) {
        // The verification of age and location (minor) has not been done.
        redirect(new moodle_url('/login/verify_age_location.php'));
    } else if ($isminor === 'yes') {
        // The user that attempts to sign up is a digital minor.
        redirect(new moodle_url('/login/digital_minor.php'));
    }
}

// Plugins can create pre sign up requests.
// Can be used to force additional actions before sign up such as acceptance of policies, validations, etc.
core_login_pre_signup_requests();

$mform_signup = $authplugin->signup_form();

if ($mform_signup->is_cancelled()) {
    redirect(get_login_url());

} else if ($user = $mform_signup->get_data()) {
    // Add missing required fields.
    $user = signup_setup_new_user($user);

    // Plugins can perform post sign up actions once data has been validated.
    core_login_post_signup_requests($user);

    $authplugin->user_signup($user, true); // prints notice and link to login/index.php
    exit; //never reached
}


$newaccount = get_string('newaccount');
$login      = get_string('login');

$PAGE->navbar->add($login);
$PAGE->navbar->add($newaccount);

$PAGE->set_pagelayout('login');
$PAGE->set_title($newaccount);
$PAGE->set_heading($SITE->fullname);
echo '<style>
  #id_country{
    width:100%;
  }
  label{
    font-weight:bold;
  }
  #page-header{
    display:none;
  } 
  .login-heading{
    font-size:18px !important;
    font-weight:bold;
  }
  .btn-primary{
      color: #fff;
  background-color: #000;
  border-color: #ffe500;
  }
  .btn-primary:hover{
    background-color: #ffe500;
    border-color: #ffe500;
    color:#000;
  }
  .btn-secondary{
    color: #fff;
  background-color: #000;
  border-color: #ffe500;
  }
  .btn-secondary:hover{
    color: #000;
  background-color: #ffe500;
  border-color: #ffe500;
  }
  .signupform{
      width: 600px;
  box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
  margin: 30px auto;
  background: #fff;
  padding: 3rem;
  }
  #region-main-box{
    padding:0px !important;
  }
  footer .footer_top .information{
    margin-left:0px !important;
  }
</style>';


if ($mform_signup instanceof renderable) {
    // Try and use the renderer from the auth plugin if it exists.
    try {
        $renderer = $PAGE->get_renderer('auth_' . $authplugin->authtype);
    } catch (coding_exception $ce) {
        // Fall back on the general renderer.
        $renderer = $OUTPUT;
    }
    echo $renderer->render($mform_signup);
} else {
    // Fall back for auth plugins not using renderables.
    $mform_signup->display();
}
?>
<!-- changes -->
<footer>
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-3 col-md-3 col-lg-3 p-0 ">
          <div class="shape_wrapper">
            <img src="images/shapes/bubble_shpe_1.png" alt="" class="shape_t_1">
            <img src="images/shapes/round_shpae_1.png" alt="" class="shape_t_2">
          </div>
        </div>
        <div class="col-12 col-sm-9 col-md-9 col-lg-9 p-0 become_techer_wrapper">
          <div class="become_a_teacher">
            <div class="title">
              <h2>How it works</h2>
              <p>York-E has been designed with one aim in mind: to improve learning by maximizing the capabilities
                created by online and
                mobile technologies.</p>
            </div><!-- ends: .section-header -->
            <div class="get_s_btn">
              <a href="#" title="">REQUEST A DEMO</a>
            </div>
            <img src="images/shapes/bubble_shpe_2.png" alt="" class="shape_t_1">
          </div>
        </div>
      </div>
      <div class="footer_top">
        <div class="row">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="footer_single_col footer_intro">
              <img src="images/logo.png" alt="" class="f_logo">
              <p>Lorem ipsum dolor sit amet mollis dapibus arcur donec viverra to phasellus
                eget. Etiam maecenas vel vici quis dictum rutrum nec nisi et. Ac pena
                tibus aenean laoreet.</p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-2">
            <div class="footer_single_col">
              <h3>Useful Links</h3>
              <ul class="location_info quick_inf0">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Catalogue 2021</a></li>
                <li><a href="#">York Notes</a></li>
                <li><a href="#">Digital Learning</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-2">
            <div class="footer_single_col information">
              <h3>information</h3>
              <ul class="quick_inf0">
                <li><a href="#">Campus Tour</a></li>
                <li><a href="#">Student Life</a></li>
                <li><a href="#">Scholarship</a></li>
                <li><a href="#">Admission</a></li>
                <li><a href="#">Leadership</a></li>
              </ul>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="footer_single_col contact">
              <h3>Contact Us</h3>
              <p>York Press Limited
                322 Old Brompton Road
                London SW5 9JH
                United Kingdom</p>
              <div class="contact_info">
                <span>+44 (0)20 7373 7781</span>
                <span class="email">info@york-press.com</span>
              </div>
              <ul class="social_items d-flex list-unstyled">
                <li><a href="#"><i class="fab fa-facebook-f fb-icon"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter twitt-icon"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin-in link-icon"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram ins-icon"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="round_shape">
      <span class="shape_1"></span>
      <span class="shape_2"></span>
      <span class="shape_3"></span>
      <span class="shape_4"></span>
      <span class="shape_5"></span>
      <span class="shape_6"></span>
    </div>
    <img src="images/shapes/footer_bg_shpe_1.png" alt="" class="shapes1_footer">
  </footer><!-- End Footer -->
  <link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/login/css/style.css">
<link rel="stylesheet" href="<?php echo $baseurl;?>/login/css/assets/flaticon.css"> 

<?php
echo $OUTPUT->footer();
