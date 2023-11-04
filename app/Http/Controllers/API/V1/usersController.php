<?php

    namespace App\Http\Controllers\API\V1;

    use App\Http\Controllers\API\Contracts\ApiController;
    use App\Repositories\Contracts\userRepositoryInterface;
    use Illuminate\Http\Request;

    class usersController extends ApiController
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
            
            $newUser = $this->userRepository->create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => app('hash')->make($request->password) 
            ]);

            return $this->responseCreated('کاربر با موفقیت ایجاد شد', [
                'full_name' => $newUser->getFullname(),
                'email' => $newUser->getEmail(),
                'mobile' => $newUser->getMobile(),
                'password' => $newUser->getPassword()    
            ]);

        }

        public function update(Request $request)
        {
            $this->validate($request, [
                'id' => 'required|string',
                'full_name' => 'required|string',
                'email' => 'required|string',
                'mobile' => 'required|string',
            ]);

            $user = $this->userRepository->update($request->id , [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
            ]);

            return $this->responseSuccess('کاربر با موفقیت بروزرسانی شد', [
                'full_name' => $user->getFullname(),
                'email' => $user->getEmail(),
                'mobile' => $user->getMobile(),
            ]);
        }   

        public function updatePassword(Request $request)
        {
            $this->validate($request, [
                'id' => 'required',
                'password' => 'min:6|required_with:password_repeat|same:password_repeat',
                'password_repeat' => 'min:6'
            ]);

            try {
                $user = $this->userRepository->update($request->id, [
                'password' => app('hash')->make($request->password)
            ]);
            } catch (\Exception $e) {
                return $this->responseNotFound('کاربر بروزرسانی نشد');
            }
            return $this->responseSuccess('رمز شما با موفقیت تغییر کرد', [
                'full_name' => $user->getFullname(),
                'email' => $user->getEmail(),
                'mobile' => $user->getMobile(),
            ]);
        }

        public function delete(Request $request)
        {
            $this->validate($request, [
                'id' => 'required'
            ]);

            if(!$this->userRepository->find($request->id))
            {
                return $this->responseNotFound('کاربر با این آیدی وجود ندارد');
            }

            $this->userRepository->delete($request->id);
            return $this->responseSuccess('کاربر با موفقیت حذف شد', []);
        }

        public function index(Request $request)
        {
            $this->validate($request, [
                'search' => 'nullable|string',
                'page' => 'required|numeric',
                'pageSize' => 'nullable|numeric'
            ]);

            $users = $this->userRepository->paginate($request->search, $request->page, $request->pageSize ?? 3, ['full_name', 'email', 'mobile']);
            return $this->responseSuccess('کاربران', $users);
        }
    }


?>