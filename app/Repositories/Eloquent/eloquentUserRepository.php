<?php

    namespace App\Repositories\Eloquent;

use App\Entities\User\userEloquentEntity;
use App\Entities\User\userEntity;
use App\Models\User;
    use App\Repositories\Contracts\userRepositoryInterface;
use Exception;

    class eloquentUserRepository extends eloquentBaseRepository implements userRepositoryInterface
    {
        protected $model = User::class;

        public function create(array $data) : userEntity
        {
            $newUser = parent::create($data);

            return new userEloquentEntity($newUser);
        }

        public function update(int $id, array $data)
        {
            if(!parent::update($id, $data))
            {
                throw new \Exception('کاربر بروزرسانی نشد');
            }

            return new userEloquentEntity(parent::find($id));
        }
    }

?>