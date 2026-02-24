<?php
/**
 * 一款Typecho卡片风格主题，记录生活好帮手
 * 　
 * 🔹请使用php7.3或者7.4。
 * 　
 * 　📗 主题文档：<a href="https://flowus.cn/dorcandy/share/dcf8922e-0a87-4e92-b010-abf33b7c26dd?code=CANGJE" target="_blank">点此查看 ⮞</a>
 * 　📕 更新日志：<a href="https://store.mmbkz.cn/index.php/MyDiary.html" target="_blank">点此查看 ⮞</a>
 * 
 * @package 🌸 MyDiary
 * @author 火喵酱
 * @version 2025.8.8
 * @link https://www.mmbkz.cn
 */
?>
<!DOCTYPE HTML>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<?php $this->widget('Widget_Contents_Post_Recent@check', 'pageSize=1')->to($cat_post); ?>
<?php if (!$cat_post->have()) : ?>
<div class="main">
    <li class="friends_block" style="text-align: center;">一篇文章都没有呢，请去后台创建一篇新的文章</li>
</div>
<?php $this->need('parts/footer.php'); ?>
<?php exit; endif; ?>
    <div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <script src="<?php echo resource_cdn() . 'public/swiper-bundle.min.js' ?>"></script>
    <ul class="cat_index_infocards">
        <?php $this->need('parts/indexcard.php'); ?>
    </ul>
    <?php if($this->options->cat_notice && $this->is('index')) :?>
        <div class="friends_block" style="width: 100%;padding: 1rem;font-size: 1rem;line-height: 2rem; margin-bottom: var(--margin);">
            <div class="swiper" style="z-index: 0;">
				<div class="swiper-wrapper">
				    <?php
                        $db = $this->db;
                        $options = $this->options;
                        $page = $db->fetchRow($db->select()->from('table.contents')
                            ->where('table.contents.created < ?', $options->gmtTime)
                            ->where('table.contents.slug = ?', $options->cat_notice));
                        if ($page) {
                            $type = $page['type'];
                            $routeExists = (NULL != Typecho_Router::get($type));
                            $page['pathinfo'] = $routeExists ? Typecho_Router::url($type, $page) : '#';
                            $page['permalink'] = Typecho_Common::url($page['pathinfo'], $options->index);
                            $comments = $db->fetchAll($db->select()->from('table.comments')
                                ->where('table.comments.status = ?', 'approved')
                                ->where('table.comments.created < ?', $options->gmtTime)
                                ->where('table.comments.type = ?', 'comment')
                                ->where('table.comments.cid = ?', $page['cid'])
                                ->order('table.comments.created', Typecho_Db::SORT_DESC)
                                ->limit(3));
                    ?>
                    <?php foreach ($comments AS $comment) : ?>
                        <div class="swiper-slide">
                            <?php echo '<b style="color:var(--theme);">' . $page['title']. '：</b><span style="color:#999999;">（' . date("n月j日",$comment["created"]) . '）</span>'; ?>
						    <a class="item" href="<?php echo $page["permalink"] . '#li-comment-' . $comment["coid"]; ?>" target="_blank" rel="noopener noreferrer nofollow">
							    <?php cat_reply($comment['text']); ?>
							</a>
						</div>
                    <?php endforeach; ?>
                    <?php
                        } else {
                            echo "<div>暂无内容</div>";
                        }
                    ?>
				</div>
				<div class="swiper-pagination" style="top: auto;bottom: 0;"></div>
			</div>
        </div>
    <?php endif; ?>
    <div id="cat_article_start" class="cat_indexcard_grid">
    	<div class="card1">
    	    <div class="friends_block" style="width:100%;">
                <?php
                    $db = $this->db;
                    $options = $this->options;
                    $page = $db->fetchRow($db->select()->from('table.contents')
                        ->where('table.contents.created < ?', $options->gmtTime)
                        ->where('table.contents.slug = ?', $options->cat_diary_slug ? $options->cat_diary_slug :'cat_diary'));
                    if ($page) {
                        $type = $page['type'];
                        $routeExists = (NULL != Typecho_Router::get($type));
                        $page['pathinfo'] = $routeExists ? Typecho_Router::url($type, $page) : '#';
                        $page['permalink'] = Typecho_Common::url($page['pathinfo'], $options->index);
                        $comments = $db->fetchAll($db->select()->from('table.comments')
                            ->where('(secert = 0 OR secert is NULL)')
                            ->where('status = ?', 'approved')
                            ->where('created < ?', $options->gmtTime)
                            ->where('type = ?', 'comment')
                            ->where('parent = ?', '0')
                            ->where('cid = ?', $page['cid'])
                            ->order('created', Typecho_Db::SORT_DESC)
                            ->limit(1)
                        );
                    ?>
                <?php if($comments) :?>    
                <div class="box_out">
                        <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-quill-pen-line"></i></div>
                        <div class="cat_indexcard_time cat_indexcard_time_2" style="text-align: right;">
                            <?php echo date('Y年n月j日',$comments[0]['created']); ?>
                        </div>
                        <div class="cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_2line" style="-webkit-line-clamp: 6;">
                            <?php
                                $agreedparent = $comments[0]['coid'];
                                $agreedusers = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                    ->select('name', 'mail')
                                    ->from('table.dianzan')
                                    ->where('parent = ?', $agreedparent)
                                    ->order('id', Typecho_Db::SORT_DESC)
                                    ->limit('5')
                                );
                                if (!empty ($agreedusers)){
                                    echo '<i class="ri-hearts-line"></i>';
                                    foreach ($agreedusers as $i=>$agreeduser) {
                                        echo '<div title="' . $agreeduser['name'] . '" style="display: inline-block;"><img style="width: 1.5rem;border-radius: 0.3rem;margin: 0 0.5rem;vertical-align: middle;" class="avatar lazyload" data-src="'.get_AvatarByMail($agreeduser['mail']).'" src="' . get_AvatarLazyload(false) . '"></div>';
                                    }
                                    echo '<div class="likesuccess_newavatar" style="display: inline-block;"></div>';
                                    $agreecnt = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                        ->select('COUNT(name) AS cnt')
                                        ->from('table.dianzan')
                                        ->where('parent = ?', $agreedparent)
                                        ->order('id', Typecho_Db::SORT_DESC)
                                    );
                                    if ($agreecnt[0]['cnt'] > 5){
                                        echo '+ ';
                                        echo $agreecnt[0]['cnt'] - 5;
                                    }
                                    echo "<br>";
                                }
                            ?>
                            <?php if($this->options->cat_Indexcardsay_news != 'off') :?>
                                <?php if($this->options->cat_Indexcardsay_news == 'anime' || $this->options->cat_Indexcardsay_news == 'poem' || $this->options->cat_Indexcardsay_news == 'famous') :?>
                                    <?php if($this->options->cat_Indexcardsay_news == 'anime'){
                                        $filename = "anime";
                                    }elseif($this->options->cat_Indexcardsay_news == 'poem'){
                                        $filename = "poem";
                                    }elseif($this->options->cat_Indexcardsay_news == 'famous'){
                                        $filename = "famous";
                                    }
                                    $fileurlall = Helper::options()->themeUrl. '/api/text/' . $filename;
                                    $newurl = parse_url($fileurlall);
                                    $fileurl = substr($newurl['path'],1);
                                    if(!file_exists($fileurl)){
                                        die('一言文件不存在');
                                    }
                                    $lines = [];
                                    $fs = fopen($fileurl, "r");
                                    while(!feof($fs)){
                                        $line=trim(fgets($fs));
                                        if($line!=''){
                                            array_push($lines, $line);
                                        }
                                    } 
                                    fclose($fs);
                                    $newlines = array_filter($lines);
                                    $line_key = array_rand($newlines);
                                    echo '<i class="ri-chat-voice-line"></i> ' . $newlines[$line_key];
                                    ?>
                                <?php endif; ?>
                                <?php if($this->options->cat_Indexcardsay_news == 'user'){
                                    if ($this->options->cat_Indexcardsay_user) {
                                	    $say_user = array_values(array_filter(explode("\r\n", $this->options->cat_Indexcardsay_user)));
                                        if (count($say_user) > 0) {
                                            $say_user_key = array_rand($say_user);
                                            $say_user_one = $say_user[$say_user_key];
                                        }
                                    }else{
                                        $say_user_one = '';
                                    }
                                    echo '<i class="ri-chat-voice-line"></i> ' . $say_user_one;
                                }
                                ?>
                            <?php endif; ?>
                        </div>
                        <?php
                            $pattern = '/\{IMG\}(.*?)\{\/IMG\}/';
                            $matches = array();
                            preg_match_all($pattern, $comments[0]['text'], $matches);
                        ?>
                        <a href="<?php echo $page['permalink'] ?>">
                            <img style="height: 25rem;" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php 
                            if ($comments[0]['image']) {
                                echo $comments[0]['image'];
                            }elseif(!empty($matches[1])){
                                echo $matches[1][0];
                            } else {
                                echo get_random_Thumbnail($this);
                            } ?>">
                        </a>
                </div>
                <div class="index_status">    
                    <?php 
                        $weather = $comments[0]['weather'];
                        $mood = $comments[0]['mood'];
                        $temperature = $comments[0]['temperature'];
                    ?>
                    <?php 
                        echo $weather ? '<span title="天气" style="color: var(--theme);">'. diary_logo_weather($weather) .'</span> ' . diary_he_weather($weather) . '　' : '';
                        echo $mood ? '<span title="心情">'. diary_logo_mood($mood) .'</span> ' . '<span title="状态">'. diary_logo_status($mood)  .'</span> '. $mood . '　' : '';
                        echo $temperature ? '<span title="气温">' . diary_logo_temperature($temperature) . '</span> ' . $temperature . '℃' : ''; 
                    ?>
                </div>
                    <?php
                        $comments_cut = cat_reply_unformat($comments[0]['text']);
                        echo '<div class="cat_index_diary">' . $comments_cut . '</div>';
                    ?>
                    <?php else: ?> 
                        <div style="display: inline-block;position: relative;margin: 0;left: 50%;top: 50%;transform: translate(-50%,-50%);-webkit-transform: translate(-50%,-50%);">暂无日记，请在日记页面右侧侧栏书写第一篇日记。</div>
                    <?php endif; ?> 
                    <?php
                    } else {
                        echo '<div style="display: inline-block;position: relative;margin: 0;left: 50%;top: 50%;transform: translate(-50%,-50%);-webkit-transform: translate(-50%,-50%);">未创建日记页面，请在后台创建日记页面<br>若已创建，请在主题“设置-首页”中填写必要选项</div>';
                    }
                ?>       
            </div>   
    	</div>
    	<div class="card2">
    	    <?php $this->widget('Widget_Contents_Post_Recent@onlyone', 'pageSize=1')->to($cat_post); ?>
            <div class="flex_first flex_second">
                <?php while ($cat_post->next()) : ?>
        			<div class="friends_block flex_block_add">
                        <div class="box_out" style="<?php if ($cat_post->fields->post_top_info_select == "album") : ?>width:100%;<?php elseif ($cat_post->fields->post_top_info_select == "book" || $cat_post->fields->post_top_info_select == "movie") : ?>width:auto;<?php endif; ?>">
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
                            <?php if ($cat_post->fields->post_top_info_select != "book" && $cat_post->fields->post_top_info_select != "movie" && $cat_post->fields->post_top_info_select != "music") : ?>
                                <div class="cat_indexcard_time cat_indexcard_time_2"><time datetime="<?php $cat_post->date('c'); ?>" itemprop="datePublished"><?php $cat_post->date('Y年n月j日'); ?></time></div>
                                <div class="cat_indexcard_time cat_indexcard_time_5">最新</div>
                            <?php endif; ?>
                            <?php if ($cat_post->fields->post_top_info_select == "album") : ?>
                                <a href="<?php echo $cat_post->permalink ?>">
                                <div class="cat_album_out" title="<?php echo $cat_post->title ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[0] ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[1] ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[2] ?>">
                                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[3] ?>">
                                </div>
                                </a>
                            <?php elseif ($cat_post->fields->post_top_info_select == "book") : ?>
                                <a href="<?php echo $cat_post->permalink ?>">
                                <img style="display:inline-block; width: auto; height: 12.5rem; aspect-ratio: 1 / 1.414;" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $cat_post->fields->post_top_info_book_img ? $cat_post->fields->post_top_info_book_img : get_post_Thumbnail($cat_post) ?>">
                                </a>
                                <div class="cat_archive_hide_one">
                                   <div title="标题：<?php echo $cat_post->title ?>" class="cat_covertitle"><i class="ri-h-1"></i> <?php $cat_post->title() ?></div>
                                    <div class="cat_covertitle"><i class="ri-price-tag-3-line"></i> <div class="cat_indexcard_tags" itemprop="keywords" style="display: contents;"><?php $cat_post->tags('', true, '<span class="no_tags">无标签</span>'); ?></div></div>
                                    <div title="发表：<?php echo $cat_post->date() ?>" class="cat_covertitle"><i class="ri-time-line"></i> <?php echo $cat_post->date() ?></div>
                                    <div title="书名：<?php echo $cat_post->fields->post_top_info_book_name ?>" class="cat_covertitle"><i class="ri-book-3-line"></i> <?php echo $cat_post->fields->post_top_info_book_name ?></div>
                                    <div title="作者：<?php echo $cat_post->fields->post_top_info_book_author ?>" class="cat_covertitle"><i class="ri-user-5-line"></i> <?php echo $cat_post->fields->post_top_info_book_author ?></div>
                                    <div title="评分：<?php get_stars_num($cat_post->fields->post_top_info_book_star); ?>" class="cat_covertitle"><i class="ri-star-smile-line"></i> <?php get_stars_num($cat_post->fields->post_top_info_book_star); ?></div>
                                </div>
                            <?php elseif ($cat_post->fields->post_top_info_select == "movie") : ?>
                                <a href="<?php echo $cat_post->permalink ?>">
                                <img style="display:inline-block; width: auto; height: 12.5rem; aspect-ratio: 1 / 1.414;" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $cat_post->fields->post_top_info_movie_img ? $cat_post->fields->post_top_info_movie_img : get_post_Thumbnail($cat_post) ?>">
                                </a>
                                <div class="cat_archive_hide_one">
                                    <div title="标题：<?php echo $cat_post->title ?>" class="cat_covertitle"><i class="ri-h-1"></i> <?php $cat_post->title() ?></div>
                                    <div class="cat_covertitle"><i class="ri-price-tag-3-line"></i> <div class="cat_indexcard_tags" itemprop="keywords" style="display: contents;"><?php $cat_post->tags('', true, '<span class="no_tags">无标签</span>'); ?></div></div>
                                    <div title="发表：<?php echo $cat_post->date() ?>" class="cat_covertitle"><i class="ri-time-line"></i> <?php echo $cat_post->date() ?></div>
                                    <div title="影片：<?php echo $cat_post->fields->post_top_info_movie_name ?>" class="cat_covertitle"><i class="ri-book-3-line"></i> <?php echo $cat_post->fields->post_top_info_movie_name ?></div>
                                    <div title="导演：<?php echo $cat_post->fields->post_top_info_movie_author ?>" class="cat_covertitle"><i class="ri-user-5-line"></i> <?php echo $cat_post->fields->post_top_info_movie_author ?></div>
                                    <div title="评分：<?php get_stars_num($cat_post->fields->post_top_info_movie_star); ?>" class="cat_covertitle"><i class="ri-star-smile-line"></i> <?php get_stars_num($cat_post->fields->post_top_info_movie_star); ?></div>
                                </div>
                            <?php elseif ($cat_post->fields->post_top_info_select == "steam") : ?>
                                <a href="<?php echo $cat_post->permalink ?>">
                                <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="
                                    <?php 
                                        $game = get_game_appid($cat_post->fields->post_top_info_steam_more);
                                        echo !empty($game['result']) ? $game['result']['topic_detail']['hb2style']['bg_pic'] : get_post_Thumbnail($cat_post);
                                    ?>
                                ">
                                </a>
                            <?php elseif ($cat_post->fields->post_top_info_select != "music") : ?>
                                <a href="<?php echo $cat_post->permalink ?>">
                                <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($cat_post) ?>">
                                </a>
                            <?php endif; ?>
                            <?php if ($cat_post->fields->post_top_info_select != "book" && $cat_post->fields->post_top_info_select != "movie" && $cat_post->fields->post_top_info_select != "music"): ?>
                                <div class="box_avatar">
                                    <div class="box_avatar_right" style="max-width: 100%;">
                                        <div class="cat_indexcard_tags" itemprop="keywords" ><?php $cat_post->tags('', true, '<span class="no_tags">无标签</span>'); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($cat_post->fields->post_top_info_select == "book") : ?>
                            <div class="cat_archive_hide_two">
                                <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php $cat_post->title() ?>"><?php $cat_post->title() ?></a>
                                <div class="cat_covertitle"><i class="ri-book-3-line"></i> 书名：<?php echo $cat_post->fields->post_top_info_book_name ?></div>
                                <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($cat_post->fields->post_top_info_book_star) ?></div>
                                <div class="friends_post_point"><?php get_stars_num($cat_post->fields->post_top_info_book_star); ?></div>
                            </div>
                            <div class="cat_covertitle_desc"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post) ?></div>
                        <?php elseif ($cat_post->fields->post_top_info_select == "movie") : ?>
                            <div class="cat_archive_hide_two">
                                <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php $cat_post->title() ?>"><?php $cat_post->title() ?></a>
                                <div class="cat_covertitle"><i class="ri-clapperboard-line"></i> 影片：<?php echo $cat_post->fields->post_top_info_movie_name ?></div>
                                <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($cat_post->fields->post_top_info_movie_star) ?></div>
                                <div class="friends_post_point"><?php get_stars_num($cat_post->fields->post_top_info_movie_star); ?></div>
                            </div>
                            <div class="cat_covertitle_desc"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post) ?></div>
                        <?php elseif ($cat_post->fields->post_top_info_select == "music") : ?>
                            <meting-js
                            	server="netease"
                            	type="song"
                            	id="<?php echo $cat_post->fields->post_top_info_music_more ?>">
                            </meting-js>
                            <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php $cat_post->title() ?>"><?php $cat_post->title() ?></a>
                            <div class="friends_post_post friends_musicpost"><i class="ri-user-5-line"></i> 创作：<?php echo $cat_post->fields->post_top_info_music_author ?></div>
                            <div class="friends_post_post friends_musicpost"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($cat_post->fields->post_top_info_music_star) ?></div>
                            <div class="friends_post_point"><?php get_stars_num($cat_post->fields->post_top_info_music_star); ?></div>
                        <?php elseif ($cat_post->fields->post_top_info_select == "steam") : ?>
                            <?php if(empty($game['result'])) : ?>
                                <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                                <div class="cat_postlist_category cat_covertitle">
                                    <i class="ri-archive-line"></i> 分类：
                                    <?php if (sizeof($cat_post->categories) > 0) : ?>
                                        <?php $i=-1; foreach (array_slice($cat_post->categories, 0, 3) as $key => $item) : $i++; ?>
                                        <a class="linkicon" href="<?php echo $cat_post->categories[$i]['permalink']; ?>" title="<?php echo $cat_post->categories[$i]['name']; ?>">
                                            <?php echo ($cat_post->categories[$i]['description'] ? (cat_have_emoji($cat_post->categories[$i]['description']) ? $cat_post->categories[$i]['description'] : '<i class="'.  $cat_post->categories[$i]['description'] . '"></i>') : '') . $cat_post->categories[$i]['name'] ?>
                                        </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post); ?></div>
                            <?php else: ?>
                                <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                                <div class="cat_covertitle"><i class="ri-gamepad-line"></i> 游戏：<?php echo $game['result']['name'] ?></div>
                                <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($game['result']['score']) ?></div>
                                <div class="cat_covertitle_desc"><i class="ri-booklet-line"></i> 简介：<?php echo strip_tags($game['result']['about_the_game']) ?></div>
                            <?php endif; ?>
                        <?php elseif ($cat_post->fields->post_top_info_select != "album") : ?>
                            <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                            <div class="cat_postlist_category cat_covertitle">
                                <i class="ri-archive-line"></i> 分类：
                                <?php if (sizeof($cat_post->categories) > 0) : ?>
                                    <?php $i=-1; foreach (array_slice($cat_post->categories, 0, 3) as $key => $item) : $i++; ?>
                                    <a class="linkicon" href="<?php echo $cat_post->categories[$i]['permalink']; ?>" title="<?php echo $cat_post->categories[$i]['name']; ?>">
                                        <?php echo ($cat_post->categories[$i]['description'] ? (cat_have_emoji($cat_post->categories[$i]['description']) ? $cat_post->categories[$i]['description'] : '<i class="'.  $cat_post->categories[$i]['description'] . '"></i>') : '') . $cat_post->categories[$i]['name'] ?>
                                    </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post); ?></div>
                        <?php endif; ?>
                    </div>
        		<?php endwhile; ?>
            </div>
    	</div>
    	    <?php
                $lunbo = $this->options->cat_IndexTopPost ? $this->options->cat_IndexTopPost : '';
                $hang = explode("||", $lunbo);
                $n = count($hang);
                $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                    ->select()
                    ->from('table.contents')
                    ->where('type = ?', 'post')
                    ->where('status = ?', 'publish')
                    ->where('password is NULL')
                    ->order('views', Typecho_Db::SORT_DESC)
                    ->limit('2')
                );
                if (empty($lunbo) || $n != 2){
                    if(empty($counts[1])){
                        $hang = array($counts[0]['cid'],$counts[0]['cid']);
                    }else{
                        $hang = array($counts[0]['cid'],$counts[1]['cid']);
                    }
                }
            ?>
                <?php
                for ($i=0;$i<2;$i++) {
                	$this->widget('Widget_Archive@lunbo'.$i, 'pageSize=1&type=post', 'cid='.$hang[$i])->to($cat_post);
                    $created = date('Y年n月j日', $cat_post->created);
                ?>	
                	<div class="friends_block card<?php echo (3+$i); ?>">
                        <div class="box_out">
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
                                    <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo $created; ?></div>
                                    <div class="cat_indexcard_time <?php if ($cat_post->fields->post_top_info_select == "book" || $cat_post->fields->post_top_info_select == "movie") : ?>cat_indexcard_time_3<?php else: ?>cat_indexcard_time_5<?php endif; ?>">置顶</div>
                                    <?php if ($cat_post->fields->post_top_info_select == "movie") : ?>
                                        <div class="cat_indexcard_time cat_indexcard_time_6" style="max-width: 70%;"><?php echo $cat_post->fields->post_top_info_movie_name ?></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($cat_post->fields->post_top_info_select == "album") : ?>
                                    <a href="<?php echo $cat_post->permalink ?>">
                                    <div class="cat_album_out cat_album_out_4parts" title="<?php echo $cat_post->title ?>">
                                        <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[0] ?>">
                                        <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[1] ?>">
                                        <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[2] ?>">
                                        <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($cat_post->content)[3] ?>">
                                    </div>
                                    </a>
                                <?php elseif ($cat_post->fields->post_top_info_select == "book") : ?>
                                    <a href="<?php echo $cat_post->permalink ?>">
                                    <img class="index_image1 lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $cat_post->fields->post_top_info_book_img ? $cat_post->fields->post_top_info_book_img : get_post_Thumbnail($cat_post) ?>">
                                    </a>
                                    <div class="cat_indexcard_time cat_indexcard_time_4" style="max-width:75%">
                                        <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-h-1"></i> 标题：<?php echo $cat_post->title ?></div>
                                        <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-book-3-line"></i> 书名：<?php echo $cat_post->fields->post_top_info_book_name ?></div>
                                        <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-user-5-line"></i> 作者：<?php echo $cat_post->fields->post_top_info_book_author ?></div>
                                        <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-star-smile-line"></i> 评分：<?php get_stars_num($cat_post->fields->post_top_info_book_star); ?></div>
                                    </div>
                                <?php elseif ($cat_post->fields->post_top_info_select == "movie") : ?>
                                    <a href="<?php echo $cat_post->permalink ?>">
                                    <img class="index_image1 lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $cat_post->fields->post_top_info_movie_img ? $cat_post->fields->post_top_info_movie_img : get_post_Thumbnail($cat_post) ?>">
                                    </a>
                                    <div class="cat_indexcard_time cat_indexcard_time_4" style="max-width:75%">
                                        <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-h-1"></i> 标题：<?php echo $cat_post->title ?></div>
                                        <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-book-3-line"></i> 影片：<?php echo $cat_post->fields->post_top_info_movie_name ?></div>
                                        <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-user-5-line"></i> 导演：<?php echo $cat_post->fields->post_top_info_movie_author ?></div>
                                        <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-star-smile-line"></i> 评分：<?php get_stars_num($cat_post->fields->post_top_info_movie_star); ?></div>
                                    </div>
                                <?php elseif ($cat_post->fields->post_top_info_select == "steam") : ?>
                                    <a href="<?php echo $cat_post->permalink ?>">
                                    <img class="index_image2 lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="
                                        <?php 
                                			$game = get_game_appid($cat_post->fields->post_top_info_steam_more);
                                			echo !empty($game['result']) ? $game['result']['topic_detail']['hb2style']['bg_pic'] : get_post_Thumbnail($cat_post);
                                		?>
    	                            ">
                                    </a>
                                <?php elseif ($cat_post->fields->post_top_info_select != "music") : ?>
                                    <a href="<?php echo $cat_post->permalink ?>">
                                    <img class="index_image2 lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($cat_post) ?>">
                                    </a>
                                <?php endif; ?>
                            <?php if ($cat_post->fields->post_top_info_select != "book" && $cat_post->fields->post_top_info_select != "movie" && $cat_post->fields->post_top_info_select != "music"): ?>
                                <div class="box_avatar">
                                    <div class="box_avatar_right" style="max-width: 90%;">
                                        <div class="cat_indexcard_tags" itemprop="keywords" >
                                            <?php $cat_post->tags('', true, '<span class="no_tags">无标签</span>'); ?>
                                        </div>
                                        <?php if (sizeof($cat_post->categories) > 0) : ?>
                                            <a class="linkicon" title="<?php echo $cat_post->categories[0]['name']; ?>" href="<?php echo $cat_post->categories[0]['permalink']; ?>">
                                                <?php echo ($cat_post->categories[0]['description'] ? (cat_have_emoji($cat_post->categories[0]['description'])? '<span style="margin: -0.25rem;">' . $cat_post->categories[0]['description'] . '</span>' : '<i class="'.  $cat_post->categories[0]['description'] . '"></i>') : '<p>' . mb_substr($cat_post->title, 0, 1, 'utf-8') . '</p>' )?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($cat_post->fields->post_top_info_select == "book") : ?>
                        <?php elseif ($cat_post->fields->post_top_info_select == "movie") : ?>
                        <?php elseif ($cat_post->fields->post_top_info_select == "steam") : ?>
                            <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                            <?php if(empty($game['result'])) : ?>
                                <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post); ?></div>
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
                            <div class="friends_post_post friends_musicpost"><i class="ri-user-5-line"></i> 创作：<?php echo $cat_post->fields->post_top_info_music_author ?></div>
                            <div class="friends_post_post friends_musicpost"><i class="ri-netease-cloud-music-line"></i> 云ID：<?php echo $cat_post->fields->post_top_info_music_more ?> <a href="https://music.163.com/#/song?id=<?php echo $cat_post->fields->post_top_info_music_more ?>" target="_blank"><i class="ri-share-circle-line"></i></a></div>
                            <div class="friends_post_post friends_musicpost"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($cat_post->fields->post_top_info_music_star) ?></div>
                            <div class="friends_post_post friends_musicpost"><i class="ri-price-tag-3-line"></i> 标签：<div class="cat_indexcard_tags" itemprop="keywords" style="display: contents;"><?php $cat_post->tags('', true, '<span class="no_tags">无标签</span>'); ?></div></div>
                            <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                            <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post); ?></div>
                        <?php elseif ($cat_post->fields->post_top_info_select == "album") : ?>
                            <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                        <?php else: ?>
                            <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                            <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post); ?></div>
                        <?php endif; ?>
                    </div>
                <?php } ?>
    	<div class="card5">
            <div class="friends_block " style="width:100%;">
                <div class="box_out">
                    <div class="cat_indexcard_time cat_indexcard_time_1"><i class='ri-newspaper-line'></i></div>
                    <?php if ($this->options->cat_Indexcardimg_news == 'on'): ?>
                        <img class="lazyload box_img" style="max-height: 23rem;" src="<?php echo get_Lazyload() ?>" data-src="<?php echo resource_cdn() . 'img/weeks/'. date('N') .'.webp'; ?>">
                        <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo date('Y年n月j日'); ?></div>
                        <div class="cat_indexcard_time cat_indexcard_time_4"><?php echo date('l.'); ?></div>
                        <div class="cat_indexcard_time cat_indexcard_time_3">焦点</div>
                    <?php elseif ($this->options->cat_Indexcardimg_news == "pics" && $this->options->cat_Indexcardimg_news_pics): ?>
                    	<?php
            				$carousel = [];
            				$carousel_text = $this->options->cat_Indexcardimg_news_pics;
            				if ($carousel_text) {
            					$carousel_arr = array_values(array_filter(explode("\r\n", $carousel_text)));
            					if (count($carousel_arr) > 0) {
            						for ($i = 0; $i < count($carousel_arr); $i++) {
            							$img = explode("||", $carousel_arr[$i])[0];
            							$url = explode("||", $carousel_arr[$i])[1];
            							$title = explode("||", $carousel_arr[$i])[2];
            							$carousel[] = array("img" => trim($img), "url" => trim($url), "title" => trim($title));
            						};
            					}
            				}
            			?>
            			<?php if (sizeof($carousel) > 0) : ?>
            				<div class="swiper" style="z-index: 0;">
            					<div class="swiper-wrapper">
            						<?php foreach ($carousel as $item) : ?>
            							<div class="swiper-slide">
            							    <a class="item" href="<?php echo $item['url'] ?>" target="_blank" rel="noopener noreferrer nofollow">
            								    <img class="lazyload box_img" style="max-height: 23rem;"  src="<?php echo get_Lazyload() ?>" data-src="<?php echo $item['img'] ?>" alt="<?php echo $item['title'] ?>" />
            									<div class="cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_2line"><?php echo $item['title'] ?></div>
            								</a>
            							</div>
            						<?php endforeach; ?>
            					</div>
            					<div class="swiper-pagination"></div>
                                <div class="swiper-button-prev rot" slot="button-prev">
                                     <div class="cat_title_arrow_left anniu" style="margin-left:0.5rem;"><i style="color: var(--color-white);filter: drop-shadow(4px 4px 4px var(--colorG));" class="ri-arrow-left-s-line"></i></div>
                                </div>
                                <div class="swiper-button-next rat" slot="button-next">
                                     <div class="cat_title_arrow_right anniu" style="margin-right:0.5rem;"><i style="color: var(--color-white);filter: drop-shadow(4px 4px 4px var(--colorG));" class="ri-arrow-right-s-line"></i></div>
                                </div>
            				</div>
            			<?php endif; ?>
                    <?php else: ?>
                        <img class="lazyload box_img" style="max-height: 23rem;" src="<?php echo get_Lazyload() ?>" data-src="<?php echo cat_get_bing(); ?>">
                        <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo date('Y年n月j日'); ?></div>
                        <div class="cat_indexcard_time cat_indexcard_time_4"><?php echo date('l.'); ?></div>
                        <div class="cat_indexcard_time cat_indexcard_time_3">焦点</div>
                    <?php endif; ?>
                </div>
                <?php if($this->options->cat_Indexcardaddr_news) : ?>
                    <?php
                        $context = stream_context_create(array('ssl'=>array(
                            'allow_self_signed'=> true,
                            'verify_peer' => false,
                        )));
                        libxml_set_streams_context($context);
                        $rss =  simplexml_load_file($this->options->cat_Indexcardaddr_news);
                        $title =  $rss->channel->title;
                        $link = $rss->channel->link;
                    ?>
                    <a href='<?php echo $link ?>' target="_blank" class="friends_post_title news_title"><?php echo $title; ?></a>
                    <?php
                        echo '<ul class="friends_title">';
                        $i = 1;
                        foreach ($rss->channel->item as $item) {
                            if ($i > 9) {
                                break;
                            }
                            echo "<li><i style='color:var(--theme-60);' class='ri-newspaper-line'></i> <a target='_blank' href='" . $item->link . "'>" . $item->title . "</a></li>";
                            $i++;
                        }
                        echo '</ul>';
                    ?>
                <?php else: ?>
                    <div class="friends_post_title news_title">近期文章</div>
                    <ul class="friends_title">
                        <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=9')->to($contents); ?>
                        <?php while($contents->next()): ?>
                            <li>
                                <i style='color:var(--theme-60);' class='ri-newspaper-line'></i>
                                <a target='_blank' href='<?php $contents->permalink(); ?>'><?php $contents->title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
    	</div>
    </div>
    <div class="cat_index_start">
        <div class="flex_first">
            <?php
            if ($this->options->cat_hotpost == "zan"){
                $cat_hotpost = 'agree';
                $cat_hotpost_logo = '<i class="ri-thumb-up-line"></i> ';
                $post_num = 6;
                $post_letter = '最赞';
            }elseif($this->options->cat_hotpost == "ping"){
                $cat_hotpost = 'commentsNum';
                $cat_hotpost_logo = '<i class="ri-message-3-line"></i> ';
                $post_num = 6;
                $post_letter = '热评';
            }elseif($this->options->cat_hotpost == "user"){
                $post_list = $this->options->cat_hotpost_user;
    	        $post_arr = explode("||", $post_list);
	            $post_num = count($post_arr);
                $cat_hotpost = 'views';
                $cat_hotpost_logo = '';
                $post_letter = '推荐';
            }else{
                $cat_hotpost = 'views';
                $cat_hotpost_logo = '<i class="ri-eye-line"></i> ';
                $post_num = 6;
                $post_letter = '热门';
            }
            $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                ->select()
                ->from('table.contents')
                ->where('type = ?', 'post')
                ->where('status = ?', 'publish')
                ->where('password is NULL')
                ->order($cat_hotpost, Typecho_Db::SORT_DESC)
                ->limit($post_num)
            );
            $i=0;
            foreach ($counts as $count) {
                $cat_post = null;
                if($this->options->cat_hotpost == "user"){
                    $this->widget('Widget_Archive@post_list' . $count['cid'], 'pageSize=1&type=post', 'cid='.$post_arr[$i])->to($cat_post);
                    $views = '';
                    $i++;
                }else{
                    $this->widget('Widget_Archive@hots' . $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post);
                    $views = $count[$cat_hotpost];
                }
                $created = date('Y年n月j日', $cat_post->created);
                ?>
                <div class="friends_block flex_block_add">
                    <div class="box_out">
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
                                <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo $created; ?></div>
                                <div class="cat_indexcard_time <?php echo ($cat_post->fields->post_top_info_select == "book" || $cat_post->fields->post_top_info_select == "movie") ? 'cat_indexcard_time_3' : 'cat_indexcard_time_5' ?>"><?php echo $post_letter; ?></div>
                                <?php if ($cat_post->fields->post_top_info_select == "movie") : ?>
                                    <div class="cat_indexcard_time <?php echo ($cat_post->fields->post_top_info_select == "book" || $cat_post->fields->post_top_info_select == "movie") ? 'cat_indexcard_time_4' : 'cat_indexcard_time_6' ?>" style="max-width: 70%;"><i class="ri-h-1"></i> <?php echo $cat_post->fields->post_top_info_movie_name ?><br><?php echo $cat_hotpost_logo . $views; ?></div>
                                <?php elseif ($cat_post->fields->post_top_info_select != "book") : ?>
                                    <div class="cat_indexcard_time cat_indexcard_time_6"><?php echo $cat_hotpost_logo . $views; ?></div>
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
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><?php echo $cat_hotpost_logo; ?> 热度：<?php echo $views; ?></div>
                                </div>
                            <?php elseif ($cat_post->fields->post_top_info_select == "movie") : ?>
                                <img class="index_image1 lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $cat_post->fields->post_top_info_movie_img ? $cat_post->fields->post_top_info_movie_img : get_post_Thumbnail($cat_post) ?>">
                                <div class="cat_indexcard_time cat_indexcard_time_4" style="max-width:75%">
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-h-1"></i> 标题：<?php echo $cat_post->title ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-book-3-line"></i> 书名：<?php echo $cat_post->fields->post_top_info_movie_name ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-user-5-line"></i> 作者：<?php echo $cat_post->fields->post_top_info_movie_author ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><i class="ri-star-smile-line"></i> 评分：<?php get_stars_num($cat_post->fields->post_top_info_movie_star); ?></div>
                                    <div class="cat_covertitle" style="padding: 0 0.25rem;color: #fff;"><?php echo $cat_hotpost_logo; ?> 热度：<?php echo $views; ?></div>
                                </div>
                            <?php elseif ($cat_post->fields->post_top_info_select == "steam") : ?>
                                    <img class="index_image2 lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="
                                        <?php 
                                			$game = get_game_appid($cat_post->fields->post_top_info_steam_more);
                                			echo !empty($game['result']) ? $game['result']['topic_detail']['hb2style']['bg_pic'] : get_post_Thumbnail($cat_post);
                                		?>
    	                            ">
                            <?php elseif ($cat_post->fields->post_top_info_select != "music") : ?>
                                <img class="index_image2 lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($cat_post) ?>">
                            <?php endif; ?>
                        </a>
                        <?php if ($cat_post->fields->post_top_info_select != "book" && $cat_post->fields->post_top_info_select != "movie" && $cat_post->fields->post_top_info_select != "music"): ?>
                            <div class="box_avatar">
                                <div class="box_avatar_right" style="max-width: 90%;">
                                    <div class="cat_indexcard_tags" itemprop="keywords" >
                                        <?php $cat_post->tags('', true, '<span class="no_tags">无标签</span>'); ?>
                                    </div>
                                    <?php if (sizeof($cat_post->categories) > 0) : ?>
                                        <a class="linkicon" title="<?php echo $cat_post->categories[0]['name']; ?>" href="<?php echo $cat_post->categories[0]['permalink']; ?>">
                                            <?php echo ($cat_post->categories[0]['description'] ? (cat_have_emoji($cat_post->categories[0]['description'])? '<span style="margin: -0.25rem;">' . $cat_post->categories[0]['description'] . '</span>' : '<i class="'.  $cat_post->categories[0]['description'] . '"></i>') : '<p>' . mb_substr($cat_post->title, 0, 1, 'utf-8') . '</p>' )?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($cat_post->fields->post_top_info_select == "book") : ?>
                    <?php elseif ($cat_post->fields->post_top_info_select == "movie") : ?>
                    <?php elseif ($cat_post->fields->post_top_info_select == "steam") : ?>
                        <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                        <?php if(empty($game['result'])) : ?>
                            <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post); ?></div>
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
                        <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                        <div class="friends_post_post friends_musicpost"><i class="ri-user-5-line"></i> 创作：<?php echo $cat_post->fields->post_top_info_music_author ?></div>
                        <div class="friends_post_post friends_musicpost"><i class="ri-netease-cloud-music-line"></i> 云ID：<?php echo $cat_post->fields->post_top_info_music_more ?> <a href="https://music.163.com/#/song?id=<?php echo $cat_post->fields->post_top_info_music_more ?>" target="_blank"><i class="ri-share-circle-line"></i></a></div>
                        <div class="friends_post_post friends_musicpost"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($cat_post->fields->post_top_info_music_star) ?></div>
                        <div class="cat_postlist_category cat_covertitle">
                            <i class="ri-archive-line"></i> 分类：
                            <?php if (sizeof($cat_post->categories) > 0) : ?>
                                <?php $i=-1; foreach (array_slice($cat_post->categories, 0, 3) as $key => $item) : $i++; ?>
                                <a class="linkicon" href="<?php echo $cat_post->categories[$i]['permalink']; ?>" title="<?php echo $cat_post->categories[$i]['name']; ?>">
                                    <?php echo ($cat_post->categories[$i]['description'] ? (cat_have_emoji($cat_post->categories[$i]['description']) ? $cat_post->categories[$i]['description'] : '<i class="'.  $cat_post->categories[$i]['description'] . '"></i>') : '') . $cat_post->categories[$i]['name'] ?>
                                </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="friends_post_post friends_musicpost"><i class="ri-price-tag-3-line"></i> 标签：<div class="cat_indexcard_tags" itemprop="keywords" style="display: contents;"><?php $cat_post->tags('', true, '<span class="no_tags">无标签</span>'); ?></div></div>
                        <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post); ?></div>
                    <?php elseif ($cat_post->fields->post_top_info_select == "album") : ?>
                        <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                    <?php else: ?>
                        <a class="friends_post_title" href="<?php echo $cat_post->permalink ?>" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></a>
                        <div class="friends_post_post"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($cat_post); ?></div>
                    <?php endif; ?>
                </div>
                <?php } ?>
        </div>
        <section>
            <?php $this->widget('Widget_Comments_Recent', 'ignoreAuthor=true&pageSize=15')->to($item); ?>
            <ul class="cat_index_recentcomment_list">
               <?php if ($item->have()) : ?>
                    <?php while ($item->next()) : ?>
                        <li class="friends_block">
                            <div class="user">
                                <img class="avatar lazyload" src="<?php get_AvatarLazyload() ?>" data-src="<?php echo get_AvatarByMail($item->mail); ?>" alt="<?php $item->author(false) ?>" />
                                <span class="onlinetime_recent" style="background:<?php echo get_user_last_login($item->mail,true); ?>"></span>
                                <div class="info">
                                    <div class="author">
                                        <?php $item->author(false) ?>
                                        <span title="<?php $item->date('Y年n月j日 H:m'); ?>" class="date"><?php $item->date('n.j'); ?></span>
        							</div>
                                    <div class="animetags">
                						<?php cat_comment_levelcard($item->mail);?>
                						<?php cat_comment_friendcard($item, $item->mail); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $db  = Typecho_Db::get();
                                $counts = $db->fetchAll($db
                                    ->select('secert','mail','author')
                                    ->from('table.comments')
                                    ->where('coid = ?', $item->coid)
                                );
                                $secert = $counts[0]['secert'];
                            ?>
                            <div class="reply" title="来自《<?php $item->title() ?>》" style="<?php if($secert == '1') :?>background: repeating-linear-gradient(135deg,var(--theme-10),var(--theme-10) 1rem,var(--background) 0,var(--background) 2rem);<?php endif; ?>">
                                <a class="link" href="<?php $item->permalink() ?>">
                                    <?php
                                        if($secert == '1'){
                                            echo '该评论已加密，点击查看详情';
                                        }else{
                                            cat_reply($item->content);
                                        }
                                    ?>
                                </a>
                            </div>
                        </li>
                    <?php endwhile; ?>
                <?php else : ?>
                    <li class="friends_block">小站还没有评论呢</li>
                <?php endif; ?>
            </ul>
        </section>
    </div>
</div>
<?php $this->need('parts/footer.php'); ?>