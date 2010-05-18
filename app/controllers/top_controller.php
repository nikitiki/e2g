<?php
/**
 * Top Controller
 * PHP 5
 *
 * @category Controller
 * @package
 * @version
 * @author nikitiki
 * @license 
 * @link 
 */
class TopController extends AppController
{

    var $name = 'top';
    var $uses = array( 'marker' );
    var $helpers = array(
        'Javascript',
        'Ajax'
    );

    // {{{ index
    /**
     *
     */
    function index() {

        $markers = $this->marker->find( 'all' );

    }
    // }}}
}
?>
