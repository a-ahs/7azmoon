<?php

    namespace API\V1\Users;

use App\Repositories\Contracts\userRepositoryInterface;
use Tests\TestCase;

    class UserTest extends TestCase
    {
        public function setUp() : void
        {
            parent::setUp();
            $this->artisan('migrate:refresh');
        }

        public function testCreateNewUser()
        {
            $userInfo = [
                'full_name' => 'ashkan',
                'email' => 'ashkan@gmail.com',
                'mobile' => '09111111111',
                'password' => 'ashkan123'
            ];
            $response = $this->call('POST', 'api/v1/users', $userInfo);

            $userInfo['password'] = json_decode($response->getContent(), true)['data']['password'];
            $this->seeInDatabase('users', $userInfo);
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

        public function testItShouldUpdateUserInfo()
        {
            $user = $this->createUser()[0];
            $response = $this->call('PUT', 'api/v1/users', [
                'id' => (string)$user->getId(),
                'full_name' => 'updated',
                'email' => 'updated@gmail.com',
                'mobile' => '09111111111',
            ]);
            
            $this->assertEquals(200, $response->status());

            $this->seeJsonStructure([
                'success',
                'message',
                'data' => [
                    'full_name',
                    'email',
                    'mobile',
                ]
            ]);
        }

        public function testItShouldUpdateUserPass()
        {
            $user = $this->createUser()[0];
            $response = $this->call('PUT', 'api/v1/users/change-pass', [
                'id' => (string)$user->getId(),
                'password' => '123456',
                'password_repeat' => '123456'
            ]);

            $this->assertEquals(200, $response->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data' => [
                    'full_name',
                    'email',
                    'mobile',
                ]
            ]);
        }

        public function testSendWrongDataForUpdateUser()
        {
            $response = $this->call('PUT', 'api/v1/users', []);

            $this->assertEquals(422, $response->status());
        }

        public function testItShouldDeleteUser()
        {
            $user = $this->createUser()[0];
            $response = $this->call('DELETE', 'api/v1/users', [
                'id' => (string)$user->getId()
            ]);

            $this->assertEquals(200, $response->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data'
            ]);
        }

        public function testItShouldGetUser()
        {
            $this->createUser(10);
            $pageSize = 2;
            $response = $this->call('GET', 'api/v1/users', [
                'page' => 1,
                'pageSize' => $pageSize
            ]);

            $data = json_decode($response->getContent(), true);

            $this->assertEquals($pageSize, count($data['data']));
            $this->assertEquals(200, $response->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data'
            ]);
        }

        public function testItShouldGetFilteredUsers()
        {
            $pageSize = 2;
            $userEmail = 'ashkan@gmail.com';
            $response = $this->call('GET', 'api/v1/users', [
                'search' => $userEmail,
                'page' => 1,
                'pageSize' => $pageSize
            ]);

            $data = json_decode($response->getContent(), true);

            foreach($data['data'] as $user)
            {
                $this->assertEquals($user['email'], $userEmail);
            }
            $this->assertEquals(200, $response->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data'
            ]);
        }
    }

?>