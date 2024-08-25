<?php
	// Exit if accessed directly.
	if ( !defined('ABSPATH') ) { exit; }

	$classNames = [
		"amokit-block-{$settings['blockUniqId']}",
		"amokit-accordion",
		"amokit-accordion-{$settings['style']}",
		"amokit-accordion-indicator-{$settings['iconAlignment']}"
	];
	$classes = implode(' ', $classNames);
	echo "<div class='" . esc_attr($classes) . "'>" . wp_kses_post($content) ."</div>";