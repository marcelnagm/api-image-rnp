<?php

require 'vendor/autoload.php';

use Symfony\Component\BrowserKit\HttpBrowser;

$client = new HttpBrowser();

$url = 'https://panorama.rnp.br/panorama';
$crawler = $client->request('GET', $url);

// dd($crawler->images());

$images = $crawler->filter('img')->images();
// var_dump($images);
foreach ($images as $image) {
    
    $data = $image->getNode()->getAttribute('src');

    list($type, $data) = explode(';', $data);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    file_put_contents('./image.png', $data);
}

$im = imagecreatefrompng('./image.png');
$size = min(imagesx($im), imagesy($im));
$im2 = imagecrop($im, ['x' => 600, 'y' => 0, 'width' => 300, 'height' => 200]);
if ($im2 !== FALSE) {
    imagepng($im2, './image-cropped.png');
    imagedestroy($im2);
}
imagedestroy($im);

$colorok = '10079282';
$colorok_ven = '1251590';
// image
$im = imagecreatefrompng('./image-cropped.png');
// dd(imagecolorat($im,195,82));
$imageData = file_get_contents('./image-cropped.png');
$base64Image = base64_encode($imageData);
$json = json_encode([
'#AM => RR' => (imagecolorat($im,95,82)  != '10079282'),
'#RR <= AM' => (imagecolorat($im,195,82)   != '10079282'),
'RR => VEN' => (imagecolorat($im,244,82)   != '1251590'),
'img' => $base64Image
]);


?>
<!-- <img src='./image-cropped.png'> -->
<?php echo $json;?>