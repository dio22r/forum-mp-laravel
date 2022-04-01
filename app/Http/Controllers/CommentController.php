<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\MhForumTopic;
use App\Models\ThForumComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

    public function store(CommentRequest $request, MhForumTopic $forum)
    {
        $comment = new ThForumComment();

        $comment->comment = $request->comment;
        $comment->mh_forum_topic_id = $forum->id;
        $comment->created_by = Auth::id();

        $status = $comment->save();
        if (!$status) {
            return back()->withInput();
        }

        return redirect()->route("forum.detail", ["slug" => $forum->slug]);
    }


    public function destroy(Request $request, ThForumComment $comment)
    {
        $this->authorize('delete', $comment);

        $forum = $comment->MhForumTopic;
        DB::transaction(function () use ($comment) {
            $comment->deleted_by = Auth::id();
            $comment->save();
            $comment->delete();
        });

        return redirect()->route("forum.detail", ['slug' => $forum->slug]);
    }
}
