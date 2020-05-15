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
        <li><a class="corner-container-link" href="tel:<?php echo $phone; ?>"><span class="icon-phone"></span></a></li>
        <li><a class="corner-container-link" href="mailto:<?php echo $mail; ?>"><span class="icon-mail"></span></a></li>
        <li><a class="corner-container-link" href="<?php echo $map; ?>"><span class="icon-map"></span></a></li>
    </ul>
</div>