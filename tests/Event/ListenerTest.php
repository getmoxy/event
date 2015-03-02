<?php
/**
* @coversDefaultClass \Moxy\Event\Listener
*/
class ListenerTest extends PHPUnit_Framework_TestCase
{

    public function errorDataProvider()
    {
        return array(
            array(null),
            array('noncallable'),
            array(1),
            array(array()),
            array($this),
            array(false)
        );
    }
    public function _callback($event)
    {
        $this->assertInstanceOf('\Moxy\Event', $event);    
    }

    public function testConstruct()
    {
        $listener = new \Moxy\Event\Listener(array($this, '_callback'));

        return $listener;
    }

    /**
     * @depends testConstruct
     */
    public function testCall($listener)
    {
        $listener->call(new \Moxy\Event('test.event',array()));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Moxy\Event\Listener expects valid callback
     * @dataProvider errorDataProvider
     */
    public function testConstructFailure($callable)
    {
         new \Moxy\Event\Listener($callable);
    }


}