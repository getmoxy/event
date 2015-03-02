<?php
/**
* @coversDefaultClass \Moxy\Event\Dispatcher
*/
class DispatcherTest extends PHPUnit_Framework_TestCase
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

    }

    public function testConstruct()
    {
        return new \Moxy\Event\Dispatcher('test.event');
    }

    /**
     * @depends testConstruct
     */
    public function testAddListener($dispatcher)
    {
        $dispatcher->addListener(array($this,'_callback'));
    }

    /**
     * @depends testConstruct
     * @expectedException Exception
     * @expectedExceptionMessage Moxy\Event Dispatcher requires callable as listener
     * @dataProvider errorDataProvider
     */
    public function testAddListenerFailure($callable, $dispatcher)
    {
        $dispatcher->addListener($callable);
    }


}