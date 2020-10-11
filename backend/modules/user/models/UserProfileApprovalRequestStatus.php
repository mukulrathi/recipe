<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 4/10/17
 * Time: 10:37 PM
 */

namespace backend\modules\user\models;


use yii2mod\enum\helpers\BaseEnum;

class UserProfileApprovalRequestStatus extends BaseEnum
{
    const PENDING = 0;
    const UNDER_REVIEW = 1;
    const APPROVED = 2;
    const REJECTED = 3;

    public static $list = [
        self::PENDING => 'Pending',
        self::UNDER_REVIEW => 'Under Review',
        self::APPROVED => 'Approved',
        self::REJECTED => 'Rejected',
    ];
}