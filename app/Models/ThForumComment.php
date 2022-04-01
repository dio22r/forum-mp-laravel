<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThForumComment extends Model
{
    use SoftDeletes;

    protected $table = 'th_forum_comment';

    public function User()
    {
        return $this->belongsTo(User::class, "created_by", "id");
    }

    public function MhForumTopic()
    {
        return $this->belongsTo(MhForumTopic::class);
    }
}
