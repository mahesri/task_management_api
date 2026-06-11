<?php

class AuthControllerTest extends \Tests\TestCase

{

    protected function setUp() : void
    {
    parent::setUp();
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('user_data')]
    public function test_registerNewUser($data)
    {

        $response = $this->post('/api/register', $data);
    }

    public static function user_data()
    {
        return [[[
            "name" => "Erla Masara",
            "email" => "p1@gmail.com",
            "password" => "secret"
        ]]];
    }

    #[\PHPUnit\Framework\Attributes\TestWith(
        [[
            'email' => 'riyadi.dev@gmail.com',
            'password' => 'rahasia'
        ]]
    )]
    public function test_login($data_user)
    {

        $response = $this->post('/api/login', $data_user);
        dd($response);
    }
}
