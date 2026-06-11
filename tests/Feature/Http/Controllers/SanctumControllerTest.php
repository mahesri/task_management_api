<?php

class SanctumControllerTest extends \Tests\TestCase
{
    #[\PHPUnit\Framework\Attributes\DataProvider('data_user')]
    public function test_accessingSanctum($data_user)
    {
        $this->post("/api/tokens/create", $data_user);
    }

    public static function data_user() : array
    {
        return [[[
            "name" => "Purwanti",
            "email" => "p02@gmail.com",
            "password" => "secret"
        ]]];
    }

    public function test_getTasks()
    {
        $response = $this->get("/api/tasks");
        dd($response);
    }
}
