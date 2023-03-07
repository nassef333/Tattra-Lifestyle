<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blogs;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return BlogResource::collection(
            Blogs::get()
        );
    }

    public function store(Request $request)
    {
        $blog = Blogs::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);
        return $this->success(new BlogResource($blog), 'Blog Created Successfully.', 200);
    }

    public function show(Blogs $blog)
    {
        return new BlogResource($blog);
    }

    public function update(Request $request, string $id)
    {
        $blog = Blogs::find($id);
        $blog->update($request->all());
        return $this->success(new BlogResource($blog), 'Blog Updated Successfully.', 200);
    }

    public function destroy(Blogs $blog)
    {
        $blog->delete();
        return $this->success('', 'Blog Deleted succesfuly.', 200);
    }
}
