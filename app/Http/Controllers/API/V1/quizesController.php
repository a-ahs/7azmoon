<?php

    namespace App\Http\Controllers\API\V1;

    use App\Http\Controllers\API\Contracts\ApiController;
use App\Repositories\Contracts\quizRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

    class quizesController extends ApiController
    {
        public function __construct(private quizRepositoryInterface $quizRepository)
        {
            
        }

        public function store(Request $request)
        {
            $this->validate($request, [
                'category_id' => 'required|numeric',
                'title' => 'required|string',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'duration' => 'required|date',
                
            ]);

            $createdQuiz = $this->quizRepository->create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'duration' => Carbon::parse($request->duration),
            ]);
            
            return $this->responseCreated('کوییز با موفقیت ایجاد شد', [
                'category_id' => $createdQuiz->getCategoryId(),
                'title' => $createdQuiz->getTitle(),
                'description' => $createdQuiz->getdescription(),
                'start_date' => $createdQuiz->getStart_date(),
                'duration' => $createdQuiz->getDuration()
            ]);
        }
    }

?>