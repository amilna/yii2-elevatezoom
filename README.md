Elevate Zoom Widget for Yii2
========================
An elevate zoom widget for Yii2 based on [Elevate Zoom](http://www.elevateweb.co.uk/image-zoom).

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require "amilna/yii2-elevatezoom" "*"
```

or add

```json
"amilna/yii2-elevatezoom" : "*"
```
to the require section of your application's `composer.json` file.

Usage
-----

in View

```
	use amilna\elevatezoom\ElevateZoom;
 	
	$images = ['an url of zoom image 1','an url of zoom image n'];

	/* //or another exmple set 'images' with 3 dimension array:
	$images'= [
		[	
			'image'=>'an url of zoom image 1',
			'small'=>'an url of gallery display image 1',
			'medium'=>'an url of basic display image 1'
		],
		[	
			'image'=>'an url of zoom image n',
			'small'=>'an url of gallery display image n',
			'medium'=>'an url of basic display image n'
		],
	];
	*/

	echo ElevateZoom::widget([
 		'images'=>$images,
		'baseUrl'=>Yii::$app->urlManager->baseUrl.'/upload',
		'smallPrefix'=>'/.thumbs',
		'mediumPrefix'=>'',
	]);
```

'images' is array of images (1 or 3 dimensions, if 1 dimensions then you should set baseUrl, smallPrefix and mediumPrefix) or activeDataProvider (if activeDataProvider you should set imageKey, smallKey and mediumKey)

available options:

1. images
2. css   
3. baseUrl
4. smallPrefix
5. mediumPrefix
6. imageKey
7. smallKey
8. mediumKey
9. targetId
