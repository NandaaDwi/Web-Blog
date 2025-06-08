<?php

namespace App\Http\Controllers\Traits;

use App\Models\ActivityLog;

trait LogsActivity
{
    protected function logActivity(string $action, $model)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'loggable_type' => get_class($model),
            'loggable_id' => $model->id,
        ]);
    }
}
