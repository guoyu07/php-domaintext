<?php

namespace Kumatch\Test\DomainText;

use Kumatch\DomainText\ImmutableDomain;

class ImmutableDomainTest extends DomainTestCase
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
     * @return ImmutableDomain
     */
    protected function createDomain($texts = null)
    {
        if (is_null($texts)) {
            return new ImmutableDomain();
        } else {
            return new ImmutableDomain($texts);
        }
    }
}