<?php

namespace App\Models;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key): ?string
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->first();
        if (!$entry) {
            return null;
        }
        return $entry->value;
    }

    public static function set(string $key, string | Number $value = null): bool
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->firstOrFail();
        $entry->value = $value;
        $entry->saveOrFail();
        Config::set('key', $value);
        if (Config::get($key) == $value) {
            return true;
        }
        return false;
    }
}
