<?php
/**
* @coversDefaultClass \Moxy\Event
*/
class EmitterTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->emitter = new \Moxy\Event\Emitter;
        $this->inspect = new ReflectionClass($this->emitter);
    }

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

    public function testOn()
    {
        $this->emitter->on('test.event',array($this, '_callback'));

        $eventsProp = $this->inspect->getProperty('_events');
        $eventsProp->setAccessible(true);
        $events = $eventsProp->getValue($this->emitter);
        $this->assertInternalType('array',$events);
        $this->assertCount(1,$events);
        $this->assertInstanceOf('\Moxy\Event\Dispatcher',$events['test.event']);

        return $dispatcher;
    }




}