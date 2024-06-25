<?php

namespace App\Console\Commands;

use App\Models\Feed;
use Illuminate\Console\Command;

class CopyFeedCommand extends Command
{
    protected $signature = 'copy:feed {id} {--only=} {--include-posts=}';
    protected $description = 'Copy a feed entry and its related data';

    public function handle(): void
    {
        $feedId = $this->argument('id');
        $only = $this->option('only');
        $includePosts = $this->option('include-posts');

        $feed = Feed::with('instagramSource', 'tiktokSource', 'posts')->find($feedId);

        if (!$feed) {
            $this->error('Feed not found.');
            return;
        }

        $newFeed = $feed->replicate();
        $newFeed->save();

        if ($only == 'instagram' || !$only) {
            $this->copyInstagramSource($feed, $newFeed);
        }

        if ($only == 'tiktok' || !$only) {
            $this->copyTiktokSource($feed, $newFeed);
        }

        if ($includePosts) {
            $this->copyPosts($feed, $newFeed, $includePosts);
        }

        $this->info('Feed copied successfully.');
    }

    protected function copyInstagramSource($feed, $newFeed): void
    {
        if ($feed->instagramSource) {
            $newInstagramSource = $feed->instagramSource->replicate();
            $newInstagramSource->feed_id = $newFeed->id;
            $newInstagramSource->save();
        }
    }

    protected function copyTiktokSource($feed, $newFeed): void
    {
        if ($feed->tiktokSource) {
            $newTiktokSource = $feed->tiktokSource->replicate();
            $newTiktokSource->feed_id = $newFeed->id;
            $newTiktokSource->save();
        }
    }

    protected function copyPosts($feed, $newFeed, $count): void
    {
        $posts = $feed->posts->take($count);
        foreach ($posts as $post) {
            $newPost = $post->replicate();
            $newPost->feed_id = $newFeed->id;
            $newPost->save();
        }
    }
}
