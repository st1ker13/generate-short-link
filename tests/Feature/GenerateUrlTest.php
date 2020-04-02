<?php

namespace Tests\Feature;

use App\Managers\GenerateUrlManager;
use App\Models\Generate;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GenerateUrlTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    private $linkToConvert = 'http://github.com/';

    public function testGenerateGet()
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertSee('Generate Link');
    }

    public function testValidateError()
    {
        $response = $this->post('/');

        $response->assertSessionHasErrors(['link']);
    }

    public function testRedirect()
    {
        $generateManage = new GenerateUrlManager();
        $link = $generateManage->generateLink($this->linkToConvert);

        $response = $this->get('/' . $link->token);

        $response
            ->assertStatus(302);
    }

    public function testRedirectError()
    {
        $response = $this->get('/' . 123456);

        $response
            ->assertRedirect('/')
            ->assertSessionHas('error_redirect', Generate::LINK_NOT_FOUND);
    }
}
