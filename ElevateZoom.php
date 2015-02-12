<?php
/**
 * @link https://github.com/amilna/yii2-elevatezoom
 * @copyright Copyright (c) 2015 Amilna
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace amilna\elevatezoom;

use Yii;
use yii\helpers\Html;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * Usage example:
 * 
 * use amilna\elevatezoom\ElevateZoom;
 * 
 * echo ElevateZoom::widget([
 * 		'images'=>$images,
 *		'baseUrl'=>Yii::$app->urlManager->baseUrl.'/upload',
 *		'smallPrefix'=>'/.thumbs',
 *		'mediumPrefix'=>'',
 *	]);
 */
class ElevateZoom extends Widget
{    	
	public $images = null; // array of images (1 or 3 dimensions, if 1 dimensions then you should set baseUrl, smallPrefix and mediumPrefix) or activeDataProvider (if activeDataProvider you should set imageKey, smallKey and mediumKey)
	public $targetId = 'elevatezoom'; 
	public $css = null;   
	
	public $baseUrl = null;
	public $smallPrefix = null;
	public $mediumPrefix = null;
	
	public $imageKey = null;
	public $smallKey = null;
	public $mediumKey = null;
	
	public $options = [		
		'zoomType'=> "lens", 
		'containLensZoom'=> false,		
		'borderSize'=>0,
		'scrollZoom'=> true, 
		'gallery'=>'galez',		
		'cursor'=>'crosshair',			
	];
	
    private $bundle = null;

    public function init()
    {
        parent::init();
        $view = $this->getView();				
		
		$bundle = ElevateZoomAsset::register($view);
		$this->bundle = $bundle;
        if ($this->css == null) {
			//$view->registerCssFile("{$bundle->baseUrl}/css/style.css");
        }
        else
        {
			$view->registerCssFile("@web/{$this->css}");
		}
		
		$images = (is_object($this->images)?$this->images->getModels():$this->images);
			
		if (count($this->images) > 0)
        {																					
			echo '<div id="'.$this->targetId.'" class="elevatezoom">';
			$n = 0;	
			$thumb = '';
			$img = null;		
			foreach ($this->images as $i)
			{
				if (is_object($this->images))
				{
					$image = $i->$imageKey;	
					$small = $i->$smallKey;
					$medium = $i->$mediumKey;
				}
				else
				{
					if (is_array($i))
					{
						$image = $i['image'];	
						$small = $i['small'];
						$medium = $i['medium'];
					}
					else
					{
						$image = $i;	
						$small = str_replace($this->baseUrl,$this->baseUrl.$this->smallPrefix,$i);
						$medium = str_replace($this->baseUrl,$this->baseUrl.$this->mediumPrefix,$i);
					}
				}
				
				if ($n == 0)
				{
					echo Html::img($medium,["id"=>"elevatezoom-".$n,"data-zoom-image"=>$image,"style"=>"width:100%;"]);							
					$img = $i;
				}
				$thumb .= Html::a(Html::img($small,["class"=>"elevatethumb"]),"#",["class"=>"elevatezoom-gallery","data-zoom-image"=>$image,"data-image"=>$medium]);				
				$n += 1;
			}
			echo ($thumb != ""?"<div id='galez'>".$thumb."</div>":"").'</div>';						
			
			$script = "
			//var ez =   $('#elevatezoom-0').data('elevateZoom');
			//ez.swaptheimage(smallImage, largeImage); 
			
			$('#elevatezoom-0').elevateZoom(".json_encode($this->options).");
			" . PHP_EOL;
		

            $view->registerJs($script);
		}		               
        
    }
        
}
