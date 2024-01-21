<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\PostDto;
use App\Exceptions\PostNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostApiController extends Controller
{
    public function __construct (
        protected PostRepositoryInterface $postRepository
    ){
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = $this->postRepository->all();
        return (new PostCollection($posts))->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostStoreRequest $request): JsonResponse
    {
        try{
            if (!$request->validated()){
                return response()->json($request->failedValidation(), Response::HTTP_BAD_REQUEST);
            }

            $postDto = new PostDto($request->all());

            $post = $this->postRepository->create($postDto);

        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }

        return (new PostResource($post))->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $post = $this->postRepository->findById($id);
        } catch (PostNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        return (new PostResource($post))->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $title
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostByTitle(string $title): JsonResponse
    {
        try {
            $post = $this->postRepository->findPostByTitle($title);
        } catch (PostNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        return (new PostResource($post))->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified resource by created_at.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterByCreatedAt(Request $request): JsonResponse
    {
        $posts = $this->postRepository->getPostsByCreatedAt($request->get('date'));
        return (new PostCollection($posts))->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->postRepository->delete($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
