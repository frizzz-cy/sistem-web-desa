<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    // Helper untuk mengambil setting
    public static function get($key, $default = null)
    {
        try {
            $setting = self::where('key', $key)->first();
            return ($setting && $setting->value !== null && $setting->value !== '') ? $setting->value : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    // Helper untuk menyimpan/mengubah setting
    public static function set($key, $value)
    {
        try {
            return self::updateOrCreate(['key' => $key], ['value' => $value]);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
