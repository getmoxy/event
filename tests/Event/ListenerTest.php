<?php
class ListenerTest extends PHPUnit_Framework_TestCase
{

    public function _callback($event)
    {
        $this->assertInstanceOf($event, '\Moxy\Event');    
    }

    public function testConstruct()
    {
        $listener = new \Moxy\Event\Listener(array($this, '_callback'));
    }

}