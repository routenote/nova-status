<?php

namespace Kingsley\NovaStatus\Http\Controllers;

use Kingsley\NovaStatus\NovaStatus;

class NovaStatusController
{
    public function __invoke()
    {
        return NovaStatus::response();
    }
}
