<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Locationable
{
    public function location() : MorphOne;
}
