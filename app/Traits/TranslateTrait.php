<?php

namespace App\Traits;

use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

trait TranslateTrait
{
    protected function translateCol($col, $lang)
    {
        $lang ??= App::getLocale();
        $text = Arr::get($col, $lang);

        if ($text != null) return $text;

        if ($lang == 'ar')
            return Arr::get($col, 'en');
        else
            return Arr::get($col, 'ar');
    }

    public function created_ago($datetime, $lang = 'ar', $full = false)
    {
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        if ($lang == 'ar') {
            $string = array(
                'y' => 'سنة', 'm' => 'شهر', 'w' => 'اسبوع', 'd' => 'يوم',
                'h' => 'ساعة', 'i' => 'دقيقة', 's' => 'ثانية',
            );
        } else {
            $string = array(
                'y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day',
                'h' => 'hour', 'i' => 'minute', 's' => 'second',
            );
        }

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                if ($lang == 'ar') {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
                } else {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                }
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);

        if ($lang == 'ar') {
            return $string ? 'قبل ' . implode(', ', $string) : 'الان';
        } else {
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        }
    }
}
