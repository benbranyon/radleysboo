<?php 
$comments_args = array(

        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',
        'title_reply'       => '',

);

comment_form($comments_args);

wp_list_comments();
?>