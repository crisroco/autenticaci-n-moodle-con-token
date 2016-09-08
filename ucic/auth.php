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
 * Authentication Plugin: Manual Authentication
 * Just does a simple check against the moodle database.
 *
 * @package    auth_manual
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

/**
 * Manual authentication plugin.
 *
 * @package    auth
 * @subpackage manual
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class auth_plugin_ucic extends auth_plugin_base {

    /**
     * The name of the component. Used by the configuration.
     */
    const COMPONENT_NAME = 'auth_ucic';
    const LEGACY_COMPONENT_NAME = 'auth/ucic';

    /**
     * Constructor.
     */
    function __construct() {
        $this->authtype = 'ucic';
        $config = get_config(self::COMPONENT_NAME);
        $legacyconfig = get_config(self::LEGACY_COMPONENT_NAME);
        $this->config = (object)array_merge((array)$legacyconfig, (array)$config);
    }

    /**
     * Returns true if the username and password work and false if they are
     * wrong or don't exist. (Non-mnet accounts only!)
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure.
     */
     function user_login($username, $password) {
         global $CFG, $DB, $USER;

         //verify if token exist
         if(isset($_POST['token'])){

             $token = $_POST['token'];
             //$config = get_config('auth_ucic','token');
             //echo get_config('auth_ucic','token');die();
             if ($token==get_config('auth_ucic','token')) {

                 //verify if user exist
                 if(isset($_POST['username'])){
                    $username = $_POST['username'];

                 }else {
                   header('Location: http://dev.atypax.com/ucic/zegel/index.php?status=fail');
                           die();;
                 }
               $user = $DB->get_record('user', array('username'=>$username));
               //print_r($user);die();
               if (is_object($user)) {

                   return true;
               }
               header('Location: http://dev.atypax.com/ucic/zegel/index.php?status=fail');
                           die();
            }
               header('Location: http://dev.atypax.com/ucic/zegel/index.php?status=fail');
                           die();
         }

         else {
                if(isset($_POST['empresa'])){
                    $empresa = $_POST['empresa'];
                }else{
                    $empresa = 'aulavirtual';
                }

                if($empresa == "In Retail"){
                    $empresa = "inretail";
                }
                //var_dump($username . ' - ' . $password);die();
                if (!$user = $DB->get_record('user', array('username'=>$username, 'mnethostid'=>$CFG->mnet_localhost_id))) {
                    header('Location: http://' . $empresa . '.ucic.pe/index.html?status=fail');
                    //return false;
                    die();
                }
                if (!validate_internal_user_password($user, $password)) {
                    header('Location: http://' . $empresa . '.ucic.pe/index.html?status=fail');
                    //return false;
                    die();
                }
                if ($password === 'changeme') {
                    set_user_preference('auth_forcepasswordchange', true, $user->id);
                }
                return true;
        }

     }

    function logoutpage_hook() {

        global $USER, $redirect;
        $keys = array_keys($USER->profile);
        //print_r($USER->profile[$keys[0]]);die();
        switch($USER->profile[$keys[0]]){
            case "Interbank":
                $redirect = "http://interbank.ucic.pe";
            break;
            case "NGR":
                $redirect = "http://ngr.ucic.pe";
            break;
            case "Innova Schools":
                $redirect = "http://innovaschools.ucic.pe/";
            break;
            case "Casa Andina":
                $redirect = "http://casa-andina.ucic.pe/";
            break;
            case "Real Plaza":
                $redirect = "http://realplaza.ucic.pe/";
            break;
            case "In Retail":
                $redirect = "http://inretail.ucic.pe/";
            break;
            case "Zegel IPAE":
                $redirect = "http://dev.atypax.com/ucic/zegel/";
            break;
            default:

            break;
        }


    }

    function config_form($config, $err, $user_fields) {
      include 'config.html';
    }

    function process_config($config) {
      // Set to defaults if undefined.
      if (!isset($config->token)) {
          $config->token = '';
       }

      set_config('token', $config->token, self::COMPONENT_NAME);

      return true;
    }

    function prevent_local_passwords() {
        return false;
    }

    /**
     * Returns true if this authentication plugin is 'internal'.
     *
     * @return booĺ
     */
    function is_internal() {
        return true;
    }

    /**
     * Returns true if this authentication plugin can change the user's
     * password.
     *
     * @return bool
     */
    function can_change_password() {
        return true;
    }

    /**
     * Returns the URL for changing the user's pw, or empty if the default can
     * be used.
     *
     * @return moodle_url
     */
    function change_password_url() {
        return null;
    }

    /**
     * Returns true if plugin allows resetting of internal password.
     *
     * @return bool
     */
    function can_reset_password() {
        return true;
    }

    /**
     * Returns true if plugin can be manually set.
     *
     * @return bool
     */
    function can_be_manually_set() {
        return true;
    }

    public function password_expire($username) {
        return 0;
    }

}
