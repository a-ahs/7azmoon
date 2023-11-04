<?php

    namespace API\V1\Category;

use Carbon\Carbon;
use Tests\TestCase;

    class QuizTest extends TestCase
    {
        public function setUp() : void
        {
            parent::setUp();
            $this->artisan('migrate:refresh');
        }

        public function testItShouldCreateQuiz()
        {
            $category = $this->createCategory()[0];
            $startDate = Carbon::now()->addDay();
            
            $quizData = [
                'category_id' => $category->getId(),
                'title' => 'quiz1',
                'description' => 'This is Quiz 1',
                'start_date' => $startDate->format('Y-m-d'), 
                'duration' => $startDate->addMinutes(60)->format('Y-m-d'),
            ];

            $response = $this->call('POST', 'api/v1/quizes', $quizData);
            // dd(json_decode($response->getContent(), true));

            $this->assertEquals(201, $response->status());
            $this->seeJsonStructure([
                'success',
                'message',
                'data' => [
                    'category_id',
                    'title',
                    'description',
                    'start_date', 
                    'duration'
                ]
            ]);
        }
    }

?>