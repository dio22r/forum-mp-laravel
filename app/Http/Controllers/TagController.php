<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\MhForumTag;
use App\Models\MhForumTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $listTag = MhForumTag::withCount("MhForumTopic")
            ->orderBy("title", "asc")
            ->filters(request(["search"]))
            ->paginate(15);

        return view("pages.tag.index", [
            "listTag" => $listTag
        ]);
    }

    public function show(Request $request, String $slug)
    {
        $tag = MhForumTag::withCount("MhForumTopic")
            ->where("slug", "=", $slug)
            ->first();

        if (!$tag) abort(404);

        $forums = MhForumTopic::with("User")
            ->where("mh_forum_tag_id", "=", $tag->id)
            ->orderBy("created_at", "desc")
            ->paginate(20);

        return view("pages.tag.detail", [
            "tag" => $tag,
            "forums" => $forums
        ]);
    }

    public function create(Request $request)
    {
        $tag = new MhForumTag();

        return view("pages.tag.form", [
            "tag" => $tag,
            "method" => "POST",
            "action_url" => route('tag.store')
        ]);
    }

    public function store(TagRequest $request)
    {
        $forum = new MhForumTag();

        $forum->slug = Str::slug($request->title) . "-" . rand(100, 999);
        $forum->title = $request->title;
        $forum->description = $request->description;
        $forum->created_by = Auth::id();

        $status = $forum->save();
        if (!$status) {
            return back()->withInput();
        }

        return redirect()->route("tag.detail", ["slug" => $forum->slug]);
    }

    public function edit(Request $request, MhForumTag $tag)
    {
        $this->authorize('update', $tag);

        return view("pages.tag.form", [
            'tag' => $tag,
            "method" => "PUT",
            "action_url" => route('tag.update', ['tag' => $tag])
        ]);
    }

    public function update(TagRequest $request, MhForumTag $tag)
    {
        $this->authorize('update', $tag);

        $tag->title = $request->title;
        $tag->description = $request->description;
        $tag->created_by = Auth::id();

        $status = $tag->save();
        if (!$status) {
            return back()->withInput();
        }

        return redirect()->route("tag.detail", ["slug" => $tag->slug]);
    }

    public function destroy(Request $request, MhForumTag $tag)
    {
        $this->authorize('delete', $tag);

        DB::transaction(function () use ($tag) {
            $tag->deleted_by = Auth::id();
            $tag->MhForumTopic()->update(
                ["deleted_by" => Auth::id()]
            );
            $tag->MhForumTopic()->delete();
            $tag->save();
            $tag->delete();
        });

        return redirect()->route("tag");
    }
}
