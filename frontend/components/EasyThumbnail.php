<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 12/2/2018
 * Time: 7:19 PM
 */

namespace frontend\components;


use himiklab\thumbnail\EasyThumbnail as BaseEasyThumbnail;

class EasyThumbnail extends BaseEasyThumbnail
{

    const GRABBER_PHP = 1;
    const GRABBER_CURL = 2;

    /** @var string $cacheAlias path alias relative with @web where the cache files are kept */
    public $cacheAlias = 'assets/thumbnails';
    public $uploadsAlias = 'assets/thumbnails';
    public $defaultImage = 'default.png';

    /** @var integer $cacheExpire seconds */
    public $cacheExpire = 0;

    /** @var integer */
    public $grabberType = self::GRABBER_PHP;

    public function init()
    {
        EasyThumbnailImage::$cacheAlias = $this->cacheAlias;
        EasyThumbnailImage::$cacheExpire = $this->cacheExpire;
        EasyThumbnailImage::$uploadsAlias = $this->uploadsAlias;
        EasyThumbnailImage::$defaultImage = $this->defaultImage;
        EasyThumbnailImage::$grabberType = $this->grabberType;
    }
}