<?php
if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) :
	die('Die Datei "comments.php" kann nicht direkt aufgerufen werden.');
endif;

?>
<div class="comment-container container-fluid">
    <div class="row">
    <?php
    if ( post_password_required() ) : ?>
        <p class="nopassword col-12"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyeleven' ); ?></p>
        <?php return; endif; ?>

        <h2 class="comments-headline col-12" id="comments"><?php comments_number('Keine Kommentare', 'Kommentare: <span>1</span>', 'Kommentare: <span>%</span>'); ?></h2>
        
        <?php if ( $comments ) : ?>
        <ul id="commentlist" class="col-12 commentlist">
            <?php foreach ($comments as $comment) : ?>
            <li id="comment-<?php comment_ID(); ?>">
                    <?php comment_text(); ?>
            <p><cite><?php comment_type('Kommentar', 'Trackback', 'Pingback'); ?> von <?php comment_author_link(); ?> - <?php comment_date(); ?> um <a href="#comment-<?php comment_ID(); ?>"><?php comment_time(); ?></a></cite> <?php edit_comment_link(); ?></p>
                    </li>
            
            <?php endforeach; ?>
        </ul>
        
        <?php else : // Es wurden noch keine Kommentare abgegeben ?>
        <p class="nocommentset col-12">Bis jetzt noch keine Kommentare</p>
        <?php endif; ?>
        
        <p class="commentrssfeed col-12"><?php post_comments_feed_link('RSS-Feed für Kommentare dieses Beitrags'); ?>
            <?php if ( pings_open() ) : ?>
            - <a href="<?php trackback_url(); ?>" rel="trackback">Die Trackback-Adresse</a>
            <?php endif; ?>
        </p>
        
        <?php if ( comments_open() ) : ?>
        <h3 class="col-12" id="postcomment">Einen Kommentar abgeben</h3>
        
        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p class="col-12"><?php printf('Du musst dich <a href="%s">eingeloggen</a> um Kommentare abzugeben.', get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
        <?php else : ?>

        <form class="col-12" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
            <?php if ( $user_ID ) : ?>
                <p><?php printf('Angemeldet als %s - ', '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Ausloggen bzw. Abmelden">Abmelden</a></p>
            <?php else : ?>
                <p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
                <label for="author"><small>Name <?php if ($req) '(erforderlich)'; ?></small></label></p>

                <p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
                <label for="email"><small>E-Mail (wird nicht veröffentlicht) <?php if ($req) '(erforderlich)'; ?></small></label></p>

                <p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
                <label for="url"><small>Website</small></label></p>

                <?php endif; ?>

                <p><textarea name="comment" id="comment" cols="55" rows="5" tabindex="4"></textarea></p>

                <p><input class="btn comment-send-button" name="submit" type="submit" id="submit" tabindex="5" value="<?php echo esc_attr(__('Kommentar senden')); ?>" />
                <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
                </p>
                <?php do_action('comment_form', $post->ID); ?>
        </form>
            
    <?php endif; // Ende: wenn Registrierung erforderlich, aber man nicht eingeloggt ist ?>
    
    <?php else : // Kommentare sind geschlossen ?>
    <p class="col-12">Tut mir Leid, aber die Kommentar-Funktion ist momentan deaktiviert.</p>
    <?php endif; ?>
    </div>
 </div>