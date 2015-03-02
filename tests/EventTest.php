<?php
/**
* @coversDefaultClass \Moxy\Event
*/
class EventTest extends PHPUnit_Framework_TestCase
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

    public function testConstruct()
    {
        return new \Moxy\Event('test.event',array('test' => 'data'));
    }

    /**
     * @depends testConstruct
     */
    public function testGetter($event)
    {
        $this->assertEquals('data', $event->test);
        $this->assertEquals('test.event', $event->name);
    }

}