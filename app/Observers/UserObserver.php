<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function deleting(User $user)
    {
        $user->properties()->exists() ?
            $user->properties()->each(function ($property) {
                $property->propertyFeature()->delete();
                $property->delete();
            }) : null;
        $user->businesses()->exists() ?
            $user->businesses()->each(function ($business) {
                $business->delete();
            }) : null;
        $user->jobProfile()->exists() ?
            $user->jobProfile()->each(function ($jobProfile) {
                $jobProfile->delete();
            }) : null;
    }
}
