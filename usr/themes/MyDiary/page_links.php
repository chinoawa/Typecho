<?php
/**
 * 友链
 * 
 * @package custom 
 * 
 **/
?>
<!DOCTYPE HTML>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<?php
error_reporting(0);
function seexml($urls) {
$ch = array();
$res = array();
$conn = array();
$mh = curl_multi_init();
$duration = (helper::options()->cat_links_duration ? helper::options()->cat_links_duration : '30');
foreach ($urls as $i => $url) {
    $conn[$i] = curl_init();
	curl_setopt_array($conn[$i], array(
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_NOSIGNAL => 1,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => $duration,
        CURLOPT_TIMEOUT => $duration,
        CURLOPT_RETURNTRANSFER => true,
    ));
    curl_multi_add_handle($mh, $conn[$i]);
}
$active = null;
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);
while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) != -1) {
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
}
foreach ($urls as $i => $url) {
    //获取输出的文本流
    $res[$i] = curl_multi_getcontent($conn[$i]);
    $rss_out[] = simplexml_load_string($res[$i]);
    curl_multi_remove_handle($mh, $conn[$i]);
    curl_close($conn[$i]);
}
curl_multi_close($mh);
return $rss_out;
}
?>
<div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <div id="cat_article_start" class="tabs_content">
        <?php
            $settime = ($this->options->cat_links_updatetime ? $this->options->cat_links_updatetime : '28800');
        ?>
        <?php if(file_exists('pre_links_ok.html') && (time() - filemtime("pre_links_ok.html") < $settime) && ($_GET["type"] != 'RELOAD')) : ?>
            <?php include('pre_links_ok.html'); ?>
        <?php else: ?>
            <?php ob_start(); ?>
            <section class="tab1">
            <div class="cat_grid section_random">
                <?php
                    $friends_text = $this->options->cat_links_rss;
                    if ($friends_text) {
                        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
                        if (count($friends_arr) > 0) {
                            for ($i = 0; $i < count($friends_arr); $i++) {
                                $x_rss = explode("||", $friends_arr[$i])[0];
                                $x_mail = explode("||", $friends_arr[$i])[1];
                                $friendss[] = array("x_rss" => trim($x_rss), "x_mail" => trim($x_mail));
                            };
                            $friends_rss = array_column($friendss,'x_rss');
                            $friends_mail = array_column($friendss,'x_mail');
                        }
                    $rss_out1 = seexml($friends_rss);
                    }
                ?>
                <?php if (is_array($friends_rss)) : ?>
                    <?php $t = 0; foreach ($friends_rss as $friend) : ?>
                        <?php
                            if(!empty($rss_out1[$t])){
                                $rss = $rss_out1[$t];
                                $title 			=  $rss->channel->title;
                                $description 	=  $rss->channel->description;
                                $link 			=  $rss->channel->link;
                            }else{
                                $title 			=  '此网站异常';
                                $description 	=  '请联系管理员处理';
                                $link 			=  $friends_rss[$t];
                            }
                            $faviconhost = parse_url($link);
                        ?>
                        <div class="friends_block">
                            <div class="box_out">
                                <?php if($this->options->cat_links_showimg == 'on') :?>
                                    <img class="lazyload box_img" src="<?php echo $this->options->cat_Lazyload ? $this->options->cat_Lazyload : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' ?>" data-src="<?php echo !empty($link) ? 'https://s0.wp.com/mshots/v1/'.$link.'?w=400&amp;h=270' : get_random_Thumbnail($this); ?>">
                                <?php else: ?>
                                    <br>
                                <?php endif;?>
                                <div class="box_avatar" style="margin-top: -1rem;">
                                    <div class="box_avatar_left">
                                        <img style="background: #fff;" class="lazyload" src="<?php echo resource_cdn() . 'img/avatar.webp'; ?>" data-src="<?php echo $friends_mail[$t] ? get_AvatarByMail($friends_mail[$t]) : get_favicon($faviconhost['host']) ?>" width="50px" height="50px">
                                    </div>
                                    <div class="box_avatar_right">
                                        <a title="<?php echo $description ?>" target="_blank" href="<?php echo $link ?>"><?php echo $title ?></a>
                                        <i title="从RSS订阅" class="linkicon ri-rss-line"></i>
                                    </div>
                                </div>
                            </div>
                            <?php    
                                $i=1;
                                echo '<ul class="friends_title">';
                                if(!empty($rss_out1[$t])){
                                    foreach ($rss->channel->item as $item) {
                                	    $datex = date_create($item->pubDate,timezone_open("Asia/Shanghai"));
                                        $datey = date_format($datex,"Y年n月j日 H:i:s");
                                        if($i>5) break;
                                        echo '<li><a title="更新时间：<br>' . $datey . '" target="_blank" href="' . $item->link . '"><i style="color:var(--theme-60);" class="ri-file-list-3-line"></i> ' . $item->title . '</a></li>';
                                        $i++; 
                                    }
                                }else{
                                    echo '此站点可能无法正常访问，请联系站长解决此问题。<br>站点链接：<a href="' . $link . '" target="_blank">' . $link . '</a>';
                                }
                                echo '</ul>';
                            ?>
                        </div>
                    <?php $t++; endforeach; ?>
                <?php endif; ?>
				<?php
                    $atom_friends_text = $this->options->cat_links_atom;
                    if ($atom_friends_text) {
                        $atom_friends_arr = array_values(array_filter(explode("\r\n", $atom_friends_text)));
                        if (count($atom_friends_arr) > 0) {
                            for ($i = 0; $i < count($atom_friends_arr); $i++) {
                                $atom_x_rss = explode("||", $atom_friends_arr[$i])[0];
                                $atom_x_mail = explode("||", $atom_friends_arr[$i])[1];
                                $atom_friendss[] = array("x_rss" => trim($atom_x_rss), "x_mail" => trim($atom_x_mail));
                            };
                            $atom_friends_rss = array_column($atom_friendss,'x_rss');
                            $atom_friends_mail = array_column($atom_friendss,'x_mail');
                        }
                    $rss_out2 = seexml($atom_friends_rss);
                    }
                ?>
                <?php if (is_array($atom_friends_rss)) : ?>
                    <?php $t = 0; foreach ($atom_friends_rss as $atom_friend) : ?>
                	    <?php
                            if(!empty($rss_out2[$t])){
                                $atom = $rss_out2[$t];
                                $title          =  $atom->title;
                                $description    =  $atom->subtitle;
                                $link_pre       =  $atom->id;
                                $link = 'https://' . parse_url($link_pre)['host'];
                            }else{
                                $title 			=  '此网站异常';
                                $description 	=  '请联系管理员处理';
                                $link 			=  $friends_rss[$t];
                            }
                            $faviconhost = parse_url($link);
                        ?>
                        <div class="friends_block">
                        <div class="box_out">
                            <?php if($this->options->cat_links_showimg == 'on') :?>
                                <img class="lazyload box_img" src="<?php echo $this->options->cat_Lazyload ? $this->options->cat_Lazyload : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' ?>" data-src="<?php echo !empty($link) ? 'https://s0.wp.com/mshots/v1/'.$link.'?w=400&amp;h=270' : get_random_Thumbnail($this); ?>">
                            <?php else: ?>
                                <br>
                            <?php endif;?>
                            <div class="box_avatar" style="margin-top: -1rem;">
                                <div class="box_avatar_left author-infos">
                                    <img style="background: #fff;" class="lazyload" src="<?php echo resource_cdn() . 'img/avatar.webp'; ?>" data-src="<?php echo $atom_friends_mail[$t] ? get_AvatarByMail($atom_friends_mail[$t]) : get_favicon($faviconhost['host']) ?>" width="50px" height="50px">
                                </div>
                                <div class="box_avatar_right">
                                    <a title="<?php echo $description ?>" target="_blank" href="<?php echo $link ?>"><?php echo $title ?></a>
                                    <i title="从Atom订阅" class="linkicon ri-gps-line"></i>
                                </div>
                            </div>
                        </div>
                        <?php    
                            $i=1;
                            echo '<ul class="friends_title">';
                                foreach ($atom->entry as $entry) {
                            	    $datex = date_create($entry->updated,timezone_open("Asia/Shanghai"));
                                    $datey = date_format($datex,"Y年n月j日 H时");
                                    if($i>5) break;
                                    echo '<li><a title="更新时间：<br>' . $datey . '" target="_blank" href="' . $entry->id . '"><i style="color:var(--theme-60);" class="ri-file-list-3-line"></i> ' . $entry->title . '</a></li>';
                                    $i++; 
                                }
                            echo '</ul>';
                            ?>
                        </div>
                    <?php $t++; endforeach; ?>
                <?php endif; ?>
                <?php
                    $friends = [];
                    $friends_text = $this->options->cat_links_nofeed;
                    if ($friends_text) {
                        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
                        if (count($friends_arr) > 0) {
                            for ($i = 0; $i < count($friends_arr); $i++) {
                                $name = explode("||", $friends_arr[$i])[0];
                                $url = explode("||", $friends_arr[$i])[1];
                                $avatar = explode("||", $friends_arr[$i])[2];
                                $desc = explode("||", $friends_arr[$i])[3];
                                $friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
                            };
                        }
                    }
                ?>
                <?php if (sizeof($friends) > 0) : ?>
                    <?php foreach ($friends as $item) : ?>
                        <div class="friends_block">
                            <div class="box_out">
                                <?php if($this->options->cat_links_showimg == 'on') :?>
                                    <img class="lazyload box_img" src="<?php echo $this->options->cat_Lazyload ? $this->options->cat_Lazyload : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' ?>" data-src="<?php echo !empty($item['url']) ? 'https://s0.wp.com/mshots/v1/'.$item['url'].'?w=400&amp;h=270' : get_random_Thumbnail($this); ?>">
                                <?php else: ?>
                                    <br>
                                <?php endif;?>
                                <div class="box_avatar" style="margin-top: -1rem;">
                                    <div class="box_avatar_left author-infos">
                                        <img style="background: #fff;" class="lazyload" src="<?php echo resource_cdn() . 'img/avatar.webp'; ?>" data-src="<?php echo $item['avatar'] ?>" width="50px" height="50px">
                                    </div>
                                    <div class="box_avatar_right">
                                        <a target="_blank" href="<?php echo $item['url'] ?>"><?php echo $item['name'] ?></a>
                                        <i title="友情链接" class="linkicon ri-link"></i>
                                    </div>
                                </div>
                            </div>
                            <ul class="friends_link_desc">
                                <?php echo $item['desc'] ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php
                    $friends = [];
                    $friends_text = $this->options->cat_links_auto;
                    if ($friends_text) {
                        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
                        if (count($friends_arr) > 0) {
                            for ($i = 0; $i < count($friends_arr); $i++) {
                                $url = explode("||", $friends_arr[$i])[0];
                                $mail = explode("||", $friends_arr[$i])[1];
                                $friends[] = array("url" => trim($url), "mail" => trim($mail));
                            };
                        }
                    }
                ?>
                <?php if (sizeof($friends) > 0) : ?>
                    <?php foreach ($friends as $item) : ?>
                    <?php 
                        $faviconhost = parse_url($item['url']);
                    ?> 
                        <div class="friends_block">
                            <div class="box_out">
                                <?php if($this->options->cat_links_showimg == 'on') :?>
                                    <img class="lazyload box_img" src="<?php echo $this->options->cat_Lazyload ? $this->options->cat_Lazyload : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' ?>" data-src="<?php echo !empty($item['url']) ? 'https://s0.wp.com/mshots/v1/'.$item['url'].'?w=400&amp;h=270' : get_random_Thumbnail($this); ?>">
                                <?php else: ?>
                                    <br>
                                <?php endif;?>
                                <div class="box_avatar" style="margin-top: -1rem;">
                                    <div class="box_avatar_left author-infos">
                                        <img style="background: #fff;" class="lazyload" src="<?php echo resource_cdn() . 'img/avatar.webp'; ?>" data-src="<?php echo $item['mail'] ? get_AvatarByMail($item['mail']) : get_favicon($faviconhost['host']); ?>" width="50px" height="50px">
                                    </div>
                                    <div class="box_avatar_right">
                                        <a target="_blank" href="<?php echo $item['url'] ?>"><?php echo get_link_title($item['url'])['title'] ?></a>
                                        <i title="友情链接" class="linkicon ri-link"></i>
                                    </div>
                                </div>
                            </div>
                            <ul class="friends_link_desc">
                                <?php echo get_link_title($item['url'])['description'];?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php if ($this->options->cat_links_nolink) :?>
                <div class="cat_links_unlink_moreusers"><i class="ri-arrow-down-line"></i> unlinked</div>
            <?php endif; ?>
            <div class="unlink_top">
            <div class="cat_grid">
                <?php
                    $friends = [];
                    $friends_text = $this->options->cat_links_nolink;
                    if ($friends_text) {
                        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
                        if (count($friends_arr) > 0) {
                            for ($i = 0; $i < count($friends_arr); $i++) {
                                $name = explode("||", $friends_arr[$i])[0];
                                $url = explode("||", $friends_arr[$i])[1];
                                $friends[] = array("name" => trim($name), "url" => trim($url));
                            };
                        }
                    }
                ?>
                <?php if (sizeof($friends) > 0) : ?>
                        <?php foreach ($friends as $item) : ?>
                            <div class="friends_block">
                                <div class="box_out">
                                    <div class="box_avatar">
                                        <div class="box_avatar_right">
                                            <a target="_blank" rel="noopener noreferrer nofollow" href="<?php echo $item['url'] ?>"><?php echo $item['name'] ?></a>
                                            <i title="网站失联" class="unlinkicon ri-link-unlink"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                <?php endif; ?>
            </div>
            </div>
        </section>
            <?php if ($this->options->cat_links_circle == "on"): ?>
        		<section class="tab2">
                    <div class="section_first">
                    <?php $feed = array(); ?>
                    <?php if (is_array($friends_rss)) : ?>
                        <?php
                        $t = 0;
                        foreach($friends_rss as $rss_url){
                            if(!empty($rss_out1[$t])){
                                $rss = $rss_out1[$t];
                            }
                            $titleinfo =  $rss->channel->title;
                            $linkinfo =  $rss->channel->link;
                                foreach ($rss->channel->item as $node) {
                                    $newdesc = strip_tags($node->description);
                                    $item = array (
                                        'title' => $node->title,
                                        'desc' => $newdesc,
                                        'link' => $node->link,
                                        'date' => $node->pubDate,
                                        'titleinfo' => $titleinfo,
                                        'linkinfo' => $linkinfo,
                                        'avatar' => get_AvatarByMail($friends_mail[$t]),
                                        );
                                array_push($feed, $item);
                                }
                                $t++;
                            }    
                        ?>
                    <?php endif; ?>
                    <?php if (is_array($atom_friends_rss)) : ?>
                    <?php
                    $t = 0;
                    foreach($atom_friends_rss as $atom_rss_url){
                        if(!empty($rss_out2[$t])){
                            $rss = $rss_out2[$t];
                        }
                        $titleinfo = $rss->author->name;
                        $linkinfo = $rss->id;
                            foreach ($rss->entry as $node) {
                                if ($node->content){
                                    $newdesc = strip_tags($node->content);
                                } elseif($node->summary) {
                                    $newdesc = strip_tags($node->summary);
                                }
                                $item = array (
                                    'title' => $node->title,
                                    'desc' => $newdesc,
                                    'link' => $node->id,
                                    'date' => $node->published,
                                    'titleinfo' => $titleinfo,
                                    'linkinfo' => $linkinfo,
                                    'avatar' => get_AvatarByMail($atom_friends_mail[$t]),
                                );
                                array_push($feed, $item);
                            }
                            $t++;
                        } 
                    ?>
                    <?php endif; ?>
                    <?php
                      foreach ($feed as $i=>$v){
                          $datenum = $v['date'];
                          $datex = date_create($datenum,timezone_open("Asia/Shanghai"));
                          $feed[$i][0] = date_format($datex,"U");
                      }
                      $last_names = array_column($feed,0);
                      array_multisort($last_names,SORT_DESC,$feed);
                        foreach ($feed as $i=>$v){
                          if ($i > 30){
                              break;
                        }
                        $feed[$i][0] = date('Y年n月j日 H时',$v[0]);
                        $faviconhost = parse_url($feed[$i]['linkinfo']);
                    ?>
                        <div class="friends_block">
                            <div class="box_out">
                                <div class="box_avatar">
                                    <div class="box_avatar_left">
                                        <img style="background: #fff; margin-top: var(--margin);" class="lazyload" src="<?php echo resource_cdn() . 'img/avatar.webp'; ?>" data-src="<?php echo $feed[$i]['avatar'] ?>" width="40px" height="40px">
                                    </div>
                                    <div class="box_avatar_right">
                                        <a title="<?php echo $feed[$i][0] ?>" target="_blank" href="<?php echo $feed[$i]['linkinfo'] ?>"><?php echo $feed[$i]['titleinfo'] ?></a>
                                        <i title="好友" class="linkicon ri-user-heart-line"></i>
                                    </div>
                                </div>
                            </div>
                            <a class="friends_post_title" title="<?php echo $feed[$i]['title'] ?>" target="_blank" href="<?php echo $feed[$i]['link'] ?>"><?php echo $feed[$i]['title'] ?></a>
                            <div class="friends_post_post"><?php echo $feed[$i]['desc'] ?></div>
                        </div>
                        <?php }?>
                    </div> 
        </section>
        	<?php endif; ?>
        	<?php
                $content = ob_get_contents();
                $content .= "\n<!--Create time: " . date( 'Y-m-d H:i:s' ) . "-->";
                file_put_contents('pre_links_ok.html',$content);
            ?>
        <?php endif; ?>
        <?php if ($this->options->cat_links_tenyears == "on"): ?>
    		<section class="tab3">
                <?php $this->need('parts/tenyears.php'); ?>
    		</section>
    	<?php endif; ?>
		<section class="tab4">
            <div style="<?php if ($this->fields->cat_close_post == "on") { echo 'display:none;'; } ?>">
                <?php $this->need('parts/article.php'); ?>
            </div>
            <?php $this->need('parts/comments.php'); ?>
		</section>
	</div>
</div>
<?php $this->need('parts/footer.php'); ?>
<?php if ($this->options->cat_links_random == "on"): ?>
<script>
  jQuery(function($){
       var arr = $('.section_random .friends_block').toArray();
       var len = arr.length;
       var rand = parseInt(Math.random()*(len));
       $('.section_random .friends_block').each(function(i){
            $('.section_random').append($('.section_random .friends_block').eq(rand));
            rand = parseInt(Math.random()*(len));
       });
});
</script>
<?php endif; ?>