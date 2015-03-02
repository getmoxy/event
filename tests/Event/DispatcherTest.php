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
        $dispatcher = new \Moxy\Event\Dispatcher('test.event');

        $inspect = new ReflectionClass($dispatcher);

        $nameProperty = $inspect->getProperty('_name');
        $nameProperty->setAccessible(true);
        $this->assertEquals('test.event',$nameProperty->getValue($dispatcher));

        return $dispatcher;
    }

    /**
     * @depends testConstruct
     */
    public function testAddListener($dispatcher)
    {
        $dispatcher->addListener(new \Moxy\Event\Listener(array($this,'_callback')));

        $inspect = new ReflectionClass($dispatcher);

        $listenersProp = $inspect->getProperty('_listeners');
        $listenersProp->setAccessible(true);
        $listeners = $listenersProp->getValue($dispatcher);
        $this->assertInternalType('array',$listeners);
        $this->assertCount(1,$listeners);
        $this->assertInstanceOf('\Moxy\Event\Listener',$listeners[0]);

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