<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function deleting(User $user)
    {
        $user->properties()->each(fn ($property) => $property->delete());
        $user->businesses()->each(fn ($business) => $business->delete());
        $user->jobProfile()->each(fn ($jobProfile) => $jobProfile->delete());
        \Storage::delete($user->getProfilePhotoUrlAttribute());
    }
}
