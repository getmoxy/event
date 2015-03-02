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

    /**
     * Construct Event Dispatcher
     *
     * @author Tom Morton
     * @param string $name Event Name
     */
    public function __construct($name) 
    {
        $this->_name = $name;
    }

    /**
     * Dispatch an Event
     *
     * Iterates the list of Event Listeners
     * and calls each of them sequentially
     *
     * @author Tom Morton
     * @param array $data An array of Data
     */
    public function dispatch($data) 
    {

        $event = new \Moxy\Event($this->_name, $data);

        foreach($this->_listeners as $listener) {
            $listener->call($event);
        }

    }

    /**
     * Add Listener
     *
     * @author Tom Morton
     * @param \Moxy\Event\ListenerInterface $listener Listener class
     */
    public function addListener(\Moxy\Event\ListenerInterface $listener) 
    {
        $this->_listeners[] = $listener;
    }

}