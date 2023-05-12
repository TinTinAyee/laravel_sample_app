<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Repository\Blog\BlogRepository;
use App\Services\Blog\BlogService;
use Exception;
use Illuminate\Http\Request;
use Mockery\Expectation;
use PhpParser\Node\Stmt\TryCatch;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $blogService,$blogRepo;
    
    public function __construct(BlogService $blogService , BlogRepository $blogRepo)
    {
        $this->blogService = $blogService;
        $this->blogRepo = $blogRepo;
    }

    public function index()
    {
        $data = Blog::all();

        try {
            return response()->json([
                'status'=>'success',
                'message'=>'Blog List',
                'data'=>$data
        ],200);

        } catch (Exception $e) {
            return response()->json([
                'status'=>'error',
                'message'=>$e->getMessage(),
                'data'=>$data
        ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
       $data= $this->blogService->store($request->validated());

        try {
            return response()->json([
                'status'=>'success',
                'message'=>'Blog Create Data',
                'data'=>$data
        ],200);
        } catch (Exception $e) {
            return response()->json([
                'status'=>'error',
                'message'=>$e->getMessage(),
                'data'=>$data
        ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->blogRepo->show($id);
        try {
            return response()->json([
                'status'=>'success',
                'message'=>'blog show success',
                'data'=>$data
            ],200);

        } catch (Exception $e) {
            return response()->json([
                'status'=>'error',
                'message'=>$e->getMessage(),
                'data'=>$data
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $data = $this->blogService->update($request->validated(),$id);

        try {
            return response()->json([
                'status'=>'success',
                'message'=>'Blog Update Success',
                'data'=>$data,
            ],200);

        } catch (Exception $e) {
            return response()->json([
                'status'=>'error',
                'message'=>$e->getMessage(),
                'data'=>$data,
            ],500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->blogService->delete($id);

        try {
            return response()->json([
            'status'=>'success',
            'message'=>'blog delete success',
            'data'=>$data
        ],200);

        } catch (Exception $e) {
            return response()->json([
                'status'=>'error',
                'message'=>$e->getMessage(),
                'data'=>$data,
            ],500);
        }
    }
}