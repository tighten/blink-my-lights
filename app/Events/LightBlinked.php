<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class LightBlinked
{
    use Dispatchable;

    public $color;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($color)
    {
        $this->color = $color;
    }
}
