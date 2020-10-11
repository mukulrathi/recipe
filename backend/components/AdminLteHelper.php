<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 10/10/17
 * Time: 11:34 AM
 */

namespace backend\components;

use Yii;
use dmstr\helpers\AdminLteHelper as BaseAdminLteHelper;

class AdminLteHelper extends BaseAdminLteHelper
{
    /**
     * It allows you to get the name of the css class.
     * You can add the appropriate class to the body tag for dynamic change the template's appearance.
     * Note: Use this fucntion only if you override the skin through configuration.
     * Otherwise you will not get the correct css class of body.
     *
     * @return string
     */
    public static function skinClass()
    {
        return 'skin-blue';
    }
}