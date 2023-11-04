<?php

    namespace App\Entities\Category;

    interface categoryEntity
    {
        public function getId(): int;

        public function getName(): string;

        public function getSlug(): string;
    }

?>