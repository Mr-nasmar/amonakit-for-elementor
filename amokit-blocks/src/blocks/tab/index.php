<?php
	// Exit if accessed directly.
	if ( !defined('ABSPATH') ) { exit; }

	$classNames = [
		"amokit-block-{$settings['blockUniqId']}",
		"amokit-tab",
		"amokit-tab-{$settings['style']}",
	];
	$classes = trim(implode(' ', $classNames));
	ob_start();
	?>
		<div class="<?php echo esc_attr($classes); ?>">
			<ul class='amo-tab-nav'>
				<?php 
					foreach ($settings['tabs'] as $key => $tab) {
						printf (
							'<li data-tab-target="%1$s" class="amo-tab-nav-item %2$s">
								%3$s
								%4$s
							</li>',
							esc_attr($key),
							$settings['activeTab'] === $key ? esc_attr('amokit-tab-nav-item-active') : '',
							$tab['icon'] && $tab['icon'] !== '' && !$settings['hideIcon'] ? "<span class='" . esc_attr($tab['icon']) . "'></span>" : null,
							esc_html($tab['label'])
						);
					}
				?>
			</ul>
			<div class='amo-tab-content'>
				<?php echo wp_kses_post($content); ?> 
			</div>
		</div>
	<?php
	echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
?>