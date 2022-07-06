<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class SettingManager extends Component
{
    public string $siteName;
    public string $siteTitle;

    protected $rules = [
        'siteName' => 'required|string|min:1',
        'siteTitle' => 'required|string|min:1',
    ];

    public function render()
    {
        $settings = Setting::all();
        return view('livewire.admin.setting-manager', [
            'settings' => $settings,
        ]);
    }

    public function mount()
    {
        $this->siteName = config('settings.site_name');
        $this->siteTitle = config('settings.site_title');
    }

    public function save()
    {
        $this->validate();
        Setting::set('site_name', $this->siteName);
        Setting::set('site_title', $this->siteTitle);
        return redirect()->route('admin.settings');
        // $this->emitSelf('refresh');
    }
}
