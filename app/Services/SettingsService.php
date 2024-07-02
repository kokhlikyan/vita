<?php

namespace App\Services;

use App\Models\Settings;

class SettingsService
{
    public function createOrUpdate($request): array
    {
        $settings = Settings::query()->updateOrCreate(
            ['user_id' => auth()->id()],
            $request->only(['goals_color', 'habits_color'])
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
