<?php

namespace App\Traits;

use App\Helpers\Helper;

trait HasFormattedDates
{
    /**
     * Initialize the trait.
     */
    public function initializeHasFormattedDates()
    {
        $this->append('created_date', 'created_time', 'created_date_time');
    }

    /**
     * Get formatted date.
     */
    public function getCreatedDateAttribute()
    {
        return Helper::customDate($this->created_at);
    }

    /**
     * Get formatted time.
     */
    public function getCreatedTimeAttribute()
    {
        return Helper::customTime($this->created_at);
    }

    /**
     * Get formatted date and time.
     */
    public function getCreatedDateTimeAttribute()
    {
        return Helper::customDateTime($this->created_at);
    }
}
