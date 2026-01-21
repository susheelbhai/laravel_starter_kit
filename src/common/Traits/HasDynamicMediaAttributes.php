<?php

namespace App\Traits;

trait HasDynamicMediaAttributes
{
    /**
     * Initialize the trait.
     *
     * @return void
     */
    public function initializeHasDynamicMediaAttributes()
    {
        $this->fillable = array_merge($this->fillable, $this->getMediaAttributeNames());
        $this->appends = array_merge($this->appends, $this->getMediaAttributeNames());
    }

    /**
     * Get all media attribute names, including converted versions.
     *
     * @return array
     */
    protected function getMediaAttributeNames(): array
    {
        $attributes = [];
        foreach ($this->mediaAttributes ?? [] as $attribute) {
            $attributes[] = $attribute;
            $attributes[] = "{$attribute}_converted";
        }
        return $attributes;
    }

    /**
     * Handle dynamic calls to the model.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (str_starts_with($method, 'get') && str_ends_with($method, 'Attribute')) {
            $attributeName = substr($method, 3, -9);
            $key = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $attributeName));

            if (str_ends_with($key, '_converted')) {
                $collection = str_replace('_converted', '', $key);
                if (in_array($collection, $this->mediaAttributes ?? [])) {
                    return $this->getMediaConvertedUrls($collection);
                }
            }

            if (in_array($key, $this->mediaAttributes ?? [])) {
                return $this->getMediaUrl($key);
            }
        }

        return parent::__call($method, $parameters);
    }
}
