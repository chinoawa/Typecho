<!DOCTYPE HTML>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <div style="<?php if ($this->fields->cat_close_post == "on") { echo 'display:none;'; } ?>">
        <?php $this->need('parts/article.php'); ?>
    </div>
    <?php if ($this->fields->post_change_comment == "on"): ?>
        <?php $this->need('parts/weibo.php'); ?>
    <?php else: ?>
        <?php $this->need('parts/comments.php'); ?>
    <?php endif; ?>
</div>
<?php $this->need('parts/footer.php'); ?>