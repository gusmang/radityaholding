<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Setting
{
    public function get($key)
    {
        return Cache::remember('setting-' . $key, 3600, function ()  use ($key) {
            $setting = DB::table('settings')->where('key', $key)->select('value')->first();
            if ($setting) {
                return json_decode($setting->value);
            }
        });
    }

    private function formatPrice($price)
    {
        if ($price >= 1000000) {
            return ($price / 1000000) . ' Juta';
        } elseif ($price >= 1000) {
            return ($price / 1000) . ' Ribu';
        } else {
            return $price;
        }
    }

    public function getPrice($key, $rupiahFormat = false)
    {
        $price = Cache::remember('pricings' . $key, 3600, function ()  use ($key) {
            return DB::table('pricings')->where('pricing_name', $key)->select('monthly_pay', 'yearly')->first();
        });

        $monthly_pay = ($rupiahFormat) ? 'Rp ' . number_format($price->monthly_pay, 0, ",", ".") : $price->monthly_pay;
        $yearly = ($rupiahFormat) ? 'Rp ' . number_format($price->yearly, 0, ",", ".") : $price->yearly;

        return [
            'monthly_pay' => $monthly_pay,
            'yearly' => $yearly,
            'monthly_pay_format' => $this->formatPrice($price->monthly_pay),
            'yearly_format' => $this->formatPrice($price->yearly)
        ];
    }
}
