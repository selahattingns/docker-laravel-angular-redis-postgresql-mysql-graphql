<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;

class CreateFactoryData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:factory {--user=} {--post=} {--comment=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userCount = $this->option('user');
        $postCount = $this->option('post');
        $commentCount = $this->option('comment');

        User::factory(intval($userCount))->create()->each(function ($user) use ($postCount, $commentCount){
            $user->posts()->saveMany(
                Post::factory(intval($postCount))->create([
                    "user_id" => $user->id
                ])->each(function ($post) use ($user, $commentCount) {
                    $post->comments()->saveMany(
                        Comment::factory($commentCount)->create([
                            "post_id" => $post->id
                        ])
                    );
                })
            );
        });

        $this->info('successfully');
    }
}
