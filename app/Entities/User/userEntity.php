<?php

    namespace App\Entities\User;

    interface userEntity
    {
        public function getId(): int;

        public function getFullname(): string;
        
        public function getEmail(): string;

        public function getMobile(): string;

        public function getPassword(): string;
    }

?>