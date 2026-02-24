<?php
/**
 * 留言板
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
        <?php if ($this->options->cat_Guestbook_top30 == "on") : ?>   
            <div class="cat_index_visitors_top3">
                <?php
                $period = time() - 999592000;
                $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                    ->select('COUNT(author) AS cnt', 'author', 'authorId', 'mail','url')
                    ->from('table.comments')
                    ->where('created > ?', $period)
                    ->where('status = ?', 'approved')
                    ->where('type = ?', 'comment')
                    ->group('author,authorId,mail')
                    ->order('cnt', Typecho_Db::SORT_DESC)
                    ->limit('4')
                );
                $mostactive = '';
                foreach (array_reverse($counts) as $i => $count) {
                    if ($count['authorId'] == '0') { 
                    ?>
                    <div class="friends_block flex_block_add">
                        <div class="box_out">
                            <div style="position: absolute;backdrop-filter: blur(1rem);border-radius: var(--radius) 0;padding: 0 0.5rem;color: var(--color-white);z-index: 1;font-size: 1.5rem;background: <?php if ($i == 2): ?>rgb(255 215 0 / 70%)<?php elseif ($i == 1): ?>rgb(192 192 192 / 70%)<?php elseif ($i == 0): ?>rgb(184 115 50 / 70%)<?php else: ?><?php endif; ?>;">
                                <?php if ($i == 2): ?>1<?php elseif ($i == 1): ?>2<?php elseif ($i == 0): ?>3<?php else: ?><?php endif; ?>
                            </div>
                            <div class="cat_indexcard_time cat_indexcard_time_2">累计评论 <?php echo $count['cnt'] ?> 次</div>
                            <?php  
                                $urlDB = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                    ->select('url')
                                    ->from('table.comments')
                                    ->where('mail = ?', $count['mail'])
                                    ->where('status = ?', 'approved')
                                    ->where('type = ?', 'comment')
                                    ->order('created', Typecho_Db::SORT_DESC)
                                    ->limit('1')
                                );
                            ?>
                            <?php if($urlDB[0]['url']):?>
                                <img class="lazyload box_img" style="max-height:14rem;" src="<?php echo get_Lazyload() ?>" data-src="https://s0.wp.com/mshots/v1/<?php echo $urlDB[0]['url']; ?>?w=400&amp;h=270">
                            <?php else:?>
                                <img class="lazyload box_img" style="max-height:14rem;" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_random_Thumbnail($this) ?>">
                            <?php endif; ?>
                            <div class="box_avatar">
                                <div class="box_avatar_left author-infos">
                                    <img style="background: #fff;margin-top: -0.75rem;" class="head_avatar avatar lazyload" src="<?php get_AvatarLazyload() ?>" data-src="<?php echo get_AvatarByMail($count['mail']) ?>" width="50px" height="50px">
                                </div>
                                <div class="box_avatar_right">
                                    <a target="_blank" rel='noopener noreferrer nofollow' href="<?php echo $urlDB[0]['url'] ?>"><?php echo $count['author'] ?></a>
                        		    <div class="animetags">
                            		    <?php cat_comment_levelcard($count['mail']) ?>
                            		    <?php cat_comment_friendcard_nocat($count['mail']) ?>
                            		    <li title="评论 <?php echo $count['cnt'] ?> 次" class="animeinfo"><?php echo $count['cnt'] ?></li>
                            		</div>
                                </div>
                            </div>
                        </div>
                   </div>
                <?php } } ?>
            </div>
            <div class="cat_index_visitors_others">
                <div class="cat_index_visitors">
                    <?php
                    $period = time() - 999592000;
                    $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                        ->select('COUNT(author) AS cnt', 'author', 'authorId', 'mail', 'url')
                        ->from('table.comments')
                        ->where('created > ?', $period)
                        ->where('status = ?', 'approved')
                        ->where('type = ?', 'comment')
                        ->group('author,authorId,mail')
                        ->order('cnt', Typecho_Db::SORT_DESC)
                        ->limit('31')
                    );
                    $mostactive = '';
                    foreach ($counts as $i => $count) {
                        if ($count['authorId'] == '0' && $i> 3) { 
                        ?>
                        <div class="friends_block" style="padding: 0.5rem;">
                            <div style="display: flex;">
                        		<img class="head_avatar avatar lazyload" data-src="<?php echo get_AvatarByMail($count['mail']) ?>" src="<?php get_AvatarLazyload() ?>">
                        		<div class="num"><?php echo $i; ?></div>
                        		<ul style="margin: 0 1rem;">
                        		    <li title="<?php echo $count['author'] ?>" class="visitor_name">
                        		        <a target="_blank" rel='noopener noreferrer nofollow' href="<?php echo $count['url'] ?>"><?php echo $count['author'] ?></a>
                            		</li>
                        		    <div class="animetags">
                            		    <?php cat_comment_levelcard($count['mail']) ?>
                            		    <?php cat_comment_friendcard_nocat($count['mail']) ?>
                        		        <li title="评论 <?php echo $count['cnt'] ?> 次" class="animeinfo"><?php echo $count['cnt'] ?></li>
                            		</div>
                        		</ul>
                        	</div>
                        </div>
                        <?php }
                    }
                    ?>
                </div>
            </div>
            <div class="cat_index_visitors_moreusers"><i class="ri-arrow-down-line"></i> top30</div>
        <?php endif; ?>
        <div style="<?php if ($this->fields->cat_close_post == "on") { echo 'display:none;'; } ?>">
            <?php $this->need('parts/article.php'); ?>
        </div>
        <?php $this->need('parts/comments.php'); ?>
    </div>
</div>
<?php $this->need('parts/footer.php'); ?>