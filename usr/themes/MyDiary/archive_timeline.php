<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <link rel="stylesheet" href="<?php echo resource_cdn() . 'css/timeline.css' ?>" />
    <div id="cat_article_start">
    <?php if ($this->have()): ?>
        <div class="timeline">
            <?php while ($this->next()): ?>
		    <div class="timeline__item">
            	<div class="timeline__item__station"></div>
            	<div class="timeline__item__content friends_block">
                    <div class="box_out" style="<?php if ($this->fields->post_top_info_select == "album") : ?>width:100%;<?php elseif ($this->fields->post_top_info_select == "book" || $this->fields->post_top_info_select == "movie") : ?>width:auto;<?php endif; ?>">
                        <a href="<?php echo $this->permalink ?>">
                            <div class="cat_indexcard_time cat_indexcard_time_1">
                                <?php if ($this->fields->post_top_info_select == "album") : ?>
                                    <i class="ri-image-line"></i>
                                <?php elseif ($this->fields->post_top_info_select == "book") : ?>
                                    <i class="ri-book-3-line"></i>
                                <?php elseif ($this->fields->post_top_info_select == "music") : ?>
                                    <i class="ri-music-2-line"></i>
                                <?php elseif ($this->fields->post_top_info_select == "movie") : ?>
                                    <i class="ri-clapperboard-line"></i>
                                <?php elseif ($this->fields->post_top_info_select == "tour") : ?>
                                    <i class="ri-road-map-line"></i>
                                <?php elseif ($this->fields->post_top_info_select == "steam") : ?>
                                    <i class="ri-gamepad-line"></i>
                                <?php else: ?>
                                    <?php echo $this->fields->post_icon ? (cat_have_emoji($this->fields->post_icon) ? $this->fields->post_icon : '<i class="'.  $this->fields->post_icon . '"></i>') : '<i class="ri-file-list-3-line"></i>' ?>
                                <?php endif; ?>
                            </div>
                            <?php if ($this->fields->post_top_info_select != "book" && $this->fields->post_top_info_select != "movie" && $this->fields->post_top_info_select != "music") : ?>
                                <div class="cat_indexcard_time cat_indexcard_time_2"><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y年n月j日'); ?></time></div>
                                <div class="cat_indexcard_time cat_indexcard_time_6"><i class="ri-eye-line"></i> <?php echo get_post_Views($this)?></div>
                            <?php endif; ?>
                            <?php if ($this->fields->post_top_info_select == "album") : ?>
                                <div class="cat_album_out" title="<?php $this->title() ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($this->content)[0] ?>" alt="<?php echo $this->title ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($this->content)[1] ?>" alt="<?php echo $this->title ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($this->content)[2] ?>" alt="<?php echo $this->title ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($this->content)[3] ?>" alt="<?php echo $this->title ?>">
                                </div>
                            <?php elseif ($this->fields->post_top_info_select == "book") : ?>
                                <img style="display:inline-block; width: auto; height: 12rem; aspect-ratio: 1 / 1.414;" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $this->fields->post_top_info_book_img ? $this->fields->post_top_info_book_img : get_post_Thumbnail($this) ?>" alt="<?php echo $this->title ?>">
                                <div style="display:inline-block;position: absolute;">
                                    <div class="cat_covertitle"><i class="ri-h-1"></i> 标题：<?php $this->title() ?></div>
                                    <div class="cat_covertitle"><i class="ri-price-tag-3-line"></i> 标签：<?php $this->tags('', true, '<span class="no_tags">无标签</span>'); ?></div>
                                    <div class="cat_covertitle"><i class="ri-time-line"></i> 发表：<?php echo $this->date() ?></div>
                                    <div class="cat_covertitle"><i class="ri-book-3-line"></i> 书名：<?php echo $this->fields->post_top_info_book_name ?></div>
                                    <div class="cat_covertitle"><i class="ri-user-5-line"></i> 作者：<?php echo $this->fields->post_top_info_book_author ?></div>
                                    <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars_num($this->fields->post_top_info_book_star); ?></div>
                                </div>
                            <?php elseif ($this->fields->post_top_info_select == "movie") : ?>
                                <img style="display:inline-block; width: auto; height: 12rem; aspect-ratio: 1 / 1.414;" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $this->fields->post_top_info_movie_img ? $this->fields->post_top_info_movie_img : get_post_Thumbnail($this) ?>" alt="<?php echo $this->title ?>">
                                <div style="display:inline-block;position: absolute;">
                                    <div class="cat_covertitle"><i class="ri-h-1"></i> 标题：<?php $this->title() ?></div>
                                    <div class="cat_covertitle"><i class="ri-price-tag-3-line"></i> 标签：<?php $this->tags('', true, '<span class="no_tags">无标签</span>'); ?></div>
                                    <div class="cat_covertitle"><i class="ri-time-line"></i> 发表：<?php echo $this->date() ?></div>
                                    <div class="cat_covertitle"><i class="ri-book-3-line"></i> 影片：<?php echo $this->fields->post_top_info_movie_name ?></div>
                                    <div class="cat_covertitle"><i class="ri-user-5-line"></i> 导演：<?php echo $this->fields->post_top_info_movie_author ?></div>
                                    <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars_num($this->fields->post_top_info_movie_star); ?></div>
                                </div>
                            <?php elseif ($this->fields->post_top_info_select == "steam") : ?>
                                <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="
                                    <?php 
                            			$game = get_game_appid($this->fields->post_top_info_steam_more);
                            			echo !empty($game['result']) ? $game['result']['topic_detail']['bg_pic'] : get_post_Thumbnail($this);
                            		?>
	                            " alt="<?php echo $this->title ?>">
                            <?php elseif ($this->fields->post_top_info_select != "music") : ?>
                                <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($this) ?>" alt="<?php echo $this->title ?>">
                            <?php endif; ?>
                        </a>
                        <?php if ($this->fields->post_top_info_select != "book" && $this->fields->post_top_info_select != "movie" && $this->fields->post_top_info_select != "music"): ?>
                            <div class="box_avatar">
                                <div class="box_avatar_right" style="max-width: 100%;">
                                    <div class="cat_indexcard_tags" itemprop="keywords" >
                                        <?php $this->tags('', true, '<span class="no_tags">无标签</span>'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($this->fields->post_top_info_select == "music") : ?>
                        <meting-js
                        	server="netease"
                        	type="song"
                        	id="<?php echo $this->fields->post_top_info_music_more ?>">
                        </meting-js>
                        <a class="friends_post_title" style="padding: 0;" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php echo $this->title ?></a>
                        <div class="friends_post_post friends_musicpost"><i class="ri-user-5-line"></i> 创作：<?php echo $this->fields->post_top_info_music_author ?></div>
                        <div class="friends_post_post friends_musicpost"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_music_star) ?></div>
                    <?php elseif ($this->fields->post_top_info_select == "steam") : ?>
                        <?php if(empty($game['result'])) : ?>
                            <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                            <div class="cat_postlist_category">
                                <?php if (sizeof($this->categories) > 0) : ?>
                                    <?php $i=-1; foreach (array_slice($this->categories, 0, 3) as $key => $item) : $i++; ?>
                                    <a class="linkicon" href="<?php echo $this->categories[$i]['permalink']; ?>" title="<?php echo $this->categories[$i]['name']; ?>">
                                        <?php echo ($this->categories[$i]['description'] ? (cat_have_emoji($this->categories[$i]['description']) ? $this->categories[$i]['description'] : '<i class="'.  $this->categories[$i]['description'] . '"></i>') : '<p>' . mb_substr($pages->title, 0, 1, 'utf-8') . '</p> ') . $this->categories[$i]['name'] ?>
                                    </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="friends_post_post"><?php echo get_Abstract($this); ?></div>
                        <?php else: ?>
                            <div class="cat_covertitle"><i class="ri-h-1"></i> 标题：<?php echo $this->title ?></div>
                            <div class="cat_covertitle"><i class="ri-gamepad-line"></i> 游戏：<?php echo $game['result']['name'] ?></div>
                            <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($game['result']['score']) ?></div>
                        <?php endif; ?>
                    <?php elseif (($this->fields->post_top_info_select != "book") && ($this->fields->post_top_info_select != "movie")) : ?>
                        <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="friends_block" style="margin-bottom:var(--margin);">
            <div class="friends_post_title" style="padding-top: 3rem;">没有找到内容</div>
            <div style="border-radius: var(--radius);padding-bottom: 2rem;">
                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input style="padding: 0.5rem;margin: 1rem;width: calc(100% - 5rem);" type="text" id="s" name="s" class="text" placeholder="输入关键字搜索"/>
                    <button style="color: var(--theme-60);font-size: 1.5rem;vertical-align: middle;background:#fff0;cursor: pointer;" type="submit" class="submit"><i class="ri-search-2-line"></i></button>
                </form>
            </div>
        </div>
	<?php endif; ?>
    <?php
        $this->pageNav(
            '&laquo;',
            '&raquo;',
            1,
            '...',
            array(
                'wrapTag' => 'div',
                'wrapClass' => 'cat_pagination',
                'itemTag' => 'li',
                'textTag' => 'a',
                'currentClass' => 'active',
                'prevClass' => 'prev',
                'nextClass' => 'next'
            )
        );
    ?>
    </div>
</div>
<?php $this->need('parts/footer.php'); ?>
