<?php
/*
Template Name: Such Formular
*/
?>
<form class="bc-search--form" role="search" method="get" action="<?php echo home_url('/'); ?>">
    <input type="search" class="bc-search--box cleaned-input" placeholder="Suchen ..." value="<?php echo get_search_query(); ?>" name="s" title="Search"/>
    <button class="btn search-button"><span class="icon-search"></span></button>
</form>