<?php

include 'constants/hsl2rgb.php';
include 'constants/rainbowify.php';

$light = array_key_exists('light', $_POST) &&
	preg_match('/^\d{1,3}$/', $_POST['light']) &&
	$_POST['light'] <= 100 ?
	$_POST['light'] :
	50;

$saturation = array_key_exists('saturation', $_POST) &&
	preg_match('/^\d{1,3}$/', $_POST['saturation']) &&
	$_POST['saturation'] <= 100 ?
	$_POST['saturation'] :
	100;

$light_gray = round(255 * $light / 100);
$bw = $light_gray <= 128 ? '#101010' : '#f0f0f0';
$bw_inverse = $light_gray <= 128 ? '#f0f0f0' : '#101010';
$light_gray = 'rgb(' . $light_gray . ', ' . $light_gray . ', ' . $light_gray . ')';

if (
	array_key_exists('text', $_POST) &&
	!preg_match('/^\s*$/', $_POST['text'])
) {
	$text = $_POST['text'];
	$rainbow = rainbowify($text, $saturation, $light);
	$html = $rainbow[0];
	$bbc = $rainbow[1];
}
else {
	$html = false;
	$bbc = false;
	$text = '';
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Rainbow Text Generator</title>
		<link rel="stylesheet" media="all" type="text/css" href="index.css" />
		<meta name="description" content="Generate rainbow-colored text in HTML or BB code for forums!" />
		<meta name="keywords" content="rainbow color text generator, rainbow text for forums, rainbow text generator, rainbow text html, rainbow text maker, rainbowify, rainbowify text" />
	</head>
	<body>
<?php

if ($html) {

?>
		<section id="your-text">
			<h2>Your Rainbow Text</h2>
			<blockquote style="background-color: <?php echo $bw_inverse; ?>; border-color: <?php echo $bw; ?>;">
				<?php echo nl2br($html); ?>
			</blockquote>
			<h3>HTML:</h3>
			<div><textarea rows="7"><?php echo htmlspecialchars($html); ?></textarea></div>
			<h3><abbr title="Bulletin Board">BB</abbr> Code:</h3>
			<div><textarea rows="7"><?php echo $bbc; ?></textarea></div>
		</section>
<?php

}

else {

?>
		<section>
			<h2>About</h2>
			<p>&quot;Rainbowify&quot; your text with this rainbow text generator. Turn your <em>black and white text</em> into <strong><?php echo rainbowify('rainbow-colored text', 100, 50)[0]; ?></strong>!</p>
		</section>
<?php

}

?>
		<section>
			<h2>Settings</h2>
			<form action="rainbow-text" method="post">
				<div>
					<label for="saturation">Saturation</label>
					<input id="saturation" name="saturation" type="range" value="<?php echo $saturation; ?>" />
					<label for="light">Lightness</label>
					<div id="light-slider">
						<input id="light" name="light" type="range" value="<?php echo $light; ?>" />
						<div>
							<div style="background-color: <?php echo $light_gray; ?>;"><?php echo $light; ?>%</div>
						</div>
					</div>
					<label for="text">Text</label>
					<textarea id="text" name="text" rows="5"><?php echo htmlspecialchars($text); ?></textarea>
				</div>
				<input class="raised-button" type="submit" value="Rainbowify!" />
			</form>
		</section>
		<script type="text/javascript" src="index.js"></script>
	</body>
</html>
