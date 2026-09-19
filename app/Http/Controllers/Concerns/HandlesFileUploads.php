<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HandlesFileUploads
{
    /**
     * Store an uploaded file on the public disk under <section>[/<subfolder>]
     * and return the FILENAME ONLY (no path, no URL).
     */
    protected function storeUpload(UploadedFile $file, string $section, ?string $subfolder = null): string
    {
        $ext = $file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'bin';
        $filename = time().'_'.Str::random(8).'.'.$ext;

        $dir = $section.($subfolder ? '/'.$subfolder : '');
        $file->storeAs($dir, $filename, 'public'); // auto-creates the folder

        return $filename; // filename only — Requirement 2
    }
}
