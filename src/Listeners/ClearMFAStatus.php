<?php

namespace Jacksonmg\LaravelMFA\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jacksonmg\LaravelMFA\Helpers\MFAHelper;

/**
 * Class ClearMFAStatus
 * @package Jacksonmg\LaravelMFA\Listeners
 */
class ClearMFAStatus
{
    protected $helper;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MFAHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (!empty($event->user->id)) {
            $groups = array_keys(config("laravel-mfa.group", []));
            $groups[] = 'default';
            foreach ($groups as $group) {
                $this->helper->clearVerificationCompleted($group, $event->user->id);
            }
        }
    }
}
