<?php

    namespace App\Http\Controllers\API\V1;

    use App\Http\Controllers\Controller;
    use App\Repositories\Contracts\userRepositoryInterface;
    use Illuminate\Http\Request;

    class usersController extends Controller
    {
        public function __construct(private userRepositoryInterface $userRepository)
        {
            
        }

        public function store(Request $request)
        {
            $this->validate($request, [
                'full_name' => 'required|string',
                'email' => 'required|string',
                'mobile' => 'required|string',
                'password' => 'required'
            ]);

            $this->userRepository->create($request->toArray());

            return response()->json([
                'success' => true,
                'message' => 'کاربر با موفقیت ایجاد شد',
                'data' => [
                    'full_name' => $request->full_name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => $request->password    
                ]
            ])->setStatusCode(201);
        }
    }


?>