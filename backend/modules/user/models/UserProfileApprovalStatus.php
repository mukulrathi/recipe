<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 4/10/17
 * Time: 10:37 PM
 */

namespace backend\modules\user\models;


use yii2mod\enum\helpers\BaseEnum;

class UserProfileApprovalStatus extends BaseEnum
{
    const PENDING = 0;
    const APPROVED = 1;
    const REJECTED = 2;
    const UNDER_REVIEW = 3;

    public static $list = [
        self::PENDING => 'Pending',
        self::APPROVED => 'Approved',
        self::REJECTED => 'Rejected',
        self::UNDER_REVIEW => 'Under Review',
    ];
}