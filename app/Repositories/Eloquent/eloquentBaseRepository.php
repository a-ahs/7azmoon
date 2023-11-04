<?php

    namespace App\Repositories\Eloquent;

    use App\Repositories\Contracts\repositoryInterface;

    class eloquentBaseRepository implements repositoryInterface
    {
        protected $model;

        public function paginate(string $search = null , int $page, int $pageSize = 20, array $column = []): array
        {
            if(is_null($search))
            {
                return $this->model::paginate($pageSize, $column, null, $page)->toArray()['data'];
            }

            $modelQuery = $this->model::query();
            foreach($column as $value)
            {
                $modelQuery->orWhere($value, $search);
            }
            return $this->model::paginate($pageSize, $column, null, $page)->toArray()['data'];
        }

        public function create(array $data)
        {
            return $this->model::create($data);
        }

        public function update(int $id, array $data)
        {
            return $this->model::where('id', $id)->update($data);
        }

        public function deleteBy(array $where)
        {
            $query = $this->model::query();

            foreach($where as $key => $value)
            {
                $query->where($key, $value);
            }

            return $query->get();

        }

        public function delete(int $id): bool
        {
            return $this->model::where('id', $id)->delete();   
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