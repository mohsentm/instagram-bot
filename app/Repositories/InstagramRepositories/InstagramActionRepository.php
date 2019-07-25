<?php

namespace App\Repositories\InstagramRepositories;

use App\Exceptions\InstagramException\InvalidInstagramActionType;
use App\Models\InstagramAccount;
use App\Models\InstagramAction;
use App\Repositories\BaseRepository;

class InstagramActionRepository extends BaseRepository
{
    /** @var string Status values */
    public const STATUS_PENDING = 'PENDING';
    public const STATUS_DONE = 'DONE';
    public const STATUS_LIST = [self::STATUS_PENDING, self::STATUS_DONE];
    public const DEFAULT_STATUS = self::STATUS_PENDING;

    /** @var string ActionType values */
    public const ACTION_TIMELINE = 'TIMELINE';
    public const ACTION_LIKE = 'LIKE';
    public const ACTION_COMMENT = 'COMMENT';
    public const ACTION_LIST = [
        self::ACTION_TIMELINE,
        self::ACTION_LIKE,
        self::ACTION_COMMENT
    ];

    /**
     * @return mixed|string
     */
    public function model()
    {
        return InstagramAction::class;
    }

    /**
     * @param InstagramAccount $account
     * @param string $actionType
     * @param int $actionId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws InvalidInstagramActionType
     */
    public function setAction(InstagramAccount $account, string $actionType, int $actionId = 0)
    {
        if (!in_array($actionType, self::ACTION_LIST, true)) {
            throw new InvalidInstagramActionType();
        }
        return $this->query->create([
            'account_id' => $account->id,
            'action_id' => $actionId,
            'action_type' => $actionType,
            'status' => self::DEFAULT_STATUS
        ]);
    }

    /**
     * Flush the table
     */
    public function flushActions(): void
    {
        $this->query->truncate();
    }
}
