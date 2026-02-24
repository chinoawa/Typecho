<!DOCTYPE HTML>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->comments()->to($comments); 
    global $header_login;
    global $header_username;
    global $header_usermail;
    $header_login = ($this->user->hasLogin() ? '1' : '0');
    $header_username = ($this->user->hasLogin() ? $this->user->screenName : $this->remember('author', true));
    $header_usermail = ($this->user->hasLogin() ? $this->user->mail : $this->remember('mail', true));
?>
<div id="cat_comment">
    <?php $this->comments()->to($comments); ?>
    	<?php if ($this->allow('comment') && $this->options->cat_comment_allow != "on") : ?>
			<div class="cat_comment_close cat_comment_title">共计 <?php $this->commentsNum(); ?> 条评论，点此发表评论</div>
		<?php endif; ?>
    <?php if ($this->allow('comment') && $this->options->cat_comment_allow != "on") : ?>
        <div class="cat_comment_replyout_style cat_cancel_titleout" style="display:none;">
            <div id="<?php $this->respondId(); ?>" class="respond">
                <div class="cat_cancel_comment_reply">
                    <?php $comments->cancelReply(); ?>
                </div>
                <form method="post" class="cat_comment_respond_form" action="<?php $this->commentUrl() ?>" data-type="text">
					<div style="display: flex;"> 
						<div class="replyavatar">
							<img id="avatarimg" src="<?php
							$dr_userEmail = ($this->user->hasLogin()? $this->user->mail:$this->remember('mail', true) );
							if(!empty($dr_userEmail)){
							    echo get_AvatarByMail($dr_userEmail);
							}else{
								echo resource_cdn() . 'img/avatar.webp';
							}
						?>" alt="">
						</div>
						<div class="head">
							<div class="list">
								<input type="text" id="toavatar" value="<?php $this->user->hasLogin() ? $this->user->mail() : $this->remember('mail') ?>" autocomplete="off" name="mail" placeholder="QQ号或邮箱..." />
							</div>
							<div class="list">
								<input type="text" id="tonick" value="<?php $this->user->hasLogin() ? $this->user->screenName() : $this->remember('author') ?>" autocomplete="off" name="author" maxlength="16" placeholder="昵称..." />
							</div>
							<div class="list">
								<input type="text" value="<?php $this->user->hasLogin() ? $this->user->url() : $this->remember('url') ?>" autocomplete="off" name="url" placeholder="站点..." />
							</div>
						</div>
					</div>
                    <div class="body">
                        <textarea name="text" value="" class="OwO-textarea" autocomplete="new-password" placeholder="<?php echo $this->options->cat_comment_placeholder ?>"></textarea>
                    </div>
                    <div class="foot">
                        <div class="left">
                            <div title="表情" class="OwO OwO_1"></div>
                            <div title="私密评论" class="cat_comment_button comment_secert">
							    <input type="checkbox" name="secert" value="1"> <i class="ri-lock-2-line no_secert"></i> <i class="ri-lock-2-fill yes_secert"></i>
							</div>
                            <?php if($this->user->hasLogin() || $this->options->cat_comment_IMG_user == 'on'):?>
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
    <?php else: ?>
        <div class="cat_comment_close">
			<i class="ri-chat-off-line"></i>
			<?php if ($this->options->cat_comment_allow == "on") : ?>
				<span>&nbsp;博主关闭了所有页面的评论</span>
			<?php else : ?>
				<span>&nbsp;博主关闭了当前页面的评论</span>
			<?php endif; ?>
		</div>
    <?php endif; ?>
</div>
<?php function threadedComments($comments, $options) {
?>
<li id="li-<?php $comments->theId(); ?>" class="<?php 
if ($comments->levels > 0) {
    echo 'cat_comment_child';
} else {
    echo 'cat_comment_parent';
}
?> <?php if ($comments->authorId) {if ($comments->authorId == $comments->ownerId){?>huomiaoreply<?php }}?> ">
    <div class="shijian"><time class="date" datetime="<?php $comments->date('Y年n月j日'); ?>"><?php $comments->date('Y年n月j日'); ?></time></div>
    <div class="cat_comment_replyout" replyout_id="<?php $comments->theId(); ?>">
        <div class="cat_comment_body" id="<?php $comments->theId(); ?>">
            <div title="回复" class="cat_comment_reply" reply_id="<?php $comments->theId(); ?>" onclick="return TypechoComment.reply('<?php $comments->theId(); ?>', <?php $comments->coid(); ?>);">
                <img width="48" height="48" class="avatar lazyload" src="<?php get_AvatarLazyload() ?>" data-src="<?php echo get_AvatarByMail($comments->mail); ?>" alt="头像" />
                <div class="replymengban"><i class="ri-at-line"></i></div>
                <span title="<?php echo get_user_last_login($comments->mail,false); ?>留言过" class="onlinetime" style="background:<?php echo get_user_last_login($comments->mail,true); ?>"></span>
            </div>
            <div class="content">
                <div class="user"<?php if ($comments->authorId) {if ($comments->authorId == $comments->ownerId){?>align="right"<?php }}?>>
                    <span class="author"><?php $comments->author(); ?></span>
                    <?php get_comment_at($comments->coid) ?>
                        <div class="animetags" style="display:inline; margin: 0 0.5rem;">
    						<?php cat_comment_levelcard($comments->mail);?>
    						<?php cat_comment_friendcard($comments, $comments->mail); ?>
                        </div>
                    <?php if ($comments->status === "waiting") : ?>
                        <em class="waiting" style="color:var(--theme-60);">（评论审核中...）</em>
                    <?php endif; ?>
                </div>
                <?php
                    $db  = Typecho_Db::get();
                    $counts = $db->fetchAll($db
                        ->select('secert','mail','author','parent')
                        ->from('table.comments')
                        ->where('coid = ?', $comments->coid)
                    );
                    $parent = $counts[0]['parent'];
                    $secert = $counts[0]['secert'];
                    $mail = $counts[0]['mail'];
                    $author = $counts[0]['author'];
                ?>
                <?php
                    $db  = Typecho_Db::get();
                    $counts = $db->fetchAll($db
                        ->select('mail','author')
                        ->from('table.comments')
                        ->where('coid = ?', $parent)
                    );
                    $mail_parent = $counts[0]['mail'];
                    $author_parent = $counts[0]['author'];
                ?>
                <div class="substance" style="<?php if ($comments->authorId) {if ($comments->authorId == $comments->ownerId){?>margin-left: auto;margin-right: 0;<?php }}?>">
                    <p style="<?php if ($secert == '1') { echo 'background: repeating-linear-gradient(135deg,var(--theme-10),var(--theme-10) 1rem,var(--background) 0,var(--background) 2rem);color: var(--theme);'; } ?>">
                        <?php if($secert != '1' || ($secert == '1' && ($GLOBALS['header_login']=='1' || ($GLOBALS['header_usermail'] != '' && $mail==$GLOBALS['header_usermail'] && $author==$GLOBALS['header_username']) || ($GLOBALS['header_usermail'] != '' && $mail_parent==$GLOBALS['header_usermail'] && $author_parent==$GLOBALS['header_username'])))):?>
                            <?php echo cat_comment_changetext($comments->content); ?>
                        <?php else: ?>
                            <?php echo '此内容仅评论者及博主可见'; ?>
                        <?php endif;?>
                    </p>
                </div>
                <div class="handle"<?php if ($comments->authorId) {if ($comments->authorId == $comments->ownerId){?>align="right"<?php }}?>>
                    <time title="<?php $comments->date('Y年n月j日 H:i'); ?>" class="date" datetime="<?php $comments->date('jS H:i'); ?>"><?php $comments->dateWord(); ?></time>
                    <?php if(Helper::options()->cat_comment_UA == 'on') :?>
                        <?php echo ' · ' . get_AgentOS($comments->agent) . ' · ' . get_AgentBrowser($comments->agent); ?>
                    <?php endif; ?>
                    <?php if(Helper::options()->cat_comment_IP == 'on' && Helper::options()->cat_comment_ip_api) :?>
                        <?php
            			$db = Typecho_Db::get();
                        $row = $db->fetchRow($db
                            ->select('place')
                            ->from('table.comments')
                            ->where('ip = ?', $comments->ip)
                        );
                        $placeaddr = max($row);
                        if($placeaddr){
                            $place = $placeaddr;
                        }else{
            				$result = file_get_contents("https://restapi.amap.com/v3/ip?key=" . Helper::options()->cat_comment_ip_api . "&ip=" . $comments->ip);
            				$arr=json_decode($result,true);
            				if(Helper::options()->cat_comment_place == 'province'){
            				    if ($arr['infocode']==10000) {
            				        if (!empty($arr['adcode'])) {
                				    	$place = str_replace(['省','市','壮族自治区','回族自治区','维吾尔自治区','自治区'],"",$arr['province']);
            				        }else{
            				            $place = '海外';
            				        }
                				}
            				}elseif(Helper::options()->cat_comment_place == 'city'){
            				    if ($arr['infocode']==10000) {
            				        if (!empty($arr['adcode'])) {
                				    	$place = str_replace('市',"",$arr['city']);
            				        }else{
            				            $place = '海外';
            				        }
                				}
            				}elseif(Helper::options()->cat_comment_place == 'both'){
            				    if ($arr['infocode']==10000) {
            				        if (!empty($arr['adcode'])) {
            				            $place = str_replace(['省','市','壮族自治区','回族自治区','维吾尔自治区','自治区'],"",$arr['province']) . '-' . str_replace('市',"",$arr['city']);
            				        }else{
            				            $place = '海外';
            				        }
                				}
            				}
            				$update = $db->update('table.comments')
                                         ->rows(array('place' => $place))
                                         ->where('ip=?', $comments->ip);
                            $updatePLACE = $db->query($update);
                        }
            			echo ' · ' . $place;
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>