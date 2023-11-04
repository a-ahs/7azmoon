<?php

    namespace   App\Repositories\Json;

    use App\Entities\User\userEntity;
    use App\Entities\User\userJsonEntity;
    use App\Repositories\Contracts\userRepositoryInterface;

    class jsonUserRepository extends jsonBaseRepository implements userRepositoryInterface
    {
        protected $jsonModel = 'users.json';
        
        public function create(array $data) : userEntity
        {
            $newData = parent::create($data);

            return new userJsonEntity($newData);
        }

        public function find(int $id): userEntity
        {
            $user = parent::find($id);

            return new userJsonEntity($user);
        }
    }

?>