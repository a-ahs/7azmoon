<?php

    namespace API\V1\Category;

use App\Repositories\Contracts\categoryRepositoryInterface;
use Tests\TestCase;

    class CategoryTest extends TestCase
    {
        public function setUp() : void
        {
            parent::setUp();
            $this->artisan('migrate:refresh');
        }

        public function testItShouldCreateCategory()
        {
            $newCategory = [
                'name' => 'category 1',
                'slug' => 'category-1'
            ];
            $response = $this->call('POST', 'api/v1/categories', $newCategory);

            $this->assertEquals(201, $response->status());
            $this->seeInDatabase('categories', $newCategory);
            $this->seeJsonStructure([
                'success',
                'message',
                'data' => [
                    'name',
                    'slug'
                ]
            ]);
        }

        public function testItShouldDeleteCategory()
        {
            $category = $this->createCategory()[0];

            $response = $this->call('DELETE', 'api/v1/categories', [
                'id' => (string)$category->getId()
            ]);

            $this->assertEquals(200, $response->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data'
            ]);
        }

        public function testItShouldUpdateCategory()
        {
            $category = $this->createCategory()[0];

            $response = $this->call('PUT', 'api/v1/categories', [
                'id' => (string)$category->getId(),
                'name' => 'Updated',
                'slug' => 'updated'
            ]);

            $this->assertEquals(200, $response->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data' => [
                    'name',
                    'slug'
                ]
            ]);
        }

        public function testItShouldGetCategories()
        {
            $this->createCategory(10);
            $pageSize = 2;
            $response = $this->call('GET', 'api/v1/categories', [
                'page' => 1, 
                'pageSize' => $pageSize,
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

        public function testItShouldGetFilteredCategories()
        {
            $this->createCategory(10);
            $pageSize = 2;
            $name = 'TestCategory';
            $response = $this->call('GET', 'api/v1/categories', [
                'search' => $name,
                'page' => 1, 
                'pageSize' => $pageSize,
            ]);

            $data = json_decode($response->getContent(), true);
            foreach($data['data'] as $category)
            {
                $this->assertEquals($category['name'], $name);
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