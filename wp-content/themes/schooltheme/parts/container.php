<?php
$enable_top_arrow = esc_attr(get_option( 'bc_enable_to_top_arrow' ));
$mail = esc_attr(get_option( 'contact_settings_mail' ));
$phone = esc_attr(get_option( 'contact_settings_phone' ));
$map = esc_attr(get_option( 'contact_settings_map' ));
?>

<?php if ($enable_top_arrow === "on") { ?>
<div class="top-arrow-container">
    <span class="icon-arrowsingle"></span>
</div>
<?php } ?>

<div class="corner-container js--sidecontainer">
    <span class="corner-container-toggle icon-info-circle"></span>
    <ul class="sidecontainer-list">
        <a class="corner-container-link" href="tel:<?php echo $phone; ?>"><li><span class="icon-phone"></span></li></a>
        <a class="corner-container-link" href="mailto:<?php echo $mail; ?>"><li><span class="icon-mail"></span></li></a>
        <a class="corner-container-link" href="<?php echo $map; ?>"><li><span class="icon-map"></span></li></a>
    </ul>
</div>