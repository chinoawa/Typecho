<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <div id="cat_article_start">
    <?php if ($this->have()): ?>
        <ul class="cat_index_tags" style="cursor: pointer;margin-bottom: var(--margin);">     
            <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
            <?php while ($category->next()) : ?>
                <?php if ($category->levels === 0 && $this->getArchiveSlug() === $category->slug) : ?>
                    <?php $children = $category->getAllChildren($category->mid); ?>
                    <?php if (!empty($children)) : ?>
                        <?php foreach ($children as $mid) : ?>
                            <li class="friends_block"> 
                                <?php $child = $category->getCategory($mid); ?>
                                <a class="cat_block category_child" href="<?php echo $child['permalink'] ?>"> <?php echo ($child['description'] ? (cat_have_emoji($child['description']) ? $child['description'] : '<i class="'.  $child['description'] . '"></i> ') : '') . $child['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
        <div class="flex_first <?php echo $this->options->cat_postlist_simple != "big" ? 'flex_second' : '' ?> <?php echo $this->options->cat_postlist_simple == "on" ? 'flex_third' : '' ?>">
            <?php while ($this->next()): ?>
            	<div class="friends_block flex_block_add">
                    <div class="box_out" style="<?php if ($this->fields->post_top_info_select == "album") : ?>width:100%;<?php elseif ($this->options->cat_postlist_simple == ("big" || "off") && ($this->fields->post_top_info_select == "book" || $this->fields->post_top_info_select == "movie")) : ?>width:auto;<?php endif; ?><?php if ($this->options->cat_postlist_simple == "off" && ($this->fields->post_top_info_select == "book" || $this->fields->post_top_info_select == "movie")) : ?>display: inline-block;vertical-align: baseline;<?php endif; ?>">
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
                                <a href="<?php echo $this->permalink ?>">
                                <div class="cat_album_out <?php echo $this->options->cat_postlist_simple == "big" ? 'cat_album_out_4parts' : '' ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($this->content)[0] ?>" alt="<?php echo $this->title ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($this->content)[1] ?>" alt="<?php echo $this->title ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($this->content)[2] ?>" alt="<?php echo $this->title ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($this->content)[3] ?>" alt="<?php echo $this->title ?>">
                                </div>
                                </a>
                            <?php elseif ($this->fields->post_top_info_select == "book") : ?>
                                <a href="<?php echo $this->permalink ?>">
                                <img style="<?php if ($this->options->cat_postlist_simple != "big"): ?><display:inline-block; width: auto; height: 12.5rem; aspect-ratio: 1 / 1.414;<?php endif; ?>" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $this->fields->post_top_info_book_img ? $this->fields->post_top_info_book_img : get_post_Thumbnail($this) ?>" alt="<?php echo $this->title ?>">
                                </a>
                            <?php elseif ($this->fields->post_top_info_select == "movie") : ?>
                                <a href="<?php echo $this->permalink ?>">
                                <img style="<?php if ($this->options->cat_postlist_simple != "big"): ?><display:inline-block; width: auto; height: 12.5rem; aspect-ratio: 1 / 1.414;<?php endif; ?>" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $this->fields->post_top_info_movie_img ? $this->fields->post_top_info_movie_img : get_post_Thumbnail($this) ?>" alt="<?php echo $this->title ?>">
                                </a>
                            <?php elseif ($this->fields->post_top_info_select == "steam") : ?>
                                <a href="<?php echo $this->permalink ?>">
                                <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="
                                    <?php 
                            			$game = get_game_appid($this->fields->post_top_info_steam_more);
                            			echo !empty($game['result']) ? $game['result']['topic_detail']['hb2style']['bg_pic'] : get_post_Thumbnail($this);
                            		?>
	                            " alt="<?php echo $this->title ?>">
                                </a>
                            <?php elseif ($this->fields->post_top_info_select != "music") : ?>
                                <a href="<?php echo $this->permalink ?>">
                                <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($this) ?>" alt="<?php echo $this->title ?>">
                                </a>
                            <?php endif; ?>
                        <?php if ($this->fields->post_top_info_select != "book" && $this->fields->post_top_info_select != "movie" && $this->fields->post_top_info_select != "music" || $this->options->cat_postlist_simple == "big" && $this->fields->post_top_info_select != "music"): ?>
                            <div class="box_avatar">
                                <div class="box_avatar_right" style="max-width: 100%;">
                                    <div class="cat_indexcard_tags" itemprop="keywords" >
                                        <?php $this->tags('', true, '<span class="no_tags">无标签</span>'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($this->fields->post_top_info_select == "book") : ?>
                        <div class="cat_archive_hide_one">
                            <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                            <div class="cat_covertitle"><i class="ri-price-tag-3-line"></i> <div class="cat_indexcard_tags" itemprop="keywords" style="display: contents;"><?php $this->tags('', true, '<span class="no_tags">无标签</span>'); ?></div></div>
                            <div title="发表：<?php echo $this->date() ?>" class="cat_covertitle"><i class="ri-time-line"></i> <?php echo $this->date() ?></div>
                            <div title="书名：<?php echo $this->fields->post_top_info_book_name ?>" class="cat_covertitle"><i class="ri-book-3-line"></i> <?php echo $this->fields->post_top_info_book_name ?></div>
                            <div title="作者：<?php echo $this->fields->post_top_info_book_author ?>" class="cat_covertitle"><i class="ri-user-5-line"></i> <?php echo $this->fields->post_top_info_book_author ?></div>
                            <div title="评分：<?php get_stars_num($this->fields->post_top_info_book_star); ?>" class="cat_covertitle"><i class="ri-star-smile-line"></i> <?php get_stars_num($this->fields->post_top_info_book_star); ?></div>
                        </div>
                        <div class="cat_archive_hide_two">
                            <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                            <div class="cat_covertitle"><i class="ri-book-3-line"></i> 书名：<?php echo $this->fields->post_top_info_book_name ?></div>
                            <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_book_star) ?></div>
                            <div class="friends_post_point"><?php get_stars_num($this->fields->post_top_info_book_star); ?></div>
                        </div>
                        <div class="cat_covertitle_desc"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($this) ?></div>
                    <?php elseif ($this->fields->post_top_info_select == "movie") : ?>
                        <div class="cat_archive_hide_one">
                            <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                            <div class="cat_covertitle"><i class="ri-price-tag-3-line"></i> <div class="cat_indexcard_tags" itemprop="keywords" style="display: contents;"><?php $this->tags('', true, '<span class="no_tags">无标签</span>'); ?></div></div>
                            <div title="发表：<?php echo $this->date() ?>" class="cat_covertitle"><i class="ri-time-line"></i> <?php echo $this->date() ?></div>
                            <div title="影片：<?php echo $this->fields->post_top_info_movie_name ?>" class="cat_covertitle"><i class="ri-book-3-line"></i> <?php echo $this->fields->post_top_info_movie_name ?></div>
                            <div title="导演：<?php echo $this->fields->post_top_info_movie_author ?>" class="cat_covertitle"><i class="ri-user-5-line"></i> <?php echo $this->fields->post_top_info_movie_author ?></div>
                            <div title="评分：<?php get_stars_num($this->fields->post_top_info_movie_star); ?>" class="cat_covertitle"><i class="ri-star-smile-line"></i> <?php get_stars_num($this->fields->post_top_info_movie_star); ?></div>
                        </div>
                        <div class="cat_archive_hide_two">
                            <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                            <div class="cat_covertitle"><i class="ri-clapperboard-line"></i> 影片：<?php echo $this->fields->post_top_info_movie_name ?></div>
                            <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_movie_star) ?></div>
                            <div class="friends_post_point"><?php get_stars_num($this->fields->post_top_info_movie_star); ?></div>
                        </div>
                        <div class="cat_covertitle_desc"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($this) ?></div>
                    <?php elseif ($this->fields->post_top_info_select == "music") : ?>
                        <meting-js
                        	server="netease"
                        	type="song"
                        	id="<?php echo $this->fields->post_top_info_music_more ?>">
                        </meting-js>
                        <?php if ($this->options->cat_postlist_simple == "big"): ?>
                            <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php echo $this->title ?>"><?php echo $this->title ?></a>
                            <div class="friends_post_post friends_musicpost"><i class="ri-user-5-line"></i> 创作：<?php echo $this->fields->post_top_info_music_author ?></div>
                            <div class="friends_post_post friends_musicpost"><i class="ri-netease-cloud-music-line"></i> 云ID：<?php echo $this->fields->post_top_info_music_more ?> <a href="https://music.163.com/#/song?id=<?php echo $this->fields->post_top_info_music_more ?>" target="_blank"><i class="ri-share-circle-line"></i></a></div>
                            <div class="friends_post_post friends_musicpost"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_music_star) ?></div>
                            <div class="cat_postlist_category cat_covertitle">
                                <i class="ri-archive-line"></i> 分类：
                                <?php if (sizeof($this->categories) > 0) : ?>
                                    <?php $i=-1; foreach (array_slice($this->categories, 0, 3) as $key => $item) : $i++; ?>
                                    <a class="linkicon" href="<?php echo $this->categories[$i]['permalink']; ?>" title="<?php echo $this->categories[$i]['name']; ?>">
                                        <?php echo ($this->categories[$i]['description'] ? (cat_have_emoji($this->categories[$i]['description']) ? $this->categories[$i]['description'] : '<i class="'.  $this->categories[$i]['description'] . '"></i>') : '') . $this->categories[$i]['name'] ?>
                                    </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="friends_post_post friends_musicpost"><i class="ri-price-tag-3-line"></i> 标签：<div class="cat_indexcard_tags" itemprop="keywords" style="display: contents;"><?php $this->tags('', true, '<span class="no_tags">无标签</span>'); ?></div></div>
                            <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($this); ?></div>
                        <?php else: ?>
                            <a class="friends_post_title" style="padding-top: 0;" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                            <div class="friends_post_post friends_musicpost"><i class="ri-user-5-line"></i> 创作：<?php echo $this->fields->post_top_info_music_author ?></div>
                            <div class="friends_post_post friends_musicpost"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_music_star) ?></div>
                            <div class="friends_post_point"><?php get_stars_num($this->fields->post_top_info_music_star); ?></div>
                        <?php endif; ?>
                    <?php elseif ($this->fields->post_top_info_select == "steam") : ?>
                        <?php if(empty($game['result'])) : ?>
                            <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                            <div class="cat_postlist_category cat_covertitle">
                                <i class="ri-archive-line"></i> 分类：
                                <?php if (sizeof($this->categories) > 0) : ?>
                                    <?php $i=-1; foreach (array_slice($this->categories, 0, 3) as $key => $item) : $i++; ?>
                                    <a class="linkicon" href="<?php echo $this->categories[$i]['permalink']; ?>" title="<?php echo $this->categories[$i]['name']; ?>">
                                        <?php echo ($this->categories[$i]['description'] ? (cat_have_emoji($this->categories[$i]['description']) ? $this->categories[$i]['description'] : '<i class="'.  $this->categories[$i]['description'] . '"></i>') : '') . $this->categories[$i]['name'] ?>
                                    </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php if($this->options->cat_postlist_simple == "on") : ?>
                                <div class="cat_archive_hide_one">
                                    <div class="cat_covertitle"><i class="ri-time-line"></i> <?php echo $this->date() ?></div>
                                </div>
                                <div class="cat_archive_hide_two">
                                    <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($this); ?></div>
                                </div>
                            <?php else: ?>
                                <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($this); ?></div>
                            <?php endif; ?>
                        <?php else: ?>
                            <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                            <?php if($this->options->cat_postlist_simple == "on") : ?>
                                <div class="cat_archive_hide_one">
                                    <div class="cat_covertitle"><i class="ri-gamepad-line"></i> <?php echo $game['result']['name'] ?></div>
                                    <div class="cat_covertitle"><i class="ri-star-smile-line"></i> <?php get_stars_num($game['result']['score']) ?></div>
                                </div>
                                <div class="cat_archive_hide_two">
                                    <div class="cat_covertitle"><i class="ri-gamepad-line"></i> 游戏：<?php echo $game['result']['name'] ?></div>
                                    <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($game['result']['score']) ?></div>
                                </div>
                            <?php else: ?>
                                <div class="cat_covertitle"><i class="ri-gamepad-line"></i> 游戏：<?php echo $game['result']['name'] ?></div>
                                <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($game['result']['score']) ?></div>
                            <?php endif; ?>
                            <div class="cat_covertitle_desc"><i class="ri-booklet-line"></i> 简介：<?php echo strip_tags($game['result']['about_the_game']) ?></div>
                            <div class="friends_post_point"><?php get_stars_num($game['result']['score']); ?></div>
                        <?php endif; ?>
                    <?php else : ?>
                        <a class="friends_post_title" href="<?php echo $this->permalink ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                        <?php if ($this->fields->post_top_info_select != "album") : ?>
                            <?php if($this->options->cat_postlist_simple == "on") : ?>
                                <div class="cat_archive_hide_one">
                                    <div class="cat_postlist_category cat_covertitle">
                                        <i class="ri-archive-line"></i>
                                        <?php if (sizeof($this->categories) > 0) : ?>
                                            <?php $i=-1; foreach (array_slice($this->categories, 0, 3) as $key => $item) : $i++; ?>
                                            <a class="linkicon" href="<?php echo $this->categories[$i]['permalink']; ?>" title="<?php echo $this->categories[$i]['name']; ?>">
                                                <?php echo ($this->categories[$i]['description'] ? (cat_have_emoji($this->categories[$i]['description']) ? $this->categories[$i]['description'] : '<i style="margin-left: 0.2rem;" class="'.  $this->categories[$i]['description'] . '"></i>') : '') . $this->categories[$i]['name'] ?>
                                            </a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="cat_covertitle"><i class="ri-time-line"></i> <?php echo $this->date() ?></div>
                                </div>
                                <div class="cat_archive_hide_two">
                                    <div class="cat_postlist_category cat_covertitle">
                                        <i class="ri-archive-line"></i> 分类：
                                        <?php if (sizeof($this->categories) > 0) : ?>
                                            <?php $i=-1; foreach (array_slice($this->categories, 0, 3) as $key => $item) : $i++; ?>
                                            <a class="linkicon" href="<?php echo $this->categories[$i]['permalink']; ?>" title="<?php echo $this->categories[$i]['name']; ?>">
                                                <?php echo ($this->categories[$i]['description'] ? (cat_have_emoji($this->categories[$i]['description']) ? $this->categories[$i]['description'] : '<i class="'.  $this->categories[$i]['description'] . '"></i>') : '') . $this->categories[$i]['name'] ?>
                                            </a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($this); ?></div>
                                </div>
                            <?php else: ?>
                                <div class="cat_postlist_category cat_covertitle">
                                    <i class="ri-archive-line"></i> 分类：
                                    <?php if (sizeof($this->categories) > 0) : ?>
                                        <?php $i=-1; foreach (array_slice($this->categories, 0, 3) as $key => $item) : $i++; ?>
                                        <a class="linkicon" href="<?php echo $this->categories[$i]['permalink']; ?>" title="<?php echo $this->categories[$i]['name']; ?>">
                                            <?php echo ($this->categories[$i]['description'] ? (cat_have_emoji($this->categories[$i]['description']) ? $this->categories[$i]['description'] : '<i class="'.  $this->categories[$i]['description'] . '"></i>') : '') . $this->categories[$i]['name'] ?>
                                        </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($this); ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
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
        <div class="flex_first">
            <?php
            $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                ->select()
                ->from('table.contents')
                ->where('type = ?', 'post')
                ->where('password is NULL')
                ->where('status = ?', 'publish')
                ->order('agree', Typecho_Db::SORT_DESC)
                ->limit('6')
            );
            foreach ($counts as $count) {
                $cat_post = null;
                $this->widget('Widget_Archive@hots' . $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post);
                ?>
                <div class="friends_block flex_block_add">
                    <div class="box_out" style="<?php if ($cat_post->fields->post_top_info_select == "album") : ?>width:100%;<?php elseif ($cat_post->fields->post_top_info == "book") : ?>width:auto;<?php endif; ?>">
                        <a href="<?php echo $cat_post->permalink ?>">
                            <div class="cat_indexcard_time cat_indexcard_time_1">
                                <?php if ($cat_post->fields->post_top_info_select == "album") : ?>
                                    <i class="ri-image-line"></i>
                                <?php elseif ($cat_post->fields->post_top_info_select == "book") : ?>
                                    <i class="ri-book-3-line"></i>
                                <?php elseif ($cat_post->fields->post_top_info_select == "music") : ?>
                                    <i class="ri-music-2-line"></i>
                                <?php elseif ($cat_post->fields->post_top_info_select == "movie") : ?>
                                    <i class="ri-clapperboard-line"></i>
                                <?php elseif ($cat_post->fields->post_top_info_select == "tour") : ?>
                                    <i class="ri-road-map-line"></i>
                                <?php elseif ($cat_post->fields->post_top_info_select == "steam") : ?>
                                    <i class="ri-gamepad-line"></i>
                                <?php else: ?>
                                    <?php echo $cat_post->fields->post_icon ? (cat_have_emoji($cat_post->fields->post_icon) ? $cat_post->fields->post_icon : '<i class="'.  $cat_post->fields->post_icon . '"></i>') : '<i class="ri-file-list-3-line"></i>' ?>
                                <?php endif; ?>
                            </div>
                            <?php if ($cat_post->fields->post_top_info_select != "music") : ?>
                                <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo date('Y年n月j日', $cat_post->created); ?></div>
                                <div class="cat_indexcard_time <?php echo ($cat_post->fields->post_top_info_select == "book" || $cat_post->fields->post_top_info_select == "movie") ? 'cat_indexcard_time_3' : 'cat_indexcard_time_5' ?>"><?php echo '<i class="ri-thumb-up-line"></i> ' . $count['agree']; ?></div>
                                <?php if ($cat_post->fields->post_top_info_select == "movie") : ?>
                                    <div class="cat_indexcard_time cat_indexcard_time_6" style="max-width:70%;"><?php echo $cat_post->fields->post_top_info_movie_name ?></div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($cat_post->fields->post_top_info_select == "album") : ?>
                                <div class="cat_album_out cat_album_out_4parts" title="<?php echo $cat_post->title ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[0] ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[1] ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[2] ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[3] ?>">
                                </div>
                            <?php elseif ($cat_post->fields->post_top_info_select == "book") : ?>
                                <img class="index_image1 lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $cat_post->fields->post_top_info_book_img ? $cat_post->fields->post_top_info_book_img : get_post_Thumbnail($cat_post) ?>">
                                <div class="cat_indexcard_time cat_indexcard_time_4" style="max-width:75%">
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-h-1"></i> 标题：<?php echo $cat_post->title ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-book-3-line"></i> 书名：<?php echo $cat_post->fields->post_top_info_book_name ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-user-5-line"></i> 作者：<?php echo $cat_post->fields->post_top_info_book_author ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-star-smile-line"></i> 评分：<?php get_stars_num($cat_post->fields->post_top_info_book_star); ?></div>
                                </div>
                            <?php elseif ($cat_post->fields->post_top_info_select == "movie") : ?>
                                <img class="index_image1 lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $cat_post->fields->post_top_info_movie_img ? $cat_post->fields->post_top_info_movie_img : get_post_Thumbnail($cat_post) ?>">
                                <div class="cat_indexcard_time cat_indexcard_time_4" style="max-width:75%">
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-h-1"></i> 标题：<?php echo $cat_post->title ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-book-3-line"></i> 书名：<?php echo $cat_post->fields->post_top_info_movie_name ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-user-5-line"></i> 作者：<?php echo $cat_post->fields->post_top_info_movie_author ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-star-smile-line"></i> 评分：<?php get_stars_num($cat_post->fields->post_top_info_movie_star); ?></div>
                                </div>
                            <?php elseif ($cat_post->fields->post_top_info_select == "steam") : ?>
                                <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="
                                    <?php 
                            			$game = get_game_appid($cat_post->fields->post_top_info_steam_more);
                            			echo !empty($game['result']) ? $game['result']['topic_detail']['bg_pic'] : get_post_Thumbnail($cat_post);
                            		?>
	                            ">
                            <?php elseif ($cat_post->fields->post_top_info_select != "music") : ?>
                                <img style="height:14rem;" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($cat_post) ?>">
                            <?php endif; ?>
                        </a>
                        <?php if ($cat_post->fields->post_top_info_select != "book" && $cat_post->fields->post_top_info_select != "movie" && $cat_post->fields->post_top_info_select != "music"): ?>
                            <div class="box_avatar">
                                <div class="box_avatar_right" style="max-width: 90%;">
                                    <div class="cat_indexcard_tags" itemprop="keywords">
                                        <?php $cat_post->tags('', true, '<span class="no_tags">无标签</span>'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($cat_post->fields->post_top_info_select == "book") : ?>
                    <?php elseif ($cat_post->fields->post_top_info_select == "movie") : ?>
                    <?php elseif ($cat_post->fields->post_top_info_select == "steam") : ?>
                        <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                        <?php if(empty($game['result'])) : ?>
                            <div class="friends_post_post"><?php echo get_Abstract($cat_post); ?></div>
                        <?php else: ?>
                            <div class="cat_covertitle"><i class="ri-gamepad-line"></i> 游戏：<?php echo $game['result']['name'] ?></div>
                            <div class="cat_covertitle"><i class="ri-history-line"></i> 发行：<?php echo $game['result']['release_date'] ?></div>
                            <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($game['result']['score']) ?></div>
                        <?php endif; ?>
                    <?php elseif ($cat_post->fields->post_top_info_select == "music") : ?>
                        <meting-js
                        	server="netease"
                        	type="song"
                        	id="<?php echo $cat_post->fields->post_top_info_music_more ?>">
                        </meting-js>
                        <div class="friends_post_post friends_musicpost" style="margin-top: 2rem;"><i class="ri-user-5-line"></i> 创作：<?php echo $cat_post->fields->post_top_info_music_author ?></div>
                        <div class="friends_post_post friends_musicpost"><i class="ri-timer-2-line"></i> 发布：<?php echo $cat_post->fields->post_top_info_music_time ?></div>
                        <div class="friends_post_post friends_musicpost"><i class="ri-netease-cloud-music-line"></i> 云ID：<?php echo $cat_post->fields->post_top_info_music_more ?> <a href="https://music.163.com/#/song?id=<?php echo $cat_post->fields->post_top_info_music_more ?>" target="_blank"><i class="ri-share-circle-line"></i></a></div>
                        <div class="friends_post_post friends_musicpost"><i class="ri-price-tag-3-line"></i> 标签：<div class="cat_indexcard_tags" itemprop="keywords" style="display: contents;"><?php $cat_post->tags('', true, '<span class="no_tags">无标签</span>'); ?></div></div>
                        <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                        <div class="friends_post_post"><?php echo get_Abstract($cat_post); ?></div>
                    <?php elseif ($cat_post->fields->post_top_info_select == "album") : ?>
                        <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                    <?php else: ?>
                        <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                        <div class="friends_post_post"><?php echo get_Abstract($cat_post); ?></div>
                    <?php endif; ?>
                </div>
                <?php } ?>
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
