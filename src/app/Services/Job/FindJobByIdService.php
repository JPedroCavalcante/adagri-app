<?php

namespace App\Services\Job;

use App\Models\Job;

class FindJobByIdService
{
    public function run(int $id)
    {
        return Job::findOrFail($id);
    }
}
