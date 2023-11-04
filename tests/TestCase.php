<?php

namespace Tests;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use App\Repositories\Contracts\userRepositoryInterface;
use App\Repositories\Contracts\categoryRepositoryInterface;


abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    protected function createCategory(int $count = 1)
    {
        $categoryRepository = $this->app->make(categoryRepositoryInterface::class);
        $category = [
            'name' => 'TestCategory',
            'slug' => 'testSlug'
        ];
        $categoryData = [];

        foreach(range(0, $count) as $item)
        {
            $categoryData[] = $categoryRepository->create($category);
        }
        return $categoryData;
    }

    protected function createUser(int $count = 1)
    {
        $userRepository = $this->app->make(userRepositoryInterface::class);
        $userData = [
            'full_name' => 'user',
            'email' => 'user@example.com',
            'mobile' => '01234567890'
        ];
        $users = [];

        foreach(range(0, $count) as $item)
        {
            $users[] = $userRepository->create($userData);
        }
        return $users;
    }
}
