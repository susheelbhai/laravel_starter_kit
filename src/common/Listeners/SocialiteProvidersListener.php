<?php

namespace App\Listeners;

use SocialiteProviders\Manager\SocialiteWasCalled;

class SocialiteProvidersListener
{
    /**
     * Handle the event.
     */
    public function handle(SocialiteWasCalled $event): void
    {
        $event->extendSocialite('apple', \SocialiteProviders\Apple\Provider::class);
        $event->extendSocialite('amazon', \SocialiteProviders\Amazon\Provider::class);
    }
}