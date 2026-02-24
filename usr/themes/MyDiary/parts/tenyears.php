<div class="section_first"> 
<?php
    $rss =  simplexml_load_file('https://tool.bcrjl.com/snzy-rss/');
    $title =  $rss->channel->title;
    $i = 0;
    foreach ($rss->channel->item as $item) {
        if ($i > 30){
            break;
        }
        $faviconhost = parse_url($item->link);
        $datex = date_create($item->pubDate,timezone_open("Asia/Shanghai"));
        $datey = date_format($datex,"Y年n月j日");
?>
    <div class="friends_block">
        <div class="box_out">
            <div class="box_avatar">
                <div class="box_avatar_left">
                    <img style="background: #fff; margin-top: var(--margin);" class="lazyload" src="<?php echo resource_cdn() . 'img/avatar.webp'; ?>" data-src="<?php echo get_favicon($faviconhost['host']) ?>" onerror="javascript:this.src='data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';" width="40px" height="40px">
                </div>
                <div class="box_avatar_right">
                    <a rel="noopener noreferrer nofollow" title="<?php echo $datey ?>" target="_blank" href="<?php echo 'https://' . $faviconhost['host'] ?>"><?php echo $item->author ?></a>
                    <i title="十年之约成员" class="linkicon ri-user-star-line"></i>
                </div>
            </div>
        </div>
        <a rel="noopener noreferrer nofollow" class="friends_post_title" target="_blank" href="<?php echo $item->link ?>"><?php echo $item->title ?></a>
        <div class="friends_post_post" style="text-indent: 2em;"><?php echo $item->description ?></div>
    </div>
    <?php }?>
</div> 