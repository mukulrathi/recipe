<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 9/10/17
 * Time: 4:41 PM
 */

namespace backend\modules\user\models;


use yii2mod\enum\helpers\BaseEnum;

class UserStatus extends BaseEnum
{
    const INACTIVE = 0;
    const ACTIVE = 1;
    const BLOCKED = 2;
    const SUSPENDED = 3;

    /**
     * @var string message category
     * You can set your own message category for translate the values in the $list property
     * Values in the $list property will be automatically translated in the function `listData()`
     */
    public static $messageCategory = 'app';

    /**
     * @var array
     */
    public static $list = [
        self::INACTIVE => 'Inactive',
        self::ACTIVE => 'Active',
        self::BLOCKED => 'Blocked',
        self::SUSPENDED => 'Suspended',
    ];
}