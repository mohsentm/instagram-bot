<?php

namespace App\Events\BotCoreEvents;

use App\Models\InstagramAccount;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use InstagramAPI\Response\ReelsTrayFeedResponse;

class StoryFeedResponseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var InstagramAccount  */
    public $instagramAccount;

    /** @var ReelsTrayFeedResponse  */
    public $feedResponse;

    /**
     * StoryFeedResponseEvent constructor.
     * @param InstagramAccount $instagramAccount
     * @param ReelsTrayFeedResponse $feedResponse
     */
    public function __construct(InstagramAccount $instagramAccount, ReelsTrayFeedResponse $feedResponse)
    {
        $this->instagramAccount = $instagramAccount;
        $this->feedResponse = $feedResponse;
    }

}
