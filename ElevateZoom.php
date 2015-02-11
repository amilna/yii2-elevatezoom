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
 * 
 */
class ElevateZoom extends Widget
{    	
	public $images = [];
	public $targetId = 'elevatezoom'; 
	public $css = null;   
    private $bundle = null;

    public function init()
    {
        parent::init();
        $view = $this->getView();				
		
		$bundle = ElevateZoomAsset::register($view);
		$this->bundle = $bundle;
        if ($this->css == null) {
			$view->registerCssFile("{$bundle->baseUrl}/css/style.css");
        }
        else
        {
			$view->registerCssFile("@web/{$this->css}");
		}
			
		if (count($this->images) > 0)
        {																					
			echo '<div id="'.$this->targetId.'" class="elevatezoom">';
			$n = 0;	
			$thumb = '';
			$img = null;		
			foreach ($this->images as $i)
			{
				if ($n == 0)
				{
					echo Html::img($i,["id"=>"elevatezoom-".$n,"data-zoom-image"=>str_replace("/upload/","/upload/.zoom/",$i)]);							
					$img = $i;
				}
				$thumb .= Html::a(Html::img(str_replace("/upload/","/upload/.thumbs/",$i),["class"=>"elevatethumb"]),"#",["class"=>"elevatezoom-gallery","data-zoom-image"=>str_replace("/upload/","/upload/.zoom/",$i),"data-image"=>$i]);				
				$n += 1;
			}
			echo ($thumb != ""?"<div id='galez'>".$thumb."</div>":"").'</div>';						
			
			$script = "
			//var ez =   $('#elevatezoom-0').data('elevateZoom');
			//ez.swaptheimage(smallImage, largeImage); 
			
			$('#elevatezoom-0').elevateZoom({
				gallery	: 'galez',
				tint: true,
				cursor:'crosshair',	
				windowHeight:600		
			});
			" . PHP_EOL;
		

            $view->registerJs($script);
		}		               
        
    }
        
}
