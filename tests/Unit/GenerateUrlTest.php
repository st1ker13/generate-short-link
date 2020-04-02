<?php

namespace Tests\Unit;

use App\Managers\GenerateUrlManager;
use App\Models\Generate;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GenerateUrlTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    private $linkToConvert = 'http://github.com/';

    public function testGenerateUrl()
    {
        $generateManage = new GenerateUrlManager();
        $link = $generateManage->generateLink($this->linkToConvert);

        self::assertNotEmpty($link);
        self::assertEquals(strlen($link->token), Generate::LENGTH_TOKEN);
        self::assertEquals($link->origin, $this->linkToConvert);
    }
}
