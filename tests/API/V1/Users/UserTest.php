<?php

    namespace API\V1\Users;

    use Tests\TestCase;

    class UserTest extends TestCase
    {
        public function testCreateNewUser()
        {
            $response = $this->call('POST', 'api/v1/users', [
                'full_name' => 'ashkan',
                'email' => 'ashkan@gmail.com',
                'mobile' => '09111111111',
                'password' => 'ashkan123'
            ]);

            $this->assertEquals(201, $response->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data' => [
                    'full_name',
                    'email',
                    'mobile',
                    'password'
                ]
            ]);
        }

        public function testSendWrongData()
        {
            $response = $this->call('POST', 'api/v1/users', []);

            $this->assertEquals(422, $response->status());
        }
    }

?>