<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{

    public function newPost(Request $request)
    {
        $this->validate($request, [
            'subtitle' => 'nullable|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'event_id' => 'required|integer',
        ]);
        $post = new Post;
        $post->subtitle = $request->subtitle;
        $post->event_id = $request->event_id;

        $imageUrl = request()->file('picture')->store('public/posts');
        $imageUrl = substr($imageUrl, 7);

        Image::configure(array('driver' => 'gd'));

        Image::make(storage_path('app/public/' . $imageUrl))
            ->resize(300,300)
            ->save(storage_path('app/public/' . $imageUrl));

        $post->picture = $imageUrl;

        $post->save();


        return redirect()->route('events.show', ['id' => $post->event_id]);
    }
    
    public function getPosts(Request $request, $event)
    {
        $results = Post::where('event_id', $event)
                                ->orderBy('created_at', 'desc')
                                ->paginate(6);
        $posts = '';
        $postsArray = [];
        foreach($results as $pos){
            $postsArray[] = [
                'id' => $pos->id,
                'subtitle' => $pos->subtitle,
                'picture' => $pos->picture,
                'created_at' => $pos->created_at,
                'event_id' => $pos->event_id,
            ];
        }
        $array = array_chunk($postsArray, 3, true);
        foreach ($array as $column)
        {   
            $posts .= '<div class="row mb-2">';
            foreach ($column as $post)
            {
                $posts .= '<div class="col-4">';
                $posts .= '<div class="postImageOuter">';
                $posts .= '<img class="w-100" src="' . asset('storage/' . $post['picture']) . '"></img>';
                $posts .= '<div class="postOverlay"></div>';
                $posts .= '</div>';
                $posts .= '</div>';
            }
            $posts .= '</div>';
        }
        return $posts;
    }

}
