<?php
/**
 * 用户中心
 * 
 * @package custom 
 * 
 **/
?>
<!DOCTYPE HTML>
<?php
    $header_username = ($this->user->hasLogin() ? $this->user->screenName : $this->remember('author', true));
    $header_usermail = ($this->user->hasLogin() ? $this->user->mail : $this->remember('mail', true));
    $header_usersite = ($this->user->hasLogin() ? $this->user->url : $this->remember('url', true));
    if(empty($header_username)){
        header('Location: /');
    }
?>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <div style='display:none;'>
        <?php $this->need('parts/article.php'); ?>
    </div>
    <div id="cat_article_start" class="cat_diary_start">
            <div class="friends_block cat_userpage_block">
                <div class="box_out">
                    <div style="font-size: 2rem;">
                        <img style="height: 100%;" class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php 
                        if(!empty($header_usersite)){
                                echo 'https://s0.wp.com/mshots/v1/' . $header_usersite . '?w=1920&h=1080';
                            }else{
                                echo get_random_Thumbnail($this);
                            }
                        ?>">
                        <div class="cat_userpage_userinfo">
                            <div class="box_avatar" style="padding: 1rem 0;">
                                <div class="box_avatar_left">
                                    <img class="cat_userpage_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php
                                        $dr_userEmail = ($this->user->hasLogin()? $this->user->mail:$this->remember('mail', true) );
                                        if(!empty($dr_userEmail)){
                                            echo get_AvatarByMail($dr_userEmail);
                                        }
                                    ?>" alt="检测到用户" width="50px" height="50px">
                                </div>
                                <div class="box_avatar_right">
                                    <?php  
                                        echo '<span style="font-size: 1.5rem; margin-right: 0.5rem; color:';
                                        if(!empty($header_username)){
                                            echo 'var(--color-white);">' . $header_username . '</span>';
                                        }else{
                                            echo 'var(--theme);">用户未登录</span>';
                                        }
                                    if ($this->user->uid == $this->authorId) {      
                                        echo ' <p class="animeinfo lv_cat" style="color: hsl(0 0% 100% / 0.7);" title="博主">博主</p>';
                                    } else {       
                                        echo ' ' .cat_comment_levelcard($header_usermail);
                                        echo ' ' .cat_comment_friendcard($this , $header_usermail);
                                    }
                                    ?>
                                    <p title="上次留言时间" class="animeinfo lv_cat" style="background:<?php echo get_user_last_login($header_usermail , true) ?>; background-image: -webkit-linear-gradient(45deg,hsla(0,0%,100%,.4) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.4) 0,hsla(0,0%,100%,.4) 75%,transparent 0,transparent); opacity: 0.7; color: #fff;"><?php echo get_user_last_login($header_usermail , false) ?></p>
                                </div>
                            </div>
                            <div title="使用邮箱"><i class="ri-mail-line"></i> <?php echo $header_usermail ?></div>
                            <?php if($header_usersite): ?>
                                <div title="个人地址"><i class="ri-link"></i> <?php echo $header_usersite ?></div>
                            <?php endif; ?>
                            <div title="首条留言"><i class="ri-history-line"></i> <?php echo get_user_first_login($header_usermail) ?></div>
                            <div title="累计留言"><i class="ri-message-3-line"></i> <?php echo get_comment_num($header_username) . ' 条' ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="comment-list">
                <div class="cat_userpage_replytitle">近期回复我的评论</div>
                <?php
                    $db  = Typecho_Db::get();
                    $counts = $db->fetchAll($db
                        ->select('text','coid','created','authorId','ownerId','cid')
                        ->from('table.comments')
                        ->where('status = ?', 'approved')
                        ->where('mail = ?', $header_usermail)
                        ->where('type = ?', 'comment')
                        ->order('coid', Typecho_Db::SORT_DESC)
                        ->limit('50')
                    );
                    $i = 0;
                    foreach ($counts as $i=>$count) {
                        $db  = Typecho_Db::get();
                        $reply = $count['coid'];
                        $counts2 = $db->fetchAll($db
                            ->select('text','mail','author','created','authorId','ownerId')
                            ->from('table.comments')
                            ->where('status = ?', 'approved')
                            ->where('parent = ?', $reply)
                            ->where('type = ?', 'comment')
                            ->limit('5')
                        );
                        $i = 0;
                        if (isset($counts2[0]['text']) && $counts2[0]['text']) {
                ?>
                        <div class="cat_userpage_replyli"><li style="display: inline;">
                        <div style="display: inline-flex;white-space: nowrap;">
                            <div style="position: relative;">
                                <img style="margin-right: 1rem;" class="cat_userpage_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php echo get_AvatarByMail($header_usermail) ?>" alt="头像" />
                                <div class="onlinetime" title="<?php echo get_user_last_login($header_usermail,false); ?>留言过" style="right:0.65rem; background:<?php echo get_user_last_login($header_usermail) ?>"></div>
                            </div>
                            <div style="display: grid;">
                                <div class="cat_userpage_name"><?php echo $header_username ?></div>
                                <?php
                                    $countstitle = $db->fetchAll($db
                                    ->select('title','slug')
                                    ->from('table.contents')
                                    ->where('cid = ?', $count['cid'])
                                    );
                                ?>
                                <a style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" href="/<?php echo $countstitle[0]['slug'] ?>.html">发表自：《<?php echo $countstitle[0]['title'] ?>》</a>
                            </div>
                        </div>
                        <div class="cat_userpage_text">
                            <p><?php echo cat_comment_changetext_pre($count['text']); ?></p>
                        </div>
                        <div class="cat_userpage_time">
                            <time>
                                <?php echo date('n月j日 H:i',$count['created']) ?>
                            </time>
                        </div>
                        <?php foreach ($counts2 as $i=>$count2): ?>
                            <li style="display: table;margin: 2rem 0 0 auto;max-width: 80%;">
                                <div style="white-space: nowrap;display: flex;justify-content: flex-end;">
                                    <div style="display: inline-block;">
                                        <div class="cat_userpage_name" style="text-align: right;"><?php echo $count2['author'] ?></div>
                                        <div>
                                        <?php if ($count2['authorId'] == $count2['ownerId']): ?>
                                            <div style="font-style: italic;color: var(--colorE);text-align: right;margin: 0.2rem;font-size: small;">我</div>
                                		<?php else: ?>
                                		    <?php cat_comment_levelcard($count2['mail']);?>
                						    <?php cat_comment_friendcard($this,$count2['mail']); ?>
                                		<?php endif; ?>
                                        </div>
                                    </div>
                                    <div style="position: relative;">
                                        <img style="margin-left: 1rem;" class="cat_userpage_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php echo get_AvatarByMail($count2['mail']) ?>" alt="头像" />
                                        <div class="onlinetime" title="<?php echo get_user_last_login($count2['mail'],false); ?>留言过" style="right:-0.35rem; bottom: 0; background:<?php echo get_user_last_login($count2['mail']) ?>"></div>
                                    </div>
                                </div>   
                                <div class="cat_userpage_text">
                                    <p><?php echo cat_comment_changetext_pre($count2['text']) ?></p>
                                </div>  
                                <div class="cat_userpage_time" style="float: right;">
                                    <time><?php echo date('n月j日 H:i',$count2['created']) ?></time>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </li></div>
                <?php } } ?>
                <?php if(!$this->user->hasLogin()):?>
                    <div class="cat_userpage_replytitle user_loginout">退出游客账户并返回首页</div>
                <?php endif; ?>
            </div>
    </div>
</div>
<?php $this->need('parts/footer.php'); ?>