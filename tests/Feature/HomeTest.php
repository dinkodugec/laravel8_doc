<?php

namespace Tests\Feature;

/* use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker; */
use Tests\TestCase;

class HomeTest extends TestCase
{

    public function testHomePageisWorkingCorrect()  //no problem for long name of method
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSeeText('This is test');  //verify if we see this on home page

    }

    public function testContactPageIsWorkingCorrectly()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contact');
        $response->assertSeeText('Hello this is contact!');
    }
}
