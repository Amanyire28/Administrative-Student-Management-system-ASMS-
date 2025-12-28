<?php

use App\Models\SchoolSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('school_setting')) {
    /**
     * Get a school setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function school_setting(string $key, $default = null)
    {
        return SchoolSetting::get($key, $default);
    }
}

if (!function_exists('school_logo_url')) {
    /**
     * Get the full URL for school logo
     *
     * @return string|null
     */
    function school_logo_url()
    {
        $logo = school_setting('school_logo');

        if ($logo && Storage::disk('public')->exists($logo)) {
            return asset('storage/' . $logo);
        }

        return null;
    }
}

if (!function_exists('school_signature_url')) {
    /**
     * Get the full URL for a signature
     *
     * @param string $type (e.g., 'principal', 'headteacher')
     * @return string|null
     */
    function school_signature_url(string $type)
    {
        $signature = school_setting($type . '_signature');

        if ($signature && Storage::disk('public')->exists($signature)) {
            return asset('storage/' . $signature);
        }

        return null;
    }
}

if (!function_exists('current_academic_year')) {
    /**
     * Get the current academic year
     *
     * @return string
     */
    function current_academic_year()
    {
        return school_setting('current_academic_year', date('Y') . '/' . (date('Y') + 1));
    }
}

if (!function_exists('current_term')) {
    /**
     * Get the current term/semester
     *
     * @return int
     */
    function current_term()
    {
        return (int) school_setting('current_term', 1);
    }
}

if (!function_exists('term_system')) {
    /**
     * Get the term system (3_terms or 2_semesters)
     *
     * @return string
     */
    function term_system()
    {
        return school_setting('term_system', '3_terms');
    }
}

if (!function_exists('is_three_term_system')) {
    /**
     * Check if school uses 3-term system
     *
     * @return bool
     */
    function is_three_term_system()
    {
        return term_system() === '3_terms';
    }
}

if (!function_exists('term_dates')) {
    /**
     * Get all term dates
     *
     * @return array
     */
    function term_dates()
    {
        return school_setting('term_dates', []);
    }
}

if (!function_exists('get_term_date')) {
    /**
     * Get specific term start or end date
     *
     * @param int $term
     * @param string $type ('start' or 'end')
     * @return string|null
     */
    function get_term_date(int $term, string $type = 'start')
    {
        $dates = term_dates();
        return $dates[$term][$type . '_date'] ?? null;
    }

    if (!function_exists('str')) {
    function str($string = null)
    {
        if (is_null($string)) {
            return new class {
                public function __call($method, $parameters)
                {
                    return Str::$method(...$parameters);
                }
            };
        }

        return Str::of($string);
    }
}
}
