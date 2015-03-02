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

    public function emitErrorDataProvider()
    {
        return array(
            array(null),
            array('noncallable'),
            array(1),
            array($this),
            array(false)
        );
    }

    public function _callback($event) 
    {
        $this->assertInstanceOf('\Moxy\Event', $event);
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
    }

    /**
     * @depends testOn
     */
    public function testListen()
    {
        $this->emitter->listen('test.listen',array($this, '_callback'));

        $eventsProp = $this->inspect->getProperty('_events');
        $eventsProp->setAccessible(true);
        $events = $eventsProp->getValue($this->emitter);
        $this->assertInternalType('array',$events);
        $this->assertCount(2,$events);
        $this->assertInstanceOf('\Moxy\Event\Dispatcher',$events['test.listen']);
    }

    /**
     * @depends testOn
     */
    public function testEmit()
    {
        $this->emitter->emit('test.event',array('test' => 'data'));
    }


    /**
     * @depends testOn
     * @dataProvider errorDataProvider
     * @expectedException Exception
     * @expectedExceptionMessage Event callback must be a callable
     */
    public function testOnNonCallable($callable)
    {
        $this->emitter->on('test.event',$callable);
    }

     /**
     * @depends testEmit
     * @dataProvider emitErrorDataProvider
     * @expectedException Exception
     * @expectedExceptionMessage Moxy\Event data must be an array
     */
    public function testEmitWithInvalid($data)
    {
        $this->emitter->emit('test.event',$data);
    }




}