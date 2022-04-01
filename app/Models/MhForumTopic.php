<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
