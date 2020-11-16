<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="qodef-tags-holder">
    <div class="qodef-tags">
        <?php the_tags('', ' ', ''); ?>
    </div>
</div>
<?php } ?>