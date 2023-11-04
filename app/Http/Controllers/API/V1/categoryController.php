<?php

    namespace App\Http\Controllers\API\V1;

    use App\Http\Controllers\API\Contracts\ApiController;
    use App\Repositories\Contracts\categoryRepositoryInterface;
    use Illuminate\Http\Request;

    class categoryController extends ApiController
    {
        public function __construct(private categoryRepositoryInterface $categoryRepository)
        {
            
        }

        public function store(Request $request)
        {
            $this->validate($request,[
                'name' => 'required|string|min:3|max:255',
                'slug' => 'required|string|min:3|max:255'
            ]);

            $newCategory = $this->categoryRepository->create([
                'name' => $request->name,
                'slug' => $request->slug
            ]);

            return $this->responseCreated('دسته بندی با موفقیت ایجاد شد', [
                'name' => $newCategory->getName(),
                'slug' => $newCategory->getSlug()
            ]);
        }

        public function delete(Request $request)
        {
            $this->validate($request, [
                'id' => 'required'
            ]);

            if(!$this->categoryRepository->find($request->id))
            {
                return $this->responseNotFound('دسته بندی پیدا نشد');
            }

            return $this->responseSuccess('کاربر با موفقیت حذف شد', []);
        }

        public function update(Request $request)
        {
            $this->validate($request, [
                'id' => 'required|numeric',
                'name' => 'required|string',
                'slug' => 'required|string',
            ]);

            $updatedCategory = $this->categoryRepository->update($request->id, [
                'name' => $request->name,
                'slug' => $request->slug
            ]);

            return $this->responseSuccess('دسته‌بندی با موفقیت بروزرسانی شد', [
                'name' => $updatedCategory->getName(),
                'slug' => $updatedCategory->getSlug()
            ]);
        }

        public function index(Request $request)
        {
            $this->validate($request, [
                'search' => 'nullable|string',
                'page' => 'required|numeric',
                'pageSize' => 'nullable|numeric'
            ]);

            $categories = $this->categoryRepository->paginate($request->search, $request->page, $request->pageSize, ['name', 'slug']);
            return $this->responseSuccess('دسته‌بندی ها', $categories);
        }
    }

?>