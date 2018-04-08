<?php

namespace App\Models;

use App\Models\DB\ActivityLog as DBActivityLog;
use App\Models\Entity\ActivityLog as EntityActivityLog;
use App\Models\DB\Activity;
use App\Models\Entity;

class ActivityLogManager
{
    /**
     * @param $id
     * @return array
     */
    public static function getByGroupId($id)
    {
        $activityLogs = DBActivityLog::with('activity')
            ->where('group_id', $id)
            ->orderByDesc('created_at')
            ->get();

        return self::multiMap($activityLogs);
    }

    /**
     * @param $groupIdList
     * @return array
     */
    public static function getByGroupIdList($groupIdList)
    {
        $activityLogs = DBActivityLog::with('activity')
            ->whereIn('group_id', $groupIdList)
            ->orderByDesc('created_at')
            ->get();

        return self::multiMap($activityLogs);
    }

    public static function getUserGroupsActivityLogs($userId)
    {
        $groupIdList = [];
        $groups = GroupUserManager::getGroupsByUserId($userId);
        foreach ($groups as $group) {
            $groupIdList[] = $group->getGroupId();
        }

        return self::getByGroupIdList($groupIdList);
    }

    /**
     * @param DBActivityLog $activityLogData
     * @return EntityActivityLog
     */
    public static function map(DBActivityLog $activityLogData)
    {
        $activityLog = new EntityActivityLog();
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

    /**
     * @param Activity $activityData
     * @return Entity\Activity
     */
    public static function activityMap(Activity $activityData)
    {
        $activity = new Entity\Activity();
        $activity->setId($activityData->id);
        $activity->setName($activityData->name);
        $activity->setTable($activityData->table);

        return $activity;
    }

    /**
     * @param $activityLogs
     * @return array
     */
    public static function multiMap($activityLogs)
    {
        $activityLogList = [];
        foreach ($activityLogs as $activityLog) {
            $activityLogList[] = self::map($activityLog);
        }

        return $activityLogList;
    }



    public static function getActivityLogsByUserId($userId)
    {
        $activityLogs = DBActivityLog::with('activity')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return self::multiMap($activityLogs);
    }

    public static function save($activityLog)
    {
        $model = new DBActivityLog();
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
        $activity = Activity::where('name', $name)
            ->where('table', $table)
            ->first();

        if (!empty($activity)) {
            return $activity->id;
        }
    }
}
