<?php if(comments_open()) { ?>
	<div class="qodef-post-info-comments-holder">
		<a itemprop="url" class="qodef-post-info-comments" href="<?php comments_link(); ?>" target="_self">
			<span class="lnr lnr-bubble comment-icon"></span><?php comments_number('0 ', '1 ', '% '); ?>
		</a>
	</div>
<?php } ?>