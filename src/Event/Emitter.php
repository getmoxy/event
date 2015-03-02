<?php
namespace Moxy\Event;

/**
 * Emits and and listens for events
 *
 * @category   Event
 * @package    Moxy\Event
 * @author     Tom Morton <tom@errant.me.uk>
 * @copyright  2015 Tom Morton
 * @license    MIT
 */
class Emitter {

    public static $_events = array();

    public function emit($name, $eventData = FALSE) {
        if(isset(self::$_events[$name])) {
            self::$_events[$name]->dispatch($eventData);   
        }
    }

    public function on($name, $callback) {

        if(!is_a($callback, '\Moxy\Interface\Event\Listener')) {
            if(!is_callable($callback)) {
                throw new \Moxy\Exception('Event callback must be a callable');
            }

            $callback = new \Moxy\Event\Listener($callback);
        }
        
        if(!array_key_exists($name, self::$_events)) {
            self::$_events[$name] = \Moxy\Event\Dispatcher($name);
        }

        self::$_events[$name]->addListener($callback);

    }

    public function listen($name, $callback) {
        $this->on($name, $callback);
    }
}