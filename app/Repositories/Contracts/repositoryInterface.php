<?php

    namespace App\Repositories\Contracts;

    interface repositoryInterface
    {
        public function create(array $data);

        public function update(int $id, array $data);

        public function deleteBy(array $where);

        public function delete(int $id): bool;

        public function all(array $where);

        public function find(int $id);

        public function paginate(string $search = null, int $page, int $pageSize = 20, array $column = []): array;
    }

?>