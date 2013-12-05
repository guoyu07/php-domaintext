<?php

namespace Kumatch\Test\DomainText;

use Kumatch\DomainText\Domain;

abstract class DomainTestCase extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @param null $texts
     * @return Domain
     */
    abstract protected function createDomain($texts = null);


    public function provideTexts()
    {
        return array(
            array('foo', 'foobarbaz'),
            array(123, 456),
            array(42.95, 42.123),
            array("", "blank"),
            array(0, "zero")
        );
    }

    /**
     * @test
     * @dataProvider provideTexts
     */
    public function getArgumentsText($text)
    {
        $domain = $this->createDomain();

        $this->assertEquals($text, $domain->get($text));
    }


    /**
     * @test
     */
    public function setTextsByConstructor()
    {
        $texts = array(
            "foo" => "bar",
            123 => 456,
        );
        $domain = $this->createDomain($texts);

        $this->assertEquals(2, $domain->count());
        $this->assertEquals($texts["foo"], $domain->get("foo"));
        $this->assertEquals($texts[123], $domain->get(123));
    }



    public function provideInvalidValues()
    {
        return array(
            array(null),
            array(true),
            array(array("foo")),
            array((object)array("foo"))
        );
    }

    /**
     * @test
     * @dataProvider provideInvalidValues
     * @expectedException \Kumatch\DomainText\InvalidArgumentException
     */
    public function throwExceptionIfGetValueIsNotScalarOrBoolean($text)
    {
        $domain = $this->createDomain();
        $domain->get($text);
    }
}