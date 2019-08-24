<?php

namespace App\Events\BotCoreEvents;

use App\Models\InstagramAccount;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BotWakeupEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var InstagramAccount  */
    public $instagramAccount;

    /**
     * BotWakeupEvent constructor.
     * @param InstagramAccount $instagramAccount
     */
    public function __construct(InstagramAccount $instagramAccount)
    {
        $this->instagramAccount = $instagramAccount;
    }
}
