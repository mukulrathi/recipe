<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 12/9/2018
 * Time: 8:47 AM
 */

namespace backend\modules\user\models;


use yii2mod\enum\helpers\BaseEnum;

class UserServices extends BaseEnum
{
    const WASHING = 0;
    const SERVICE = 1;
    const CAR = 2;
    const BIKE = 3;

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
        self::WASHING => 'Washing',
        self::SERVICE => 'Service',
        self::CAR => 'Car',
        self::BIKE => 'Bike',
    ];
}