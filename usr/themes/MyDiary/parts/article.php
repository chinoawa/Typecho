<link rel="stylesheet" href="<?php echo resource_cdn() . 'css/article.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'prism/'?><?php echo $this->options->cat_article_codetheme? $this->options->cat_article_codetheme : "theme_Default" ?>.css">
<style>
.cat_post_out hr::before {
    content: '<?php $this->options->title() ?>';
}
.cat_post_out>p {
    text-indent: <?php echo $this->options->cat_article_indent == "on" ? '2em': '0' ?>;
    background: url(<?php echo $this->options->cat_article_wordline == "on" ? resource_cdn() . 'img/wordline.webp' : 'none' ?>);
}
.flex_block_add {
    -webkit-animation: fadeInUp 0.5s .2s ease both;
    -moz-animation: fadeInUp 0.5s .2s ease both;
    animation: fadeInUp 0.5s .2s ease both;
    animation-delay: 0.7s;
}
</style>
<?php if($this->options->cat_article_firstletter === "on"): ?>
<style>
.cat_post_out>p:first-letter{
    font-size: 2.5rem;
    line-height: 5rem;
    float:left;
    margin-right: 0.5rem;
}
</style>
<?php endif; ?>   
<?php if($this->options->cat_post_album_text === "on"): ?>
<style>
.cat_post_album_text{
    text-align: center;
    color: var(--colorD);
    font-size: 0.9rem;
}
</style>
<?php else: ?>
<style>
.cat_post_album_text{
    display: none;;
}
</style>
<?php endif; ?>  
<?php if($this->fields->post_h1h2h3 === "on"): ?>
<style>
.cat_post_out h1::before {
	content: counter(h1) " - ";
    font-family: 'catfont_title';
    color: var(--theme);
    z-index: 1;
    vertical-align: bottom;
}
.cat_post_out h2::before {
	content: counter(h1) ". " counter(h2) " - ";
    font-family: 'catfont_title';
    color: var(--theme);
    z-index: 1;
    vertical-align: bottom;
}
.cat_post_out h3::before {
    content: counter(h1) ". " counter(h2) ". " counter(h3) " - ";
    font-family: 'catfont_title';
    color: var(--theme);
    vertical-align: bottom;
}
</style>
<?php endif; ?>
<?php if ($this->is('post') && $this->options->post_overtime && $this->options->post_overtime !== 'off' && floor((time() - ($this->modified)) / 86400) > $this->options->post_overtime) : ?>
    <div class="post_overtime" style="animation-delay:0.4s;">
        <i class="ri-bell-line"></i>：本文最后更新于<?php echo date('Y年m月d日', $this->modified); ?>，已经过了<?php echo floor((time() - ($this->modified)) / 86400); ?>天没有更新，若内容或图片失效，请留言反馈
    </div>
<?php endif; ?>
<?php if($this->fields->post_top_info_select === "book") : ?>
    <div class="flex_first flex_second" style="margin-bottom: var(--margin);">
        <div class="friends_block flex_block_add">
            <div class="cat_conertitle_img">
                <img style="aspect-ratio: 1 / 1.414;" class="isfancy lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $this->fields->post_top_info_book_img ?>">
            </div>
            <div class="cat_covertitle"><i class="ri-book-3-line"></i> 书名：《 <?php echo $this->fields->post_top_info_book_name ?> 》</div>
            <div class="cat_covertitle"><i class="ri-user-5-line"></i> 作者：<?php echo $this->fields->post_top_info_book_author ?></div>
            <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_book_star) ?></div>
            <div class="cat_covertitle_desc"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($this) ?></div>
            <div class="friends_post_point"><?php get_stars_num($this->fields->post_top_info_book_star); ?></div>
        </div>
    </div>
<?php elseif($this->fields->post_top_info_select === "music" && $this->fields->post_top_info_music_more) : ?>
    <div class="flex_first flex_second" style="margin-bottom: var(--margin);">
        <div class="friends_block flex_block_add">
            <meting-js
            	server="netease"
            	type="song"
            	id="<?php echo $this->fields->post_top_info_music_more ?>">
            </meting-js>
            <div class="friends_post_post friends_musicpost"><i class="ri-user-5-line"></i> 创作：<?php echo $this->fields->post_top_info_music_author ?></div>
            <div class="friends_post_post friends_musicpost"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_music_star) ?></div>
            <div class="friends_post_post friends_musicpost"><i class="ri-netease-cloud-music-line"></i> 云ID：<?php echo $this->fields->post_top_info_music_more ?> <a href="https://music.163.com/#/song?id=<?php echo $this->fields->post_top_info_music_more ?>" target="_blank"><i class="ri-share-circle-line"></i></a></div>
            <div class="friends_post_point"><?php get_stars_num($this->fields->post_top_info_music_star); ?></div>
        </div>
    </div>
<?php elseif($this->fields->post_top_info_select === "movie") : ?>
    <div class="flex_first flex_second" style="margin-bottom: var(--margin);">
        <div class="friends_block flex_block_add">
            <div class="cat_conertitle_img">
            <?php if ($this->fields->post_top_info_movie_more) : ?>
            <?php
                if(Helper::options()->cat_bili_choose == 'on'){
                    echo '<iframe style="aspect-ratio: 16 / 9;" class="box_img" src="' . Helper::options()->themeUrl . '/api/bilibili/?bv=' . $this->fields->post_top_info_movie_more . '&p=1&q=80&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>';
                }elseif(Helper::options()->cat_bili_choose == 'office'){
                    echo '<iframe style="aspect-ratio: 16 / 9;" class="box_img" src="https://api.injahow.cn/bparse/?bv=' . $this->fields->post_top_info_movie_more . '&p=1&q=80&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>';
                }else{
                    echo '<iframe style="aspect-ratio: 16 / 9;" class="box_img" src="//player.bilibili.com/player.html?&bvid=' . $this->fields->post_top_info_movie_more . '&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>';
                }
            ?>
            <?php else : ?>
                <img style="aspect-ratio: 1 / 1.414;" class="isfancy lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $this->fields->post_top_info_movie_img ? $this->fields->post_top_info_movie_img : get_post_Thumbnail($this); ?>">
            <?php endif; ?>
            </div>
            <div class="cat_covertitle"><i class="ri-clapperboard-line"></i> 影片：《 <?php echo $this->fields->post_top_info_movie_name ?> 》</div>
            <div class="cat_covertitle"><i class="ri-user-5-line"></i> 导演：<?php echo $this->fields->post_top_info_movie_author ?></div>
            <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_movie_star) ?></div>
            <div class="cat_covertitle_desc"><i class="ri-booklet-line"></i> 简介：<?php echo get_Abstract($this) ?></div>
            <div class="friends_post_point"><?php get_stars_num($this->fields->post_top_info_movie_star); ?></div>
        </div>
    </div>
<?php elseif($this->fields->post_top_info_select === "steam" && $this->fields->post_top_info_steam_more) : ?>
    <div class="flex_first flex_second" style="margin-bottom: var(--margin);">
        <div class="friends_block flex_block_add">
            <?php $game = get_game_appid($this->fields->post_top_info_steam_more); ?>
            <?php if(empty($game['result'])) : ?>
                <div style="text-align: center;">游戏APPID读取失败</div>
            <?php else: ?>
                <div class="cat_conertitle_img">
                    <img style="aspect-ratio: 16 / 9;" class="isfancy lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $game['result']['topic_detail']['hb2style']['bg_pic'] ?>">
                </div>
                <div class="cat_covertitle"><i class="ri-gamepad-line"></i> 游戏：<?php echo $game['result']['name'] ?></div>
                <div class="cat_covertitle"><i class="ri-history-line"></i> 发行：<?php echo $game['result']['release_date'] ?></div>
                <div class="cat_covertitle"><i class="ri-star-smile-line"></i> 评分：<?php get_stars($game['result']['score']) ?></div>
                <div class="cat_covertitle_desc"><i class="ri-booklet-line"></i> 简介：<?php echo strip_tags($game['result']['about_the_game']) ?></div>
                <div class="friends_post_point"><?php get_stars_num($game['result']['score']); ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php elseif((($this->fields->post_top_info_select === "post" && $this->fields->post_top_info_post_abstract === "on") || $this->fields->post_top_info_select === "album") && $this->fields->post_abstract) : ?>
    <div class="post_overtime">
            <div style="color:var(--main);"><i class="ri-broadcast-line"></i>：<?php echo get_Abstract($this) ?></div>
    </div>
<?php endif; ?>
<?php if ($this->fields->post_top_info_select == "album") : ?>   
    <div id="cat_article_start" class="<?php echo $this->fields->post_top_info_album_grid == "column" ? 'cat_post_album_out_column' : 'cat_post_album_out_grid'?>">
        <?php
        	$pattern = '/\<img src\=\"(.*?)\" alt\=\"(.*?)\" title\=\"(.*?)\">/i';
        	if (preg_match_all($pattern, $this->content, $thumbUrl)) {
        		foreach ($thumbUrl[1] as $i => $list1) {
        		    $lists1[$i]="$list1";
            	}
            	foreach ($thumbUrl[2] as $i => $list2) {
        		    $lists2[$i]="$list2";
            	}
            	foreach ($lists1 as $i => $list) {
            	    echo '<div style="position: relative;" class="isfancy" data-src="' . $lists1[$i] . '" alt="' . $lists2[$i] . '">';
        		    echo '<img class="lazyload" src="' . get_Lazyload() . '" data-src="' . $lists1[$i] . '">';
        		    echo '<div title="' . $lists2[$i] . '" style="-webkit-line-clamp: 3;" class="postalbum_pic_info cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_2line">' . $lists2[$i] . '</div>';
        		    echo '</div>';
            	}
        	}	        
        ?>
    </div>		    
<?php else: ?>
    <?php if($this->fields->post_top_info_select === "book") : ?>
        <div id="cat_article_start" class="cat_diary_start">
            <div class="friends_block cat_diary_peitu">
                <div class="box_out">
                    <div style="font-size: 2rem;">
                        <img style="height: 100%;" class="isfancy lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src=<?php echo $this->fields->post_top_info_book_img; ?>>
                        <div class="cat_indexcard_time cat_postcard_leftinfo">
                            <div><i class="ri-book-3-line"></i> 书名：《 <?php echo $this->fields->post_top_info_book_name ?> 》</div>
                            <div><i class="ri-user-5-line"></i> 作者：<?php echo $this->fields->post_top_info_book_author ?></div>
                            <div><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_book_star) ?></div>
                        </div>
                    </div>
                </div>
            </div>
    <?php elseif($this->fields->post_top_info_select === "movie") : ?>
        <div id="cat_article_start" class="cat_diary_start">
            <div class="friends_block cat_diary_peitu">
                <div class="box_out">
                    <div style="font-size: 2rem;">
                        <?php if ($this->fields->post_top_info_movie_more) : ?>
                        <?php
                            if(Helper::options()->cat_bili_choose == 'on'){
                                echo '<iframe style="height: 100%;filter:none;" class="box_img" src="' . Helper::options()->themeUrl . '/api/bilibili/?bv=' . $this->fields->post_top_info_movie_more . '&p=1&q=80&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>';
                            }elseif(Helper::options()->cat_bili_choose == 'office'){
                                echo '<iframe style="height: 100%;filter:none;" class="box_img" src="https://api.injahow.cn/bparse/?bv=' . $this->fields->post_top_info_movie_more . '&p=1&q=80&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>';
                            }else{
                                echo '<iframe style="height: 100%;filter:none;" class="box_img" src="//player.bilibili.com/player.html?&bvid=' . $this->fields->post_top_info_movie_more . '&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>';
                            }
                        ?>
                        <?php else : ?>
                            <img style="height: 100%;" class="isfancy lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src=<?php echo $this->fields->post_top_info_movie_img ? $this->fields->post_top_info_movie_img : get_post_Thumbnail($this); ?>>
                        <?php endif; ?>
                        <div class="cat_indexcard_time cat_postcard_leftinfo" <?php if ($this->fields->post_top_info_movie_more) : ?>style="bottom: 4.2rem;backdrop-filter: blur(0.375rem);padding: 0.5rem 1.5rem;left: 0;right:0;"<?php endif; ?>>
                            <div><i class="ri-clapperboard-line"></i> 影片：《 <?php echo $this->fields->post_top_info_movie_name ?> 》</div>
                            <div><i class="ri-user-5-line"></i> 导演：<?php echo $this->fields->post_top_info_movie_author ?></div>
                            <div><i class="ri-star-smile-line"></i> 评分：<?php get_stars($this->fields->post_top_info_movie_star) ?></div>
                        </div>
                    </div>
                </div>
            </div>
    <?php elseif($this->fields->post_top_info_select === "tour" && $this->options->cat_map_key1 && $this->options->cat_map_key2) : ?>
        <div id="cat_article_start" class="cat_diary_start">
            <script type="text/javascript">
        		window._AMapSecurityConfig = {
        			securityJsCode:'<?php $this->options->cat_map_key2()?>',
        		}
        	</script>
        	<script type="text/javascript" src="https://webapi.amap.com/maps?v=2.0&key=<?php $this->options->cat_map_key1()?>"></script>
        	<script>
        		$(function(){
        			setTimeout(function(){ 
        				var map = new AMap.Map('tourmap_post', {
        					zoom:18,
        					center: [<?php $this->fields->post_top_info_tour_more() ?>],
        					viewMode:'2D'
        				});
        				<?php if ($this->options->cat_map_style1): ?>
        					map.setMapStyle('amap://styles/<?php $this->options->cat_map_style1() ?>');
        				<?php endif; ?>
        				var circle = new AMap.Circle({
        					map: map,
        					center: [<?php $this->fields->post_top_info_tour_more() ?>],
        					radius: 75,
        					strokeColor: "#3366FF",
        					strokeOpacity: 0.3,
        					strokeWeight: 3,
        					fillColor: "#ffd3a6",
        					fillOpacity: 0.35
        				});
        				map.add(circle);
        				AMap.plugin([
        					'AMap.ToolBar',
        					'AMap.Scale',
        					'AMap.MapType',
        				], function(){
        					map.addControl(new AMap.ToolBar());
        					map.addControl(new AMap.Scale());
        					map.addControl(new AMap.MapType());
        				});
        			}, 1000);
        		});
        	</script>
        	<script>
        		$(function(){
        			setTimeout(function(){ 
        				var map = new AMap.Map('tourmap_post_dark', {
        					zoom:18,
        					center: [<?php $this->fields->post_top_info_tour_more() ?>],
        					viewMode:'2D'
        				});
        				<?php if ($this->options->cat_map_style2): ?>
        					map.setMapStyle('amap://styles/<?php $this->options->cat_map_style2() ?>');
        				<?php endif; ?>
        				var circle = new AMap.Circle({
        					map: map,
        					center: [<?php $this->fields->post_top_info_tour_more() ?>],
        					radius: 75,
        					strokeColor: "#3366FF",
        					strokeOpacity: 0.3,
        					strokeWeight: 3,
        					fillColor: "#ffd3a6",
        					fillOpacity: 0.35
        				});
        				map.add(circle);
        				AMap.plugin([
        					'AMap.Scale',
        				], function(){
        					map.addControl(new AMap.Scale());
        				});
        			}, 1000);
        		});
        	</script>
            <div class="friends_block cat_diary_peitu">
                <div class="box_out">
                    <div id="tourmap_post"></div>
                    <div id="tourmap_post_dark"></div>
                </div>
            </div>
    <?php else: ?>
        <div id="cat_article_start">
    <?php endif; ?>
        <article itemscope itemtype="http://schema.org/BlogPosting">
			<?php if($this->fields->post_abstract && strpos($this->fields->post_abstract, '[AI]') === 0):?>
			<div class="ai_abstract">
                <i class="ri-openai-fill"></i><?= substr($this->fields->post_abstract, 4);?>
            </div>
			<?php endif; ?>
            <div id="post_menu">
                <div class="cat_littlecard_title"><i class="ri-menu-unfold-line"></i> 目 录</div>
            </div>
            <div class="cat_post_out line-numbers" data-prismjs-copy=''>
                <?php cat_article_changetext($this, $this->user->hasLogin()) ?>
            </div>
            <?php if ($this->is('post') && $this->options->cat_article_end): ?>
                <?php echo $this->options->cat_article_end ?>
            <?php endif; ?>
        </article>
    </div>
<?php endif; ?>
    <?php if($this->is('post')||$this->is('page')): ?>
        <?php $this->header('commentReply=1&description=0&keywords=0&generator=0&template=0&pingback=0&xmlrpc=0&wlw=0&rss2=0&rss1=0&atom'); ?>
        <script src="<?php echo resource_cdn() . 'js/article.js'?>"></script>
        <script src="<?php echo resource_cdn() . 'prism/prism.js'?>"></script>
    <?php endif; ?>
    <?php if($this->is('post')): ?>
        <script>
            $('.head_menu a[tabnum = cat_blog]').addClass('tab_on');
        </script>
    <?php elseif($this->is('page')): ?>
        <script>
            $('.head_menu a[tabnum = cat_pages]').addClass('tab_on');
        </script>
    <?php endif; ?>