<?php

    namespace App\Entities\Quiz;

use App\Models\Quiz;

    class quizEloquentEntity implements quizInterface
    {
        private $quiz;

        public function __construct(Quiz $quiz)
        {
            return $this->quiz = $quiz;
        }

        public function getId()
        {
            return $this->quiz->id;
        }

        public function getCategoryId()
        {
            return $this->quiz->category_id;
        }
        
        public function getTitle()
        {
            return $this->quiz->title;
        }
        
        public function getDescription()
        {
            return $this->quiz->description;
        }
        
        public function getStart_date()
        {
            return $this->quiz->start_date;
        }
        
        public function getDuration()
        {
            return $this->quiz->duration;
        }
    }

?>