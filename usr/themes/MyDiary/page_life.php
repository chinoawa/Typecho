<?php
/**
 * 专题
 * 
 * @package custom 
 * 
 **/
?>
<!DOCTYPE HTML>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <div id="cat_article_start" class="tabs_content">
        <section class="tab0 cat_zhuanti_tab">
                <div class="section_anime flex_second">
                    <?php
                        $zt_title = ['文集' , '相册' , '旅行' , '书籍' , '音乐' , '电影' , '游戏' , 'Steam'];
                        $zt_icon = ['file-list-3' , 'image' , 'road-map' , 'book-3' , 'music-2' , 'clapperboard' , 'gamepad' , 'steam'];
                        $zt_category = ['post' , 'album' , 'tour' , 'book' , 'music' , 'movie' , 'steam' , 'true_steam'];
                    ?>
                    <?php for($i=0; $i<7; $i++) : ?>
                        <?php
                        if($i == 0){
                            $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                ->select('table.fields.cid')
                                ->from('table.fields')
                                ->join('table.contents', 'table.contents.cid = table.fields.cid')
                                ->where('table.contents.status = ?', 'publish')
                                ->where('table.contents.type = ?', 'post')
                                ->where('table.contents.password is NULL')
                                ->where('table.fields.name = ?', 'post_top_info_post_name')
                                ->where('table.fields.str_value != ?', '')
                                ->where('table.fields.type = ?', 'str')
                                ->order('table.fields.cid', Typecho_Db::SORT_DESC)
                                ->limit(6)
                            );
                        }else{
                            ${"counts_".$zt_category[$i]} = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('cid')->from('table.fields')->where('name = ?', 'post_top_info_select')->where('str_value = ?', $zt_category[$i])->where('type = ?', 'str')->order('cid', Typecho_Db::SORT_DESC));
                            if($i==4){ $t = 9; }else{ $t = 6; }
                            $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                ->select('table.fields.cid')
                                ->from('table.fields')
                                ->join('table.contents', 'table.contents.cid = table.fields.cid')
                                ->where('table.fields.name = ?', 'post_top_info_select')
                                ->where('table.contents.status = ?', 'publish')
                                ->where('table.contents.type = ?', 'post')
                                ->where('table.fields.str_value = ?', $zt_category[$i])
                                ->where('table.fields.type = ?', 'str')
                                ->order('table.fields.cid', Typecho_Db::SORT_DESC)
                                ->limit($t)
                            );
                        }
                        ?>
                        <?php if($counts || ${"counts_".$zt_category[$i]}): ?>
                        <div class="friends_block flex_zhuanti_add">
                            <div class="friends_zhuanti_title cat_<?php echo $zt_category[$i]; ?>_ANNIU" zhuanti="tab<?php echo $i+1; ?>"><i class="ri-<?php echo $zt_icon[$i]; ?>-line"></i> <?php echo $zt_title[$i]; ?><span class="friends_zhuanti_title_more"><i class="ri-arrow-right-line"></i></span></div>
                            <div class="flex_zhuanti_box_out">
                                <?php if($counts): ?>
                    		        <?php $m=0; foreach ($counts as $count): ?>
                    		            <?php $this->widget('Widget_Archive@zhuanti'. $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post); ?>
                            		    <div class="flex_zhuanti_box" style="<?php if($i<3 || $i==6) :?>width: calc((100% - var(--gap)) / 2);<?php else: ?>width: calc((100% - 2 * var(--gap)) / 3);<?php endif; ?>">
                                            <a href="<?php echo $cat_post->permalink ?>" style="width:100%;">
                                                <div class="cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_2line" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></div>
                                                <img class="lazyload box_img" style="<?php if($i==3 || $i==5) :?>aspect-ratio: 1/1.414;<?php elseif($i==4) :?>aspect-ratio: 1.09;<?php else: ?>aspect-ratio: 1.68;<?php endif; ?>" src="<?php echo get_Lazyload() ?>" data-src="<?php
                                                    if($i == 3){
                                                        echo $cat_post->fields->post_top_info_book_img ? $cat_post->fields->post_top_info_book_img : get_post_Thumbnail($cat_post);
                                                    }elseif($i == 4){
                                                        echo $cat_post->fields->post_top_info_music_img ? $cat_post->fields->post_top_info_music_img : get_post_Thumbnail($cat_post);
                                                    }elseif($i == 5){
                                                        echo $cat_post->fields->post_top_info_movie_img ? $cat_post->fields->post_top_info_movie_img : get_post_Thumbnail($cat_post);
                                                    }elseif($i == 6){
                                                        $gamearr = get_game_appid($cat_post->fields->post_top_info_steam_more);
                                                        echo !empty($gamearr['result']) ? $gamearr['result']['topic_detail']['hb2style']['bg_pic'] : get_post_Thumbnail($cat_post) ;
                                                    }else{
                                                        echo get_post_Thumbnail($cat_post);
                                                    }
                                                ?>">
                                            </a>
                                        </div>
                                    <?php $m++; endforeach; ?>
                                    <?php for ($n = 0; ($i==4 ? $n < 9 - $m : $n < 6 - $m); $n++): ?>
                                        <div class="cat_life_card_github" style="<?php if($i<3 || $i==6) :?>width: calc((100% - var(--gap)) / 2);<?php else: ?>width: calc((100% - 2 * var(--gap)) / 3);<?php endif; ?><?php if($i==3 || $i==5) :?>aspect-ratio: 1/1.414;<?php elseif($i==4) :?>aspect-ratio: 1.09;<?php else: ?>aspect-ratio: 1.68;<?php endif; ?>"></div>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if (!empty($this->options->cat_bili)): ?>
                        <div class="friends_block flex_zhuanti_add">
                            <div class="friends_zhuanti_title" zhuanti="tab8"><i class="ri-bilibili-line"></i> 番剧<span class="friends_zhuanti_title_more"><i class="ri-arrow-right-line"></i></span></div>
                            <?php
                                header("Content-Type:text/html;charset=UTF-8");
                				$biliuid = $this->options->cat_bili;
                                $opts = array(
                                    'http'=>array(
                                        'method'=>"GET",
                                        'header'=>"Accept-language: en\r\n"
                                    )
                                );
                                echo '<div class="flex_zhuanti_box_out">';
                                $context = stream_context_create($opts);
                                $json_string = file_get_contents('https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=2&pn=1&ps=21&vmid=' . $biliuid, false, $context); 
                                $data = json_decode($json_string);
                                $list = $data->data->list;
                                $str = '';
                                for ($i = 0; $i < 6; $i++) {
                                    $ss = $list[$i]->season_id;
                                    $cover = $list[$i]->cover;
                                    $title = $list[$i]->title;
                                    $evaluate = $list[$i]->evaluate;
                                    $patten = array("\r\n", "\n", "\r");
                                    $evaluate = str_replace($patten, " ", $evaluate);
                                    $season_type_name = $list[$i]->season_type_name;
                                    $area = $list[$i]->areas[0]->name;
                                    $index_show = $list[$i]->new_ep->index_show;
                                    $str .= "<div class='flex_zhuanti_box' style='width: calc((100% - 2 * var(--gap)) / 3);'>
                                                        <div>
                                                            <div class='cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_2line' title='$title'>$title</div>
                                                            <img class='box_img' style='aspect-ratio: 1 / 1.414;' referrerPolicy='no-referrer' src='$cover@220w_280h.jpg' alt=''>
                                                        </div>
                                                    </div>";
                                  };
                                  $str = preg_replace('/\\n*/', '', $str);
                                  echo $str;
                                  echo '</div>';
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($this->options->cat_github)): ?>
                        <div class="friends_block flex_zhuanti_add">
                            <div class="friends_zhuanti_title" zhuanti="tab9"><i class="ri-github-line"></i> 项目<span class="friends_zhuanti_title_more"><i class="ri-arrow-right-line"></i></span></div>
                            <?php
                                $file = file_get_contents("githubinfo.json");
                                $arr = json_decode($file,true);
                                $view = '<div class="flex_zhuanti_box_out">';
                                foreach ($arr as $i => $item){
                                    if($i>=6) break;
                                    $view .= '<div class="cat_life_card_github">
                                                    <div class="title">' . $item['name'] . '</div>
                                                    <div class="cat_indexcard_time_2line">' . $item['description'] . '</div>
                                                </div>
                                            ';
                                }
                                $view .= '</div>';
                                echo $view;
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($this->options->cat_steamid) && !empty($this->options->cat_steamkey)): ?>
                        <div class="friends_block flex_zhuanti_add">
                            <div class="friends_zhuanti_title" zhuanti="tab10"><i class="ri-steam-line"></i> Steam<span class="friends_zhuanti_title_more"><i class="ri-arrow-right-line"></i></span></div>
                            <?php
                                $file = file_get_contents("pre_steam_ok.html");
                                $pattern = '/<img class="lazyload box_img" src="data:image\/gif;base64,R0lGODlhAQABAIAAAAAAAP\/\/\/yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="(.*?)">/';
                                preg_match_all($pattern, $file, $matches);
                                $view = '<div class="flex_zhuanti_box_out">';
                                foreach ($matches[1] as $i => $item){
                                    if($i>=6) break;
                                    $view .= "<div class='flex_zhuanti_box' style='width: calc((100% - var(--gap)) / 2);'>
                                                    <img style='aspect-ratio: 1.68;' class='box_img' src='$item' alt=''>
                                                </div>";
                                }
                                $view .= '</div>';
                                echo $view;
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
        </section>
		<section class="tab1 cat_post_tab">
                <?php
                    $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                        ->select('table.fields.cid')
                        ->from('table.fields')
                        ->join('table.contents', 'table.contents.cid = table.fields.cid')
                        ->where('table.contents.status = ?', 'publish')
                        ->where('table.contents.type = ?', 'post')
                        ->where('table.contents.password is NULL')
                        ->where('table.fields.name = ?', 'post_top_info_select')
                        ->where('table.fields.str_value = ?', 'post')
                        ->where('table.fields.type = ?', 'str')
                        ->order('table.fields.cid', Typecho_Db::SORT_DESC)
                    );
                ?>
                <?php
                    foreach ($counts as $count) {
                        $post_names = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                            ->select('str_value')
                            ->from('table.fields')
                            ->where('name = ?', 'post_top_info_post_name')
                            ->where('cid = ?', $count)
                            ->where('type = ?', 'str')
                        );
                        $post_name[] = $post_names[0]['str_value'];
                    }
					if($post_name){
						$post_new_names = array_unique($post_name);
						$post_new_names = array_filter($post_new_names);
					}
                ?>
                <?php if($counts): ?>
                    <ul class="cat_index_tags" style="cursor: pointer;margin-bottom: var(--margin);"> 
                        <?php foreach ($post_new_names as $post_new_name): ?>
                        <?php if ($post_new_name): ?>
                            <li class="friends_block"> 
                                📓 <div class="cat_post_tabname" style="display:inline-block;"><?php echo $post_new_name; ?></div>
                            </li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <div class="cat_grid">
        		        <?php $i=0; foreach ($counts as $count): ?>
        		        <?php $this->widget('Widget_Archive@zuopin'. $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post); ?>
        		        <?php if(!empty($post_name[$i])): ?>
                        	<div class="friends_block" data_post="<?php echo $post_name[$i]; ?>" style="padding:0;display:none;">
                                <div style="position: relative;">
                                    <a href="<?php echo $cat_post->permalink ?>">
                                        <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-file-list-3-line"></i></div>
                                        <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo $cat_post->date('Y年n月j日') ?></div>
                                        <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($cat_post) ?>">
                                        <div class="cat_indexcard_time cat_indexcard_time_4" title="标题：<?php echo $cat_post->title ?>" style="max-width:70%"><i class="ri-h-1"></i> <?php echo $cat_post->title ?></div>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
        		        <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
        </section>
        <section class="tab2 cat_album_tab">
                <?php
                    $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                        ->select('table.fields.cid')
                        ->from('table.fields')
                        ->join('table.contents', 'table.contents.cid = table.fields.cid')
                        ->where('table.contents.status = ?', 'publish')
                        ->where('table.contents.type = ?', 'post')
                        ->where('table.contents.password is NULL')
                        ->where('table.fields.name = ?', 'post_top_info_select')
                        ->where('table.fields.str_value = ?', 'album')
                        ->where('table.fields.type = ?', 'str')
                        ->order('table.fields.cid', Typecho_Db::SORT_DESC)
                    );
                ?>
                <?php
                    foreach ($counts as $count) {
                        $album_names = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                            ->select('str_value')
                            ->from('table.fields')
                            ->where('name = ?', 'post_top_info_album_name')
                            ->where('cid = ?', $count)
                            ->where('type = ?', 'str')
                        );
                        if(empty($album_names[0]['str_value'])){
                            $album_name[] = '默认相册';
                        }else{
                            $album_name[] = $album_names[0]['str_value'];
                        }
                    }
					if($album_name){
						$album_new_names = array_unique($album_name);
					}
                ?>
                <?php if($album_new_names): ?>
                    <ul class="cat_index_tags" style="cursor: pointer;margin-bottom: var(--margin);"> 
                        <?php foreach ($album_new_names as $album_new_name): ?>
                            <li class="friends_block"> 
                                📒 <div class="cat_album_tabname" style="display:inline-block;"><?php echo $album_new_name; ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="cat_grid">
        		        <?php $i=0; foreach ($counts as $count): ?>
        		        <?php $this->widget('Widget_Archive@album'. $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post); ?>
                            <?php
                                $single = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                    ->select('commentsNum','views','text')
                                    ->from('table.contents')
                                    ->where('cid = ?', $count['cid'])
                                    ->where('status = ?', 'publish')
                                    ->where('type = ?', 'post')
                                );
                                $text = $single[0]['text'];
                		    ?>
                        	<div class="friends_block" data_album="<?php echo $album_name[$i] ? $album_name[$i] : '默认相册'; ?>" style="padding:0;display:none;">
                                <div style="position: relative;">
                                    <a href="<?php echo $cat_post->permalink ?>">
                                        <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-image-line"></i></div>
                                        <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo '<i class="ri-eye-line"></i> ' . $single[0]['views'] . ' / <i class="ri-message-3-line"></i> ' . $single[0]['commentsNum'] ?></div>
                                        <div class="cat_indexcard_time cat_indexcard_time_4" title="标题：<?php echo $cat_post->title ?>" style="max-width:70%"><i class="ri-h-1"></i> <?php echo $cat_post->title ?></div>
                                        <div class="cat_album_out">
                                            <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($text)[0] ?>">
                                            <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($text)[1] ?>">
                                            <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($text)[2] ?>">
                                            <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_album_Thumbnail($text)[3] ?>">
                                        </div>
                                    </a>
                                </div>
                            </div>
        		        <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
        </section>
		<section class="tab3">
                <?php
                    $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                        ->select('table.fields.cid')
                        ->from('table.fields')
                        ->join('table.contents', 'table.contents.cid = table.fields.cid')
                        ->where('table.contents.status = ?', 'publish')
                        ->where('table.contents.type = ?', 'post')
                        ->where('table.contents.password is NULL')
                        ->where('table.fields.name = ?', 'post_top_info_select')
                        ->where('table.fields.str_value = ?', 'tour')
                        ->where('table.fields.type = ?', 'str')
                        ->order('table.fields.cid', Typecho_Db::SORT_DESC)
                    );
                ?>
                <?php if($counts): ?>
                    <div class="cat_grid">
        		        <?php foreach ($counts as $count): ?>
        		        <?php $this->widget('Widget_Archive@album'. $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post); ?>
                            <?php
                                $single = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                    ->select('commentsNum','views','text')
                                    ->from('table.contents')
                                    ->where('cid = ?', $count['cid'])
                                    ->where('status = ?', 'publish')
                                    ->where('type = ?', 'post')
                                );
                		    ?>
                        	<div class="friends_block" style="padding:0;" zuobiao_id="<?php echo $cat_post->fields->post_top_info_tour_more ?>">
                                <div style="position: relative;">
                                    <a href="<?php echo $cat_post->permalink ?>">
                                        <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-road-map-line"></i></div>
                                        <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo '<i class="ri-eye-line"></i> ' . $single[0]['views'] . ' / <i class="ri-message-3-line"></i> ' . $single[0]['commentsNum'] ?></div>
                                        <div class="cat_indexcard_time cat_indexcard_time_4" title="标题：<?php echo $cat_post->title ?>" style="max-width:70%"><i class="ri-h-1"></i> <?php echo $cat_post->title ?></div>
                                        <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($cat_post) ?>">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
		</section>
		<section class="tab4 cat_book_tab">
                <?php
                    $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                        ->select('table.fields.cid')
                        ->from('table.fields')
                        ->join('table.contents', 'table.contents.cid = table.fields.cid')
                        ->where('table.contents.status = ?', 'publish')
                        ->where('table.contents.type = ?', 'post')
                        ->where('table.contents.password is NULL')
                        ->where('table.fields.name = ?', 'post_top_info_select')
                        ->where('table.fields.str_value = ?', 'book')
                        ->where('table.fields.type = ?', 'str')
                        ->order('table.fields.cid', Typecho_Db::SORT_DESC)
                    );
                ?>
                <?php
                    foreach ($counts as $count) {
                        $book_names = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                            ->select('str_value')
                            ->from('table.fields')
                            ->where('name = ?', 'post_top_info_book_fenlei')
                            ->where('cid = ?', $count)
                            ->where('type = ?', 'str')
                        );
                        if(empty($book_names[0]['str_value'])){
                            $book_name[] = '默认书单';
                        }else{
                            $book_name[] = $book_names[0]['str_value'];
                        }
                    }
					if($book_name){
						$book_new_names = array_unique($book_name);
					}
                ?>
                <?php if($book_new_names): ?>
                    <ul class="cat_index_tags" style="cursor: pointer;margin-bottom: var(--margin);"> 
                        <?php foreach ($book_new_names as $book_new_fenlei): ?>
                            <li class="friends_block"> 
                                📚 <div class="cat_book_tabname" style="display:inline-block;"><?php echo $book_new_fenlei; ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <div class="cat_grid" style="grid-template-columns: repeat(auto-fill,minmax(18rem,1fr));">
        		        <?php $i=0; foreach ($counts as $count): ?>
        		        <?php $this->widget('Widget_Archive@book'. $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post); ?>
                            <?php
                                $single = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                    ->select('commentsNum','views')
                                    ->from('table.contents')
                                    ->where('cid = ?', $count['cid'])
                                    ->where('status = ?', 'publish')
                                    ->where('type = ?', 'post')
                                );
                		    ?>
                        	<div class="friends_block" data_book="<?php echo $book_name[$i] ? $book_name[$i] : '默认书单'; ?>" style="padding:0;display:none;">
                                <div style="position: relative;">
                                    <a href="<?php echo $cat_post->permalink ?>">
                                        <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-book-3-line"></i></div>
                                        <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo '<i class="ri-eye-line"></i> ' . $single[0]['views'] . ' / <i class="ri-message-3-line"></i> ' . $single[0]['commentsNum'] ?></div>
                                        <img class="lazyload box_img" style="aspect-ratio: 1 / 1.414;" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $cat_post->fields->post_top_info_book_img ? $cat_post->fields->post_top_info_book_img : get_post_Thumbnail($cat_post) ?>">
                                        <div class="cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_info">
                                            <span title="标题：<?php echo $cat_post->title ?>"><i class="ri-h-1"></i> <?php echo $cat_post->title ?></span>
                                            <span title="书籍：<?php echo $cat_post->fields->post_top_info_book_name ?>"><i class="ri-book-3-line"></i> <?php echo $cat_post->fields->post_top_info_book_name ?></span>
                                            <span title="作者：<?php echo $cat_post->fields->post_top_info_book_author ?>"><i class="ri-user-5-line"></i> <?php echo $cat_post->fields->post_top_info_book_author ?></span>
                                            <span title="评分：<?php get_stars_num($cat_post->fields->post_top_info_book_star) ?>"><i class="ri-star-smile-line"></i> <?php get_stars($cat_post->fields->post_top_info_book_star) ?></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
        		        <?php $i++; ?>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
        </section>
		<section class="tab5">
            <?php
                $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                    ->select('table.fields.cid')
                        ->from('table.fields')
                        ->join('table.contents', 'table.contents.cid = table.fields.cid')
                        ->where('table.contents.status = ?', 'publish')
                        ->where('table.contents.type = ?', 'post')
                        ->where('table.contents.password is NULL')
                        ->where('table.fields.name = ?', 'post_top_info_select')
                        ->where('table.fields.str_value = ?', 'music')
                        ->where('table.fields.type = ?', 'str')
                        ->order('table.fields.cid', Typecho_Db::SORT_DESC)
                );
            ?>
            <?php if($counts): ?>
                <div class="cat_grid">
    		        <?php foreach ($counts as $count): ?>
    		        <?php $this->widget('Widget_Archive@album'. $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post); ?>
                        <?php
                            $single = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                ->select('commentsNum','views')
                                ->from('table.contents')
                                ->where('cid = ?', $count['cid'])
                                ->where('status = ?', 'publish')
                                ->where('type = ?', 'post')
                            );
            		    ?>
                    	<div class="friends_block">
                    	    <div class="box_out" style="margin-bottom: 1rem;">
                                <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-music-2-line"></i></div>
                                <meting-js
                                	server="netease"
                                	type="song"
                                	id="<?php echo $cat_post->fields->post_top_info_music_more ?>">
                                </meting-js>
                            </div>
                            <div class="friends_post_post friends_musicpost" title="标题：<?php echo $cat_post->title ?>"><i class="ri-h-1"></i> <a href="<?php echo $cat_post->permalink ?>"><?php echo $cat_post->title ?></a></div>
                            <div class="friends_post_post friends_musicpost" title="创作：<?php echo $cat_post->fields->post_top_info_music_author ?>"><i class="ri-user-5-line"></i> <?php echo $cat_post->fields->post_top_info_music_author ?></div>
                            <div class="friends_post_post friends_musicpost" title="评分：<?php get_stars_num($cat_post->fields->post_top_info_music_star) ?>"><i class="ri-star-smile-line"></i> <?php get_stars($cat_post->fields->post_top_info_music_star) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
		</section>
		<section class="tab6">
            <?php
                $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                    ->select('table.fields.cid')
                        ->from('table.fields')
                        ->join('table.contents', 'table.contents.cid = table.fields.cid')
                        ->where('table.contents.status = ?', 'publish')
                        ->where('table.contents.type = ?', 'post')
                        ->where('table.contents.password is NULL')
                        ->where('table.fields.name = ?', 'post_top_info_select')
                        ->where('table.fields.str_value = ?', 'movie')
                        ->where('table.fields.type = ?', 'str')
                        ->order('table.fields.cid', Typecho_Db::SORT_DESC)
                );
            ?>
            <?php if($counts): ?>
                <div class="cat_grid" style="grid-template-columns: repeat(auto-fill,minmax(18rem,1fr));">
    		        <?php foreach ($counts as $count): ?>
    		        <?php $this->widget('Widget_Archive@album'. $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post); ?>
                        <?php
                            $single = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                ->select('commentsNum','views')
                                ->from('table.contents')
                                ->where('cid = ?', $count['cid'])
                                ->where('status = ?', 'publish')
                                ->where('type = ?', 'post')
                            );
            		    ?>
                    	<div class="friends_block" style="padding:0;">
                            <div style="position: relative;">
                                <a href="<?php echo $cat_post->permalink ?>">
                                    <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-clapperboard-line"></i></div>
                                    <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo '<i class="ri-eye-line"></i> ' . $single[0]['views'] . ' / <i class="ri-message-3-line"></i> ' . $single[0]['commentsNum'] ?></div>
                                    <img class="lazyload box_img" style="aspect-ratio: 1 / 1.414;" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $cat_post->fields->post_top_info_movie_img ? $cat_post->fields->post_top_info_movie_img : get_post_Thumbnail($cat_post) ?>">
                                    <div class="cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_info">
                                        <span title="标题：<?php echo $cat_post->title ?>"><i class="ri-h-1"></i> <?php echo $cat_post->title ?></span>
                                        <span title="影片：<?php echo $cat_post->fields->post_top_info_movie_name ?>"><i class="ri-clapperboard-line"></i> <?php echo $cat_post->fields->post_top_info_movie_name ?></span>
                                        <span title="导演：<?php echo $cat_post->fields->post_top_info_movie_author ?>"><i class="ri-user-5-line"></i> <?php echo $cat_post->fields->post_top_info_movie_author ?></span>
                                        <span title="评分：<?php get_stars_num($cat_post->fields->post_top_info_movie_star) ?>"><i class="ri-star-smile-line"></i> <?php get_stars($cat_post->fields->post_top_info_movie_star) ?></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
		</section>
		<section class="tab7">
		    <?php
                    $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                        ->select('table.fields.cid')
                        ->from('table.fields')
                        ->join('table.contents', 'table.contents.cid = table.fields.cid')
                        ->where('table.contents.status = ?', 'publish')
                        ->where('table.contents.type = ?', 'post')
                        ->where('table.contents.password is NULL')
                        ->where('table.fields.name = ?', 'post_top_info_select')
                        ->where('table.fields.str_value = ?', 'steam')
                        ->where('table.fields.type = ?', 'str')
                        ->order('table.fields.cid', Typecho_Db::SORT_DESC)
                    );
                ?>
                <?php if($counts): ?>
                    <div class="cat_grid">
        		        <?php foreach ($counts as $count): ?>
        		        <?php $this->widget('Widget_Archive@game'. $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($cat_post); ?>
                            <?php
                                $single = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                    ->select('commentsNum','views')
                                    ->from('table.contents')
                                    ->where('cid = ?', $count['cid'])
                                    ->where('status = ?', 'publish')
                                    ->where('type = ?', 'post')
                                );
                		    ?>
                    		<div class="friends_block" style="padding:0;">
                    		    <div style="position: relative;">
                                    <a href="<?php echo $cat_post->permalink ?>">
                                        <?php $game = get_game_appid($cat_post->fields->post_top_info_steam_more); ?>
                                        <?php if(empty($game['result'])) : ?>
                                            <div style="text-align: center;">游戏APPID读取失败</div>
                                        <?php else: ?>
                                            <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-gamepad-line"></i></div>
                                            <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo '<i class="ri-eye-line"></i> ' . $single[0]['views'] . ' / <i class="ri-message-3-line"></i> ' . $single[0]['commentsNum'] ?></div>
                                            <div class="cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_info">
                                                <span title="标题：<?php echo $cat_post->title ?>"><i class="ri-h-1"></i> <?php echo $cat_post->title ?></span>
                                                <span title="游戏：<?php echo $game['result']['name'] ?>"><i class="ri-gamepad-line"></i> <?php echo $game['result']['name'] ?></span>
                                                <span title="评分：<?php get_stars_num($game['result']['score']) ?>"><i class="ri-star-smile-line"></i> <?php get_stars($game['result']['score']) ?></span>
                                            </div>
                                            <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $game['result']['topic_detail']['hb2style']['bg_pic'] ?>">
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
		</section>
		<?php if (!empty($this->options->cat_bili)): ?>
		<section class="tab8">
	 		    <?php
    				header("Content-Type:text/html;charset=UTF-8");
    				$biliuid = $this->options->cat_bili;
    				$result = file_get_contents("https://api.bilibili.com/x/web-interface/card?mid=" . $biliuid . "&jsonp=jsonp&article=true");
    				$arr=json_decode($result,true);
    			?>	
                <?php if ($arr['code']==0) : ?>
                    <div class='friends_block' style="margin-bottom: var(--margin);">
                        <div class="cat_title_logoimage"><i class="ri-bilibili-fill"></i></div>
                        <div style='position: relative;float: left;padding-right: 1rem;'>
                            <img class='box_img' style='height: 10rem;width:10rem;' referrerPolicy='no-referrer' src='<?php echo $arr['data']['card']['face'] ?>' alt=''>
                        </div>
                        <div class='anime_right'>
                            <div class='animetitle'>
                                <?php echo $arr['data']['card']['name'] ?>
                                <div title='<?php echo $arr['data']['card']['nameplate']['name'] ?>' style="display:inline-block; vertical-align: sub;"><img referrerpolicy="no-referrer" style="width: 1.5rem;" src="<?php echo $arr['data']['card']['nameplate']['image_small'] ?>" alt="" /></div>
                                <div title='等级' class='animetags animeinfo lv_cat' style="vertical-align: middle;">Lv.<?php echo $arr['data']['card']['level_info']['current_level'] ?></div>
                            </div>
                            <div class='animetags'>
                                <div class='animeinfo'>关注：<?php echo $arr['data']['card']['attention'] ?></div>
                                <div class='animeinfo'>粉丝：<?php echo $arr['data']['card']['fans'] ?></div>
                            </div>
                            <div class='animeword'><?php echo $arr['data']['card']['sign'] ?></div>
                        </div>
                    </div>
                    <?php else: ?> 
    					出错啦！联系火喵解决！
    				<?php endif; ?> 
                <?php
                    $opts = array(
                        'http'=>array(
                            'method'=>"GET",
                            'header'=>"Accept-language: en\r\n"
                        )
                    );
                    echo '<div class="section_anime">';
                    $context = stream_context_create($opts);
                    $json_string = file_get_contents('https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=2&pn=1&ps=21&vmid=' . $biliuid, false, $context); 
                    $data = json_decode($json_string);
                    $list = $data->data->list;
                    $str = '';
                    $num = count($list);
                    for ($i = 0; $i < $num; $i++) {
                        $ss = $list[$i]->season_id;
                        $cover = $list[$i]->cover;
                        $title = $list[$i]->title;
                        $evaluate = $list[$i]->evaluate;
                        $patten = array("\r\n", "\n", "\r");
                        $evaluate = str_replace($patten, " ", $evaluate);
                        $season_type_name = $list[$i]->season_type_name;
                        $area = $list[$i]->areas[0]->name;
                        $index_show = $list[$i]->new_ep->index_show;
                        $str .= "<div class='friends_block'>
                                    <div style='position: relative;float: left;padding-right: 1rem;'>
                                        <div class='cat_indexcard_time cat_indexcard_time_1'><i class='ri-bilibili-line'></i></div>
                                        <img class='box_img' style='height: 12rem;aspect-ratio: 3 / 4;' referrerPolicy='no-referrer' src='$cover@220w_280h.jpg' alt=''>
                                    </div>
                                    <div class='anime_right'>
                                        <div title='$title' class='animetitle'>$title</div>
                                        <div class='animetags'>
                                            <div class='animeinfo'>$season_type_name</div>
                                            <div class='animeinfo'>$area</div>
                                            <div class='animeinfo'>$index_show</div>
                                        </div>
                                        <div class='animeword'>$evaluate</div>
                                        </div>
                                    </div>";
                      };
                      $str = preg_replace('/\\n*/', '', $str);
                      echo $str;
                      echo '</div>';
                ?>
		</section>
		<?php endif; ?>
		<?php if (!empty($this->options->cat_github)): ?>
		<section class="tab9">
            <?php
            if(file_exists('githubinfo.json') && (time() - filemtime("githubuser.json") < 3600) && (time() - filemtime("githubinfo.json") < 3600)){
                $file = file_get_contents("githubuser.json");
                $arr = json_decode($file,true);
                echo '<div class="friends_block" style="margin-bottom: var(--margin);">
                    	<div class="cat_title_logoimage"><i class="ri-github-fill"></i></div>
                    	<div class="anime_right">
                    		<a style="font-size: 1.5rem;margin: 2rem 0;line-height: 3rem;" href="' . $arr['html_url'] . '" target="_blank">' . $arr['name'] . '</a>
                    		<div class="animetags">
                    			<div class="animeinfo">关注：' . $arr['following'] . '</div>
                    			<div class="animeinfo">粉丝：' . $arr['followers'] . '</div>
                    		</div>
                			<div style="margin: 0.5rem;">地理位置：' . $arr['location'] . '</div>
                			<div style="margin: 0.5rem;">仓库数量：' . $arr['public_repos'] . '</div>
                			<div style="margin: 0.5rem;">注册时间：' . date("Y年n月j日",strtotime($arr['created_at'])) . '</div>
                    	</div>
                    </div>';
                $file = file_get_contents("githubinfo.json");
                $arr = json_decode($file,true);
                $view = '<div class="cat_grid">';
                $i = 0;
                foreach ($arr as $item){
                    if($i>=40) break;
                        $view .= '
                        <div class="friends_block">
                        	<div class="box_out">
                        		<div class="box_avatar">
                        			<div class="box_avatar_right">
                        				<a target="_blank" href="' . $item['html_url'] . '" data-pjax-state="">' . $item['name'] . '</a>
                        				<i class="linkicon ri-github-line"></i>
                        			</div>
                        		</div>
                        	</div>
                        	<div class="friends_link_desc"><i title="watch" class="ri-eye-line"></i>' . $item['watchers_count'] . ' / <i title="fork" class="ri-git-branch-line"></i>' . $item['forks_count'] . ' / <i title="star" class="ri-star-line"></i>' . $item['stargazers_count'] . '</div>
                        	<div class="friends_link_desc" style="-webkit-line-clamp: 2;height: 3.5rem;">' . $item['description'] . '</div>
                        	<div style="text-align: center;color: var(--colorD);margin-top: 0.5rem;">- ' . ($item['language'] ? $item['language'] : '未知') . ' -</div>
                        </div>
                        ';
                        $i++;   
                }
                $view .= '</div>';
                echo $view;
                }else{
                    $link = 'https://api.github.com/users/' . $this->options->cat_github;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $link);
                    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $ret = curl_exec($ch);
                    curl_close($ch);
                    file_put_contents("githubuser.json",$ret);
                    $link = 'https://api.github.com/users/' . $this->options->cat_github . '/repos';
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $link);
                    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $ret = curl_exec($ch);
                    curl_close($ch);
                    file_put_contents("githubinfo.json",$ret);
                }
            ?>
		</section>
		<?php endif; ?>
		<?php if (!empty($this->options->cat_steamid) && !empty($this->options->cat_steamkey)): ?>
		<section class="tab10">
        <?php
            $settime = ($this->options->cat_steam_updatetime ? $this->options->cat_steam_updatetime : '259200');
        ?>
        <?php if(file_exists('pre_steam_ok.html') && (time() - filemtime("pre_steam_ok.html") < $settime) && (!isset($_GET["type"]) || ($_GET["type"] != 'RELOAD'))) : ?>
            <?php include('pre_steam_ok.html'); ?>
        <?php else: ?>
            <?php ob_start(); ?>
            <?php
            $json_z = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v2/?key=" . $this->options->cat_steamkey . "&steamids=" . $this->options->cat_steamid);
            $json_userinfo = json_decode($json_z, true);
            $json_a = file_get_contents("http://api.steampowered.com/IPlayerService/GetOwnedGames/v1/?key=" . $this->options->cat_steamkey . "&steamid=" . $this->options->cat_steamid);
            $json_info = json_decode($json_a, true);
            $json_b = file_get_contents("http://api.steampowered.com/IPlayerService/GetSteamLevel/v1/?key=" . $this->options->cat_steamkey . "&steamid=" . $this->options->cat_steamid);
            $json_level = json_decode($json_b, true);
            $json_c = file_get_contents("http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=" . $this->options->cat_steamkey . "&steamid=" . $this->options->cat_steamid . "&format=json");
            $json_week = json_decode($json_c, true);
            error_reporting(E_ERROR);
            ini_set("display_errors","Off");
            $json_d = file_get_contents("http://api.steampowered.com/ISteamUser/GetFriendList/v1/?key=" . $this->options->cat_steamkey . "&steamid=" . $this->options->cat_steamid);
            $json_friends = json_decode($json_d, true);
            ?>
            <div class='friends_block' style="margin-bottom: var(--margin);">
                <div class="cat_title_logoimage"><i class="ri-steam-fill"></i></div>
                <div class='box_out' style='float: left;padding-right: 1rem;'>
                    <img class='box_img' style='height: 10rem;width:10rem;' referrerPolicy='no-referrer' src='<?php echo $json_userinfo['response']['players'][0]['avatarfull'] ?>' alt=''>
                    <?php if ($this->user->hasLogin()):?>
                        <a title="手动刷新steam缓存" href='?type=RELOAD' style="position: absolute; right: 1rem; bottom: 0; color: #fff;"><i class="ri-refresh-line"></i></a>
                    <?php endif; ?>
                </div>
                <div class='anime_right'>
                    <a href='<?php echo $json_userinfo['response']['players'][0]['profileurl'] ?>' target='_blank' class='animetitle'>
                        <?php echo $json_userinfo['response']['players'][0]['personaname'] ?>
                    </a>
                    <div class='animetags'>
                        <div class='animeinfo'>等级：<?php echo $json_level['response']['player_level'] ?></div>
                        <div class='animeinfo'>库存：<?php echo $json_info['response']['game_count'] ?></div>
                    </div>
                    <?php if($json_week['response']['total_count'] !== 0): ?>
                        <?php 
                            $i=1; 
                            foreach ($json_week['response']['games'] as $json_week_game)  { 
                            if($i>=3) break;
                        ?>
                        <img style='border-radius: var(--radius);width: 10rem;height: 5rem;margin: 1rem 0.5rem 0 0;' src='<?php echo $this->options->cat_steamcdn ? $this->options->cat_steamcdn() : 'https://media.st.dl.eccdnx.com' ?>/steam/apps/<?php echo $json_week_game['appid'] ?>/header.jpg' alt=''>
                       <?php $i++; } ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($json_friends) : ?>
                <div class="cat_grid friends_block" style="margin-bottom: var(--margin);grid-template-columns: repeat(auto-fill,minmax(5rem,1fr));"> 
                    <?php foreach ($json_friends['friendslist']['friends'] as $json_friends_info) : ?>
                        <?php 
                            $friendjson = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v2/?key=" . $this->options->cat_steamkey . "&steamids=" . $json_friends_info['steamid']); 
                            $friendavatar = json_decode($friendjson, true);
                        ?>
                        <img style="width:4rem;height:4rem;margin: auto;" title='<?php echo $friendavatar['response']['players'][0]['personaname'] ?>' class="lazyload box_img" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src='<?php echo $friendavatar['response']['players'][0]['avatarmedium'] ?>' alt=''>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php
                function levelSort($aa, $bb) {
                    if($aa['playtime_forever'] == $bb['playtime_forever']) return 0;
                    return ($aa['playtime_forever']<$bb['playtime_forever']) ? 1 : -1;
                }
                usort($json_info['response']['games'], 'levelSort');
            ?>
            <div class="section_first">
                <?php foreach($json_info['response']['games'] as $i => $item) :?>
                    <?php if($i<30) :?>
                        <div class="box_out">
                            <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-steam-line"></i></div>
                            <div class="cat_indexcard_time cat_indexcard_time_2"><?php echo date('Y年n月j日',$item['rtime_last_played']) ?></div>
                            <div class="cat_indexcard_time cat_indexcard_time_3">游玩<?php echo round($item['playtime_forever']/60,1) ?>小时</div>
                            <img class="lazyload box_img" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $this->options->cat_steamcdn ? $this->options->cat_steamcdn() : 'https://media.st.dl.eccdnx.com' ?>/steam/apps/<?php echo $item['appid']?>/header.jpg">
                        </div>
                    <?php endif; ?>    
                <?php endforeach; ?>    
            </div>
        	<?php
                $content = ob_get_contents();
                $content .= "\n<!--Create time: " . date( 'Y-m-d H:i:s' ) . "-->";
                file_put_contents('pre_steam_ok.html',$content);
            ?>
        <?php endif; ?>
		</section>
		<?php endif; ?>
	</div>
</div>
<?php $this->need('parts/footer.php'); ?>