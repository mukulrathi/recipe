<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 9/10/17
 * Time: 1:20 PM
 */

namespace backend\models;

use Yii;
use yii\base\Model;

class SiteConfiguration extends Model
{
    /**
     * @var string application name
     */
    public $appName;

    /**
     * @var string admin email
     */
    public $adminEmail;

    /**
     * @var string admin dashboard template
     */
    public $adminTheme;

    /**
     * @var string google autocomplete api key
     */
    public $googleAutocompleteApiKey;

    /**
     * @var boolean
     */
    public $loginAfterEmailVerification;

    /**
     * @var boolean
     */
    public $enableProfileApproval;

    public $copyrightYear;

    public $seoKeywords;

    public $seoDescription;

    public $seoContactDescription;

    public $projectAdSenseCode;

    public $googleAnalyticsCode;

    public $enableRobots;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appName', 'adminEmail', 'googleAutocompleteApiKey'], 'required'],
            ['copyrightYear', 'integer'],
            ['adminTheme', 'in', 'range' => AdminTemplate::getConstantsByName()],
            ['googleAutocompleteApiKey', 'string'],
            [['loginAfterEmailVerification', 'enableProfileApproval', 'enableRobots'], 'boolean'],
            [['seoKeywords', 'seoDescription', 'seoContactDescription'], 'string'],
            ['projectAdSenseCode', 'string', 'skipOnEmpty' => true],
            ['googleAnalyticsCode', 'string', 'skipOnEmpty' => true]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'appName' => Yii::t('app', 'Application Name'),
            'adminEmail' => Yii::t('app', 'Admin Email'),
            'adminTheme' => Yii::t('app', 'Admin Theme'),
            'googleAutocompleteApiKey' => Yii::t('app', 'Google Autocomplete API Key'),
            'loginAfterEmailVerification' => Yii::t('app', 'Login after email verification'),
            'enableProfileApproval' => Yii::t('app', 'Enable Profile Approval'),
            'copyrightYear' => Yii::t('app', 'Copyright Year'),
        ];
    }
}