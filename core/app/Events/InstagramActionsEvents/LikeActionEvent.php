<?php

namespace App\Events\InstagramActionsEvents;

use App\Models\InstagramAccount;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

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
