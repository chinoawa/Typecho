<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    <link rel="stylesheet" href="<?php echo resource_cdn() . 'css/diary.css' ?>" />
    <style>
        #cat_comment .cat_comment_body .content .substance {
            width: 100%!important;
        }   
    </style>
    <div id="cat_comment">
    <?php $this->comments()->to($comments); ?>
        <?php if ($this->user->uid == $this->authorId) : ?>
        	<?php if ($this->allow('comment') && $this->options->cat_comment_allow === "off") : ?>
				<div class="cat_comment_close cat_comment_title">
				    <p>共计 <?php $this->commentsNum(); ?> 条，点此发表点评</p>
				</div>
			<?php endif; ?>
		<?php endif; ?>	
        <div class="cat_comment_replyout_style cat_cancel_titleout" style="display:none;">
            <div id="<?php $this->respondId(); ?>" class="respond">
                <form method="post" class="cat_comment_respond_form" action="<?php $this->commentUrl() ?>" data-type="text">
    				<div style="display: flex;">
    					<div class="replyavatar">
    						<img class="user_logined_avatar avatar lazyload" src="<?php echo get_AvatarByMail($this->user->mail); ?>" alt="">
    					</div>
    					<div class="head">
    						<div class="list" style="display: none;">
    							<input type="text" value="<?php $this->user->mail() ?>" autocomplete="off" name="mail" placeholder="邮箱" />
    						</div>
    						<div class="list">
    							<input type="text" value="<?php $this->user->screenName() ?>" autocomplete="off" disabled="disabled" name="author" maxlength="16" placeholder="昵称" />
    						</div>
    						<div class="list" style="display: none;">
    							<input type="text" value="<?php $this->user->url() ?>" autocomplete="off" name="url" placeholder="网址" />
    						</div>
    					</div>
    				</div>
    				<script src="<?php echo resource_cdn() . 'public/jquery.md5.min.js'?>"></script>
                    <div class="body">
                        <textarea name="text" value="" class="OwO-textarea" autocomplete="new-password" placeholder="点评内容"></textarea>
                    </div>
                    <div class="head">
                        <div class="list">
    						<input type="text" value="" autocomplete="off" name="image" placeholder="点评注释" />
    					</div>
					</div>
					<div class="foot">
                        <div class="left">
                            <div title="表情" class="OwO OwO_1"></div>
                            <div title="图片" class="cat_comment_button cat_comment_button_image"><i class="ri-image-add-line"></i></div>
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
                                </script>
                            </div>
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
                        <div class="right">
                            <div class="submit" id="Captcha_ok" style="display: block;">
                                <button type="submit" id="comment_put"><i class="ri-rocket-2-line"></i></button>
                            </div>
                        </div>
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
?>
<li id="li-<?php $comments->theId(); ?>" class="cat_comment_parent">
    <div class="cat_comment_replyout">
        <div class="cat_comment_body">
            <div class="content">
                <div class="substance">
                    <p><?php echo cat_comment_changetext($comments->content); ?></p>
                </div>
                <div class="handle" style="display: block;">
                    <time title="<?php $comments->date('Y年n月j日 H:i'); ?>" class="date" datetime="<?php $comments->date('jS H:i'); ?>"><?php $comments->dateWord(); ?></time>
                    <?php
                        $db  = Typecho_Db::get();
                        $counts = $db->fetchAll($db->select('image')->from('table.comments')->where('coid = ?', $comments->coid));
                        if($counts[0]['image']){
                            echo '：'.$counts[0]['image'];
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</li>
<?php } ?>