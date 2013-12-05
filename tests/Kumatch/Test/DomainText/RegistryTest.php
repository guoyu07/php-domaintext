<?php

namespace Kumatch\Test\DomainText;

use Kumatch\DomainText\Registry;

class RegistryTest extends \PHPUnit_Framework_TestCase
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
     * @test
     */
    public function registerDomainAndGetDomain()
    {
        $registry = new Registry();
        $domainName = "foo";

        $registry->register($domainName);
        $domain = $registry->getDomain($domainName);

        $this->assertInstanceOf('Kumatch\DomainText\ImmutableDomain', $domain);
        $this->assertEquals(0, $domain->count());

        $mutable = true;
        $domain = $registry->getDomain($domainName, $mutable);

        $this->assertInstanceOf('Kumatch\DomainText\MutableDomain', $domain);
        $this->assertEquals(0, $domain->count());
    }

    /**
     * @test
     */
    public function registerDomainWithTextsAndGetDomain()
    {
        $registry = new Registry();
        $domainName = "foo";
        $texts = array("bar" => "baz", "quux" => "qux");

        $registry->register($domainName, $texts);
        $domain = $registry->getDomain($domainName);

        $this->assertEquals(2, $domain->count());
    }

    /**
     * @test
     */
    public function getRegisteredDomainNames()
    {
        $registry = new Registry();
        $names = $registry->getNames();

        $this->assertCount(0, $names);

        $registry->register('foo');
        $registry->register('bar');
        $registry->register('baz');

        $names = $registry->getNames();

        $this->assertCount(3, $names);
        $this->assertEquals($names[0], 'foo');
        $this->assertEquals($names[1], 'bar');
        $this->assertEquals($names[2], 'baz');
    }

    /**
     * @test
     * @expectedException \Kumatch\DomainText\InvalidArgumentException
     */
    public function throwExceptionIfGetDomainIsNotRegistered()
    {
        $registry = new Registry();
        $domainName = "foo";

        $registry->getDomain($domainName);
    }



    public function provideDomainFiles()
    {
        return array(
            array(__DIR__ . "/domains.json"),
            array(__DIR__ . "/domains.ini"),
            array(__DIR__ . "/domains.yml"),
            array(__DIR__ . "/domains.yaml"),
        );
    }


    /**
     * @test
     * @dataProvider provideDomainFiles
     */
    public function loadDomainsFromFile($filename)
    {
        $registry = new Registry();
        $registry->load($filename);

        $domainA = $registry->getDomain("domain_a");
        $domainB = $registry->getDomain("domain_b");

        $this->assertEquals(2, $domainA->count());
        $this->assertEquals(0, $domainB->count());
    }
}