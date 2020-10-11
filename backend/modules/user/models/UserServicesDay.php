<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 12/9/2018
 * Time: 8:47 AM
 */

namespace backend\modules\user\models;


use yii2mod\enum\helpers\BaseEnum;

class UserServicesDay extends BaseEnum
{
    const Monday = 0;
    const Tuesday = 1;
    const Wednesday = 2;
    const Thursday = 3;
    const Friday = 4;
    const Saturday = 5;
    const Sunday = 6;

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
        self::Monday => 'Monday',
        self::Tuesday => 'Tuesday',
        self::Wednesday => 'Wednesday',
        self::Thursday => 'Thursday',
        self::Friday => 'Friday',
        self::Saturday => 'Saturday',
        self::Sunday => 'Sunday',
    ];
}