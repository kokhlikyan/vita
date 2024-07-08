<?php

namespace App\Services;

use App\Models\Settings;
use Illuminate\Support\Facades\Log;

class SettingsService
{
    public function createOrUpdate($request): void
    {
        $data = array_filter([
            'goals_color' => $request->input('goals_color'),
            'habits_color' => $request->input('habits_color'),
            'blocks_color' => $request->input('blocks_color')
        ], function ($value) {
            return $value !== null;
        });
        Settings::query()->updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );
    }
}
