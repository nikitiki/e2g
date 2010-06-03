<?php
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {

    var $helpers = array( 'Session', 'Js', 'Html' );

    function beforeFilter() {

        define( 'KOKODE_URL', 'http://' . env('HTTP_HOST') . $this->webroot );
        parent::beforeFilter();

    }
}
?>
