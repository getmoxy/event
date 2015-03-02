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
            array(false)
        );
    }

    public function testConstruct()
    {
        $event = new \Moxy\Event('test.event',array('test' => 'data'));

        $inspect = new ReflectionClass($event);

        $nameProperty = $inspect->getProperty('_name');
        $nameProperty->setAccessible(true);
        $this->assertEquals('test.event',$nameProperty->getValue($event));

        $dataProperty = $inspect->getProperty('_data');
        $dataProperty->setAccessible(true);
        $data = $dataProperty->getValue($event);
        $this->assertInternalType('array', $data);
        $this->assertEquals(array('test' => 'data'), $data);

        return $event;
    }

    /**
     * @depends testConstruct
     */
    public function testGetter($event)
    {
        $this->assertEquals('data', $event->test);
        $this->assertEquals('test.event', $event->name);
    }

    /**
     * @depends testConstruct
     * @dataProvider errorDataProvider
     * @expectedException Exception
     * @expectedExceptionMessage Invalid event property
     */
    public function testGetterInvalid($name, $event)
    {
        $event->$name;
    }

}