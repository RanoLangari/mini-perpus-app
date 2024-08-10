<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function handleFileUpload(Request $request, $inputName, $existingFilePath, $storagePath)
    {
        if ($request->hasFile($inputName)) {
            if ($existingFilePath) {
                Storage::disk('public')->delete($existingFilePath);
            }
            $fileName = date('Ymd') . '_' . $request->user()->id . '_' . $request->file($inputName)->getClientOriginalName();
            return $request->file($inputName)->storeAs($storagePath, $fileName, 'public');
        }
        return $existingFilePath;
    }
}