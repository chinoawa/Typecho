<div class="user_webinfo">
    <div class="foot_left">
        <img class="head_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php get_user_avatar() ?>" alt="博客主页" />
        <span class="foot_one_line" style="font-size:1rem; margin-top: 0.5rem;"><?php $this->options->title() ?></span>
        <span class="foot_one_line"><?php $this->options->description() ?></span>
        <span class="foot_one_line foot_left_icon">
            <?php if($this->options->cat_51tongji_id && $this->options->cat_51tongji_ck){ echo "<a title='51统计' href='https://v6.51.la/' target='_blank'><img src='" . resource_cdn() . 'img/51tongji.png'; echo"' alt='51统计' /></a>";} ?>
        	<?php if($this->options->cat_baidutongji){echo "<a title='百度统计' href='https://tongji.baidu.com/' target='_blank'><img src='" . resource_cdn() . 'img/bdtongji.png'; echo "'alt='百度统计' /></a>";} ?>
        	<?php if($this->options->cat_footer_icon) : ?>
        	    <?php
                    $cat_footer_iconsinfo = $this->options->cat_footer_icon;
                    if ($cat_footer_iconsinfo) {
                        $cat_footer_iconsinfo_arr = array_values(array_filter(explode("\r\n", $cat_footer_iconsinfo)));
                        if (count($cat_footer_iconsinfo_arr) > 0) {
                            for ($i = 0; $i < count($cat_footer_iconsinfo_arr); $i++) {
                                $logo = explode("||", $cat_footer_iconsinfo_arr[$i])[0];
                                $addr = explode("||", $cat_footer_iconsinfo_arr[$i])[1];
                                $name = explode("||", $cat_footer_iconsinfo_arr[$i])[2];
                        ?>
                            <a href="<?php echo $addr; ?>" title="<?php echo $name; ?>" target="_blank"><?php echo $logo; ?></a>
                        <?php
                            }
                        }
                    }
                ?>
            <?php endif; ?>
            <?php if($this->options->cat_diary_rss == 'on'){ echo "<a title='订阅日记' href='/cat_diary_rss.xml'><i style='color:#0077c1;' class='ri-rss-fill'></i></a>";} ?>
    	</span>
    </div>
    <div class="foot_right">
        <?php if($this->options->cat_moeicp) : ?>
            <span class="foot_one_line">
                <img src="<?php echo resource_cdn() . 'img/moeicp.png'; ?> " alt="" />
                <a href="https://icp.gov.moe/?keyword=<?php $this->options->cat_moeicp() ?>" target="_blank">萌ICP备<?php $this->options->cat_moeicp() ?>号</a>
            </span>
        <?php endif; ?>
        <?php if($this->options->cat_icp) : ?>
            <span class="foot_one_line">
                <img src="<?php echo resource_cdn() . 'img/icp.png'; ?>" alt="" />
                <a href="https://beian.miit.gov.cn/#/Integrated/index" target="_blank"><?php $this->options->cat_icp() ?></a>
            </span>
        <?php endif; ?>
        <?php if($this->options->cat_gwab) : ?>
            <span class="foot_one_line">
                <img src="<?php echo resource_cdn() . 'img/beian.png'; ?>" alt="" />
                <a href="https://beian.mps.gov.cn/#/query/webSearch" target="_blank"><?php $this->options->cat_gwab() ?></a>
            </span>
        <?php endif; ?>
        <?php if ($this->options->cat_footer_upyun == 'on') : ?>
    		<span class="foot_one_line"><img src="<?php echo resource_cdn() . 'img/upyun.png'; ?>" alt="" /> 本站由<a href="https://www.upyun.com/?utm_source=lianmeng&utm_medium=referral" target="_blank"><img style="width: auto; height: 0.75rem; margin:0 0.5rem;"src="<?php echo resource_cdn() . 'img/upyun_logo.webp'; ?>" alt="又拍云" /></a>提供CDN加速/云存储服务</span>
    	<?php endif; ?>
    	<?php echo $this->options->cat_user_footinfo ? '<span class="foot_one_line">' . $this->options->cat_user_footinfo .'</span>' : '' ?>
    	<?php if($_SERVER['SERVER_NAME'] == 'www.mmbkz.cn'): ?>
            <?php if ($this->options->cat_birthday) : ?>
        		<span class="foot_one_line">
        			<img src="/ziyuan/xyear.ico" alt="" /><?php echo ' 十年之约 ' . getBuildTime($this->options->cat_birthday,false,false); ?>
        		</span>
        	<?php endif; ?>
        	<span class="foot_one_line">🌸 本站由<a href="https://typecho.org/" target="_blank"> Typecho </a>建站，并搭配自制<a title="查看主题介绍" href="https://store.mmbkz.cn/"> MyDiary </a>主题</span>
            <span class="foot_one_line"><i class="ri-copyright-fill"></i> Copyright © 2009 ~ <?php echo date("Y"); ?>. 火喵酱 All rights reserved.</span>
        <?php else: ?>
        	<?php if ($this->options->cat_birthday) : ?>
        		<span class="foot_one_line">
        			<?php echo '<i class="ri-time-fill"></i> 本站已运行 ' . getBuildTime($this->options->cat_birthday,false,false); ?>
        		</span>
        	<?php endif; ?>
        	<?php if ($this->options->cat_copyright != 'on') : ?>
        		<span class="foot_one_line"><i class="ri-heart-2-fill"></i> 自豪地使用<a href="https://typecho.org/" target="_blank"> Typecho </a>建站，并搭配<a href="https://store.mmbkz.cn/" target="_blank"> MyDiary </a>主题</span>
        	<?php endif; ?>
        	<span class="foot_one_line"><i class="ri-copyright-fill"></i> Copyright © <?php echo date("Y",strtotime($this->options->cat_birthday? $this->options->cat_birthday : 'Today')) ?> ~ <?php echo date("Y"); ?>. <?php $this->options->title() ?> All rights reserved.</span>
    	<?php endif; ?>
    </div>
</div>
<footer>
    <div class="foot_menu">
        <section>
            <ul>
                <?php if (!empty($this->options->cat_menu_foot_allchoose) && in_array('quanping', $this->options->cat_menu_foot_allchoose)): ?>
                <div id="cat_fullscreen">
                    <div class="anniu" id="cat_fullscreen_on" title="全屏显示">
                        <i class="ri-fullscreen-line"></i>
                    </div>
                    <div style="display:none;" class="anniu" id="cat_fullscreen_off" title="退出全屏">
                        <i class="ri-fullscreen-exit-line"></i>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($this->options->cat_menu_foot_allchoose) && in_array('fanyi', $this->options->cat_menu_foot_allchoose)): ?>
                    <div class="fanjianzhuanhuan" title="繁簡转换">
                        <a id="StranLink" target="_self">
                            <div class="anniu">
                                <p style="font-size: 1.35rem;width: 2rem;text-align: center;">繁</p>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            </ul>
            <ul class="tab_user">
            <?php if($this->is('post')): ?>
                <div class="anniu Category_anniu" title="分类">
                    <i class="ri-archive-line"></i>
                </div>
                <div class="anniu Search_anniu" title="搜索">
                    <i class="ri-search-2-line"></i>
                </div>
                <div class="anniu Menu_anniu" title="文章目录">
                    <i class="ri-menu-unfold-line"></i>
                </div>
                <?php if ($this->fields->post_top_info_select == "album"): ?>
                    <div class="anniu Album_large_anniu" style="<?php if ($this->fields->post_top_info_album_size == "small") echo 'display:none;' ?>" title="概览">
                        <i class="ri-artboard-2-line"></i>
                    </div>
                    <div class="anniu Album_small_anniu" style="<?php if ($this->fields->post_top_info_album_size != "small") echo 'display:none;' ?>" title="缩略">
                        <i class="ri-shape-line"></i>
                    </div>
                <?php else: ?>
                    <div class="anniu Fontsize_anniu" title="字号">
                        <i class="ri-font-size-2"></i>
                        <span class="anniu_num"></span>
                    </div>
                <?php endif; ?>
                <?php $agree = $this->hidden?array('agree' => 0, 'recording' => true):agreeNum($this->cid); ?>
                <button class="anniu Dianzan_anniu <?php echo $agree['recording']?'tab_on':''; ?>" <?php echo $agree['recording']?'disabled':''; ?> type="button" id="agree" data-cid="<?php echo $this->cid; ?>" data-url="<?php $this->permalink(); ?>">
                    <i class="ri-thumb-up-line"></i>
                    <span class="anniu_num"><?php echo $agree['agree']; ?></span>
                </button>
                <?php if (!empty($this->options->cat_wechatpay) || !empty($this->options->cat_alipay)): ?>
                    <div class="anniu reward" title="打赏">
                        <i class="ri-gift-line"></i>
                    </div>
                <?php endif; ?>
                <div class="anniu postshare" title="分享">
                    <i class="ri-share-circle-line"></i>
                </div>
            <?php endif; ?>
    <?php if ($this->is('page')): ?>        
        <?php if ($this->template == 'page_links.php'): ?>
                <div class="anniu" tabnum="tab1" title="好友">
                    <i class="ri-user-line"></i>
                </div>
            <?php if ($this->options->cat_links_circle == "on"): ?>
                <div class="anniu" tabnum="tab2" title="圈子">
                    <i class="ri-user-heart-line"></i>
                </div>
    		<?php endif; ?>
    		<?php if ($this->options->cat_links_tenyears == "on"): ?>
                <div class="anniu" tabnum="tab3" title="十年">
                    <i class="ri-user-star-line"></i>
                </div>
    		<?php endif; ?>
                <div class="anniu" tabnum="tab4" title="申请">
                    <i class="ri-user-add-line"></i>
                </div>
        <?php elseif ($this->template == 'page_life.php'): ?>
            <?php $counts_post = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('cid')->from('table.fields')->where('name = ?', 'post_top_info_select')->where('str_value = ?', 'post')->where('type = ?', 'str')->order('cid', Typecho_Db::SORT_DESC)); ?>
            <?php foreach ($counts_post as $count) {
                $post_names = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('str_value')->from('table.fields')->where('name = ?', 'post_top_info_post_name')->where('cid = ?', $count)->where('type = ?', 'str'));
                $post_name[] = $post_names[0]['str_value'];
                }
    			if($post_name){ $post_new_names = array_filter($post_name); }
            ?>   
            <?php $counts_album = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('cid')->from('table.fields')->where('name = ?', 'post_top_info_select')->where('str_value = ?', 'album')->where('type = ?', 'str')->order('cid', Typecho_Db::SORT_DESC)); ?>
            <?php $counts_tour = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('cid')->from('table.fields')->where('name = ?', 'post_top_info_select')->where('str_value = ?', 'tour')->where('type = ?', 'str')->order('cid', Typecho_Db::SORT_DESC)); ?>
            <?php $counts_book = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('cid')->from('table.fields')->where('name = ?', 'post_top_info_select')->where('str_value = ?', 'book')->where('type = ?', 'str')->order('cid', Typecho_Db::SORT_DESC)); ?>
            <?php $counts_music = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('cid')->from('table.fields')->where('name = ?', 'post_top_info_select')->where('str_value = ?', 'music')->where('type = ?', 'str')->order('cid', Typecho_Db::SORT_DESC)); ?>
            <?php $counts_movie = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('cid')->from('table.fields')->where('name = ?', 'post_top_info_select')->where('str_value = ?', 'movie')->where('type = ?', 'str')->order('cid', Typecho_Db::SORT_DESC)); ?>
            <?php $counts_game = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('cid')->from('table.fields')->where('name = ?', 'post_top_info_select')->where('str_value = ?', 'steam')->where('type = ?', 'str')->order('cid', Typecho_Db::SORT_DESC)); ?>
            <?php if($counts_post && !empty($post_new_names)): ?>
                <div class="anniu cat_post_ANNIU" tabnum="tab1" title="文集" name="文集" _img="<?php echo $this->options->cat_z_1 ? $this->options->cat_z_1 : ''; ?>">
                    <i class="ri-file-list-3-line"></i>
                </div>
            <?php endif; ?>
            <?php if($counts_album): ?>
                <div class="anniu cat_album_ANNIU" tabnum="tab2" title="相册" name="相册" _img="<?php echo $this->options->cat_z_2 ? $this->options->cat_z_2 : ''; ?>">
                    <i class="ri-image-line"></i>
                </div>
            <?php endif; ?>
            <?php if($counts_tour): ?>
                <div class="anniu cat_tour_ANNIU" tabnum="tab3" title="旅行" name="旅行" _img="">
                    <i class="ri-road-map-line"></i>
                </div>
            <?php endif; ?>
            <?php if($counts_book): ?>
                <div class="anniu cat_book_ANNIU" tabnum="tab4" title="书籍" name="书籍" _img="<?php echo $this->options->cat_z_3 ? $this->options->cat_z_3 : ''; ?>">
                    <i class="ri-book-3-line"></i>
                </div>
            <?php endif; ?>
            <?php if($counts_music): ?>
                <div class="anniu cat_music_ANNIU" tabnum="tab5" title="音乐" name="音乐" _img="<?php echo $this->options->cat_z_4 ? $this->options->cat_z_4 : ''; ?>">
                    <i class="ri-music-2-line"></i>
                </div>
            <?php endif; ?>
            <?php if($counts_movie): ?>
                <div class="anniu cat_movie_ANNIU" tabnum="tab6" title="电影" name="电影" _img="<?php echo $this->options->cat_z_5 ? $this->options->cat_z_5 : ''; ?>">
                    <i class="ri-clapperboard-line"></i>
                </div>
            <?php endif; ?>
            <?php if($counts_game): ?>
                <div class="anniu cat_game_ANNIU" tabnum="tab7" title="游戏" name="游戏" _img="<?php echo $this->options->cat_z_6 ? $this->options->cat_z_6 : ''; ?>">
                    <i class="ri-gamepad-line"></i>
                </div>
            <?php endif; ?>
            <?php if (!empty($this->options->cat_bili)): ?>
                <div class="anniu cat_anime_ANNIU" tabnum="tab8" title="番剧" name="番剧" _img="<?php echo $this->options->cat_z_7 ? $this->options->cat_z_7 : ''; ?>">
                    <i class="ri-bilibili-line"></i>
                </div>
            <?php endif; ?>
            <?php if (!empty($this->options->cat_github)): ?>
                <div class="anniu cat_github_ANNIU" tabnum="tab9" title="项目" name="项目" _img="<?php echo $this->options->cat_z_8 ? $this->options->cat_z_8 : ''; ?>">
                    <i class="ri-github-line"></i>
                </div>
            <?php endif; ?>
            <?php if (!empty($this->options->cat_steamid) && !empty($this->options->cat_steamkey)): ?>
                <div class="anniu cat_steam_ANNIU" tabnum="tab10" title="Steam" name="Steam" _img="<?php echo $this->options->cat_z_9 ? $this->options->cat_z_9 : ''; ?>">
                    <i class="ri-steam-line"></i>
                </div>
            <?php endif; ?>
        <?php elseif ($this->template == 'page_diary.php'): ?>
            <?php if($this->user->hasLogin()):?>
                <div class="anniu cat_comment_title" title="写日记" style="border-radius: var(--radius)!important;">
                    <i class="ri-edit-line"></i>
                </div>
            <?php endif; ?>
        <?php elseif ($this->template == 'page_guestbook.php'): ?>
            <?php
                $period = time() - 604800; 
                $default_avatar = get_AvatarLazyload(false);
                $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                    ->select('COUNT(author) AS cnt', 'author', 'max(url) url', 'max(authorId) authorId', 'max(mail) mail')
                    ->from('table.comments')
                    ->where('created > ?', $period)
                    ->where('status = ?', 'approved')
                    ->where('type = ?', 'comment')
                    ->group('author')
                    ->order('cnt', Typecho_Db::SORT_DESC)
                    ->limit('10')
                );
            ?>
            <?php foreach ($counts as $count) :?>
                <?php if ($count['authorId'] == '0') :?>
                <div class="anniu" title="<?php echo $count['author'] . '<br>' . '最近 ' . $count['cnt'] . ' 次留言' ?>">
                    <img class="user_logined_avatar avatar lazyload" style="height: auto;" src="<?php get_AvatarLazyload(); ?>" data-src="<?php echo get_AvatarByMail($count['mail']) ?>" alt="用户">
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php elseif ($this->template == 'page_pages.php'): ?>
            <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
            <?php while ($pages->next()): ?>
                <?php if($pages->fields->page_footer === 'on'): ?>
                    <a class="anniu <?php if ($this->is('page', $pages->slug)): ?> tab_on<?php endif; ?>" href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>">
                        <?php echo ($pages->fields->post_icon ? (cat_have_emoji($pages->fields->post_icon)? '<span style="margin: -0.25rem;">' . $pages->fields->post_icon . '</span>' : '<i class="'.  $pages->fields->post_icon . '"></i>') : '<p>' . mb_substr($pages->title, 0, 1, 'utf-8') . '</p>' )?>
                    </a>
                <?php endif; ?>    
            <?php endwhile; ?>
        <?php elseif ($this->template == 'page_echarts.php'): ?>
        <?php else: ?>
            <div class="anniu Menu_anniu" title="页面目录">
                <i class="ri-menu-unfold-line"></i>
            </div>
            <?php if ($this->fields->page_footer_user): ?>
                <?php
                    $cat_user_menus = $this->fields->page_footer_user;
                    if ($cat_user_menus) {
                        $cat_user_menus_arr = array_values(array_filter(explode("\r\n", $cat_user_menus)));
                        if (count($cat_user_menus_arr) > 0) {
                            for ($i = 0; $i < count($cat_user_menus_arr); $i++) {
                                $logo = explode("||", $cat_user_menus_arr[$i])[0];
                                $addr = explode("||", $cat_user_menus_arr[$i])[1];
                                $name = explode("||", $cat_user_menus_arr[$i])[2];
                        ?>
                        <a class="anniu" title="<?php echo $name ? $name : '未命名' ?>" href="<?php echo $addr ?>" target="_blank">
                            <?php echo cat_have_emoji($logo)? '<span style="font-size: 1.2rem;">' . $logo . '</span>' : '<i class="'.  $logo . '"></i>'; ?>
                        </a>
                        <?php
                            }
                        }
                    }
                ?>
            <?php endif; ?>
        <?php endif; ?>        
    <?php endif; ?>
    <?php if ($this->is('index')): ?>
            <?php if (!empty($this->options->cat_menu_foot_indexchoose) && in_array('category', $this->options->cat_menu_foot_indexchoose)): ?>
                <div class="anniu Category_anniu" title="分类">
                    <i class="ri-archive-line"></i>
                </div>
            <?php endif; ?>
            <?php if (!empty($this->options->cat_menu_foot_indexchoose) && in_array('search', $this->options->cat_menu_foot_indexchoose)): ?>
                <div class="anniu Search_anniu" title="搜索">
                    <i class="ri-search-2-line"></i>
                </div>
            <?php endif; ?>
            <?php if (!empty($this->options->cat_menu_foot_indexchoose) && in_array('email', $this->options->cat_menu_foot_indexchoose)): ?>
                <?php 
                    $db  = Typecho_Db::get();
                    $row = $db->fetchRow($db
                        ->select('mail')
                        ->from('table.users')
                        ->where('uid = ?', '1')
                    );
                    $mail = max($row);
                    if(empty($row)){
                        $mail = 'admin@dorcandy.cn';
                    }
                ?>
                <a class="anniu" href="mailto:<?php echo $mail;?>" target="_blank" title="电子邮箱：<br><?php echo $mail;?>">
                    <i class="ri-mail-line"></i>
                </a>
            <?php endif; ?>
            <?php if (!empty($this->options->cat_menu_foot_indexchoose) && in_array('dashang', $this->options->cat_menu_foot_indexchoose) && (!empty($this->options->cat_wechatpay) || !empty($this->options->cat_alipay))): ?>
                <div class="anniu reward" title="打赏">
                    <i class="ri-gift-line"></i>
                </div>
            <?php endif; ?>
            <?php if ($this->options->cat_user_footer_indexmenu): ?>
                <?php
                    $cat_user_menus = $this->options->cat_user_footer_indexmenu;
                    if ($cat_user_menus) {
                        $cat_user_menus_arr = array_values(array_filter(explode("\r\n", $cat_user_menus)));
                        if (count($cat_user_menus_arr) > 0) {
                            for ($i = 0; $i < count($cat_user_menus_arr); $i++) {
                                $logo = explode("||", $cat_user_menus_arr[$i])[0];
                                $addr = explode("||", $cat_user_menus_arr[$i])[1];
                                $name = explode("||", $cat_user_menus_arr[$i])[2];
                        ?>
                        <a class="anniu" title="<?php echo $name ? $name : '未命名' ?>" href="<?php echo $addr ?>" target="_blank">
                            <?php echo cat_have_emoji($logo)? '<span style="font-size: 1.2rem;">' . $logo . '</span>' : '<i class="'.  $logo . '"></i>'; ?>
                        </a>
                        <?php
                            }
                        }
                    }
                ?>
            <?php endif; ?>
    <?php endif; ?>
    <?php if ($this->is('archive')): ?>
            <div class="anniu Category_anniu" title="分类">
                <i class="ri-archive-line"></i>
            </div>
            <div class="anniu Search_anniu" title="搜索">
                <i class="ri-search-2-line"></i>
            </div>
            <a class="anniu" title="发现" href="<?php echo getRandomPosts(); ?>">
                <i class="ri-compass-3-line"></i>
            </a>
    <?php endif; ?>
            </ul>
        </section>
        <section>
            <ul class="foot_bottom">
            <?php if($this->is('post')): ?>
                <?php if ($this->allow('comment') && $this->options->cat_comment_allow != "on") : ?>
                    <?php if ($this->fields->post_change_comment !== "on") : ?>
                        <div class="anniu go_cat_comment" title="前往评论区<br>已有评论：<?php $this->commentsNum(); ?>">
                            <i class="ri-chat-download-line"></i>
                            <span class="anniu_num"><?php $this->commentsNum(); ?></span>
                        </div>
                    <?php else: ?>
                        <div class="anniu go_cat_comment" title="前往摘录区<br>已有摘录：<?php $this->commentsNum(); ?>">
                            <i class="ri-chat-smile-line"></i>
                            <span class="anniu_num"><?php $this->commentsNum(); ?></span>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
        			<?php if ($this->options->cat_comment_allow == "on") : ?>
                        <div class="anniu" title="博主关闭了所有页面的评论">
                            <i class="ri-chat-off-line"></i>
                        </div>
        			<?php else : ?>
                        <div class="anniu" title="博主关闭了当前页面的评论">
                            <i class="ri-chat-off-line"></i>
                        </div>
        			<?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php  
                $header_username = ($this->user->hasLogin() ? $this->user->screenName : $this->remember('author', true));
                $header_usermail = ($this->user->hasLogin() ? $this->user->mail : $this->remember('mail', true));
                $header_usersite = ($this->user->hasLogin() ? $this->user->url : $this->remember('url', true));
            ?>
            <?php if($this->user->hasLogin()):?>
                <div class="anniu Admin_anniu" title="管理">
                    <img class="user_logined_avatar avatar lazyload" style="height: auto;" src="<?php get_AvatarLazyload(); ?>" data-src="<?php echo get_AvatarByMail($header_usermail); ?>" alt="检测到用户">
                </div>
            <?php else: ?>
                <?php if(empty($header_username)):?>
                    <div class="anniu Login_ANNIU" title="登录">
                        <i class="ri-login-circle-line"></i>
                    </div>
                <?php else: ?>
                    <a class="anniu" title="<?php echo $header_username;?>" <?php echo $this->options->cat_user_addr? 'href="'.$this->options->cat_user_addr.'"': '';?>>
                        <img class="user_logined_avatar avatar lazyload" style="height: auto;" src="<?php get_AvatarLazyload(); ?>" data-src="<?php echo get_AvatarByMail($header_usermail); ?>" alt="检测到用户">
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <div style="display:none;">
                <div class="user_logined_username"><?php echo $header_username ?></div>
                <div class="user_logined_usermail"><?php echo $header_usermail ?></div>
                <div class="user_logined_status"><?php if(empty($header_username)){
                    echo 'not_online';
                }?></div>
            </div>
            <div class="anniu" title="返回顶部" id="percentage">
                <i class="ri-align-vertically"></i>
            </div>
        </ul>
        </section>
    </div>
</footer>
<?php $this->need('core/include_body.php'); ?>
<?php $this->need('core/include_other.php'); ?>
<?php echo $this->options->cat_user_beforebody ? $this->options->cat_user_beforebody : '' ?>
<?php echo $this->options->cat_user_js ? '<script>' . $this->options->cat_user_js . '</script>' : '' ?>
<div class="pjax_end">
    <?php $this->need('core/include_end.php'); ?>
    <script src="<?php echo resource_cdn() . 'js/end.js' ?>"></script>
    <script>
        <?php $this->options->cat_pjax_callback(); ?>
    </script>
</div>
<?php $this->footer(); ?>
<script src="<?php echo resource_cdn() . 'public/pjax.js'; ?>"></script>
<script src="<?php echo resource_cdn() . 'js/pjax.js'; ?>"></script>
</body>
</html>
<?php if ($this->options->cat_html_compress == "on") : ?>
    <?php $html_source = ob_get_contents(); ob_clean(); print compressHtml($html_source); ob_end_flush(); ?>
<?php endif; ?>
<?php if ($this->options->cat_background && $this->options->cat_background != "off") : ?>
    <?php $this->need('core/sakura.php'); ?>
<?php endif; ?>
