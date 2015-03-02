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

    /**
     * Construct Event Listener
     *
     * @author Tom Morton
     * @param callable $callback Valid PHP callback
     * @throws \Exception when $callback is not callable
     */
    public function __construct($callback) 
    {

        if(!is_callable($callback)) {
            throw new \Exception('Moxy\Event\Listener expects valid callback');
        }

        $this->_callback = $callback;

    }

    /**
     * Call Event Listener
     *
     * Execute callback, passing it the event class
     *
     * @author Tom Morton
     * @param \Moxy\EventInterface $event Event class
     */
    public function call(\Moxy\EventInterface $event) {
        call_user_func($this->_callback,$event);
    }

}