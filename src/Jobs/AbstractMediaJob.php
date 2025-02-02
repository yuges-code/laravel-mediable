<?php

namespace Yuges\Mediable\Jobs;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class AbstractMediaJob implements ShouldQueue
{
    use Queueable;
}
