<?php

    namespace App\Repositories\Eloquent;

    use App\Models\User;
    use App\Repositories\Contracts\userRepositoryInterface;

    class eloquentUserRepository extends eloquentBaseRepository implements userRepositoryInterface
    {
        protected $model = User::class;
    }

?>