<?php

namespace App\Listeners;

use TwitterAPIExchange;
use App\Events\LightBlinked;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Queue\ShouldQueue;

class Tweet implements ShouldQueue
{
    protected $colors = [
        'kelvin:8000',
        'kelvin:5000',
        'kelvin:3500',
        'kelvin:3000',
        'kelvin:2700',
        'red',
        'orange',
        'yellow',
        'green',
        'cyan',
        'blue',
        'purple',
        'pink',
        'red saturation:0.5',
        'orange saturation:0.5',
        'yellow saturation:0.5',
        'green saturation:0.5',
        'cyan saturation:0.5',
        'blue saturation:0.5',
        'purple saturation:0.5',
        'pink saturation:0.5',
    ];

    /**
     * Handle the event.
     *
     * @param  LightBlinked  $event
     * @return void
     */
    public function handle(LightBlinked $event)
    {
        if (! config('services.twitter.oauth_access_token')) {
            return;
        }

        if (! $this->validLightColor($event->color)) {
            return;
        }

        $this->queue($event->color);

        if ($this->queueCount() >= 10) {
            $this->tweet();
            Cache::forget('color_queue');
        }
    }

    protected function validLightColor($color)
    {
        return in_array($color, $this->colors);
    }

    protected function queue($color)
    {
        $queue = Cache::get('color_queue');
        $queue[] = $this->formatColor($color ?? 'random');
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

    protected function formatColor($color)
    {
        if (str_contains($color, 'saturation')) {
            $color = 'Light ' . ucfirst(str_replace_last(' saturation:0.5', '', $color));
        }

        if (str_contains($color, 'kelvin')) {
            $color = substr($color, 7) . 'K';
        }

        return ucfirst($color);
    }
}
