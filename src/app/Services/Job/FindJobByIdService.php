<?php

namespace App\Services\Job;

use App\Models\Job;

class findJobByIdService
{
    public function run(int $id)
    {
        return Job::findOrFail($id);
    }
}
