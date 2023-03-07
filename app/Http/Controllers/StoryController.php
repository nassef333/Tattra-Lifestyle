<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoryRequest;
use App\Http\Resources\StoryResource;
use App\Models\Posts;
use App\Models\Stories;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return StoryResource::collection(
            Stories::get()
        );
    }

    public function store(Request $request)
    {
        $story = Stories::create([
            'title' => $request->title,
            'story_img' => $request->story_img,
            'video' => $request->video,
            'post_id' => $request->post_id,
            'see_more' => $request->see_more,
            'is_add' => $request->is_add,
            'pub_number' => $request->pub_number,
            'slot_number' => $request->slot_number,
            'ads_script' => $request->ads_script,
        ]);
        if($request->hasFile('img')){
            $story['img'] = $request->file('img')->store('stories', 'public');
            $story->save();
        }
        else if($request->hasFile('video')){
            $story['video'] = $request->file('video')->store('stories', 'public');
            $story->save();
        }
        return $this->success(new StoryResource($story), 'Story Created Successfully.', 200);
    }

    public function show(string $id)
    {
        return new StoryResource(Stories::find($id));
    }

    public function update(Request $request, string $id)
    {
        $story = stories::find($id);
        $story->update($request->all());
        if($request->hasFile('img')){
            $story['img'] = $request->file('img')->store('stories', 'public');
            $story->save();
        }
        else if($request->hasFile('video')){
            $story['video'] = $request->file('video')->store('stories', 'public');
            $story->save();
        }
        return $this->success(new StoryResource($story), 'Story Updated Successfully.', 200);
    }

    public function destroy(string $id)
    {
        $story = Stories::find($id);
        $story->delete();
        return $this->success('', 'Story Deleted succesfuly.', 200);
    }
}
