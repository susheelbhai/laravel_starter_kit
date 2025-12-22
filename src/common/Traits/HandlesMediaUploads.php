<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait HandlesMediaUploads
{
    /**
     * Handle single file upload to a collection.
     * Automatically replaces existing file if collection uses singleFile().
     */
    protected function handleSingleFileUpload(
        Model $model,
        Request $request,
        string $fieldName,
        ?string $collectionName = null
    ): void {
        if ($request->hasFile($fieldName)) {
            $model->addMediaFromRequest($fieldName)
                ->toMediaCollection($collectionName ?? $fieldName);
        }
    }

    /**
     * Handle multiple file uploads to a collection with optional deletion.
     */
    protected function handleMultipleFileUploads(
        Model $model,
        Request $request,
        string $fieldName,
        string $collectionName,
        ?string $deletionFieldName = null
    ): void {
        // Handle deletions first
        if ($deletionFieldName && $request->has($deletionFieldName)) {
            $idsToDelete = $request->input($deletionFieldName, []);
            if (!empty($idsToDelete)) {
                $model->media()
                    ->whereIn('id', $idsToDelete)
                    ->where('collection_name', $collectionName)
                    ->get()
                    ->each(fn($media) => $media->delete());
            }
        }

        // Handle new uploads
        if ($request->hasFile($fieldName)) {
            $files = $request->file($fieldName);
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                $model->addMedia($file)
                    ->toMediaCollection($collectionName);
            }
        }
    }
}
