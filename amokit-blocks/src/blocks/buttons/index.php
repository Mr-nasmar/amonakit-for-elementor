<?php
	// Exit if accessed directly.
	if ( !defined('ABSPATH') ) { exit; }

	$classNames = [
		"amokit-block-{$settings['blockUniqId']}",
		"amokit-buttons",
		$settings['fullWidth'] ? "amokit-buttons-full-width" : "",
		$settings['stackBreakPoint'] && !empty($settings['stackBreakPoint']) ? "amokit-buttons-stack-{$settings['stackBreakPoint']}" : "",
		$settings['alignment'] && !empty($settings['alignment']) ? "amokit-buttons-{$settings['alignment']}" : "",
	];
	$classes = implode(' ', $classNames);
	echo "<div class='" . esc_attr(trim($classes)) . "'>" . wp_kses_post($content) ."</div>";