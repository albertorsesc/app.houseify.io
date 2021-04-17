<?php

namespace App\Models\Concerns;

interface DeletesRelations
{
    /**
     * Executes when Model is being deleted.
     * Model Event: deleting
     */
    public function onDelete();
}
