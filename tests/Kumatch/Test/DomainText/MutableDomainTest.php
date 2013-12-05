<?php

namespace Kumatch\Test\DomainText;

use Kumatch\DomainText\MutableDomain;

class MutableDomainTest extends DomainTestCase
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
     * @return MutableDomain
     */
    protected function createDomain($texts = null)
    {
        if (is_null($texts)) {
            return new MutableDomain();
        } else {
            return new MutableDomain($texts);
        }
    }


    /**
     * @test
     * @dataProvider provideTexts
     */
    public function setAndGetDomainsText($text, $result)
    {
        $default = "default";

        $domain = new MutableDomain();
        $domain->set($text, $result);

        $this->assertEquals($default, $domain->get($default));
        $this->assertEquals($result, $domain->get($text));
    }

    /**
     * @test
     * @dataProvider provideInvalidValues
     * @expectedException \Kumatch\DomainText\InvalidArgumentException
     */
    public function throwExceptionIfSetValueIsNotScalarOrBoolean($text)
    {
        $domain = new MutableDomain();
        $domain->set($text, "invalid");
    }
}