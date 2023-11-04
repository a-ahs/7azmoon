<?php

    namespace App\Entities\Quiz;

    interface quizInterface
    {
        public function getId();

        public function getCategoryId();
        
        public function getTitle();
        
        public function getDescription();
        
        public function getStart_date();
        
        public function getDuration();
    }

?>