<?php

namespace App\Services;

use App\Models\Settings;

class SettingsService
{
    public function createOrUpdate($request): array
    {
        $data = [
            'goals_color' => $request->input('goals_color'),
            'habits_color' => $request->input('habits_color'),
            'blocks_color' => $request->input('blocks_color')
        ];
        $settings = Settings::query()->updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );
        if ($settings->wasRecentlyCreated) {
            return [
                'message' => 'Settings created successfully.',
                'code' => 201
            ];
        } else {
            return [
                'message' => 'Settings updated successfully.',
                'code' => 200
            ];
        }
    }
}
