<?php if ($this->options->cat_static_index == "on" && !file_exists('cat_static_index.php')) : ?>
    <?php 
        $phpfile = '<?php
$nowtime=time();
$pastsec = $nowtime - $_GET["t"];
if($pastsec<600) //10分钟更新一次，时间可以自己调整
{exit;}
ob_start();
include("index.php");
$content = ob_get_contents();
$content .= "\n<!--Create time: " . date( \'Y-m-d H:i:s\' ) . "-->";
$content .= "\n<script language=javascript src=\"cat_static_index.php?t=".$nowtime."\"></script>";
file_put_contents("index.html",$content);
if (!function_exists("file_put_contents"))
{
function file_put_contents($fn,$fs)
{
$fp=fopen($fn,"w+");
fputs($fp,$fs);
fclose($fp);  
}
}
?>';
file_put_contents("cat_static_index.php",$phpfile);
header('content-type:text/html;charset=utf-8');
echo "<script>window.location.href='/cat_static_index.php';</script>";
    ?>
<?php elseif ($this->options->cat_static_index == "off" && file_exists('cat_static_index.php')): ?>
    <?php unlink('cat_static_index.php') ?>
    <?php unlink('index.html') ?>
<?php endif; ?>
<?php if ($this->options->cat_pwa_switch == "on") : ?>
<script>
window.addEventListener('appinstalled', () => {
  divInstall.classList.toggle('PWAhidden', true);
  deferredPrompt = null;
  console.log('PWA安装成功');
});
window.addEventListener('beforeinstallprompt', (event) => {
  event.preventDefault();
  console.log('👍', 'PWA未安装', event);
  window.deferredPrompt = event;
  divInstall.classList.toggle('PWAhidden', false);
});
butInstall.addEventListener('click', async () => {
  console.log('👍', 'PWA用户点击');
  const promptEvent = window.deferredPrompt;
  if (!promptEvent) {
    return;
  }
  promptEvent.prompt();
  const result = await promptEvent.userChoice;
  console.log('👍', 'PWA用户选择', result);
  window.deferredPrompt = null;
  divInstall.classList.toggle('PWAhidden', true);
});
</script>
<?php endif; ?>
<?php if ($this->options->cat_pwa_switch == "on" && !file_exists('manifest.json')) : ?>
    <?php 
        $db  = Typecho_Db::get();
        $row = $db->fetchRow($db
            ->select('mail')
            ->from('table.users')
            ->where('uid = ?', '1')
        );
        $mail = md5(max($row));
        $jsonfile = '{';
        $jsonfile .= '"name": "' . $this->options->title . '",';
        $jsonfile .= '"short_name": "' . $this->options->title . '",';
        $jsonfile .= '"start_url": "' . $this->options->siteUrl . '",';
        $jsonfile .= '"display": "fullscreen","background_color": "#ffffff","scrope": "/",';
        $jsonfile .= '"description": "' . $this->options->description . '",';
        $jsonfile .= '"theme_color": "' . ($this->options->user_themecolor ? $this->options->user_themecolor : '#ff6a6a') . '",';
        $jsonfile .= '"lang": "zh-CN",';
        $jsonfile .= '"icons": [{';
        $jsonfile .= '"src": "' . 'https://cravatar.cn/avatar/' . $mail . '?d=mm&s=48",';
        $jsonfile .= '"sizes": "48x48",';
        $jsonfile .= '"type": "image/png",';
        $jsonfile .= '"purpose": "any maskable"';
        $jsonfile .= '}, {';
        $jsonfile .= '"src": "' . 'https://cravatar.cn/avatar/' . $mail . '?d=mm&s=96",';
        $jsonfile .= '"sizes": "96x96",';
        $jsonfile .= '"type": "image/png",';
        $jsonfile .= '"purpose": "any maskable"';
        $jsonfile .= '}, {';
        $jsonfile .= '"src": "' . 'https://cravatar.cn/avatar/' . $mail . '?d=mm&s=192",';
        $jsonfile .= '"sizes": "192x192",';
        $jsonfile .= '"type": "image/png",';
        $jsonfile .= '"purpose": "any maskable"';
        $jsonfile .= '}, {';
        $jsonfile .= '"src": "' . 'https://cravatar.cn/avatar/' . $mail . '?d=mm&s=512",';
        $jsonfile .= '"sizes": "512x512",';
        $jsonfile .= '"type": "image/png",';
        $jsonfile .= '"purpose": "any maskable"';
        $jsonfile .= '}]';    
        $jsonfile .= '}';
        file_put_contents("manifest.json",$jsonfile);
    ?>
<?php elseif ($this->options->cat_pwa_switch == "off" && file_exists('manifest.json')): ?>
    <?php unlink('manifest.json') ?>
<?php endif; ?>
<?php if ($this->options->cat_pwa_switch == "on" && !file_exists('service-worker.js')) : ?>
    <?php 
        $avatar_addr = quotemeta($this->options->cat_avatar ? $this->options->cat_avatar : 'https://cravatar.cn/avatar/');
        $jsfile = 'importScripts(\'https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js\');';
        $jsfile .= 'if (workbox) { console.log(`Workbox成功加载`); } else { console.log(`Workbox加载失败`); }';
        $jsfile .= 'workbox.routing.registerRoute(new RegExp(\'.*\.(?:js|css)\'),workbox.strategies.cacheFirst({cacheName:\'css&js-cache\',plugins:[new workbox.cacheableResponse.Plugin({statuses:[0,200]}),new workbox.expiration.Plugin({maxEntries:200,maxAgeSeconds:7*24*60*60,})]}));';
        $jsfile .= 'workbox.routing.registerRoute(new RegExp(\''.$avatar_addr.'\'),workbox.strategies.cacheFirst({cacheName:\'avatar-cache\',plugins:[new workbox.cacheableResponse.Plugin({statuses:[0,200]}),new workbox.expiration.Plugin({maxEntries:200,maxAgeSeconds:30*24*60*60,})]}));';
        $jsfile .= 'workbox.routing.registerRoute(new RegExp(\'https://s0\.wp\.com/mshots/v1/\'),workbox.strategies.cacheFirst({cacheName:\'wp0-cache\',plugins:[new workbox.cacheableResponse.Plugin({statuses:[0,200]}),new workbox.expiration.Plugin({maxEntries:200,maxAgeSeconds:7*24*60*60,})]}));';
        if ($this->options->cat_steamid && $this->options->cat_steamid) {
        $jsfile .= 'workbox.routing.registerRoute(new RegExp(\''.quotemeta($this->options->cat_steamcdn ? $this->options->cat_steamcdn : 'https://media.st.dl.eccdnx.com').'\'),workbox.strategies.cacheFirst({cacheName:\'steam-cache\',plugins:[new workbox.cacheableResponse.Plugin({statuses:[0,200]}),new workbox.expiration.Plugin({maxEntries:1000,maxAgeSeconds:7*24*60*60,})]}));';
        }
        if ($this->options->cat_pwa_image == 'on') {
        $jsfile .= 'workbox.routing.registerRoute(new RegExp(\'.*\.(?:jpg|png|gif|apng|svg|webp)\'),workbox.strategies.cacheFirst({cacheName:\'image-cache\',plugins:[new workbox.cacheableResponse.Plugin({statuses:[0,200]}),new workbox.expiration.Plugin({maxEntries:2000,maxAgeSeconds:7*24*60*60,})]}));';
        }
        if ($this->options->cat_pwa_media == 'on') {
        $jsfile .= 'workbox.routing.registerRoute(new RegExp(\'.*\.(?:mp4|m3u8|webm)\'),workbox.strategies.cacheFirst({cacheName:\'media-cache\',plugins:[new workbox.cacheableResponse.Plugin({statuses:[0,200]}),new workbox.expiration.Plugin({maxEntries:100,maxAgeSeconds:7*24*60*60,})]}));';
        }
        if ($this->options->cat_pwa_cdn) {
        $jsfile .= 'workbox.routing.registerRoute(new RegExp(\''.quotemeta($this->options->cat_pwa_cdn).'\'),workbox.strategies.cacheFirst({cacheName:\'cdn-cache\',plugins:[new workbox.cacheableResponse.Plugin({statuses:[0,200]}),new workbox.expiration.Plugin({maxEntries:1000,maxAgeSeconds:7*24*60*60,})]}));';
        }
        file_put_contents("service-worker.js",$jsfile);
    ?>
<?php elseif ($this->options->cat_pwa_switch == "off" && file_exists('service-worker.js')): ?>
    <?php unlink('service-worker.js') ?>
<?php endif; ?>
<?php if($this->options->cat_diary_rss == 'on'): ?>
<?php 
    $diaryrss = '<?xml version="1.0" encoding="UTF-8"?><rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" version="2.0"><channel>';
    $diaryrss .= '<title>' . $this->options->title . ' - 日记</title>';
    $diaryrss .= '<link>' . $this->options->siteUrl . '</link>';
    $diaryrss .= '<language>zh-CN</language>';
    $diaryrss .= '<description>' . $this->options->title . '——日记动态</description>';
    $diaryslug = Typecho_Db::get()->fetchAll(Typecho_Db::get()
    	->select('cid')
    	->from  ('table.contents')
    	->where ('table.contents.slug=?',$this->options->cat_diary_slug ? $this->options->cat_diary_slug :'cat_diary')
    );
    if(!empty($diaryslug)){
        $thefeeds = Typecho_Db::get()->fetchAll(Typecho_Db::get()
        	->select('coid','created','text','weather','mood','secert')
        	->from  ('table.comments')
        	->where ('table.comments.authorId=?','1')
        	->where ('table.comments.cid=?',$diaryslug[0])
        	->where ('table.comments.parent=?','0')
            ->order ('coid', Typecho_Db::SORT_DESC)
            ->limit ('20')
        );
        foreach ($thefeeds as $i=>$thefeed) {
        	$feedtime = date("n月j日",$thefeed['created']);
        	$feedtitle = $this->options->title . ' - ' . $feedtime . ($thefeed['weather']?':' . diary_he_weather($thefeed['weather']):'') . ($thefeed['mood']?',' . $thefeed['mood']:'');
        	$feeddesc = mb_substr($thefeed['text'], 0, 200);
        	$feeddesc = preg_replace('/{linkname name="(.*?)" link="(.*?)"}/', '${1}' , $feeddesc);
        	$feeddesc = preg_replace('/{bilibili}(.*?){\/bilibili}/', '' , $feeddesc);
        	$feeddesc = preg_replace('/{netmusic}(.*?){\/netmusic}/', '' , $feeddesc);
        	$IMGNAME = $this->options->cat_comment_IMGcode ? $this->options->cat_comment_IMGcode : 'IMG';
        	$feeddesc = preg_replace('/{'.$IMGNAME.'}(.*?){\/'.$IMGNAME.'}/', '' , $feeddesc);
        	$feeddesc = preg_replace('/\:\@\((.*?)\)/', '', $feeddesc); 
        	$feeddate = date(DATE_RFC822,$thefeed['created']);
        	if($thefeed['secert'] != "1"){
        	    $diaryrss .= '<item>';
            	$diaryrss .= '<title>' . $feedtitle . '</title>';
            	$diaryrss .= '<link>' . ($this->options->rewrite == 0 ? Helper::options()->rootUrl . '/' . ('index.php/'.$this->options->cat_diary_slug ? $this->options->cat_diary_slug :'cat_diary') .'.html' : Helper::options()->rootUrl . '/' . ('index.php/'.$this->options->cat_diary_slug ? $this->options->cat_diary_slug :'cat_diary') . '.html') . '</link>';
                $diaryrss .= '<dc:creator>' . $this->options->title . '</dc:creator>';
            	$diaryrss .= '<description>' . $feeddesc . '</description>';
            	$diaryrss .= '<content:encoded>' . $feeddesc . '</content:encoded>';
            	$diaryrss .= '<pubDate>' . $feeddate . '</pubDate>';
            	$diaryrss .= '</item>';
        	}
        }
    }else{
        $diaryrss .= '<item><title>暂无日记</title><description>博主还没有写日记哦</description></item>';
    }
    $diaryrss .= '</channel></rss>';
    file_put_contents("cat_diary_rss.xml",$diaryrss);
?>
<?php endif; ?>