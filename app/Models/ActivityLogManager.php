<?php

namespace App\Models;

use App\Models\DB;
use App\Models\Entity;
use App\Helpers\Helper;

class ActivityLogManager
{
    public static function map(DB\ActivityLog $activityLogData)
    {
        $activityLog = new Entity\ActivityLog();
        $activityLog->setId($activityLogData->id);
        $activityLog->setGroupId($activityLogData->groupId);
        $activityLog->setUserId($activityLogData->userId);
        $activityLog->setAction($activityLogData->action);
        $activityLog->setItemId($activityLogData->itemId);
        $activityLog->setMessage($activityLogData->message);
        $activityLog->setRelatedTable($activityLogData->reletadTable);

        if ($activityLogData->relationLoaded('group') && !empty($activityLogData->group)) {
            $activityLog->setGroup(GroupManager::multiMap($activityLogData->group));
        }

        if ($activityLogData->relationLoaded('user') && !empty($activityLogData->user)) {
            $activityLog->setUser(UserManager::multiMap($activityLogData->user));
        }

        return $activityLog;
    }

    public static function multiMap($activityLogs)
    {
        $activityLogList = [];
        foreach ($activityLogs as $activityLog) {
            $activityLogList[] = self::map($activityLog);
        }

        return $activityLogList;
    }

    public static function save($activityLog)
    {
        $model = new DB\ActivityLog();
        $model->id = $activityLog['id'];
        $model->group_id = $activityLog['groupId'];
        $model->user_id = $activityLog['userId'];
        $model->action = $activityLog['action'];
        $model->item_id = $activityLog['itemId'];
        $model->message = $activityLog['message'];
        $model->related_table = $activityLog['relatedTable'];

        return $model->save();
    }
}
