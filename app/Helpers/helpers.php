<?php

if (! function_exists('trans')) {
    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans($key = null, $replace = [], $locale = null)
    {

        if (is_null($key)) {
            return app('translator');
        }

        $vendor_entity_name = env('VENDOR_ENTITY_NAME', 'Restaurant');
        $vendor_entity_name_plural = env('VENDOR_ENTITY_NAME_PLURAL', 'Restaurants');

        $message = app('translator')->get($key, $replace, $locale);
        if (strpos($key, 'estaurant') !== false && $vendor_entity_name != 'Restaurant' && $vendor_entity_name_plural != 'Restaurants' /* Also check in the value to change to is not restaurant  */) {
            $translatedEntity_plural = __($vendor_entity_name_plural);
            $translatedEntity = __($vendor_entity_name);

            //ES
            $message = str_replace('Restaurantes', $translatedEntity_plural, $message);
            $message = str_replace('Restaurante', $translatedEntity, $message);
            $message = str_replace('restaurantes', strtolower($translatedEntity_plural), $message);
            $message = str_replace('restaurante', strtolower($translatedEntity), $message);

            //ES
            $message = str_replace('Restaurants', $translatedEntity_plural, $message);
            $message = str_replace('Restaurant', $translatedEntity, $message);
            $message = str_replace('restaurants', strtolower($translatedEntity_plural), $message);
            $message = str_replace('restaurant', strtolower($translatedEntity), $message);

        }

        return $message;
    }
}

if (! function_exists('safeFormatIntl')) {
    /**
     * Safely format a date using Intl or fallback to Carbon
     *
     * @param  mixed  $date
     * @param  string  $pattern
     * @param  string|null  $locale
     * @param  string|null  $tz
     * @return string
     */
    function safeFormatIntl($date, $pattern, $locale = null, $tz = null)
    {
        if (!$date) return "";
        
        $locale = $locale ?: config('app.locale');
        $tz = $tz ?: config('app.timezone');

        // Try to use IntlDateFormatter if the extension is loaded
        // and it's not the polyfill for non-en locales
        if (extension_loaded('intl')) {
            try {
                $formatter = new \IntlDateFormatter($locale, \IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT);
                $formatter->setPattern($pattern);
                $formatter->setTimeZone($tz);
                $formatted = $formatter->format($date);
                if ($formatted !== false) {
                    return $formatted;
                }
            } catch (\Exception $e) {
                // Fallback to Carbon
            }
        }

        // Fallback to Carbon
        try {
            $carbonDate = \Carbon\Carbon::parse($date);
            if ($tz) {
                $carbonDate->setTimezone($tz);
            }
            
            // Map ICU pattern to PHP date format (best effort)
            // E is day name, HH is hours, mm is minutes
            // Our common patterns: "E HH:mm"
            $phpPattern = str_replace(['eeee', 'eee', 'E', 'HH', 'mm'], ['l', 'D', 'D', 'H', 'i'], $pattern);
            
            return $carbonDate->locale($locale)->translatedFormat($phpPattern);
        } catch (\Exception $e) {
            return $date instanceof \DateTime ? $date->format('Y-m-d H:i') : (string)$date;
        }
    }
}
