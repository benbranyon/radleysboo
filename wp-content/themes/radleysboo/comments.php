<?php if ( have_comments() ) : ?>

<div id="comments" class="comments-area">

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 34,
				) );
			?>
		</ol><!-- .comment-list -->
</div>
<?php endif;?>
<?php 


$comments_args = array(

        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',
        'title_reply'       => '',

);



comment_form($comments_args);
?>