<?php

namespace Tests\Feature;

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
        $link = $this->generateManager->generateLink($this->linkToConvert);
        $response = $this->get('/' . $link);

        $response
            ->assertStatus(301);
    }

    public function testRedirectError()
    {
        $response = $this->get('/' . 123456);

        $response
            ->assertRedirect('/')
            ->assertSessionHas('error', Generate::LINK_NOT_FOUND);
    }
}
