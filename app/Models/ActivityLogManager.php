<?php

namespace App\Models;

use App\Models\DB\ActivityLog;
use App\Models\DB\Activity;
use App\Models\Entity;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class ActivityLogManager
{
    public static function map(ActivityLog $activityLogData)
    {
        $activityLog = new Entity\ActivityLog();
        $activityLog->setId($activityLogData->id);
        $activityLog->setGroupId($activityLogData->group_id);
        $activityLog->setUserId($activityLogData->user_id);
        $activityLog->setActivityId($activityLogData->activity_id);
        $activityLog->setHelperId($activityLogData->helper_id);
        $activityLog->setContent($activityLogData->content);

        if ($activityLogData->relationLoaded('group') && !empty($activityLogData->group)) {
            $activityLog->setGroup(GroupManager::multiMap($activityLogData->group));
        }

        if ($activityLogData->relationLoaded('user') && !empty($activityLogData->user)) {
            $activityLog->setUser(UserManager::multiMap($activityLogData->user));
        }
        
        if ($activityLogData->relationLoaded('activity') && !empty($activityLogData->activity)) {
            $activityLog->setActivity(self::activityMap($activityLogData->activity));
        }

        return $activityLog;
    }

    public static function activityMap(Activity $activityData)
    {
        $activity = new Entity\Activity();
        $activity->setId($activityData->id);
        $activity->setName($activityData->name);
        $activity->setTable($activityData->table);

        return $activity;
    }

    public static function multiMap($activityLogs)
    {
        $activityLogList = [];
        foreach ($activityLogs as $activityLog) {
            $activityLogList[] = self::map($activityLog);
        }

        return $activityLogList;
    }

    public static function getActivityLogsByGroupId($groupId)
    {
        $activityLogs = ActivityLog::with('activity')->whereIn('group_id', $groupId)->orderBy('created_at', 'desc')->get();
        return self::multiMap($activityLogs);
    }

    public static function getActivityLogsByUserId($userId)
    {
        $activityLogs = ActivityLog::with('activity')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return self::multiMap($activityLogs);
    }

    public static function save($activityLog)
    {
        $model = new ActivityLog();
        $model->id = $activityLog['id'];
        $model->group_id = $activityLog['groupId'];
        $model->user_id = $activityLog['userId'];
        $model->activity_id = $activityLog['activityId'];
        $model->helper_id = $activityLog['helperId'];
        $model->content = json_encode($activityLog['content']);

        return $model->save();
    }

    public static function getActivity($name, $table)
    {
        $activity = DB::table('activity')->where('name', $name)->where('table', $table)->first();

        if (!empty($activity)) {
            return $activity->id;
        }
    }
}
