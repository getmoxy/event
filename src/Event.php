<?php
namespace Moxy;

/**
 * Event
 *
 * @category   Event
 * @package    Moxy\Event
 * @author     Tom Morton <tom@errant.me.uk>
 * @copyright  2015 Tom Morton
 * @license    MIT
 */
class Event implements EventInterface {

    protected $_name;
    protected $_data;

    /**
     * Construct Object
     *
     * @author Tom Morton
     * @param array $data Event data
     */
    public function __construct($name, $data) 
    {
        $this->_name = $name;
        $this->_data = $data;
    }

    /**
     * Get Event Property
     *
     * Magic methhod to allow access to Event data
     *
     * @author Tom Morton
     * @param string $name Variable name
     * @throws \Exception when passed a non-existent property name
     */
    public function __get($name)
    {

        if($name === 'name') {
            return $this->_name;
        }

        if(isset($this->_data[$name])) {
            return $this->_data[$name];
        }

        throw new \Exception('Invalid event property: ' . $name);

    }
}
