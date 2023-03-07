<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Categories;
use App\Models\Posts;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return CategoryResource::collection(
            Categories::get()
        );
    }

    public function posts(string $id){
        return PostResource::collection(
            Categories::find($id)->posts()->get()
        );
    }

    public function store(Request $request)
    {
        $category = Categories::create([
            'title' => $request->title,
            'description' => $request->description,
            'img' => $request->img,
        ]);
        if($request->hasFile('img')){
            $category['img'] = $request->file('img')->store('categories', 'public');
            $category->save();
        }        
        
        return $this->success(new CategoryResource($category), 'Category Created Successfully.', 200);
    }

    public function show(Categories $category)
    {
        return new CategoryResource($category);
    }

    public function update(Request $request, string $id)
    {
        $category = Categories::find($id);
    
        $updated = false;
        if (isset($request->title)) {
            $category->title = $request->input('title');
            $updated = true;
        }
        if (isset($request->description)) {
            $category->description = $request->input('description');
            $updated = true;
        }
        if (isset($request->img)) {
            $category->img = $request->file('img')->store('categories', 'public');
            $updated = true;
        }
        if ($updated) {
            $category->save();
        }
    
        return $this->success(new CategoryResource($category), 'Category Updated Successfully.', 200);
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return $this->success('', 'Category Deleted succesfuly.', 200);
    }
}
