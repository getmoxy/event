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

    /**
     * Emit an Event
     *
     * @author Tom Morton
     * @param string $name Name of the event
     * @param array $eventData Optional array of event data
     * @throws \Exception when $eventData is not an array
     */
    public function emit($name, $eventData = array()) 
    {

        if(!is_array($eventData)) {
            throw new \Exception('Moxy\Event data must be an array');
        }

        if(isset(self::$_events[$name])) {
            self::$_events[$name]->dispatch($eventData);   
        }

    }

    /**
     * Listen for an Event
     *
     * Binds callback to a named event. You can pass either
     * a pure PHP callable or a class that implements
     * \Moxy\Event\ListenerInterface
     *
     * @author Tom Morton
     * @param string $name Name of the event
     * @param callabel $callback Callable to run on triggering of event
     * @throws \Exception When callback is not callable
     */
    public function on($name, $callback) 
    {

        if(!is_a($callback, '\Moxy\Event\ListenerInterface')) {
            if(!is_callable($callback)) {
                throw new \Exception('Event callback must be a callable');
            }
            // Co-erce the callback into an event listener
            // This allows you to pass either a pure callable or
            // your own listener class
            $callback = new \Moxy\Event\Listener($callback);
        }

        // Set up the Event Dispatcher
        if(!array_key_exists($name, self::$_events)) {
            self::$_events[$name] = new \Moxy\Event\Dispatcher($name);
        }

        self::$_events[$name]->addListener($callback);

    }

    /**
     * Alias for On
     */
    public function listen($name, $callback) {
        $this->on($name, $callback);
    }
}