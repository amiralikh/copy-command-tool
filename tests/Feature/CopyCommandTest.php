<?php

use App\Models\Feed;
use App\Models\InstagramSource;
use App\Models\Post;
use App\Models\TiktokSource;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('copies a feed without any sources or posts', function () {
    $feed = Feed::factory()->create();

    $this->artisan('copy:feed', ['id' => $feed->id]);

    expect(Feed::count())->toBe(2);
    expect(InstagramSource::count())->toBe(0);
    expect(TiktokSource::count())->toBe(0);
    expect(Post::count())->toBe(0);
});

it('copies feed with instagram source', function () {
    $feed = Feed::factory()->create();
    InstagramSource::factory()->create(['feed_id' => $feed->id]);

    $this->artisan('copy:feed', ['id' => $feed->id, '--only' => 'instagram']);

    expect(Feed::count())->toBe(2);
    expect(InstagramSource::count())->toBe(2);
    expect(TiktokSource::count())->toBe(0);
    expect(Post::count())->toBe(0);
});

it('copies feed with tiktok source', function () {
    $feed = Feed::factory()->create();
    TiktokSource::factory()->create(['feed_id' => $feed->id]);

    $this->artisan('copy:feed', ['id' => $feed->id, '--only' => 'tiktok']);

    expect(Feed::count())->toBe(2);
    expect(InstagramSource::count())->toBe(0);
    expect(TiktokSource::count())->toBe(2);
    expect(Post::count())->toBe(0);
});

it('copies feed with posts', function () {
    $feed = Feed::factory()->create();
    Post::factory()->count(5)->create(['feed_id' => $feed->id]);

    $this->artisan('copy:feed', ['id' => $feed->id, '--include-posts' => 5]);

    expect(Feed::count())->toBe(2);
    expect(Post::count())->toBe(10);
});

it('copies feed with instagram source and specified number of posts', function () {
    $feed = Feed::factory()->create();
    InstagramSource::factory()->create(['feed_id' => $feed->id]);
    Post::factory()->count(5)->create(['feed_id' => $feed->id]);

    $this->artisan('copy:feed', ['id' => $feed->id, '--only' => 'instagram', '--include-posts' => 5]);

    expect(Feed::count())->toBe(2);
    expect(InstagramSource::count())->toBe(2);
    expect(TiktokSource::count())->toBe(0);
    expect(Post::count())->toBe(10); // 5 original + 5 copied
});

it('copies feed with tiktok source and specified number of posts', function () {
    $feed = Feed::factory()->create();
    TiktokSource::factory()->create(['feed_id' => $feed->id]);
    Post::factory()->count(5)->create(['feed_id' => $feed->id]);

    $this->artisan('copy:feed', ['id' => $feed->id, '--only' => 'tiktok', '--include-posts' => 5]);

    expect(Feed::count())->toBe(2);
    expect(InstagramSource::count())->toBe(0);
    expect(TiktokSource::count())->toBe(2);
    expect(Post::count())->toBe(10); // 5 original + 5 copied
});

it('copies feed with all sources and posts', function () {
    $feed = Feed::factory()->create();
    InstagramSource::factory()->create(['feed_id' => $feed->id]);
    TiktokSource::factory()->create(['feed_id' => $feed->id]);
    Post::factory()->count(5)->create(['feed_id' => $feed->id]);

    $this->artisan('copy:feed', ['id' => $feed->id, '--include-posts' => 5]);

    expect(Feed::count())->toBe(2);
    expect(InstagramSource::count())->toBe(2);
    expect(TiktokSource::count())->toBe(2);
    expect(Post::count())->toBe(10);
});

it('fails when feed does not exist', function () {
    $this->artisan('copy:feed', ['id' => 999])
        ->expectsOutput('Feed not found.');
});

it('copies feed with zero posts when include-posts is zero', function () {
    $feed = Feed::factory()->create();
    Post::factory()->count(5)->create(['feed_id' => $feed->id]);

    $this->artisan('copy:feed', ['id' => $feed->id, '--include-posts' => 0]);

    expect(Feed::count())->toBe(2);
    expect(Post::count())->toBe(5);
});

