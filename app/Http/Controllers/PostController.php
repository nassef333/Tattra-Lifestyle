<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\AllPostsResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\StoryResource;
use App\Models\Posts;
use App\Models\Stories;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return AllPostsResource::collection(
            Posts::get()
        );
    }

    public function stories(string $id){
        return StoryResource::collection(
            Posts::find($id)->stories()->get()
        );
    }

    public function store(Request $request)
    {     
        $post = Posts::create([
            'title' => $request->title,
            'description' => $request->description,
            'img' => $request->img,
            'category_id' => $request->category_id,
        ]);
        if($request->hasFile('img')){
            $post['img'] = $request->file('img')->store('posts', 'public');
            $post->save();
        }
        foreach($request->stories as $story){
            if(isset($story['story_img'])){
                $story['story_img'] = $story['story_img']->store('stories', 'public');
            }
            else if(isset($story['video'])){
                $story['video'] = $story['video']->store('stories', 'public');
            }
            $story['post_id'] = $post->id;
            $story = Stories::create($story);
        }
        return $this->success('', 'Post Created Successfully.', 200);
    }

    public function show(Posts $post)
    {
        return new PostResource($post);
    }

    public function update(Request $request, Posts $post)
    {
        // return dd($request['stories']);
        $updated = false;
        if (isset($request->title)) {
            $post->title = $request->input('title');
            $updated = true;
        }
        if (isset($request->description)) {
            $post->description = $request->input('description');
            $updated = true;
        }
        if (isset($request->img)) {
            $post->img = $request->file('img')->store('categories', 'public');
            $updated = true;
        }
        if (isset($request->category_id)) {
            $post->category_id = $request->input('category_id');
            $updated = true;
        }
        if ($updated) {
            $post->save();
        }
        $updated = false;
        foreach($request->stories as $story){
            if(isset($story['id'])) {
                $oldStory = Stories::find($story['id']);
                if (isset($story['title'])) {
                    $oldStory->title = $story['title'];
                    $updated = true;
                }
                if (isset($story['post_id'])) {
                    $oldStory->post_id = $story['post_id'];
                    $updated = true;
                }
                if (isset($story['see_more'])) {
                    $oldStory->see_more = $story['see_more'];
                    $updated = true;
                }
                if (isset($story['is_add'])) {
                    $oldStory->is_add = $story['is_add'];
                    $updated = true;
                }
                if (isset($story['pub_number'])) {
                    $oldStory->pub_number = $story['pub_number'];
                    $updated = true;
                }
                if (isset($story['slot_number'])) {
                    $oldStory->slot_number = $story['slot_number'];
                    $updated = true;
                }
                if (isset($story['ads_script'])) {
                    $oldStory->ads_script = $story['ads_script'];
                    $updated = true;
                }
                if (isset($story['video'])) {
                    $oldStory->video = $story['video']->store('stories', 'public');
                    $updated = true;
                }
                if (isset($story['story_img'])) {
                    $oldStory->story_img = $story['story_img']->store('stories', 'public');
                    $updated = true;
                }
                if($updated)
                    $oldStory->save();
            }
            else{
                if(isset($story['story_img'])){
                    $story['story_img'] = $story['story_img']->store('stories', 'public');
                }
                else if(isset($story['video'])){
                    $story['video'] = $story['video']->store('stories', 'public');
                }
                $story['post_id'] = $post->id;
                Stories::create($story);
            }
        }

        

        return $this->success(new PostResource($post), 'Post Updated Successfully.', 200);
    }

    public function destroy(Posts $post)
    {
        $post->delete();
        return $this->success('', 'Post Deleted succesfuly.', 200);
    }
}
