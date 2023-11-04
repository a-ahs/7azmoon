<?php

    namespace App\Repositories\Eloquent;

    use App\Entities\Quiz\quizEloquentEntity;
use App\Models\Quiz;
use App\Repositories\Contracts\quizRepositoryInterface;
    use App\Repositories\Eloquent\eloquentBaseRepository;

    class eloquentQuizRepository extends eloquentBaseRepository implements quizRepositoryInterface
    {
        protected $model = Quiz::class;
        
        public function create(array $data)
        {
            $createdData = parent::create($data);

            return new quizEloquentEntity($createdData);
        }
    }

?>