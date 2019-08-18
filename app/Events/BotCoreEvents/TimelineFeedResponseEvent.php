<?php

namespace App\Events\BotCoreEvents;

use App\Models\InstagramAccount;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use InstagramAPI\Response\TimelineFeedResponse;

class TimelineFeedResponseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var InstagramAccount  */
    public $instagramAccount;

    /** @var TimelineFeedResponse */
    public $timelineFeedResponse;

    /**
     * TimelineFeedResponseEvent constructor.
     * @param InstagramAccount $instagramAccount
     * @param TimelineFeedResponse $timelineFeedResponse
     */
    public function __construct(InstagramAccount $instagramAccount, TimelineFeedResponse $timelineFeedResponse)
    {
        $this->instagramAccount = $instagramAccount;
        $this->timelineFeedResponse = $timelineFeedResponse;
    }
}
