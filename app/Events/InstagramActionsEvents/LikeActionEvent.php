<?php

namespace App\Events\InstagramActionsEvents;

use App\Models\InstagramAccount;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class LikeActionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var InstagramAccount  */
    public $instagramAccount;

    /**
     * LikeActionEvent constructor.
     * @param InstagramAccount $instagramAccount
     */
    public function  __construct(InstagramAccount $instagramAccount)
    {
        $this->instagramAccount = $instagramAccount;
    }
}
