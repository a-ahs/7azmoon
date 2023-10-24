<?php

    namespace App\Repositories\Eloquent;

    use App\Repositories\Contracts\repositoryInterface;

    class eloquentBaseRepository implements repositoryInterface
    {
        protected $model;

        public function create(array $data)
        {
            return $this->model::create($data);
        }

        public function update(int $id, array $data)
        {
            return $this->model::where($data)->update($id);
        }

        public function delete(array $where)
        {
            $query = $this->model::query();

            foreach($where as $key => $value)
            {
                $query->where($key, $value);
            }

            return $query->get();

        }

        public function all(array $where)
        {
            $query = $this->model::query();

            foreach($where as $key => $value)
            {
                $query->where($key, $value);
            }

            return $query->get();
        }

        public function find(int $id)
        {
            return $this->model::find($id);
        }
    }

?>