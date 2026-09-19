<?php

use Illuminate\Support\Str;

if (! function_exists('section_asset')) {
    /**
     * Build a display URL for a stored file reference.
     *
     * - empty  -> '' (view decides on a default/placeholder)
     * - http*  -> returned unchanged (legacy Cloudinary URL)
     * - else   -> asset('storage/<section>[/<subfolder>]/<filename>')
     *
     * @param  string|null  $value      Stored file reference (filename or legacy URL).
     * @param  string       $section    Section folder name (e.g. 'community_board').
     * @param  string|null  $subfolder  Optional subfolder within the section (e.g. 'videos').
     */
    function section_asset(?string $value, string $section, ?string $subfolder = null): string
    {
        if (empty($value)) {
            return '';
        }

        if (Str::startsWith($value, 'http')) {
            return $value;
        }

        $path = 'storage/'.$section.($subfolder ? '/'.$subfolder : '').'/'.$value;

        return asset($path);
    }
}
