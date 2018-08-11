<?php

function rainbowify($text, $saturation, $light) {
	$saturation /= 100;
	$light /= 100;
	$bbc = '';
	$html = '';

	// Don't count white-space characters in text length.
	$strlen = strlen($text);
	$chars = strlen(preg_replace('/\s+/', '', $text));

	// For each character in the string,
	$whitespace = 0;
	for ($x = 0; $x < $strlen; $x++) {

		// Leave white-space alone.
		if (preg_match('/^\s$/', $text[$x])) {
			$whitespace++;
			$bbc .= $text[$x];
			$html .= $text[$x];
		}

		// Colored character.
		else {
			$rgb = hsl2rgb(($x - $whitespace) / $chars, $saturation, $light);
			$hex = array();
			for ($y = 0; $y < 3; $y++) {
				array_push($hex, base_convert($rgb[$y], 10, 16));
				if (strlen($hex[$y]) == 1)
					$hex[$y] = '0' . $hex[$y];
			}
			$hex = '#' . implode('', $hex);
			$bbc .= '[color=' . $hex . ']' . htmlspecialchars($text[$x]) . '[/color]';
			$html .= '<span style="color: ' . $hex . ';">' . htmlspecialchars($text[$x]) . '</span>';
		}
	}
	return array($html, $bbc);
}

?>
