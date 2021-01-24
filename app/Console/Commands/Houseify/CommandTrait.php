<?php

namespace App\Console\Commands\Houseify;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;

trait CommandTrait
{
    protected function setColor(string $color)
    {
        $this->output->getFormatter()->setStyle($color, new OutputFormatterStyle($color));
    }
}
