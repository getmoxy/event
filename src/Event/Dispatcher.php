<?php
namespace Moxy\Event;

/**
 * Event Dispatcher
 *
 * @category   Event
 * @package    Moxy\Event
 * @author     Tom Morton <tom@errant.me.uk>
 * @copyright  2015 Tom Morton
 * @license    MIT
 */
class Dispatcher {

    protected $_name;
    protected $_listeners = array();

    public function __construct($name) {
        $this->_name = $name;
    }

    public function dispatch($data) {

        $event = new \Moxy\Event($this->_name, $data);

        foreach($this->_listeners as $listener) {
            $listener->call($event);
        }
    }

    public function addListener($callback) {
        $this->_listeners[] = $callback;
    }
}