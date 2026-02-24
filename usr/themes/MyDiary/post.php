<!DOCTYPE HTML>
<?php
if (isset($_POST['agree'])) {
    if ($_POST['agree'] == $this->cid) {
        exit( strval(agree($this->cid)) );
    }
    exit('error');
}
?>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
    <div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
        <div style="<?php if ($this->fields->cat_close_post == "on") { echo 'display:none;'; } ?>">
            <?php $this->need('parts/article.php'); ?>
        </div>
        <?php if ($this->options->cat_article_bottom_info == "on"): ?>
            <div class="friends_block" style="margin-top: var(--margin);">
                <div class="box_out">
                    <div style="display: grid;grid-template-columns: auto 1fr;line-height: 1.75rem;word-break: break-all;font-size: 0.9rem;">
                        <div style="color: var(--theme);"><i class="ri-user-line"></i>作者：</div>
                        <span>
                            <?php if($this->fields->post_copyright_select === "reship" && $this->fields->post_copyright_reshipauthor): ?>
                                <?php $this->fields->post_copyright_reshipauthor(); ?>
                            <?php else: ?>
                                <?php $this->author(); ?>
                            <?php endif; ?>
                        </span>
                        <?php if($this->fields->post_top_info_select === "album"): ?>
                            <div style="color: var(--theme);"><i class="ri-image-line"></i>相册：</div><?php echo $this->fields->post_top_info_album_name?$this->fields->post_top_info_album_name:'默认相册'; ?>
                        <?php else: ?>
                            <div style="color: var(--theme);"><i class="ri-file-list-3-line"></i>文章：</div><?php $this->options->title() ?>
                        <?php endif; ?>
                        <div style="color: var(--theme);"><i class="ri-links-line"></i>地址：</div><?php $this->permalink() ?>
                        <div style="color: var(--theme);"><i class="ri-time-line"></i>更新：</div><?php echo date('Y 年 m 月 d 日 H 时' , $this->modified); ?>
                        <?php if($this->fields->post_copyright_select === "reship" && $this->fields->post_copyright_reshiptitle): ?>
                            <?php
                                $post_copyright_reshiptitle = $this->options->post_copyright_reshiptitle;
                                $a = explode("||", $post_copyright_reshiptitle)[0];
                                $b = isset(explode("||", $post_copyright_reshiptitle)[1])?explode("||", $post_copyright_reshiptitle)[1]:parse_url($a)['host'];
                            ?>
                            <div style="color: var(--theme);"><i class="ri-link"></i>转载：</div><a href="<?php echo $a; ?>" target="_blank"><?php echo $b; ?></a>
                        <?php elseif($this->fields->post_copyright_select === "quote" && $this->fields->post_copyright_quotelinks): ?>
                            <div style="color: var(--theme);"><i class="ri-double-quotes-l"></i>引用：</div>
                            <div>
                                <?php $links_arr = array_values(array_filter(explode("\r\n", $this->fields->post_copyright_quotelinks))); ?>
                                <?php foreach ($links_arr as $link): ?>
                                    <?php
                                        $a = explode("||", $link)[0];
                                        $b = isset(explode("||", $link)[1])?explode("||", $link)[1]:parse_url($a)['host'];
                                    ?>
                                    <div><a href="<?php echo $a; ?>" target="_blank"><?php echo $b; ?></a></div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div style="color: var(--theme);"><i class="ri-copyright-line"></i>声明：</div><a href="//creativecommons.org/licenses/by-nc-sa/4.0/deed.zh" target="_blank" rel="noopener noreferrer nofollow">本文由博主原创，依据 CC BY-NC-SA 4.0 许可协议授权，转载请注明出处</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($this->options->cat_article_correlation == "on"): ?>
            <?php $this->related(4,'')->to($cat_post); ?>
            <ul class="cat_post_correlation">
                <?php while ($cat_post->next()): ?>
                    <li style="margin-top: var(--margin);">
                        <div class="box_out">
                            <a href="<?php echo $cat_post->permalink ?>">
                                <div class="cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_2line" title="<?php echo $cat_post->title ?>"><?php echo $cat_post->title ?></div>
                                <img class="lazyload box_img" src="<?php echo get_Lazyload() ?>" data-src="<?php echo get_post_Thumbnail($cat_post) ?>">
                            </a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <div class="cat_tanchuang_out cat_postshare_out">
            <div class="cat_tanchuang cat_postshare">
                <img class="avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?php $this->permalink() ?>" alt="文章二维码" style="margin: 1rem;width:10rem;height:10rem;">
                <div class="title"><?php $this->title() ?></div>
                <button onclick="window.open('//connect.qq.com/widget/shareqq/index.html?url=<?php $this->permalink() ?>&title=<?php $this->title() ?>&pics=<?php get_post_Thumbnail($this) ?>','top');" style="background:#3C8AFF;" type="submit"><i class="ri-qq-line"></i> QQ分享</button>
                <button onclick="window.open('//sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php $this->permalink() ?>&sharesource=qzone&title=<?php $this->title() ?>','top');" style="background:#ff8741;" type="submit"><i class="ri-star-smile-line"></i> Qzone分享</button>
                <button onclick="window.open('//service.weibo.com/share/share.php?sharesource=weibo&title=分享：<?php $this->title() ?>，原文链接：<?php $this->permalink() ?>&pic=<?php echo get_post_Thumbnail($this) ?>','top');" style="background:#ff5656;" type="submit"><i class="ri-weibo-line"></i> 微博分享</button>
            </div>
        </div>
        <?php if ($this->fields->post_change_comment == "on"): ?>
            <?php $this->need('parts/weibo.php'); ?>
        <?php else: ?>
            <?php $this->need('parts/comments.php'); ?>
        <?php endif; ?>
    </div>
<?php $this->need('parts/footer.php'); ?>