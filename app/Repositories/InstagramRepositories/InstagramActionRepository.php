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

    public const ACTION_STORY = 'STORY';
    public const ACTION_SEE_STORY = 'SEE_STORY';

    public const ACTION_LIST = [
        self::ACTION_TIMELINE,
        self::ACTION_LIKE,
        self::ACTION_COMMENT,
        self::ACTION_COMMENT,
        self::ACTION_STORY,
        self::ACTION_SEE_STORY
    ];


    public const DEFAULT_STORY_SEE_COUNT = 5;
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
     * @param string $actionId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws InvalidInstagramActionType
     */
    public function setAction(InstagramAccount $account, string $actionType, string $actionId = '')
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

    public function doneAction(InstagramAction $action): void
    {
        $action->status = self::STATUS_DONE;
        $action->save();
    }

    /**
     * @param array $filter
     */
    public function flushActions(array $filter = []): void
    {
        if (empty($filter)) {
            $this->query->truncate();
        } else {
            $this->query->where($filter)->delete();
        }
    }

    public function likeActionDoesntExist(InstagramAccount $instagramAccount): bool
    {
        return $this->actionDoesntExist($instagramAccount, self::ACTION_LIKE);
    }

    public function likeActionExists(InstagramAccount $instagramAccount): bool
    {
        return $this->actionExist($instagramAccount, self::ACTION_LIKE);
    }

    public function getLikeAction(InstagramAccount $instagramAccount): InstagramAction
    {
        return $this->getAction($instagramAccount, self::ACTION_LIKE)->first();
    }

    public function seeStoryActionDoesntExist(InstagramAccount $instagramAccount): bool
    {
        return $this->actionDoesntExist($instagramAccount, self::ACTION_SEE_STORY);
    }

    public function seeStoryActionExists(InstagramAccount $instagramAccount): bool
    {
        return $this->actionExist($instagramAccount, self::ACTION_SEE_STORY);
    }

    public function getSeeStoryAction(InstagramAccount $instagramAccount): array
    {
        return $this->getAction($instagramAccount, self::ACTION_SEE_STORY)
            ->get()
            ->chunk(self::DEFAULT_STORY_SEE_COUNT);
    }

    private function actionDoesntExist(InstagramAccount $instagramAccount, string $actionType): bool
    {
        return $this->query->where([
            'account_id' => $instagramAccount->id,
            'action_type' => $actionType,
            'status' => self::STATUS_PENDING
        ])->doesntExist();
    }

    private function actionExist(InstagramAccount $instagramAccount, string $actionType): bool
    {
        return $this->query->where([
            'account_id' => $instagramAccount->id,
            'action_type' => $actionType,
            'status' => self::STATUS_PENDING
        ])->exists();
    }

    private function getAction(InstagramAccount $instagramAccount, string $actionType)
    {
        return $this->query->where([
            'account_id' => $instagramAccount->id,
            'action_type' => $actionType,
            'status' => self::STATUS_PENDING
        ]);
    }
}
