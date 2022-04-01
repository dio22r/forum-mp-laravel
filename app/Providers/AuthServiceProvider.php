<?php

namespace App\Providers;

use App\Models\MhForumTag;
use App\Models\MhForumTopic;
use App\Models\ThForumComment;
use App\Policies\CommentPolicy;
use App\Policies\ForumPolicy;
use App\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        MhForumTopic::class => ForumPolicy::class,
        ThForumComment::class => CommentPolicy::class,
        MhForumTag::class => TagPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
