<?php
/**
 * 页面
 * 
 * @package custom 
 * 
 **/
?>
<!DOCTYPE HTML>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <div id="cat_article_start">
        <div class="cat_grid">
            <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
                <?php while ($pages->next()): ?>
                    <?php if($pages->slug != "cat_user" &&
                             $pages->slug != "cat_statistic" && 
                             $pages->slug != "cat_diary" && 
                             $pages->slug != "cat_life" &&
                             $pages->slug != "cat_pages" &&
                             $pages->slug != "cat_links" &&
                             $pages->slug != "cat_guestbook"): ?>
                        <div class="friends_block">
                            <div class="box_out">
                                <a href="<?php echo $pages->permalink ?>">
                                    <div class="cat_indexcard_time cat_indexcard_time_1" style="font-size:1.2rem;"><?php echo ($pages->fields->post_icon ? (cat_have_emoji($pages->fields->post_icon)? '<span style="margin: -0.25rem;">' . $pages->fields->post_icon . '</span>' : '<i class="'.  $pages->fields->post_icon . '"></i>') : '<p>' . mb_substr($pages->title, 0, 1, 'utf-8') . '</p>' )?></div>
                                    <img style="height:14rem;" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($pages) ?>">
                                </a>
                                <a class="friends_post_title" style="padding: 1rem;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" href="<?php echo $pages->permalink ?>"><?php echo $pages->title(); ?></a>
                                <div class="friends_post_post" style="height: 8.75rem;"><?php echo get_Abstract($pages); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>    
                <?php endwhile; ?>
            </div>
    </div>
</div>
<?php $this->need('parts/footer.php'); ?>