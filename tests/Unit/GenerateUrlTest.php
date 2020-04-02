<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GenerateUrlTest extends TestCase
{
    use DatabaseTransactions;

    private $generateManager;
    private $linkToConvert;

    public function __construct(GenerateUrlManager $generateManager)
    {
        $this->linkToConvert = 'http://github.com/';
        $this->generateManager = $generateManager;
    }

    public function testGenerateUrl()
    {

        $link = $this->generateManager->generateLink($this->linkToConvert);

        self::assertNotEmpty($link);
        self::assertEquals(strlen($link->value), Generate::strlength);
        self::assertEquals($link->origin, $this->linkToConvert);
    }

    public function testCheckValue()
    {
        $link = Generate::create($this->linkToConvert);

        self::expectExceptionMessage(Generate::DEFAULT_EXCEPTION_MESSAGE);
    }
}
