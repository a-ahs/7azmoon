<?php

    namespace App\Repositories\Eloquent;

    use App\Entities\Category\categoryEloquentEntity;
    use App\Models\Category;
    use App\Repositories\Contracts\categoryRepositoryInterface;

    class eloquentCategoryRepository extends eloquentBaseRepository implements categoryRepositoryInterface
    {
        protected $model = Category::class;

        public function create(array $data)
        {
            $newCategory = parent::create($data);

            return new categoryEloquentEntity($newCategory);
        }

        public function update(int $id, array $data)
        {
            if(!parent::update($id, $data))
            {
                return throw new \Exception('دسته‌بندی بروزرسانی نشد');
            }
            return new categoryEloquentEntity(parent::find($id));
        }
    }

?>