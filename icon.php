<?php /* 60 Lines */

// SETTINGS
$cssClassOrTagName = '.icon.';
$cssClassOrTagEnd  = '';


// MAIN
$css = '/*

CSS Ion Icons
=================

> v1.0.0 (2020-05-14)

__Download [Feather Icons](https://github.com/ionic-team/ionicons) 
and run `icon.php` on e.g. localhost. 
It will read SVG icons from the folder `ion` and build css from it.
Now you can use the `ion.css` without the SVG Icons!__

*HINT: Only SVGs that don\'t use style="" tag can be converted!

License
-------

Licensed under the MIT License.

The icons that are used in this code are from ionicons.com

They are also licensed under the MIT License.

© 2020 [phpSoftware](https://github.com/phpSoftware/CSS-Ion-Icons)

*/
'.PHP_EOL.rtrim($cssClassOrTagName,'. [').' {
  display: inline-block;
  height: 64px;
  width: 64px;
  vertical-align: -0.125px;
  background-size: contain;'.PHP_EOL.'}'.PHP_EOL;
$html = '';
$counter = 0;
foreach (glob("ion/*.svg") as $file) {
  ++$counter;
  $svg = file_get_contents($file);
  $svg = str_replace ("\n", '', rtrim($svg));  
  if (strpos($svg, ' style="') > 0) { --$counter; continue; } // SKIP ALL SVGs WITH style=""
  $svg = preg_replace('/<title>([^<].*)<\/title>/', '', $svg);
  $svg = str_replace(array('<','"','>'), array('%3C',"'",'%3E'), $svg);
  $name = str_replace(array('ion/','.svg'), array('',''), $file);
  $css .= PHP_EOL.$cssClassOrTagName.$name.$cssClassOrTagEnd.' {
  background-image: url("data:image/svg+xml,'.$svg.'");'.PHP_EOL.'}'.PHP_EOL;
  $html .= "<i class='icon {$name}' title='{$name}'></i>";  
}
file_put_contents('Ion.css', $css);
$header = '<!DOCTYPE HTML><html><head><meta charset="UTF-8"><title>Ion Icons CSS Test</title>'.
          '<link href="Ion.css" rel="stylesheet"></head><body><tt><h1>'.$counter.' Ion Icons CSS Test</h1>';
file_put_contents('test.htm', $header.$html);
echo '<b>'.$counter.' Ion Icons CSS is ready, <a target="test" style="color:firebrick" href="test.htm">test it</a>!';
