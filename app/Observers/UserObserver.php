<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{

    public function creating(User $user)
    {
        $batch = $user->batch;
        if (!empty($batch)) {
            $user->name = ucwords($user->name);
            $user->subject_id = $batch->subject_id;
            $user->semester_id = $batch->semester_id;
        }
    }

    public function updating(User $user)
    {
        $batch = $user->batch;
        if (!empty($batch)) {
            $user->name = ucwords($user->name);
            $user->subject_id = $batch->subject_id;
            $user->semester_id = $batch->semester_id;
        }
    }
}
