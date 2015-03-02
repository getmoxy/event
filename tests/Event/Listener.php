<?php
class ListenerTest extends PHPUnit_Framework_TestCase
{

    // test callback
    public function _callback($event)
    {
        //$this->assert
    }


    public function testListenerCallback()
    {
        $listener = new \Moxy\Event\Listener(array($this, '_callback'));


    }



}