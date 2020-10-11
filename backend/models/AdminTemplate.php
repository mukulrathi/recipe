<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 9/10/17
 * Time: 5:44 PM
 */

namespace backend\models;


use yii2mod\enum\helpers\BaseEnum;

class AdminTemplate extends BaseEnum
{
    const SKIN_BLUE = "skin-blue";
    const SKIN_BLACK = "skin-black";
    const SKIN_RED = "skin-red";
    const SKIN_YELLOW = "skin-yellow";
    const SKIN_PURPLE = "skin-purple";
    const SKIN_GREEN = "skin-green";
    const SKIN_BLUE_LIGHT = "skin-blue-light";
    const SKIN_BLACK_LIGHT = "skin-black-light";
    const SKIN_RED_LIGHT = "skin-red-light";
    const SKIN_YELLOW_LIGHT = "skin-yellow-light";
    const SKIN_PURPLE_LIGHT = "skin-purple-light";
    const SKIN_GREEN_LIGHT = "skin-green-light";

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
        self::SKIN_BLUE => 'Blue',
        self::SKIN_BLACK => 'Black',
        self::SKIN_RED => 'Red',
        self::SKIN_YELLOW => 'Yellow',
        self::SKIN_PURPLE => 'Purple',
        self::SKIN_GREEN => 'Green',
        self::SKIN_BLUE_LIGHT => 'Blue Light',
        self::SKIN_BLACK_LIGHT => 'Black Light',
        self::SKIN_RED_LIGHT => 'Red Light',
        self::SKIN_YELLOW_LIGHT => 'Yellow Light',
        self::SKIN_PURPLE_LIGHT => 'Purple Light',
        self::SKIN_GREEN_LIGHT => 'Green Light',
    ];
}