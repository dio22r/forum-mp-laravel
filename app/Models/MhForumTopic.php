<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MhForumTopic extends Model
{
    use SoftDeletes;

    protected $table = 'mh_forum_topic';

    public function ThForumComment()
    {
        return $this->hasMany(ThForumComment::class);
    }

    public function MhForumTag()
    {
        return $this->belongsTo(MhForumTag::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class, "created_by", "id");
    }

    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("title", "like", "%" . $search . "%")
                ->orWhere("description", "like", "%" . $search . "%");
        });
    }

    public function doUpload(Request $request)
    {
        //get the base-64 from data
        $base64_str = substr($request->image_bas64, strpos($request->image_bas64, ",") + 1);

        //decode base64 string
        $image = base64_decode($base64_str);
        $filename = time() . "_" . rand(100, 999) . "_forum.jpg";
        $status = Storage::disk('public')->put('forum/' . $filename, $image);

        return "forum/" . $filename;
    }
}
