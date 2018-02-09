<?php

namespace App\Listeners;

use TwitterAPIExchange;
use App\Events\LightBlinked;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Queue\ShouldQueue;

class Tweet implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LightBlinked  $event
     * @return void
     */
    public function handle(LightBlinked $event)
    {
        $this->queue($event->color);

        if ($this->queueCount() >= 10) {
            $this->tweet();
            Cache::forget('color_queue');
        }
    }

    protected function queue($color)
    {
        $queue = Cache::get('color_queue');
        $queue[] = $color ?? 'random';
        Cache::forever('color_queue', $queue);
    }

    protected function queueCount()
    {
        return count(Cache::get('color_queue', []));
    }

    protected function tweet()
    {
        $tweet = join("\n", Cache::get('color_queue'));

        (new TwitterAPIExchange(config('services.twitter')))
            ->buildOauth('https://api.twitter.com/1.1/statuses/update.json', 'POST')
            ->setPostFields(['status' => $tweet])
            ->performRequest();
    }
}
