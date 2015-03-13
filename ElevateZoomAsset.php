<?php
/**
 * @link https://github.com/amilna/yii2-elevatezoom
 * @copyright Copyright (c) 2015 Amilna
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace amilna\elevatezoom;

use Yii;
use yii\web\AssetBundle;

class ElevateZoomAsset extends AssetBundle
{
    public $sourcePath = '@amilna/elevatezoom/assets';
	
	public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
	
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        parent::init();

        $this->js[] = YII_DEBUG ? 'js/jquery.elevatezoom.js' : 'js/jquery.elevateZoom-3.0.8.min.js';               
    }    
}
