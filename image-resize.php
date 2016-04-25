// another attempt to resize, final maybe, by nabtron, instead of crappy timthumb
/* usage:
nabimgresize($imageURL, $width, $height, $crop = false);
Height can be left null to change height proportional to width.
$headerImage = nabimgresize(get_theme_mod('header_image'), 200, null);
*/
function nabimgresize($imageURL, $width, $height, $crop = false) {
	$imageBase = str_replace(basename($imageURL), '', $imageURL);
	$imageURLParts = parse_url($imageURL);
	$imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageURLParts['path'];
	if (!is_file($imagePath))
		return false;
	$originalSize = getimagesize($imagePath);
	if ($originalSize[0] <= $width)
		return $imageURL;
	if (!$height)
		$height = round($originalSize[1] / $originalSize[0] * $width);
	$pathInfo = pathinfo($imagePath);
	$resizedImageFileName = $pathInfo['filename'] . '-' . $width . '-' . $height . '.' . $pathInfo['extension'];
	$resizedImageURL = $imageBase . $resizedImageFileName;
	$resizedImagePath = $pathInfo['dirname'] . '/' . $resizedImageFileName;
	if (is_file($resizedImagePath))
		return $resizedImageURL;
	$editor = wp_get_image_editor($imagePath);
	if (is_wp_error($editor))
		return false;
	$editor->resize($width, $height, $crop ? array('center', 'center') : false);
	$editor->save($resizedImagePath);
	return $resizedImageURL;
}
