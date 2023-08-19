<?php

namespace App\Console\Commands;

use App\Services\Pages\PostService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateOldPostsTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Old Posts Tags';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle()
    {
        $posts = app()->make(PostService::class)->getPostList(false, null, null, null, function ($query) {
            $query->whereDate('published_at', '<=', Carbon::now()->subDays(7));
            $query->whereDate('updated_at', '<=', Carbon::now()->subDays(7));
        });

        $posts->map(function ($post){
            app()->make(PostService::class)->bindTagToPost($post->id, $post->content);

            return $post;
        });

        Log::info('Command Completed Successfully');
    }
}
