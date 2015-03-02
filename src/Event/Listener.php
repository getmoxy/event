<?php
namespace Moxy\Event;

use Moxy\Event\ListenerInterface;
/**
 * Event Listener
 *
 * @category   Event
 * @package    Moxy\Event
 * @author     Tom Morton <tom@errant.me.uk>
 * @copyright  2015 Tom Morton
 * @license    MIT
 */
class Listener implements ListenerInterface {

    protected $_callback;

    public function __construct($callback) {
        $this->_callback = $callback;
    }

    public function call(\Moxy\EventInterface $event) {
        call_user_func($this->_callback,$event);
    }

}