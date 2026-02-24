<?php
/**
 * 日记
 * 
 * @package custom 
 * 
 **/
?>
<!DOCTYPE HTML>
<?php $this->comments()->to($comments); 
    global $header_login;
    global $header_username;
    global $header_usermail;
    $header_login = ($this->user->hasLogin() ? '1' : '0');
    $header_username = ($this->user->hasLogin() ? $this->user->screenName : $this->remember('author', true));
    $header_usermail = ($this->user->hasLogin() ? $this->user->mail : $this->remember('mail', true));
?>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <style>
        #cat_comment .cat_comment_parent .cat_comment_replyout .cat_comment_body .content .substance>p{
            text-indent: <?php echo $this->options->cat_diary_indent == "on" ? '2em': '0' ?>;
        }
        #cat_comment .comment-list {
            margin-top:0!important;
        }
        @media (min-width:1200px) {
            #cat_comment .cat_comment_parent .cat_comment_replyout .cat_comment_body .content .substance>p{
                <?php if($this->options->cat_article_wordline == "on") : ?>
                    background: url(<?php echo resource_cdn() . 'img/wordline.webp'; ?>)!important;
                <?php else: ?>
                    background: #fff0!important;
                <?php endif; ?>
            }
        }
        @media (max-width:1200px) {
            #cat_comment .cat_comment_parent .cat_comment_replyout .cat_comment_body .content .substance>p{
                <?php if($this->options->cat_article_wordline == "on") : ?>
                    background: url(<?php echo resource_cdn() . 'img/wordline.webp'; ?>)!important;
                    background-size: auto 2.5rem!important;
                <?php else: ?>
                    background: #fff0!important;
                <?php endif; ?>
            }
        }
        #cat_comment .cat_comment_child .cat_comment_replyout .cat_comment_body .content .substance>p{
            text-indent: 0;
            background: var(--theme-10)!important;
        }
        .diaryfenxiangalert {
            background: linear-gradient(to top,#fff 30%,rgb(0 0 0/0%)),url(<?php echo get_random_Thumbnail($this); ?>) no-repeat;
            background-position: center;
            background-size: cover;
        }
        <?php if ($this->options->cat_comment_allow !== "off") : ?>
            .cat_comment_reply,
            .eye_button_close,
            .eye_button_open,
            .comment-children {
            	display: none!important;
            }
        <?php endif;?>
    </style>
    <link rel="stylesheet" href="<?php echo resource_cdn() . 'css/diary.css' ?>" />
    <!--公告位置-->
<div id="cat_article_start" class="cat_diary_start" style="grid-template-columns:<?php echo $this->options->cat_Diary_img_model == 'top' ? 'auto' : '40% calc(60% - var(--margin))' ?>">
<?php if($this->options->cat_Diary_img_model != 'top') :?>
<div class="friends_block cat_diary_peitu">
    <div class="box_out" style="cursor: zoom-in;height: 100%;">
        <div style="font-size: 2rem;height: 100%;">
            <div class="cat_indexcard_time imgup" style="right: 1rem;bottom: 1rem;padding: 1rem;"></div>
            <div class="cat_indexcard_time imgdown" style="font-size: 5rem; padding: 1rem; line-height: 5rem;"></div> 
            <img style="height: 100%;" class="isfancy_ungallery lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src=<?php echo $this->options->cat_defaultImage_diary ? $this->options->cat_defaultImage_diary : get_random_Thumbnail($this); ?>>
        </div>
    </div>
</div>
<?php endif; ?>
<div id="cat_comment">
    <?php $this->comments()->to($comments); ?>
    <div class="cat_comment_replyout_style cat_cancel_titleout" style="display:none;">
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cat_cancel_comment_reply">
                <?php $comments->cancelReply(); ?>
            </div>
            <form method="post" class="cat_comment_respond_form" action="<?php $this->commentUrl() ?>" data-type="text">
						<div style="display: flex;"> 
							<div class="replyavatar">
								<img class="lazyload" id="avatarimg" src="<?php get_AvatarLazyload() ?>" data-src="<?php
								$dr_userEmail = ($this->user->hasLogin()? $this->user->mail:$this->remember('mail', true) );
								if(!empty($dr_userEmail)){
								    echo get_AvatarByMail($dr_userEmail);
								}else{
								    echo resource_cdn() . 'img/avatar.webp';
								}
							?>" alt="">
							</div>
							<div class="head">
							    <?php if($this->user->hasLogin()):?>
							        <div class="diary_input_authorinfo">
        								<div class="list">
        									<input type="text" disabled="disabled" id="toavatar" value="<?php $this->user->mail() ?>" autocomplete="off" name="mail" />
        								</div>
        								<div class="list">
        									<input type="text" disabled="disabled" id="tonick" value="<?php $this->user->screenName() ?>" autocomplete="off" name="author" />
        								</div>
        								<div class="list">
        									<input type="text" disabled="disabled" value="<?php $this->user->url() ?>" autocomplete="off" name="url" />
        								</div>
    								</div>
    								<div class="diary_input_hidden">
    								    <div class="list">
        								    <select name="mood">
                                                <option value="">心情 / 状态选择</option>
                                                <option value="愉快">😀 愉快</option>
                                                <option value="开心">😁 开心</option>
                                                <option value="失望">😞 失望</option>
                                                <option value="无语">😑 无语</option>
                                                <option value="惊讶">😯 惊讶</option>
                                                <option value="笑哭">🤣 笑哭</option>
                                                <option value="疲惫">😒 疲惫</option>
                                                <option value="伤心">😥 伤心</option>
                                                <option value="愤怒">😡 愤怒</option>
                                                <option value="无聊">🙄 无聊</option>
                                                <option value="无情">😶 无情</option>
                                                <option value="流泪">😭 流泪</option>
                                                <option value="shit">💩 shit</option>
                                                <option value="death">💀 death</option>
                                                <option value="" disabled>- - - - - - - - - - - - - -</option>
                                                <option value="学习">📖 学习</option>
                                                <option value="搬砖">🏗️ 搬砖</option>
                                                <option value="摸鱼">🐟 摸鱼</option>
                                                <option value="干饭">🍚 干饭</option>
                                                <option value="娱乐">🎤 娱乐</option>
                                                <option value="演奏">🎸 演奏</option>
                                                <option value="打电动">🎮 打电动</option>
                                                <option value="做运动">🏀 做运动</option>
                                                <option value="下午茶">🍵 下午茶</option>
                                                <option value="购物">🛒 购物</option>
                                                <option value="遛狗">🦮 吸宠</option>
                                                <option value="聚餐">🍻 聚餐</option>
                                                <option value="约会">👒 约会</option>
                                                <option value="闭关">⛔ 闭关</option>
                                            </select>
        								</div>
        								<?php if($this->options->cat_diary_weather == 'on' && $this->options->cat_diary_weather_key && $this->options->cat_map_key3) :?>
            								<div class="list">
            								    <?php
                                    				$wea_key = $this->options->cat_diary_weather_key;
                                    				$wea_loc = $this->options->cat_map_key3;
                                                    $curl = curl_init('https://devapi.qweather.com/v7/weather/now?location=' . $wea_loc . '&key=' . $wea_key);
                                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                                                    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
                                                    curl_setopt($curl, CURLOPT_ENCODING, "gzip");
                                                    $content = curl_exec($curl);
                                                    $wea_data = json_decode($content);
                                                    curl_close($curl);
                                                    $wea_icon = $wea_data->now->icon;
                                                    $wea_text = $wea_data->now->text;
                                                    $wea_temp = $wea_data->now->temp;
                                                ?>
                                                <select name="weather" disabled="disabled">
                                                    <option value="<?php echo $wea_icon ?>"><?php echo $wea_text ?>（自动）</option>
                                                </select>
                                            </div>
                                            <div class="list">
            									<input type="number" disabled="disabled" value="<?php echo $wea_temp ?>" name="temperature" />
            									<span style="position: absolute;top: 0;right: 0;font-size: 0.9rem;display: table-cell;color:var(--main);white-space: nowrap;padding: 6px 10px;">℃</span>
            								</div>
        								<?php else: ?>
        								    <div class="list">
            								    <select name="weather">
                                                    <option value="">天气选择</option>
                                                    <option value="晴">晴</option>
                                                    <option value="多云">多云</option>
                                                    <option value="阴">阴</option>
                                                    <option value="阵雨"> 阵雨</option>
                                                    <option value="小雨">小雨</option>
                                                    <option value="中雨">中雨</option>
                                                    <option value="雷电">雷电</option>
                                                    <option value="暴雨">暴雨</option>
                                                    <option value="雾">雾</option>
                                                    <option value="大风">大风</option>
                                                    <option value="雪">雪</option>
                                                    <option value="冰雹">冰雹</option>
                                                    <option value="台风">台风</option>
                                                    <option value="酷热">酷热</option>
                                                    <option value="流星雨">流星雨</option>
                                                </select>
                                            </div>
                                            <div class="list">
            									<input type="number" value="" autocomplete="off" name="temperature" placeholder="气温（纯数字）" />
            									<span style="position: absolute;top: 0;right: 0;font-size: 0.9rem;display: table-cell;color:var(--main);white-space: nowrap;padding: 6px 10px;">℃</span>
            								</div>
                                        <?php endif;?>
        								<div class="list">
        									<input type="text" value="" autocomplete="off" name="image" placeholder="配图（图片地址）" />
        								</div>
    						    	</div>
    						    <?php else: ?>
    						    	<div class="list">
    									<input type="text" id="toavatar" value="<?php $this->user->hasLogin() ? $this->user->mail() : $this->remember('mail') ?>" autocomplete="off" name="mail" placeholder="QQ号或邮箱..." />
    								</div>
    								<div class="list">
    									<input type="text" id="tonick" value="<?php $this->user->hasLogin() ? $this->user->screenName() : $this->remember('author') ?>" autocomplete="off" name="author" maxlength="16" placeholder="昵称..." />
    								</div>
    								<div class="list">
    									<input type="text" value="<?php $this->user->hasLogin() ? $this->user->url() : $this->remember('url') ?>" autocomplete="off" name="url" placeholder="站点..." />
    								</div>
                                <?php endif;?>
							</div>
						</div>
                        <div class="body">
                            <textarea name="text" value="" class="OwO-textarea" autocomplete="new-password" placeholder="<?php echo $this->options->cat_comment_placeholder ?>"></textarea>
                        </div>
                        <div class="foot">
                            <div class="left">
                                <div title="表情" class="OwO OwO_1"></div>
                                <?php if($this->user->hasLogin()):?>
                                    <div title="贴图" class="OwO OwO_2"></div>
                                    <div title="私密日记" class="cat_comment_button comment_secert">
        							    <input type="checkbox" name="secert" value="1"> <i class="ri-lock-2-line no_secert"></i> <i class="ri-lock-2-fill yes_secert"></i>
        							</div>
    							<?php endif;?>
                                <?php if($this->user->hasLogin() || $this->options->cat_comment_IMG_user == 'on'):?>
                                    <div title="引用图片" class="cat_comment_button cat_comment_button_image"><i class="ri-image-add-line"></i></div>
                                    <div class="cat_comment_button_image_block">
                                        <input id="comment_image_input" style="width: calc(100% - 3rem);" type="text" autocomplete="off" placeholder="输入图片地址" />
                                        <div class="cat_comment_button cat_comment_button_image_send" style="display: inline-block;vertical-align: bottom;"><i class="ri-add-circle-line"></i></div>
                                        <script>
                                            <?php $IMGNAME = $this->options->cat_comment_IMGcode ? $this->options->cat_comment_IMGcode : 'IMG'; ?>
                                            $(".cat_comment_button_image_send").click(function(){
                                                var comment_image_input = $('#comment_image_input').val();
                                                if (comment_image_input==''){
                                                    new jBox('Notice', { theme: 'NoticeFancy', attributes: { x: 'left', y: 'bottom' }, color: 'yellow', content: "请填入图片地址", animation: { open: 'slide:bottom', close: 'slide:left' } });
                                                }else{
                                                    document.getElementsByClassName('OwO-textarea')[0].value+='\n{'+'<?php echo $IMGNAME;?>'+'}'+comment_image_input+'{/'+'<?php echo $IMGNAME;?>'+'}\n';
                                                    $(".cat_comment_button_image_block").slideToggle();
                                                    $("#comment_image_input").val('');
                                                }
                                            });
                                            $('.main').on('change','#fileInput',function(){
                                                new jBox('Notice', { theme: 'NoticeFancy', attributes: { x: 'left', y: 'bottom' }, color: 'yellow', content: "图片尝试上传中！", animation: { open: 'slide:bottom', close: 'slide:left' } });
                                            	const fileInput = document.getElementById('fileInput');
                                            	const file = fileInput.files[0];
                                            	const url = $('.cat_comment_button_upload').attr('data-url');
                                            	const formData = new FormData();
                                            	formData.append('file', file);
                                                $.ajax({
                                                    url: url,
                                                    type: 'POST',
                                                    data: formData,
                                                    processData: false,
                                                    contentType: false,
                                                    success:function (res) {
                                                        new jBox('Notice', { theme: 'NoticeFancy', attributes: { x: 'left', y: 'bottom' }, color: 'green', content: "图片上传成功！", animation: { open: 'slide:bottom', close: 'slide:left' } });
                                                        document.getElementsByClassName('OwO-textarea')[0].value+='\n{'+'<?php echo $IMGNAME;?>'+'}'+res[0]+'{/'+'<?php echo $IMGNAME;?>'+'}\n';
                                                    },
                                                    error:function (res) {
                                                        new jBox('Notice', { theme: 'NoticeFancy', attributes: { x: 'left', y: 'bottom' }, color: 'red', content: "图片上传失败！", animation: { open: 'slide:bottom', close: 'slide:left' } });
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>
                                <?php endif;?>
                                <?php if($this->user->hasLogin()):?>
                                    <?php \Widget\Security::alloc()->to($security); ?>
                                    <label>
                                        <input type="file" id="fileInput" style="display: none;" />
                                        <div title="上传图片" class="cat_comment_button cat_comment_button_upload" data-url="<?php $security->index('/action/upload'. (isset($fileParentContent) ? '?cid=' . $fileParentContent->cid : ''));?>"><i class="ri-upload-cloud-2-line"></i></div>
                                    </label>
                                <?php endif;?>
                                <div title="链接" class="cat_comment_button cat_comment_button_links"><i class="ri-link"></i></div>
                                <div title="哔哩哔哩视频" class="cat_comment_button cat_comment_button_bilibili"><i class="ri-bilibili-line"></i></div>
                                <div title="网易云单曲" class="cat_comment_button cat_comment_button_music"><i class="ri-netease-cloud-music-line"></i></div>
                                <div class="cat_comment_button_links_block">
                                    <input id="comment_links_name_input" style="width: calc(50% - 2rem);" type="text" autocomplete="off" placeholder="输入链接名" />
                                    <input id="comment_links_addr_input" style="width: calc(50% - 2rem);" type="text" autocomplete="off" placeholder="输入链接地址" />
                                    <div class="cat_comment_button cat_comment_button_links_send" style="display: inline-block;vertical-align: bottom;"><i class="ri-add-circle-line"></i></div>
                                </div>
                                <div class="cat_comment_button_bilibili_block">
                                    <input id="comment_bilibili_input" style="width: calc(100% - 3rem);" type="text" autocomplete="off" placeholder="输入B站BV号" />
                                    <div class="cat_comment_button cat_comment_button_bilibili_send" style="display: inline-block;vertical-align: bottom;"><i class="ri-add-circle-line"></i></div>
                                </div>
                                <div class="cat_comment_button_music_block">
                                    <input id="comment_music_input" style="width: calc(100% - 3rem);" type="text" autocomplete="off" placeholder="输入网易云单曲ID" />
                                    <div class="cat_comment_button cat_comment_button_music_send" style="display: inline-block;vertical-align: bottom;"><i class="ri-add-circle-line"></i></div>
                                </div>
                            </div>
                            <?php if($this->user->hasLogin()) :?>
                                <div class="right">
                                    <div class="submit" id="Captcha_ok" style="display: block;">
                                        <button type="submit" id="comment_put"><i class="ri-rocket-2-line"></i></button>
                                    </div>
                                </div>
                            <?php else :?>
                                <div class="right">
                                    <div class="submit" id="Captcha" title="滑动验证">
                                    	<p id="CaptchaText"><i class="ri-key-line"></i></p>
                                    </div>
                                    <div class="submit" id="Captcha_ok" title="发送">
                                        <button type="submit" id="comment_put"><i class="ri-rocket-2-line"></i></button>
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                    </form>
            </div>
        </div>
        <?php if ($comments->have()): ?>
            <?php $comments->listComments(); ?>
            <?php
                $comments->pageNav(
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
        <?php endif; ?>
</div>
<?php function threadedComments($comments, $options) {
    $db  = Typecho_Db::get();
    $counts = $db->fetchAll($db
        ->select('secert','mail','author')
        ->from('table.comments')
        ->where('coid = ?', $comments->coid)
    );
    $secert = $counts[0]['secert'];
    $mail = $counts[0]['mail'];
    $author = $counts[0]['author'];
?>
<li id="li-<?php $comments->theId(); ?>" class="<?php 
if ($comments->levels > 0) {
    echo 'cat_comment_child';
} else {
    echo 'cat_comment_parent';
}
?>">
<?php
    $db  = Typecho_Db::get();
    $counts = $db->fetchAll($db
        ->select('weather','temperature','mood','image')
        ->from('table.comments')
        ->where('coid = ?', $comments->coid)
    );
    $weather = $counts[0]['weather'];
    $temperature = $counts[0]['temperature'];
    $mood = $counts[0]['mood'];
    $image = $counts[0]['image'];
?>
    <?php if(!empty($image) && ($secert != '1' || ($secert == '1' && $GLOBALS['header_login']=='1'))):?>
        <div class="cat_diary_image_li box_out">
            <img style="margin-bottom:1rem;<?php echo Helper::options()->cat_Diary_img_model == 'top' ? 'height: 30rem;' : 'display:none;' ?>" class="isfancy lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo $image; ?>">
        </div>
    <?php endif; ?>
    <div class="diary_top">
        <?php echo $weather ? '<div title="' . diary_he_weather($weather) . '" class="diary_weather">'. diary_logo_weather($weather) . '</div>' : '' ?>
        <?php echo $mood ? '<span title="心情：' . $mood . '">'. diary_logo_mood($mood) . '</span>' : '' ?>
        <?php echo $mood ? '<span title="状态：' . $mood . '">'. diary_logo_status($mood) . '</span>' : '' ?>
        <?php echo $mood ? '<div class="undisplay_mood" style="display:none;">' . $mood . '</div>': '' ?>
        <time title="<?php $comments->date('Y年n月j日 H:i'); ?>" class="date" datetime="<?php $comments->date('Y年n月j日'); ?>"><?php $comments->dateWord(); ?></time>
        <?php echo $temperature ? '<div title="气温" style="display: inline-block; padding-left:0.5rem;">' . diary_logo_temperature($temperature) . ' ' . $temperature . ' ℃</div>' : '' ?>
        <?php echo $secert == '1' ? '<div style="display: inline-block; padding-left:0.5rem;">🔒 私密</div>' : '' ?>
    </div>
    <div class="cat_comment_replyout" replyout_id="<?php $comments->theId(); ?>">
        <div class="cat_comment_body" id="<?php $comments->theId(); ?>">
            <div title="回复" data-coid="<?php $comments->coid() ?>" class="cat_comment_reply" reply_id="<?php $comments->theId(); ?>" onclick="return TypechoComment.reply('<?php $comments->theId(); ?>', <?php $comments->coid(); ?>);">
                <img width="48" height="48" class="avatar lazyload" src="<?php get_AvatarLazyload() ?>" data-src="<?php echo get_AvatarByMail($comments->mail); ?>" alt="头像" />
                <div class="replymengban"><i class="ri-at-line"></i></div>
                <span title="<?php echo get_user_last_login($comments->mail,false); ?>留言过" class="onlinetime" style="background:<?php echo get_user_last_login($comments->mail,true); ?>"></span>
            </div>
            <div class="cat_left_line"></div>
            <div class="cat_left_circle"></div>
            <div class="content">
                <div class="user">
                    <span class="author" title="<?php $comments->date('Y年n月j日 H:i'); ?>"><?php $comments->author(); ?></span>
                    <?php get_comment_at($comments->coid) ?>
                        <div class="animetags" style="display:inline;">
    						<?php cat_comment_levelcard($comments->mail);?>
    						<?php cat_comment_friendcard($comments, $comments->mail); ?>
                        </div>
                    <?php if ($comments->status === "waiting") : ?>
                        <em class="waiting">（评论审核中...）</em>
                    <?php endif; ?>
                </div>
                <div class="substance">
                    <?php if($secert == '1' && $GLOBALS['header_login']!='1' && ($mail!=$GLOBALS['header_usermail'] || $author!=$GLOBALS['header_username'])):?>
                        <cat_article_hide title="私密日记，仅博主可见">私密日记</cat_article_hide>
                    <?php else: ?>
                        <p><?php echo cat_comment_changetext($comments->content); ?></p>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php if ($secert != '1') :?>
            <div class="diary_bottom">
                <?php
                    $agreedparent = $comments->coid;
                    $agreedusers = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                        ->select('name', 'mail')
                        ->from('table.dianzan')
                        ->where('parent = ?', $agreedparent)
                        ->order('id', Typecho_Db::SORT_DESC)
                        ->limit('5')
                    );
                    if (empty ($agreedusers)){
                        echo '<p title="点击红心抢首赞！" class="noonelike_word">暂无点赞</p>';
                    }else{
                        foreach ($agreedusers as $i=>$agreeduser) {
                            echo '<div title="' . $agreeduser['name'] . '" class="likedavatar"><img class="avatar lazyload" data-src="'.get_AvatarByMail($agreeduser['mail']).'" src="' . get_AvatarLazyload(false) . '"></div>';
                        }
                    }
                    echo '<div class="likesuccess_newavatar" style="display: inline-block;"></div>';
                    $agreecnt = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                        ->select('COUNT(name) AS cnt')
                        ->from('table.dianzan')
                        ->where('parent = ?', $agreedparent)
                        ->order('id', Typecho_Db::SORT_DESC)
                    );
                    if ($agreecnt[0]['cnt'] > 5){
                        echo '<div title="累计点赞： ' . $agreecnt[0]['cnt'] . ' 人" class="like_word">+ ';
                        echo $agreecnt[0]['cnt'] - 5;
                        echo '</div>';
                    }
                ?>  
                <div class="diary_bottom_right">
                    <div class="likesuccess" style="display:none;"><span style="color:var(--color-red);margin: 0;">点赞成功！</span></div>
                    <?php
                        $db = Typecho_Db::get();
                        $prefix = $db->getPrefix();
                        $xxname = $GLOBALS['header_username'];
                        $xxparent = $comments->coid;
                        //  查询是否点赞
                        $xxisagree = $db->fetchRow($db
                            ->select('agree')
                            ->from('table.dianzan')
                            ->where('name = ?', $xxname)
                            ->where('parent = ?', $xxparent)
                        );
                    ?>
                    <?php if(empty($xxisagree)):?>
                        <div class="button like_button" data-zid="<?php $comments->theId(); ?>" data-like-coid="<?php $comments->coid(); ?>" >
                            <i title="点赞" class="ri-heart-2-fill"></i>
                            <?php if(!$agreecnt[0]['cnt'] == 0):?>
                                <p class="beforelike likenumchange"><?php echo $agreecnt[0]['cnt'] ?></p>
                            <?php else :?>
                                <p style="display: inline;" class="likenumfirstchange"></p>
                            <?php endif;?>
                        </div>
                    <?php else :?>
                        <div class="button likeD_button" data-zid="<?php $comments->theId(); ?>" data-like-coid="<?php $comments->coid(); ?>">
                            <i style="color:var(--color-red);" title="已点赞" class="ri-heart-2-fill"></i>
                            <p class="afterlike"><?php echo $agreecnt[0]['cnt'] ?></p>
                        </div>
                    <?php endif;?>
                    <div data-coid="<?php $comments->coid() ?>" class="cat_comment_reply button" reply_id="<?php $comments->theId(); ?>" onclick="return TypechoComment.reply('<?php $comments->theId(); ?>', <?php $comments->coid(); ?>);">
                        <i title="回复" class="ri-message-3-fill"></i>
                    </div>
                    <div class="button eye_button_close" data-fxid="<?php $comments->theId(); ?>">
                        <i title="收起" class="ri-eye-close-fill"></i>
                        <div class="cat_diary_single_num" data-fxid="<?php $comments->theId(); ?>"></div>
                    </div>
                    <div class="button eye_button_open" data-fxid="<?php $comments->theId(); ?>">
                        <i title="展开" class="ri-eye-fill"></i>
                        <div class="cat_diary_single_num" data-fxid="<?php $comments->theId(); ?>"></div>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>
<div style="display:none;">
    <?php $this->need('parts/article.php'); ?>
</div>
    </div>
</div>
<?php $this->need('parts/footer.php'); ?>
