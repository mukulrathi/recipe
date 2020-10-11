<?php
/**
 * Created by PhpStorm.
 * User: nomaan
 * Date: 23/1/18
 * Time: 9:42 PM
 */

namespace frontend\models;


use yii\base\Model;
use yii\web\UploadedFile;

class UpdateProfileForm extends Model
{
    public $username;

    public $emailAddress;

    public $firstName;

    public $lastName;

    public $about;

    public $mobile;

    public $address;

    public $city;

    public $state;

    public $country;

    public $latitude;

    public $longitude;

    public $placeId;

    public $postalCode;

    public $gender;

    /**
     * @var UploadedFile
     */
    public $avatar;

    public function rules()
    {
        return [
            [['firstName', 'lastName', 'address'], 'required', 'message' => '{attribute} is required.'],
            [['firstName', 'lastName'], 'string', 'max' => 64],
            [['address', 'city', 'state', 'country', 'latitude', 'longitude', 'placeId', 'postalCode', 'about'], 'string'],
            ['mobile', 'integer'],
            ['gender', 'in', 'range' => ['male', 'female']],
            ['avatar', 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1]
        ];
    }
}