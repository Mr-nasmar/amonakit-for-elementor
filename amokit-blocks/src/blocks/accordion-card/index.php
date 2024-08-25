<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

$card_classes = ['amokit-accordion-card'];
$settings['open'] && $card_classes[] = 'amokit-accordion-card-active';

add_filter('safe_style_css', function( $styles ) {
    $styles[] = 'display';
    return $styles;
});

ob_start();
?>
<div class="<?php echo esc_attr(implode(' ', $card_classes)); ?>">
	<div class="amo-accordion-card-header">
		<?php echo "<" . tag_escape($settings['titleTag']) ." class='amo-accordion-card-title'>" . esc_html($settings['title']) . "</" . tag_escape($settings['titleTag']) . ">"; ?>
		<div class="amo-accordion-card-indicator">
			<span class="inactive <?php echo esc_attr($settings['iconInActive']); ?>"></span>
			<span class="active <?php echo esc_attr($settings['iconActive']); ?>"></span>
		</div>
	</div>
	<div class="amo-accordion-card-body" style="<?php echo !$settings['open'] ? 'display: none;' : ''; ?>">
		<div class="amo-accordion-card-body-inner">
			<?php echo wp_kses_post($content); ?>
		</div>
	</div>
</div>
<?php
echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
?>