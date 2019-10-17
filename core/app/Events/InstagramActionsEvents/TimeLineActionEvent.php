<?php

namespace App\Events\InstagramActionsEvents;

use App\Models\InstagramAccount;
use App\Models\InstagramAction;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TimeLineActionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var InstagramAccount  */
    public $instagramAccount;

    /** @var InstagramAction  */
    public $action;

    /**
     * setTimeLineActionEvent constructor.
     * @param InstagramAccount $instagramAccount
     * @param InstagramAction $action
     */
    public function  __construct(InstagramAccount $instagramAccount, InstagramAction $action)
    {
        $this->instagramAccount = $instagramAccount;
        $this->action = $action;
    }
}
