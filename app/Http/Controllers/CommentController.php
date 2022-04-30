<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function getComments(Request $request, $event) {
        $results = Comment::where('event_id', $event)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
        $comments = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $author = $result->user->name;
                $comments .= <<<EOD
                <div class="row mb-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    $author
                                </div>
                                <div>
                                    <small>$result->created_at</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>$result->content</p>
                        </div>
                    </div>
                </div>
                EOD;
            }
            return $comments;
        }
        return view('welcome');
    }
}
