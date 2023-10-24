<?php

    namespace   App\Repositories\Json;

    use App\Repositories\Contracts\repositoryInterface;

    class jsonBaseRepository implements repositoryInterface
    {
        protected $model;

        public function create(array $data)
        {
            return file_put_contents('user.json', json_encode($data));
        }

        public function update(int $id, array $data)
        {
        }

        public function delete(array $where)
        {

        }

        public function all(array $where)
        {

        }

        public function find(int $id)
        {

        }
    }

?>