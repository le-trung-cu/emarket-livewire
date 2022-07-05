<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class SettingManager extends Component
{
    public function render()
    {
        $settings = Setting::all();
        return view('livewire.admin.setting-manager', [
            'settings' => $settings,
        ]);
    }
}
