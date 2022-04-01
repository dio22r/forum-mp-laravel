<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForumRequest;
use App\Models\MhForumTag;
use App\Models\MhForumTopic;
use App\Models\ThForumComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function index()
    {
        // $userRoles = Auth::user()->Role->whereIn("id", [1]);
        // dd($userRoles->count());

        $listForum = MhForumTopic::with("MhForumTag", "User")
            ->withCount("ThForumComment")
            ->orderBy("created_at", "desc")
            ->filters(request(["search"]))
            ->paginate(15);

        return view("pages.forum.index", [
            "listForum" => $listForum
        ]);
    }

    public function show(Request $request, String $slug)
    {
        $forum = MhForumTopic::with("MhForumTag")
            ->withCount("ThForumComment")
            ->where("slug", "=", $slug)
            ->first();

        if (!$forum) abort(404);

        $comments = ThForumComment::with("User")
            ->where("mh_forum_topic_id", "=", $forum->id)
            ->orderBy("created_at", "asc")
            ->paginate(20);

        return view("pages.forum.detail", [
            "forum" => $forum,
            "comments" => $comments
        ]);
    }

    public function create(Request $request)
    {
        $forum = new MhForumTopic();

        return view("pages.forum.form", [
            "forum" => $forum,
            "tags" => MhForumTag::get(),
            "method" => "POST",
            "action_url" => route('forum.store')
        ]);
    }

    public function store(ForumRequest $request)
    {
        $forum = new MhForumTopic();

        $forum->slug = Str::slug($request->title) . "-" . rand(100, 999);
        $forum->title = $request->title;
        $forum->description = $request->description;
        $forum->mh_forum_tag_id = $request->mh_forum_tag_id;
        $forum->created_by = Auth::id();

        $status = $forum->save();
        if (!$status) {
            return back()->withInput();
        }

        return redirect()->route("forum.detail", ["slug" => $forum->slug]);
    }

    public function edit(Request $request, MhForumTopic $forum)
    {
        $this->authorize('update', $forum);

        return view("pages.forum.form", [
            'forum' => $forum,
            "tags" => MhForumTag::get(),
            "method" => "PUT",
            "action_url" => route('forum.update', ['forum' => $forum->id])
        ]);
    }

    public function update(ForumRequest $request, MhForumTopic $forum)
    {
        $this->authorize('update', $forum);

        $forum->title = $request->title;
        $forum->description = $request->description;
        $forum->created_by = Auth::id();

        $status = $forum->save();
        if (!$status) {
            return back()->withInput();
        }

        return redirect()->route("forum.detail", ["slug" => $forum->slug]);
    }

    public function destroy(Request $request, MhForumTopic $forum)
    {
        $this->authorize('delete', $forum);

        DB::transaction(function () use ($forum) {
            $forum->deleted_by = Auth::id();
            $forum->save();
            $forum->delete();
        });

        return redirect()->route("home");
    }
}
