<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaExternal extends Media
{
    protected $table = 'media_external';

    /**
     * Get sorted conversions by size.
     *
     * @param  string  $sort  'asc' or 'desc'
     */
    public function getSortedConversions(string $sort = 'asc'): array
    {
        $conversions = [];
        foreach ($this->getGeneratedConversions() as $name => $generated) {
            if ($generated) {
                try {
                    $relativePath = $this->getPathRelativeToRoot($name);
                    $size = \Illuminate\Support\Facades\Storage::disk($this->disk)->size($relativePath);
                } catch (\Exception $e) {
                    $size = 0;
                }
                $conversions[$name] = [
                    'url' => $this->getUrl($name),
                    'size' => $size,
                ];
            }
        }
        // Sort by size
        uasort($conversions, fn ($a, $b) => $sort === 'desc' ? $b['size'] <=> $a['size'] : $a['size'] <=> $b['size']);

        return $conversions;
    }
}
