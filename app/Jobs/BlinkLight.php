<?php

namespace App\Jobs;

use App\Events\LightBlinked;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Zttp\Zttp;

class BlinkLight implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $color;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($color)
    {
        $this->color = $color;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Zttp::post('https://maker.ifttt.com/trigger/flash_light/with/key/' . config('services.ifttt.webhook_key'), [
            'value1' => $this->color,
        ]);

        LightBlinked::dispatch($this->color);
    }
}
