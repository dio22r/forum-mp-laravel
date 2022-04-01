<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhForumTag extends Model
{
    use SoftDeletes;

    protected $table = 'mh_forum_tag';

    public function MhForumTopic()
    {
        return $this->hasMany(MhForumTopic::class);
    }

    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("title", "like", "%" . $search . "%");
        });
    }
}
