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
        $this->assertEquals('test.event', $event->name);
        $this->assertEquals('data', $event->test);
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
        $dispatcher->addListener(new \Moxy\Event\Listener(array($this,'_callback')));

        return $dispatcher;
    }


    /**
     * @depends testAddListener
     */
    public function testDispatch($dispatcher)
    {
        $dispatcher->dispatch(array('test' => 'data'));
    }


}