<?php
function owo_path($path){
    $siteUrl = strlen(Helper::options()->siteUrl);
    $themeUrl = substr(Helper::options()->themeUrl,$siteUrl);
    if($path == true){
        return Helper::options()->themeUrl . '/stickers/';
    }else{
        return $themeUrl . '/stickers/';
    }
}
function get_AgentBrowser($agent)
{
	if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
		$outputer = 'IE浏览器';
	} else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
		$outputer = '火狐浏览器';
	} else if (preg_match('/Maxthon([\d]*)\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'Edge';
	} else if (preg_match('#360([a-zA-Z0-9.]+)#i', $agent, $regs)) {
		$outputer = '360极速';
	} else if (preg_match('/Edge([\d]*)\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'Edge';
	} else if (preg_match('/UC/i', $agent)) {
		$outputer = 'UC浏览器';
	} else if (preg_match('/QQ/i', $agent, $regs) || preg_match('/QQ Browser\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'QQ浏览器';
	} else if (preg_match('/UBrowser/i', $agent, $regs)) {
		$outputer = 'UC浏览器';
	}else if (preg_match('/BIDU/i', $agent, $regs)) {
        $outputer = '百度浏览器';
    } else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
		$outputer = 'Opera';
	} else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'Chrome';
	} else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'Safari';
	} else {
		$outputer = 'Chromium';
	}
	return $outputer;
}
function get_AgentOS($agent)
{
	$os = "Linux";
	if (preg_match('/win/i', $agent)) {
		if (preg_match('/nt 6.0/i', $agent)) {
			$os = 'Win Vista';
		} else if (preg_match('/nt 6.1/i', $agent)) {
			$os = 'Win 7';
		} else if (preg_match('/nt 6.2/i', $agent)) {
			$os = 'Win 8';
		} else if (preg_match('/nt 6.3/i', $agent)) {
			$os = 'Win 8.1';
		} else if (preg_match('/nt 5.1/i', $agent)) {
			$os = 'Win XP';
		} else if (preg_match('/nt 10.0/i', $agent)) {
			$os = 'Win 10+';
		} else {
			$os = 'Windows';
		}
	} else if (preg_match('/android/i', $agent)) {
		if (preg_match('/android 9/i', $agent)) {
			$os = 'Android Pie';
		} else if (preg_match('/android 8/i', $agent)) {
			$os = 'Android Oreo';
		} else {
			$os = 'Android';
		}
	} else if (preg_match('/ubuntu/i', $agent)) {
		$os = 'Ubuntu';
	} else if (preg_match('/linux/i', $agent)) {
		$os = 'Linux';
	} else if (preg_match('/iPhone/i', $agent)) {
		$os = 'iPhone';
	} else if (preg_match('/mac/i', $agent)) {
		$os = 'MacOS';
	} else if (preg_match('/fusion/i', $agent)) {
		$os = 'Android';
	} else {
		$os = 'Linux';
	}
	return $os;
}
function get_Lazyload($type = true)
{
    return Helper::options()->cat_Lazyload ? Helper::options()->cat_Lazyload : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
}
function get_AvatarLazyload($type = true)
{
	$str = 'data:image/webp;base64,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';
	if ($type) echo $str;
	else return $str;
}
function get_OWOLazyload($type = true)
{
	$str = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/PjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+PHN2ZyB0PSIxNjUyOTQ1MjE4NjI3IiBjbGFzcz0iaWNvbiIgdmlld0JveD0iMCAwIDEwMjQgMTAyNCIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHAtaWQ9IjMzNTEiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PC9zdHlsZT48L2RlZnM+PHBhdGggZD0iTTU2My4yIDQ2My4zTDY3NyA1NDBjMS43IDEuMiAzLjcgMS44IDUuOCAxLjggMC43IDAgMS40LTAuMSAyLTAuMiAyLjctMC41IDUuMS0yLjEgNi42LTQuNGwyNS4zLTM3LjhjMS41LTIuMyAyLjEtNS4xIDEuNi03LjhzLTIuMS01LjEtNC40LTYuNmwtNzMuNi00OS4xIDczLjYtNDkuMWMyLjMtMS41IDMuOS0zLjkgNC40LTYuNiAwLjUtMi43IDAtNS41LTEuNi03LjhsLTI1LjMtMzcuOGExMC4xIDEwLjEgMCAwIDAtNi42LTQuNGMtMC43LTAuMS0xLjMtMC4yLTItMC4yLTIuMSAwLTQuMSAwLjYtNS44IDEuOGwtMTEzLjggNzYuNmMtOS4yIDYuMi0xNC43IDE2LjQtMTQuNyAyNy41IDAuMSAxMSA1LjUgMjEuMyAxNC43IDI3LjR6TTM4NyAzNDguOGgtNDUuNWMtNS43IDAtMTAuNCA0LjctMTAuNCAxMC40djE1My4zYzAgNS43IDQuNyAxMC40IDEwLjQgMTAuNEgzODdjNS43IDAgMTAuNC00LjcgMTAuNC0xMC40VjM1OS4yYzAtNS43LTQuNy0xMC40LTEwLjQtMTAuNHogbTMzMy44IDI0MS4zbC00MS0yMGExMC4zIDEwLjMgMCAwIDAtOC4xLTAuNWMtMi42IDAuOS00LjggMi45LTUuOSA1LjQtMzAuMSA2NC45LTkzLjEgMTA5LjEtMTY0LjQgMTE1LjItNS43IDAuNS05LjkgNS41LTkuNSAxMS4ybDMuOSA0NS41YzAuNSA1LjMgNSA5LjUgMTAuMyA5LjVoMC45Yzk0LjgtOCAxNzguNS02Ni41IDIxOC42LTE1Mi43IDIuNC01IDAuMy0xMS4yLTQuOC0xMy42eiBtMTg2LTE4Ni4xYy0xMS45LTQyLTMwLjUtODEuNC01NS4yLTExNy4xLTI0LjEtMzQuOS01My41LTY1LjYtODcuNS05MS4yLTMzLjktMjUuNi03MS41LTQ1LjUtMTExLjYtNTkuMi00MS4yLTE0LTg0LjEtMjEuMS0xMjcuOC0yMS4xaC0xLjJjLTc1LjQgMC0xNDguOCAyMS40LTIxMi41IDYxLjctNjMuNyA0MC4zLTExNC4zIDk3LjYtMTQ2LjUgMTY1LjgtMzIuMiA2OC4xLTQ0LjMgMTQzLjYtMzUuMSAyMTguNCA5LjMgNzQuOCAzOS40IDE0NSA4Ny4zIDIwMy4zIDAuMSAwLjIgMC4zIDAuMyAwLjQgMC41bDM2LjIgMzguNGMxLjEgMS4yIDIuNSAyLjEgMy45IDIuNiA3My4zIDY2LjcgMTY4LjIgMTAzLjUgMjY3LjUgMTAzLjUgNzMuMyAwIDE0NS4yLTIwLjMgMjA3LjctNTguNyAzNy4zLTIyLjkgNzAuMy01MS41IDk4LjEtODUgMjcuMS0zMi43IDQ4LjctNjkuNSA2NC4yLTEwOS4xIDE1LjUtMzkuNyAyNC40LTgxLjMgMjYuNi0xMjMuOCAyLjQtNDMuNi0yLjUtODctMTQuNS0xMjl6IG0tNjAuNSAxODEuMWMtOC4zIDM3LTIyLjggNzItNDMgMTA0LTE5LjcgMzEuMS00NC4zIDU4LjYtNzMuMSA4MS43LTI4LjggMjMuMS02MSA0MS05NS43IDUzLjQtMzUuNiAxMi43LTcyLjkgMTkuMS0xMTAuOSAxOS4xLTgyLjYgMC0xNjEuNy0zMC42LTIyMi44LTg2LjJsLTM0LjEtMzUuOGMtMjMuOS0yOS4zLTQyLjQtNjIuMi01NS4xLTk3LjctMTIuNC0zNC43LTE4LjgtNzEtMTkuMi0xMDcuOS0wLjQtMzYuOSA1LjQtNzMuMyAxNy4xLTEwOC4yIDEyLTM1LjggMzAtNjkuMiA1My40LTk5LjEgMzEuNy00MC40IDcxLjEtNzIgMTE3LjItOTQuMSA0NC41LTIxLjMgOTQtMzIuNiAxNDMuNC0zMi42IDQ5LjMgMCA5NyAxMC44IDE0MS44IDMyIDM0LjMgMTYuMyA2NS4zIDM4LjEgOTIgNjQuOCAyNi4xIDI2IDQ3LjUgNTYgNjMuNiA4OS4yIDE2LjIgMzMuMiAyNi42IDY4LjUgMzEgMTA1LjEgNC42IDM3LjUgMi43IDc1LjMtNS42IDExMi4zeiIgcC1pZD0iMzM1MiIgZmlsbD0iI2JmYmZiZiI+PC9wYXRoPjwvc3ZnPg==';
	return $str;
}
function get_AvatarByMail($mail)
{
	$mailLower = strtolower($mail);
	$md5MailLower = md5($mailLower);
	$qqMail = str_replace('@qq.com', '', $mailLower);
	if (strstr($mailLower, "qq.com") && is_numeric($qqMail) && strlen($qqMail) < 11 && strlen($qqMail) > 4) {
		return 'https://q1.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';
	} else {
    	if (!empty(Helper::options()->cat_avatar)){
    	    return Helper::options()->cat_avatar . $md5MailLower . '?&d=mm&s=200';
    	}else{
    	    return 'https://cravatar.cn/avatar/' . $md5MailLower . '?&d=mm&s=200';
    	}
	}
};
function get_user_avatar()
{
    if (Helper::options()->cat_Index_user_avatar){
        echo Helper::options()->cat_Index_user_avatar;
    }else{
        $db  = Typecho_Db::get();
        $row = $db->fetchRow($db
            ->select('mail')
            ->from('table.users')
            ->where('uid = ?', '1')
        );
        $mail = max($row);
        if(!empty($row)){
            echo get_AvatarByMail($mail);    
        }else{
            echo get_AvatarByMail('admin@dorcandy.cn');
        }
    }
}
function get_favicon($url) {
    return Helper::options()->themeUrl . '/api/favicon/get.php?url=' . $url;
}
function get_post_Views($archive) {
    $db = Typecho_Db::get();
    $cid = $archive->cid;
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `'.$db->getPrefix().'contents` ADD `views` INT(10) DEFAULT 0;');
    }
    $exist = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
    if ($archive->is('single')) {
        $cookie = Typecho_Cookie::get('contents_views');
        $cookie = $cookie ? explode(',', $cookie) : array();
        if (!in_array($cid, $cookie)) {
            $db->query($db->update('table.contents')
                ->rows(array('views' => (int)$exist+1))
                ->where('cid = ?', $cid));
            $exist = (int)$exist+1;
            array_push($cookie, $cid);
            $cookie = implode(',', $cookie);
            Typecho_Cookie::set('contents_views', $cookie);
        }
    }
    echo $exist == 0 ? '暂无阅读' : $exist;
}
function get_post_Wordcount($cid){
	$db = Typecho_Db::get ();
	$rs = $db->fetchRow($db->select('table.contents.text')->from('table.contents')->where('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
	return '共计 ' . mb_strlen($rs['text'], 'UTF-8') . ' 字';
}
function get_post_Readtime($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    $text_word = mb_strlen($text,'utf-8');
    echo '约 ' . ceil($text_word / 400) . ' 分钟';
}
function get_post_Thumbnail($widget)
{   
	$rand = rand(1,9);
	$random = resource_cdn() . 'img/default/' . $rand . '.webp';
	$pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
    if ($widget->fields->post_title_img) {
        return $widget->fields->post_title_img;
    }elseif (preg_match_all($pattern, $widget->content, $thumbUrl)) {
		return $thumbUrl[1][0];
	}elseif (Helper::options()->cat_defaultImage) {
	    $defaultImage_arr = array_values(array_filter(explode("\r\n", Helper::options()->cat_defaultImage)));
        if (count($defaultImage_arr) > 0) {
            $key = array_rand($defaultImage_arr, 1);
            return $defaultImage_arr[$key] . '?' .rand(1,99);
        }
	}else{
	    return $random;
    }
}
function get_random_Thumbnail($widget)
{   
	$rand = rand(1,9);
	$random = resource_cdn() . 'img/default/' . $rand . '.webp';
    if (Helper::options()->cat_defaultImage) {
	    $defaultImage_arr = array_values(array_filter(explode("\r\n", Helper::options()->cat_defaultImage)));
        if (count($defaultImage_arr) > 0) {
            $key = array_rand($defaultImage_arr, 1);
            return $defaultImage_arr[$key] . '?' .rand(1,99);
        }
	}else{
	    return $random;
    }
}
function get_album_Thumbnail($item)
{
	$result = [];
	$rand = rand(1,9);
	$random = resource_cdn() . 'img/default/' . $rand . '.webp';
	$pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
	$patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?\))/i';
	$patternMDfoot = '/\[.*?\]: \s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp)[\S]*)/i';
	if (preg_match_all($pattern, $item, $thumbUrl)) {
		foreach ($thumbUrl[1] as $list) $result[] = $list;
	}
	if (preg_match_all($patternMD, $item, $thumbUrl)) {
		foreach ($thumbUrl[1] as $list) {
		    $listx = rtrim($list, ")");
		    $result[] = $listx;
		}
	}
	if (preg_match_all($patternMDfoot, $item, $thumbUrl)) {
		foreach ($thumbUrl[1] as $list) $result[] = $list;
	}
	if (sizeof($result) < 4) {
		$custom_thumbnail = Helper::options()->cat_defaultImage;
		if ($custom_thumbnail) {
			$custom_thumbnail_arr = explode("\r\n", $custom_thumbnail);
			for ($i = 0; $i < 4; $i++) {
				$result[] = $custom_thumbnail_arr[array_rand($custom_thumbnail_arr, 1)] . "?key=" . mt_rand(0, 1000000);
			}
		} else {
			for ($i = 0; $i < 4; $i++) {
				$result[] = $random . '?' .rand(1,99);
			}
		}
	}
	return $result;
}
function getRandomPosts(){    
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select()->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('created <= unix_timestamp(now())', 'post')
        ->where('password is NULL')
        ->limit(1)
        ->order('RAND()')
    );
    if($result){
        $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($result[0]);
        return $val['permalink'];
    }
}
function get_game_appid($appid)
{
    $url = 'https://api.xiaoheihe.cn/game/web/get_game_detail/?_time=' . time() . '&appid=' . $appid;
    $un_json = file_get_contents($url, true);
    $game_arr = json_decode($un_json, true);
    if ($game_arr['status'] == 'ok'){
        return $game_arr;
    }else{
        return 0;
    }
}
function get_Abstract($item, $type = true)
{
	$abstract = "";
	if ($item->password) {
		$abstract = "<span style='color:var(--theme-30);'> - 加密文章，请前往内页查看详情 - </span>";
	} else {
		if ($item->fields->post_abstract) {
			$abstract = $item->fields->post_abstract;
			if (strpos($abstract, '[AI]') === 0) {
				$abstract = substr($abstract, 4);
			}
		} else {
			$abstract = strip_tags($item->excerpt);
			$abstract = preg_replace('/{ }/', ' ', $abstract);
			$abstract = preg_replace('/{x}/', ' ', $abstract);
			$abstract = preg_replace('/{+}/', ' ', $abstract);
			$abstract = preg_replace('/{-}/', ' ', $abstract);
			$abstract = preg_replace('/-o-/', ' ', $abstract);
			$abstract = preg_replace('/-√-/', ' ', $abstract);
			$abstract = preg_replace('/-x-/', ' ', $abstract);
			$abstract = preg_replace('/-+-/', ' ', $abstract);
			$abstract = preg_replace('/---/', ' ', $abstract);
			$abstract = preg_replace('/-i-/', ' ', $abstract);
			$abstract = preg_replace('/-?-/', ' ', $abstract);
			$abstract = preg_replace('/-!-/', ' ', $abstract);
            if (strpos($abstract, '{cat_copy') !== false) {
                $abstract = preg_replace('/{cat_copy text="([\s\S]*?)"}/', '${1}' , $abstract);
            }
            if (strpos($abstract, '{cat_insidepost') !== false) {
                $abstract = preg_replace('/{cat_insidepost id="([\s\S]*?)"}/', '' , $abstract);
            }
            if (strpos($abstract, '{cat_bilipost') !== false) {
                $abstract = preg_replace('/{cat_bilipost id="([\s\S]*?)"}/', '' , $abstract);
            }
            if (strpos($abstract, '{cat_webpost') !== false) {
                $abstract = preg_replace('/{cat_webpost id="([\s\S]*?)"}/', '' , $abstract);
            }
            if (strpos($abstract, '{cat_gamepost') !== false) {
                $abstract = preg_replace('/{cat_gamepost id="([\s\S]*?)"}/', '' , $abstract);
            }
            if (strpos($abstract, '{{') !== false) {
                $abstract = preg_replace('/{{([\s\S]*?)}{([\s\S]*?)}}/', '${1}' , $abstract);
            }
            if (strpos($abstract, '{cat_tips_user') !== false) {
                $abstract = preg_replace('/{cat_tips_user color="([\s\S]*?)"}([\s\S]*?){\/cat_tips_user}/', '' , $abstract);
            }
            if (strpos($abstract, '{cat_usercard') !== false) {
                $abstract = preg_replace('/{cat_usercard title="(.*?)" url="(.*?)" desc="(.*?)" logo="(.*?)"}/', '' , $abstract);
            }
            if (strpos($abstract, '{cat_download') !== false) {
                $abstract = preg_replace('/{cat_download name="([\s\S]*?)" url="([\s\S]*?)" password="([\s\S]*?)"}/', '<span style="color:var(--theme-30);"> - 附件 - </span>' , $abstract);
            }
			if (strpos($abstract, '{cat_hide') !== false) {
				$abstract = preg_replace('/{cat_hide[^}]*}([\s\S]*?){\/cat_hide}/', '<span style="color:var(--theme-30);"> - 隐藏 - </span>', $abstract);
			}
			if (strpos($abstract, '{hide') !== false) {
				$abstract = preg_replace('/{hide[^}]*}([\s\S]*?){\/hide}/', '<span style="color:var(--theme-30);"> - 隐藏 - </span>', $abstract);
			}
			if (strpos($abstract, '{cat_localmusic') !== false) {
				$abstract = preg_replace('/{cat_localmusic name="([\s\S]*?)" artist="([\s\S]*?)" url="([\s\S]*?)" cover="([\s\S]*?)"}/', '<span style="color:var(--theme-30);"> - 音乐 - </span>', $abstract);
			}
			if (strpos($abstract, '{cat_qqmusic') !== false) {
				$abstract = preg_replace('/{cat_qqmusic[^}]*}([\s\S]*?){\/cat_qqmusic}/', '<span style="color:var(--theme-30);"> - 音乐 - </span>', $abstract);
			}
			if (strpos($abstract, '{cat_music') !== false) {
				$abstract = preg_replace('/{cat_music[^}]*}([\s\S]*?){\/cat_music}/', '<span style="color:var(--theme-30);"> - 音乐 - </span>', $abstract);
			}
			if (strpos($abstract, '{cat_mlist') !== false) {
				$abstract = preg_replace('/{cat_mlist[^}]*}([\s\S]*?){\/cat_mlist}/', '<span style="color:var(--theme-30);"> - 歌单 - </span>', $abstract);
			}
			if (strpos($abstract, '{cat_qqlist') !== false) {
				$abstract = preg_replace('/{cat_qqlist[^}]*}([\s\S]*?){\/cat_qqlist}/', '<span style="color:var(--theme-30);"> - 歌单 - </span>', $abstract);
			}
			if (strpos($abstract, '{cat_qqalbum') !== false) {
				$abstract = preg_replace('/{cat_qqalbum[^}]*}([\s\S]*?){\/cat_qqalbum}/', '<span style="color:var(--theme-30);"> - 歌单 - </span>', $abstract);
			}
			if (strpos($abstract, '{cat_bili') !== false) {
				$abstract = preg_replace('/{cat_bili[^}]*}([\s\S]*?){\/cat_bili}/', '<span style="color:var(--theme-30);"> - 视频 - </span>', $abstract);
			}
            if (strpos($abstract, '{cat_xigua') !== false) {
                $abstract = preg_replace('/{cat_xigua[^}]*}([\s\S]*?){\/cat_xigua}/', '<span style="color:var(--theme-30);"> - 视频 - </span>', $abstract);
            }
            if (strpos($abstract, '{cat_youku') !== false) {
                $abstract = preg_replace('/{cat_youku[^}]*}([\s\S]*?){\/cat_youku}/', '<span style="color:var(--theme-30);"> - 视频 - </span>', $abstract);
            }
            if (strpos($abstract, '{cat_txshipin') !== false) {
                $abstract = preg_replace('/{cat_txshipin[^}]*}([\s\S]*?){\/cat_txshipin}/', '<span style="color:var(--theme-30);"> - 视频 - </span>', $abstract);
            }
			if (strpos($abstract, '{cat_video') !== false) {
				$abstract = preg_replace('/{cat_video url="([\s\S]*?)"}/', '<span style="color:var(--theme-30);"> - 视频 - </span>', $abstract);
			}
			if (strpos($abstract, '{cat_album_') !== false) {
				$abstract = preg_replace('/{cat_album_[^}]*}([\s\S]*?){\/cat_album_[^}]*}/', '<span style="color:var(--theme-30);"> - 图集 - </span>', $abstract);
			}
			if (strpos($abstract, '{cat_tips') !== false) { 
			    $abstract = preg_replace('/{cat_tips_success[^}]*}([\s\S]*?){\/cat_tips_success}/', '', $abstract);
                $abstract = preg_replace('/{cat_tips_info[^}]*}([\s\S]*?){\/cat_tips_info}/', '', $abstract);
                $abstract = preg_replace('/{cat_tips_warning[^}]*}([\s\S]*?){\/cat_tips_warning}/', '', $abstract);
                $abstract = preg_replace('/{cat_tips_error[^}]*}([\s\S]*?){\/cat_tips_error}/', '', $abstract);
			}
			$abstract = preg_replace('/\|\|(.*?)\|\|(.*?)\|\|(.*?)\|\|/', ' ', $abstract);
		}
	}
	if ($abstract === '') $abstract = "<span style='color:var(--theme-30);'> - 暂无简介 - </span>";
	if ($type) echo $abstract;
	else return $abstract;
}
function cat_get_bing()
{
    $str = file_get_contents('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1');
    $str = json_decode($str,true);
    $imgurl = 'https://cn.bing.com' . $str['images'][0]['url']; 
    return $imgurl;
}
function get_link_title($url)
{
    error_reporting(E_ALL || E_STRICT);
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return '网站URL填写错误，请联系管理员查看';
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    $encoding = mb_detect_encoding($response, array("ASCII","GB2312","CP936","GBK","BIG5","UTF-8"));
    if ('UTF-8' !== ($encoding)) {
        $response = iconv($encoding, 'UTF-8', $response);
    } else {
        $response = $response;
    }
    $title = '';
    $description = '';
    $author = '';
    $keywords = '';
    if (preg_match('/<title>(.*)<\/title>/i', $response, $match)) {
        $title = $match[1];
    }
    if (preg_match('/<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']\s*\/?>/i', $response, $match)) {
        $description = $match[1];
    }
    if (preg_match('/<meta\s+name=["\']author["\']\s+content=["\'](.*?)["\']\s*\/?>/i', $response, $match)) {
        $author = $match[1];
    }
    if (preg_match('/<meta\s+name=["\']keywords["\']\s+content=["\'](.*?)["\']\s*\/?>/i', $response, $match)) {
        $keywords = $match[1];
    }
    if (empty($title)) {
        $title = parse_url($url)['host'];
    }
    if (empty($description)) {
        $description = '暂无简介';
    }
    if (empty($author)) {
        $author = '佚名';
    }
    if (empty($keywords)) {
        $keywords = '无关键词';
    }
    return array(
        'title' => $title,
        'description' => $description,
        'author' => $author,
        'keywords' => $keywords
    );
}
function get_baidu($url)
{
    error_reporting(E_ALL || E_STRICT);
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CONNECTTIMEOUT => 3,
        CURLOPT_TIMEOUT => 3,
        CURLOPT_RETURNTRANSFER => true,
    ));
    return curl_exec($ch);
    curl_close($ch);
}
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent,status')->from('table.comments')
        ->where('coid = ?', $coid));
    $mail = "";
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author,status,mail')->from('table.comments')
            ->where('coid = ?', $parent));
        $author = $arow['author'];
        $mail = $arow['mail'];
        if($author && $arow['status'] == "approved"){
            echo '<a style="margin-left:5px;font-size:12px;display:inline;" href="#comment-' . $parent . '"><span style="color: #c7c7c7;"><i class="ri-at-line"></i></span>' . $author . '</a>';
        }
    }
}
function cat_have_emoji($str)
{
    $length = mb_strlen($str);
    $array = [];
    for ($i=0; $i<$length; $i++) {
        $array[] = mb_substr($str, $i, 1, 'utf-8');
        if( strlen($array[$i]) >= 4 ){
            return true;
        }
    }
    return false;
}
function cat_comment_levelcard($i){
    $db=Typecho_Db::get();
    if (Helper::options()->cat_comment_catlevelcardname === "off"){
        $mail=$db->fetchAll($db->select(array('COUNT(cid)'=>'level'))->from('table.comments')->where('mail = ?', $i)->where('authorId = ?','0'));
    }else {
        $mail=$db->fetchAll($db->select(array('COUNT(cid)'=>'level'))->from('table.comments')->where('mail = ?', $i));
    }
    $friendcards = [];
    $friendcards_text = Helper::options()->cat_comment_levelcardname;
    if ($friendcards_text) {
        $lv0 = explode("||", $friendcards_text)[0];
        $lv1 = explode("||", $friendcards_text)[1];
        $lv2 = explode("||", $friendcards_text)[2];
        $lv3 = explode("||", $friendcards_text)[3];
        $lv4 = explode("||", $friendcards_text)[4];
        $lv5 = explode("||", $friendcards_text)[5];
        $lv6 = explode("||", $friendcards_text)[6];
        $lv7 = explode("||", $friendcards_text)[7];
        $lv8 = explode("||", $friendcards_text)[8];
        $lv9 = explode("||", $friendcards_text)[9];
        $lv10 = explode("||", $friendcards_text)[10];
    }else{
        return false;
    };
    foreach ($mail as $sl){
            $level = $sl['level'];}
    if($level<1){
        echo '';
    }elseif($level<3){
        echo '<span class="animeinfo lv_0" title="LV.0">' . $lv0 . '</span>';
    }elseif ($level<10 && $level>2) {
        echo '<span class="animeinfo lv_1" title="LV.1">' . $lv1 . '</span>';
    }elseif ($level<20 && $level>=10) {
        echo '<span class="animeinfo lv_2" title="LV.2">' . $lv2 . '</span>';
    }elseif ($level<40 && $level>=20) {
        echo '<span class="animeinfo lv_3" title="LV.3">' . $lv3 . '</span>';
    }elseif ($level<80 && $level>=40) {
        echo '<span class="animeinfo lv_4" title="LV.4">' . $lv4 . '</span>';
    }elseif ($level<120 && $level>=80) {
        echo '<span class="animeinfo lv_5" title="LV.5">' . $lv5 . '</span>';
    }elseif ($level<160 && $level>=120) {
        echo '<span class="animeinfo lv_6" title="LV.6">' . $lv6 . '</span>';
    }elseif ($level<200 && $level>=160) {
        echo '<span class="animeinfo lv_7" title="LV.7">' . $lv7 . '</span>';
    }elseif ($level<250 && $level>=200) {
        echo '<span class="animeinfo lv_8" title="LV.8">' . $lv8 . '</span>';
    }elseif ($level<300 && $level>=250) {
        echo '<span class="animeinfo lv_9" title="LV.9">' . $lv9 . '</span>';
    }elseif ($level>=300) {
        echo '<span class="animeinfo lv_10" title="贵宾">' . $lv10 . '</span>';
    }
}
function cat_comment_friendcard($widget, $email = NULL)      
{      
    if (empty($email)) return;
    $friendsmaillist = array();
    $friends_text = Helper::options()->cat_links_rss;
    if ($friends_text) {
        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
        if (count($friends_arr) > 0) {
            for ($i = 0; $i < count($friends_arr); $i++) {
                $x_mail = isset(explode("||", $friends_arr[$i])[1])?explode("||", $friends_arr[$i])[1]:'';
                $x_mail = str_replace(' ', '', $x_mail);
                $friendsmaillist[] = $x_mail;
            };
        }
    }
    $friends_text = Helper::options()->cat_links_atom;
    if ($friends_text) {
        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
        if (count($friends_arr) > 0) {
            for ($i = 0; $i < count($friends_arr); $i++) {
                $x_mail = isset(explode("||", $friends_arr[$i])[1])?explode("||", $friends_arr[$i])[1]:'';
                $x_mail = str_replace(' ', '', $x_mail);
                $friendsmaillist[] = $x_mail;
            };
        }
    }
    $friends_text = Helper::options()->cat_links_auto;
    if ($friends_text) {
        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
        if (count($friends_arr) > 0) {
            for ($i = 0; $i < count($friends_arr); $i++) {
                $x_mail = isset(explode("||", $friends_arr[$i])[1])?explode("||", $friends_arr[$i])[1]:'';
                $x_mail = str_replace(' ', '', $x_mail);
                $friendsmaillist[] = $x_mail;
            };
        }
    }
    $friends_text = Helper::options()->cat_links_nofeed;
    if ($friends_text) {
        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
        if (count($friends_arr) > 0) {
            for ($i = 0; $i < count($friends_arr); $i++) {
                $x_mail = isset(explode("||", $friends_arr[$i])[4])?explode("||", $friends_arr[$i])[4]:'';
                $x_mail = str_replace(' ', '', $x_mail);
                $friendsmaillist[] = $x_mail;
            };
        }
    }if ($widget->authorId == $widget->ownerId) {      
        echo '<p class="animeinfo lv_cat" title="博主">博主</p>';      
    } elseif (in_array($email, $friendsmaillist)) {      
        echo '<p class="animeinfo lv_friend" title="好友">好友</p>';      
    } else {       
        echo '<p class="animeinfo lv_guest" title="访客">访客</p>';      
    }
}
function cat_comment_friendcard_nocat($email = NULL)      
{      
    if (empty($email)) return;
    $friendsmaillist = array();
    $friends_text = Helper::options()->cat_links_rss;
    if ($friends_text) {
        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
        if (count($friends_arr) > 0) {
            for ($i = 0; $i < count($friends_arr); $i++) {
                $x_mail = isset(explode("||", $friends_arr[$i])[1])?explode("||", $friends_arr[$i])[1]:'';
                $x_mail = str_replace(' ', '', $x_mail);
                $friendsmaillist[] = $x_mail;
            };
        }
    }
    $friends_text = Helper::options()->cat_links_atom;
    if ($friends_text) {
        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
        if (count($friends_arr) > 0) {
            for ($i = 0; $i < count($friends_arr); $i++) {
                $x_mail = isset(explode("||", $friends_arr[$i])[1])?explode("||", $friends_arr[$i])[1]:'';
                $x_mail = str_replace(' ', '', $x_mail);
                $friendsmaillist[] = $x_mail;
            };
        }
    }
    $friends_text = Helper::options()->cat_links_nofeed;
    if ($friends_text) {
        $friends_arr = array_values(array_filter(explode("\r\n", $friends_text)));
        if (count($friends_arr) > 0) {
            for ($i = 0; $i < count($friends_arr); $i++) {
                $x_mail = isset(explode("||", $friends_arr[$i])[4])?explode("||", $friends_arr[$i])[1]:'';
                $x_mail = str_replace(' ', '', $x_mail);
                $friendsmaillist[] = $x_mail;
            };
        }
    }if (in_array($email, $friendsmaillist)) {      
        echo '<p class="animeinfo lv_friend" title="好友">好友</p>';      
    } else {       
        echo '<p class="animeinfo lv_guest" title="访客">访客</p>';      
    }
}
function cat_allviewnum($id,$isnum){
    $db = Typecho_Db::get();
    $postnum=$db->fetchRow($db->select(array('Sum(views)'=>'allviewnum'))->from ('table.contents')->where ('table.contents.authorId=?',$id)->where('table.contents.type=?', 'post'));
    $postnum = $postnum['allviewnum'];
    if ($postnum>=10000 && $isnum==1) {
        $num = substr($postnum,0,strlen($postnum)-4);
        return ' ' . $num . 'W+°c';
    }
    else{
        return ' '.$postnum.' °c';
    }
}
function cat_UV($isnum){
    $db = Typecho_Db::get();
    $row=$db->fetchRow($db->select(array('Sum(views)'=>'UVnum'))->from ('table.contents'));
    $viewnum = $row['UVnum'];
    if ($viewnum>=10000 && $isnum==1) {
        $num = substr($viewnum,0,strlen($viewnum)-4);
        return ' ' . $num . 'W+';
    }
    else{
        return number_format($viewnum);
    }
}
function timer_start() {
    global $timestart;
    $mtime     = explode( ' ', microtime() );
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
timer_start();
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $mtime     = explode( ' ', microtime() );
    $timeend   = $mtime[1] + $mtime[0];
    $timetotal = number_format( $timeend - $timestart, $precision );
    $r         = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
    if ( $display ) {
        echo $r;
    }
    return $r;
}
function online_users() {
    $filename='online.txt';
    $cookiename='Nanlon_OnLineCount';
    $onlinetime=30;
    $online=file($filename); 
    $nowtime=$_SERVER['REQUEST_TIME']; 
    $nowonline=array(); 
    foreach($online as $line){ 
        $row=explode('|',$line); 
        $sesstime=trim($row[1]); 
        if(($nowtime - $sesstime)<=$onlinetime){
            $nowonline[$row[0]]=$sesstime;
        } 
    } 
    if(isset($_COOKIE[$cookiename])){
        $uid=$_COOKIE[$cookiename]; 
    }else{
        $vid=0;
        do{
            $vid++; 
            $uid='U'.$vid; 
        }while(array_key_exists($uid,$nowonline)); 
        setcookie($cookiename,$uid); 
    } 
    $nowonline[$uid]=$nowtime;
    $total_online=count($nowonline); 
    if($fp=@fopen($filename,'w')){ 
        if(flock($fp,LOCK_EX)){ 
            rewind($fp); 
            foreach($nowonline as $fuid=>$ftime){ 
                $fline=$fuid.'|'.$ftime."\n"; 
                @fputs($fp,$fline); 
            } 
            flock($fp,LOCK_UN); 
            fclose($fp); 
        } 
    } 
    return "$total_online"; 
}
function get_comment_num($id){
    $commentnum = Typecho_Db::get()->fetchRow(Typecho_Db::get()
		->select(array('COUNT(mail)'=>'commentnum'))
		->from  ('table.comments')
		->where ('table.comments.author=?',$id)
		->where ('table.comments.type=?', 'comment'));
    $commentnum = $commentnum['commentnum'];
    return $commentnum;
}
function get_last_login($user){
    $user   = '1';
    $now = time();
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $row = $db->fetchRow($db
        ->select('activated')
        ->from('table.users')
        ->where('uid = ?', $user)
    );
    return Typecho_I18n::dateWord($row['activated'], $now);
}
function get_user_last_login($mail,$num = true){
    $db  = Typecho_Db::get();
    $row = $db->fetchRow($db
        ->select('created')
        ->from('table.comments')
        ->where('mail = ?', $mail)
        ->order('created', Typecho_Db::SORT_DESC)
    );
    $from = $row['created'];
    $now = time();
    $between = $now - $from;
    if($num){
        if ($between > 0 && $between < 604800) {
            return ('#2bde3f');
        }elseif ($between >= 604800 && $between < 2592000) {
            return ('#ffd86a');
        }elseif ($between >= 2592000){
            return ('#ff6a6a');
        }
    }else{
        if ($between > 0 && $between < 86400) {
            return '一天之内';
        }elseif ($between >= 86400 && $between < 604800) {
            return '一周之内';
        }elseif ($between >= 604800 && $between < 2592000) {
            return '一月之内';
        }elseif ($between >= 2592000 && $between < 7776000) {
            return '三月之内';
        }elseif ($between >= 7776000){
            return '很久没有';
        }
    }
}
function get_user_first_login($mail){
    $db  = Typecho_Db::get();
    $row = $db->fetchRow($db
        ->select('created')
        ->from('table.comments')
        ->where('mail = ?', $mail)
    );
    $from = $row == null ? '暂无留言' : date('Y-m-d h:i:s', max($row));
    return $from;
}
function get_stars($num){
    if($num > 10){
        $num = 10;
    }elseif($num < 0){
        $num = 0;
    }
    if(!strstr($num,'.')){
        $a = $num;
        $b = 0;
        $c = 10 - $a;
    }else{
        $a = intval($num);
        $b = 1;
        $c = 9 - $a;
    }if($num > 7){
        $color = 'green';
    }elseif($num < 3){
        $color = '#a70000';
    }else{
        $color = '#ecba00';
    }
    echo str_repeat('<i style="color:' . $color . '" class="ri-star-fill"></i>',$a);
    echo str_repeat('<i style="color:' . $color . '" class="ri-star-half-line"></i>',$b);
    echo str_repeat('<i style="color:' . $color . '" class="ri-star-line"></i>',$c);
}
function get_stars_num($num){
    if($num > 10){
        $num = 10;
    }elseif($num < 0){
        $num = 0;
    }
    if(!strstr($num,'.')){
        echo $num . '.0';
    }else{
        echo $num;
    }
}
function get_QqName($qq)
{
    $url =  file_get_contents('https://r.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins='. $qq);
    $pattern = '/portraitCallBack\((.*)\)/is';
    preg_match($pattern,$url,$result);
    $result=$result[1];
    $result = iconv('gbk', 'utf-8', $result);
    $result = json_decode($result,true);
    $res = $result["$qq"][6];
    return $res;
}
date_default_timezone_set('Asia/Shanghai');
function getBuildTime($create_time,$mode,$day) {
    $site_create_time = strtotime($create_time);
    if($mode == true){
        $time = $site_create_time - time();
    }elseif($mode == false){
        $time = time() - $site_create_time;
    }
    $printtime = '';
    if($day == true){
        if (is_numeric($time)) {
            $value = array(
                "days" => 0,
            );
            if ($time >= 86400) {
                $value["days"] = floor($time / 86400);
                $time = ($time % 86400);
            }
            $printtime .= $value['days'] . ' 天';
        } else {
            $printtime .= '<span style="color:#999999;">时间格式错误</span>';
        }
    }elseif($day == false){
        if (is_numeric($time)) {
            $value = array(
                "years" => 0, "days" => 0, "hours" => 0,
                "minutes" => 0, "seconds" => 0,
            );
            if ($time >= 31556926) {
                $value["years"] = floor($time / 31556926);
                $time = ($time % 31556926);
            }
            if ($time >= 86400) {
                $value["days"] = floor($time / 86400);
                $time = ($time % 86400);
            }
            if ($time >= 3600) {
                $value["hours"] = floor($time / 3600);
                $time = ($time % 3600);
            }
            if ($time >= 60) {
                $value["minutes"] = floor($time / 60);
                $time = ($time % 60);
            }
            $value["seconds"] = floor($time);
            if ($value['years'] != 0) {
                $printtime .= $value['years'] . ' 年 ';
            }
            $printtime .= $value['days'] . ' 天 ' . $value['hours'] . ' 小时 ' . $value['minutes'] . ' 分';
        } else {
            $printtime .= '<span style="color:#999999;">时间格式错误</span>';
        }
    }
    return $printtime;
}
function get_between($input, $start, $end){
    $substr = substr($input, strlen($start) + strpos($input, $start), (strlen($input) - strpos($input, $end)) * (-1));
    return $substr;
}
function get_cat_postinfo($cid){
    $card = '';
    if($cid[1] != '站内文章的cid'){
        $cat_post = Typecho_Widget::widget('Widget_Archive@'.$cid[1],'pageSize=1&type=post', 'cid='.$cid[1]);
        $card = '<div class="cat_article_show flex_first flex_second">';
        $card .= '<div class="friends_block flex_block_add cat_free_a" style="background:unset;padding:0;box-shadow: unset;height:auto!important;border: unset;width: 100%;">
                        <div class="box_out" style="width:auto;height:auto;">
                            <a href="'.$cat_post->permalink .'" style="display: block;">
                                <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-file-list-3-line"></i></div>
                                <div class="cat_indexcard_time cat_indexcard_time_2">'.date('Y年n月j日',$cat_post->created) .'</div>
                                <div class="cat_indexcard_time cat_indexcard_time_4" title="CID">' . $cid[1] . '</div>
                                <img style="margin:0" class="lazyload box_img" src="'.get_Lazyload().'" data-src="'. get_post_Thumbnail($cat_post) .'">
                            </a>
                        </div>
    					<a class="friends_post_title" href="'. $cat_post->permalink.'" title="'. $cat_post->title .'">'.$cat_post->title.'</a>
    					<div class="friends_post_post">'.get_Abstract($cat_post,false).'</div>
                    </div>';
        $card .='</div>';
    }
    return $card;
}
function get_web_postinfo($url){
    $card = '';
    if($url[1] != '输入url网址'){
        $tags = @get_meta_tags($url[1]);
        $img = 'https://s0.wp.com/mshots/v1/'.$url[1].'?w=285&amp;h=160';
        $title = get_link_title($url[1])['title'];
        $card = '<div class="cat_article_show flex_first flex_second">';
        $card .= '<div class="friends_block flex_block_add cat_free_a" style="background:unset;padding:0;box-shadow: unset;height:auto!important;border: unset;width: 100%;">
                        <div class="box_out" style="width:auto;height:auto;">
                            <a target="_blank" href="'. $url[1] .'" style="display: block;">
                                <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-links-line"></i></div>
                                <div class="cat_indexcard_time cat_indexcard_time_2">'. get_link_title($url[1])["author"] .'</div>
                                <div class="cat_indexcard_time cat_indexcard_time_4 cat_indexcard_time_1line" title="关键词">'. get_link_title($url[1])["keywords"] .'</div>
                                <img style="margin:0" referrerpolicy="no-referrer" class="lazyload box_img" src="'.get_Lazyload().'" data-src="'. $img .'">
                            </a>
                        </div>
    					<a class="friends_post_title" target="_blank" href="'. $url[1] .'" title="'. $title .'">'. $title .'</a>
    					<div class="friends_post_post">' . get_link_title($url[1])["description"] .'</div>
                    </div>';
        $card .='</div>';
    }
    return $card;
}
function get_bili_postinfo($bv){
    $card = '';
    if($bv[1] != 'B站视频的bv号'){
        $json_bili = file_get_contents('https://api.bilibili.com/x/web-interface/view?bvid=' . $bv[1]);
        $arr_bili = json_decode($json_bili,true);
        $card = '<div class="cat_article_show flex_first flex_second">';
        $card .= '<div class="friends_block flex_block_add cat_free_a" style="background:unset;padding:0;box-shadow: unset;height:auto!important;border: unset;width: 100%;">
                        <div class="box_out" style="width:auto;height:auto;">
                            <a target="_blank" href="https://www.bilibili.com/video/'. $arr_bili['data']['bvid'].'" style="display: block;">
                                <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-bilibili-line"></i></div>
                                <div class="cat_indexcard_time cat_indexcard_time_2">'. $arr_bili['data']['tname'] .'</div>
                                <div class="cat_indexcard_time cat_indexcard_time_4" title="BVID">'. $arr_bili['data']['bvid'] .'</div>
                                <img style="margin:0" referrerpolicy="no-referrer" class="lazyload box_img" src="'.get_Lazyload().'" data-src="'. $arr_bili['data']['pic'] .'">
                            </a>
                        </div>
    					<a class="friends_post_title" target="_blank" href="https://www.bilibili.com/video/'. $arr_bili['data']['bvid'].'" title="'. $arr_bili['data']['title'].'">'. $arr_bili['data']['title'].'</a>
    					<div class="friends_post_post">' . ($arr_bili['data']['desc'] == '' ? '<span style="font-style: italic;color: var(--colorE);">- 暂无简介 -</span>' : $arr_bili['data']['desc']) .'</div>
                    </div>';
        $card .='</div>';
    }
    return $card;
}
function get_game_postinfo($appid){
    $card = '';
    if($appid[1] != '游戏的appid'){
        $json_game = file_get_contents('https://api.xiaoheihe.cn/game/web/get_game_detail/?_time=' . time() . '&appid=' . $appid[1]);
        $arr_game = json_decode($json_game,true);
        $card = '<div class="cat_article_show flex_first flex_second">';
        $card .= '<div class="friends_block flex_block_add cat_free_a" style="background:unset;padding:0;box-shadow: unset;height:auto!important;border: unset;width: 100%;">
                        <div class="box_out" style="width:auto;height:auto;">
                            <div>
                                <div class="cat_indexcard_time cat_indexcard_time_1"><i class="ri-gamepad-line"></i></div>
                                <div class="cat_indexcard_time cat_indexcard_time_2 cat_indexcard_time_1line">'. $arr_game['result']['topic_detail']['name'] .'</div>
                                <div class="cat_indexcard_time cat_indexcard_time_4" title="APPID">'. $appid[1] .'</div>
                                <img style="margin:0" class="lazyload box_img" src="'.get_Lazyload().'" data-src="'. $arr_game['result']['topic_detail']['bg_pic'] .'">
                            </div>
                        </div>
    					<div class="friends_post_title" title="'. $arr_game['result']['name'].'">'. $arr_game['result']['name'].'</div>
    					<div class="friends_post_post">' . ($arr_game['result']['about_the_game'] == '' ? '<span style="font-style: italic;color: var(--colorE);">- 暂无简介 -</span>' : $arr_game['result']['about_the_game']) .'</div>
                    </div>';
        $card .='</div>';
    }
    return $card;
}
function get_cat_usercard($item){
    if($item[4] == '图片标识' || $item[4] == ''){
        $card = '<span class="cat_article_show cat_free_a navigation_block"><span class="box_out"><span class="box_avatar"><img style="margin: -0.75rem 0.75rem;width:2.5rem;height:2.5rem;" src="' . get_favicon($item[2]) . '"><span class="box_avatar_right"><a title="' . $item[1] . '" target="_blank" href="' . $item[2] . '" data-pjax-state="">' . $item[1] . '</a></span></span></span><span class="friends_link_desc" style="-webkit-line-clamp: 2;">' . $item[3] . '</span></span>';
    }else{
        $card = '<span class="cat_article_show cat_free_a navigation_block"><span class="box_out"><span class="box_avatar"><img style="margin: -0.75rem 0.75rem;width:2.5rem;height:2.5rem;" src="' . $item[4] . '"><span class="box_avatar_right"><a title="' . $item[1] . '" target="_blank" href="' . $item[2] . '" data-pjax-state="">' . $item[1] . '</a></span></span></span><span class="friends_link_desc" style="-webkit-line-clamp: 2;">' . $item[3] . '</span></span>';
    }
    return $card;
}
function cat_article_changetext($post, $login){
    $content = $post->content;
    $content = preg_replace('/img src/', 'img src="' . get_Lazyload() . '" class="postimg isfancy lazyload" data-src', $content);
    if (strpos($content, '{x}') !== false || strpos($content, '{+}') !== false || strpos($content, '{-}') !== false || strpos($content, '{ }') !== false) {
        $content = strtr($content, array(
            "{x}" => '<i class="ri-checkbox-line cat_post_checkbox"></i>',
            "{+}" => '<i class="ri-add-box-line cat_post_checkbox"></i>',
            "{-}" => '<i class="ri-checkbox-indeterminate-line cat_post_checkbox"></i>',
            "{ }" => '<i class="ri-checkbox-blank-line cat_post_checkbox"></i>'
        ));
    }
    if (strpos($content, '-o- ') !== false || strpos($content, '-√- ') !== false || strpos($content, '-x- ') !== false || strpos($content, '-+- ') !== false || strpos($content, '--- ') !== false || strpos($content, '-i- ') !== false || strpos($content, '-?- ') !== false || strpos($content, '-!- ') !== false) {
        $content = strtr($content, array(
            "-o- " => '<span class="post_timeline timeline_0"></span>',
            "-√- " => '<span class="post_timeline timeline_1"></span>',
            "-x- " => '<span class="post_timeline timeline_2"></span>',
            "-+- " => '<span class="post_timeline timeline_3"></span>',
            "--- " => '<span class="post_timeline timeline_4"></span>',
            "-i- " => '<span class="post_timeline timeline_5"></span>',
            "-?- " => '<span class="post_timeline timeline_6"></span>',
            "-!- " => '<span class="post_timeline timeline_7"></span>'
        ));
        $content = preg_replace('/<span class="post_timeline ([\s\S]*?)"><\/span>([\s\S]*?)</', '<span class="post_timeline ${1}"><span class="post_timeline_word">${2}</span></span><', $content);
    }
    if (strpos($content, '{cat_album_') !== false) {
        $content = preg_replace('/{cat_album_grid}([\s\S]*?){\/cat_album_grid}/', '<div class="cat_post_album_out_cube cat_post_tuji">${1}</div>' , $content);
        $content = preg_replace('/{cat_album_column}([\s\S]*?){\/cat_album_column}/', '<div class="cat_post_album_out_column cat_post_tuji">${1}</div>' , $content);
    }
    if (strpos($content, '{cat_copy') !== false) {
        $content = preg_replace('/{cat_copy text="([\s\S]*?)"}/', '<span class="cat_copy" data-clipboard-action="copy" data-clipboard-text="${1}">${1}</span>' , $content);
    }
    if (strpos($content, '{cat_insidepost') !== false) {
        $content = preg_replace_callback('/{cat_insidepost id="([\s\S]*?)"}/', 'get_cat_postinfo' , $content);
    }
    if (strpos($content, '{cat_bilipost') !== false) {
        $content = preg_replace_callback('/{cat_bilipost id="([\s\S]*?)"}/', 'get_bili_postinfo' , $content);
    }
    if (strpos($content, '{cat_webpost') !== false) {
        $content = preg_replace_callback('/{cat_webpost id="([\s\S]*?)"}/', 'get_web_postinfo' , $content);
    }
    if (strpos($content, '{cat_gamepost') !== false) {
        $content = preg_replace_callback('/{cat_gamepost id="([\s\S]*?)"}/', 'get_game_postinfo' , $content);
    }
    if (strpos($content, '{{') !== false) {
        $content = preg_replace('/{{([\s\S]*?)}{([\s\S]*?)}}/', '<span class="e" title="${2}">${1}</span>' , $content);
    }
    if (strpos($content, '{cat_usercard') !== false) {
        $content = preg_replace_callback('/{cat_usercard title="(.*?)" url="(.*?)" desc="(.*?)" logo="(.*?)"}/', 'get_cat_usercard' , $content);
    }
    if (strpos($content, '{cat_tips_user') !== false) {
        $content = preg_replace('/{cat_tips_user color="([\s\S]*?)"}([\s\S]*?){\/cat_tips_user}/', '<div class="cat_tips" style="background: ${1};background: -webkit-gradient(linear,left top,right top,from(${1}),to(${1}cf));background: -webkit-linear-gradient(left,${1},${1}cf);background: linear-gradient(90deg,${1},${1}cf);text-shadow: 0 -1px ${1};">${2}</div>' , $content);
    }
    if (strpos($content, '{cat_download') !== false) {
        $content = preg_replace('/{cat_download name="([\s\S]*?)" url="([\s\S]*?)" password="([\s\S]*?)"}/', '<div class="cat_article_show cat_free_a"><span style="color:var(--theme);"><i class="ri-attachment-2"></i>附件：</span>${1}&nbsp;&nbsp;<span title="授权码" style="color: var(--colorD);font-style: italic;">${3}</span><span style="position: absolute;right: 1rem;font-size: 1.5rem;"><a href="${2}" target="_blank"><i class="ri-download-cloud-2-line"></i></a></span></div>' , $content);
    }
    if (strpos($content, '{cat_video') !== false) {
        $player = Helper::options()->cat_user_player ? Helper::options()->cat_user_player : Helper::options()->themeUrl . '/api/DPlayer.php?url=';
        $content = preg_replace('/{cat_video url="([\s\S]*?)"}/','<cat_article_bili><iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=100% height=100% src="' . $player . '${1}"></iframe></cat_article_bili>',$content);
    }
    if (strpos($content, '{cat_localmusic') !== false) {
        $content = preg_replace('/{cat_localmusic name="([\s\S]*?)" artist="([\s\S]*?)" url="([\s\S]*?)" cover="([\s\S]*?)"}/', '<meting-js name="${1}" artist="${2}" url="${3}" cover="${4}"></meting-js>', $content);
    }
    if (strpos($content, '{cat_qqmusic') !== false) {
        $content = preg_replace('/{cat_qqmusic[^}]*}([\s\S]*?){\/cat_qqmusic}/', '<meting-js auto="https://y.qq.com/n/yqq/song/${1}.html"></meting-js>', $content);
    }
    if (strpos($content, '{cat_music') !== false) {
        $content = preg_replace('/{cat_music[^}]*}([\s\S]*?){\/cat_music}/', '<meting-js server="netease" type="song" id="${1}"></meting-js>', $content);
    }
    if (strpos($content, '{cat_mlist') !== false) {
        $content = preg_replace('/{cat_mlist[^}]*}([\s\S]*?){\/cat_mlist}/', '<meting-js server="netease" type="playlist" id="${1}"></meting-js>', $content);
    }
    if (strpos($content, '{cat_qqlist') !== false) {
        $content = preg_replace('/{cat_qqlist[^}]*}([\s\S]*?){\/cat_qqlist}/', '<meting-js auto="https://y.qq.com/n/yqq/playlist/${1}.html"></meting-js>', $content);
    }
    if (strpos($content, '{cat_qqalbum') !== false) {
        $content = preg_replace('/{cat_qqalbum[^}]*}([\s\S]*?){\/cat_qqalbum}/', '<meting-js auto="https://y.qq.com/n/yqq/album/${1}.html"></meting-js>', $content);
    }
    if (strpos($content, '<meting-js') !== false) {
        $content = preg_replace('/<p><meting-js([\s\S]*?)<\/meting-js><\/p>/', '<meting-js${1}</meting-js>', $content);
    }
    if (strpos($content, '{cat_bili') !== false) {
        if(Helper::options()->cat_bili_choose == 'on'){
            $content = preg_replace('/{cat_bili p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/cat_bili}/', '<cat_article_bili><iframe src="' . Helper::options()->themeUrl . '/api/bilibili/?bv=${3}&p=${1}&q=${2}&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $content);
        }elseif(Helper::options()->cat_bili_choose == 'office'){
            $content = preg_replace('/{cat_bili p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/cat_bili}/', '<cat_article_bili><iframe src="https://api.injahow.cn/bparse/?bv=${3}&p=${1}&q=${2}&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $content);
        }elseif(Helper::options()->cat_bili_choose == 'html5'){
            $content = preg_replace('/{cat_bili p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/cat_bili}/', '<cat_article_bili><iframe src="https://www.bilibili.com/blackboard/html5mobileplayer.html?bvid=${3}&amp;page=${1}&amp;as_wide=1&amp;danmaku=0&amp;hasMuteButton=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $content);
        }else{
            $content = preg_replace('/{cat_bili p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/cat_bili}/', '<cat_article_bili><iframe src="//player.bilibili.com/player.html?&bvid=${3}&&page=${1}" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $content);
        }
    }
    if (strpos($content, '{cat_xigua') !== false) {
        $content = preg_replace('/{cat_xigua p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/cat_xigua}/', '<cat_article_bili><iframe frameborder="0" src="https://www.ixigua.com/iframe/${3}?autoplay=0" referrerpolicy="unsafe-url" allowfullscreen></iframe></cat_article_bili>', $content);
    }
    if (strpos($content, '{cat_youku') !== false) {
        $content = preg_replace('/{cat_youku p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/cat_youku}/', '<cat_article_bili><iframe frameborder="0" src="https://player.youku.com/embed/${3}==" allowfullscreen></iframe></cat_article_bili>', $content);
    }
    if (strpos($content, '{cat_txshipin') !== false) {
        $content = preg_replace('/{cat_txshipin p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/cat_txshipin}/', '<cat_article_bili><iframe frameborder="0" src="https://v.qq.com/txp/iframe/player.html?vid=${3}" allowFullScreen="true"></iframe></cat_article_bili>', $content);
    }
    if (strpos($content, '<cat_article_bili') !== false) {
        $content = preg_replace('/<p><cat_article_bili([\s\S]*?)<\/cat_article_bili><\/p>/', '<cat_article_bili${1}</cat_article_bili>', $content);
    }
    if (strpos($content, '{cat_tips') !== false) {
        $content = preg_replace('/{cat_tips_success[^}]*}([\s\S]*?){\/cat_tips_success}/', '<div class="cat_tips cat_tips_success">${1}</div>', $content);
        $content = preg_replace('/{cat_tips_info[^}]*}([\s\S]*?){\/cat_tips_info}/', '<div class="cat_tips cat_tips_info">${1}</div>', $content);
        $content = preg_replace('/{cat_tips_warning[^}]*}([\s\S]*?){\/cat_tips_warning}/', '<div class="cat_tips cat_tips_warning">${1}</div>', $content);
        $content = preg_replace('/{cat_tips_error[^}]*}([\s\S]*?){\/cat_tips_error}/', '<div class="cat_tips cat_tips_error">${1}</div>', $content);
    }
    if (strpos($content, '{cat_hide') !== false) {
        $db = Typecho_Db::get();
        $hasComment = $db->fetchAll($db->select()->from('table.comments')->where('cid = ?', $post->cid)->where('mail = ?', $post->remember('mail', true))->limit(1));
        if ($hasComment || $login) {
            $content = strtr($content, array("{cat_hide}" => "<div class='cat_article_show'><div class='cat_article_show_word'>此处内容回复后可见，现已为您显示</div>", "{/cat_hide}" => "</div>"));
        } else {
            $content = preg_replace('/{cat_hide[^}]*}([\s\S]*?){\/cat_hide}/', '<cat_article_hide>此处内容，需回复之后可见</cat_article_hide>', $content);
        }
    }
    if (strpos($content, '{hide') !== false) {
        $db = Typecho_Db::get();
        $hasComment = $db->fetchAll($db->select()->from('table.comments')->where('cid = ?', $post->cid)->where('mail = ?', $post->remember('mail', true))->limit(1));
        if ($hasComment || $login) {
            $content = strtr($content, array("{hide}" => "", "{/hide}" => ""));
        } else {
            $content = preg_replace('/{hide[^}]*}([\s\S]*?){\/hide}/', '<cat_article_hide>此处内容，需回复之后可见</cat_article_hide>', $content);
        }
    }
    echo $content;
}
function cat_check_XSS($text)
{
    $isXss = false;
    $list = array(
        '/onabort/is',
        '/onblur/is',
        '/onchange/is',
        '/onclick/is',
        '/ondblclick/is',
        '/onerror/is',
        '/onfocus/is',
        '/onkeydown/is',
        '/onkeypress/is',
        '/onkeyup/is',
        '/onload/is',
        '/onmousedown/is',
        '/onmousemove/is',
        '/onmouseout/is',
        '/onmouseover/is',
        '/onmouseup/is',
        '/onreset/is',
        '/onresize/is',
        '/onselect/is',
        '/onsubmit/is',
        '/onunload/is',
        '/eval/is',
        '/ascript:/is',
        '/style=/is',
        '/width=/is',
        '/width:/is',
        '/height=/is',
        '/height:/is',
        '/src=/is',  
    );
    if (strip_tags($text)) {
        for ($i = 0; $i < count($list); $i++) {
            if (preg_match($list[$i], $text) > 0) {
                $isXss = true;
                break;
            }
        }
    } else {
        $isXss = true;
    };
    return $isXss;
}
function cat_comment_changetext_pre($text)
{
    if (cat_check_XSS($text)) {
        echo "该回复疑似异常，已被系统拦截！";
    } else {
        $text = preg_replace('/{linkname name="([\s\S]*?)" link="([\s\S]*?)"}/', '<a style="color: var(--theme);margin: 0 0.25rem;" href="${2}" target="_blank">${1}</a>', $text);
        if(Helper::options()->cat_comment_IMGcode){
            $text = preg_replace('/{' . Helper::options()->cat_comment_IMGcode . '}([\s\S]*?){\/' . Helper::options()->cat_comment_IMGcode . '}/', '<img src="' . get_Lazyload() . '" class="isfancy_ungallery comment_img_little lazyload" data-src="${1}" alt="" title="">', $text);
        }else{
            $text = preg_replace('/{IMG}([\s\S]*?){\/IMG}/', '<img src="' . get_Lazyload() . '" class="isfancy_ungallery comment_img_little lazyload" data-src="${1}" alt="" title="">', $text);
        }
        $text = preg_replace('/{netmusic}([\s\S]*?){\/netmusic}/', '<meting-js server="netease" type="song" id="${1}"></meting-js>', $text);
        if(Helper::options()->cat_bili_choose == 'on'){
            $text = preg_replace('/{bilibili p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/bilibili}/', '<cat_article_bili><iframe src="' . Helper::options()->themeUrl . '/api/bilibili/?bv=${3}&p=${1}&q=${2}&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $text);
            $text = preg_replace('/{bilibili}([\s\S]*?){\/bilibili}/', '<cat_article_bili><iframe src="' . Helper::options()->themeUrl . '/api/bilibili/?bv=${1}&p=1&q=80&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $text);
        }elseif(Helper::options()->cat_bili_choose == 'office'){
            $text = preg_replace('/{bilibili p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/bilibili}/', '<cat_article_bili><iframe src="https://api.injahow.cn/bparse/?bv=${3}&p=${1}&q=${2}&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $text);
            $text = preg_replace('/{bilibili}([\s\S]*?){\/bilibili}/', '<cat_article_bili><iframe src="https://api.injahow.cn/bparse/?bv=${1}&p=1&q=80&format=dash&otype=dplayer" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $text);
        }elseif(Helper::options()->cat_bili_choose == 'html5'){
            $text = preg_replace('/{bilibili p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/bilibili}/', '<cat_article_bili><iframe src="//player.bilibili.com/player.html?&bvid=${3}&&page=${1}" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $text);
            $text = preg_replace('/{bilibili([\s\S]*?)}([\s\S]*?){\/bilibili}/', '<cat_article_bili><iframe src="https://www.bilibili.com/blackboard/html5mobileplayer.html?bvid=${2}&amp;page=${1}&amp;as_wide=1&amp;danmaku=0&amp;hasMuteButton=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $text);
        }else{
            $text = preg_replace('/{bilibili p="([\s\S]*?)" q="([\s\S]*?)"}([\s\S]*?){\/bilibili}/', '<cat_article_bili><iframe src="//player.bilibili.com/player.html?&bvid=${3}&&page=${1}" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $text);
            $text = preg_replace('/{bilibili([\s\S]*?)}([\s\S]*?){\/bilibili}/', '<cat_article_bili><iframe src="//player.bilibili.com/player.html?&bvid=${2}&&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></cat_article_bili>', $text);
        }
        $text = cat_parse_owo($text);
        $text = cat_parse_owo_2($text,0);
        return $text;
    }
}
function cat_comment_changetext($text)
{
    $text = cat_comment_changetext_pre($text);
    $text = substr_replace(substr_replace($text,"",-4,4),"",0,3);
    return $text;
}
function cat_parse_owo($text)
{
    $json_owo = file_get_contents(Helper::options()->cat_user_owo ? Helper::options()->cat_user_owo : owo_path(false) . 'OwO.json');
    $arr_owo = json_decode($json_owo,true);
    foreach($arr_owo as $list_owo){
        if($list_owo['type'] == "image"){
            foreach($list_owo['container'] as $one_owo){
                if (strpos($one_owo['icon'], 'http') === 0) {
                    $text = str_replace($one_owo['data'], '<img class="owo_image lazyload" src="' . get_OWOLazyload() . '" data-src="' . $one_owo['icon'] . '"/>', $text);
                }else{
                    $text = str_replace($one_owo['data'], '<img class="owo_image lazyload" src="' . get_OWOLazyload() . '" data-src="' . Helper::options()->themeUrl . '/stickers/' . $one_owo['icon'] . '"/>', $text);
                }
            }
        }
    }
    return $text;
}
function cat_parse_owo_2($text,$mode)
{
    $json_owo = file_get_contents(Helper::options()->cat_user_owo_2 ? Helper::options()->cat_user_owo_2 : owo_path(false) . 'OwO_2.json');
    $arr_owo = json_decode($json_owo,true);
    foreach($arr_owo as $list_owo){
        if($list_owo['type'] == "image"){
            foreach($list_owo['container'] as $one_owo){
                if($mode == 0){
                    if (strpos($one_owo['icon'], 'http') === 0) {
                        $text = str_replace($one_owo['data'], '<img class="owo_image owo_image_2 lazyload" src="' . get_OWOLazyload() . '" data-src="'. $one_owo['icon'] . '"/>', $text);
                    }else{
                        $text = str_replace($one_owo['data'], '<img class="owo_image owo_image_2 lazyload" src="' . get_OWOLazyload() . '" data-src="' . Helper::options()->themeUrl . '/stickers/' . $one_owo['icon'] . '"/>', $text);
                    }
                }else{
                    $text = str_replace($one_owo['data'], '<span style="color:var(--theme-30);"> - 日记贴图 - </span>', $text);
                }
            }
        }
    }
    return $text;
}
function cat_reply_unformat($text, $type = true)
{
    if (cat_check_XSS($text)) {
        return "该回复疑似异常，已被系统拦截！";
    } else {
        if(Helper::options()->cat_comment_IMGcode){
            $text = preg_replace('/{' . Helper::options()->cat_comment_IMGcode . '}([\s\S]*?){\/' . Helper::options()->cat_comment_IMGcode . '}/', '<span class="cat_reply_media"><i class="ri-image-fill"></i> 图片</span>', $text);
        }else{
            $text = preg_replace('/{IMG}([\s\S]*?){\/IMG}/', '<span class="cat_reply_media"><i class="ri-image-fill"></i> 图片</span>', $text);
        }
        $text = preg_replace('/{linkname name="([\s\S]*?)" link="([\s\S]*?)"}/', '<a style="color: var(--theme);margin: 0 0.25rem;" href="${2}" target="_blank">${1}</a>', $text);
        $text = preg_replace('/{bilibili}([\s\S]*?){\/bilibili}/', '<span class="cat_reply_media"><i class="ri-bilibili-fill"></i> 视频</span>', $text);
        $text = preg_replace('/{netmusic}([\s\S]*?){\/netmusic}/', '<span class="cat_reply_media"><i class="ri-netease-cloud-music-fill"></i> 音乐</span>', $text);
        $text = cat_parse_owo($text);
        $text = cat_parse_owo_2($text,1);
        return $text;
    }
}
function cat_reply($text)
{
    echo cat_reply_unformat(strip_tags($text));
}
function get_thisyear($time,$item){
    if (date('Y', $time) == date('Y')) {
        $from = $item->date('M.j'); 
    }else {
        $from = $item->date('M.j.Y'); 
    }
    return $from;
}
function diary_logo_weather($weather){
    if(is_numeric($weather)){
        return '<i class="qi-'.$weather.'"></i>';
    }else{
        switch ($weather){
            case "晴":  return '<i class="qi-100"></i>';break;
            case "多云":return '<i class="qi-101"></i>';break;
            case "阴":  return '<i class="qi-102"></i>';break;
            case "阵雨":return '<i class="qi-300"></i>';break;
            case "小雨":return '<i class="qi-305"></i>';break;
            case "中雨":return '<i class="qi-306"></i>';break;
            case "雷电":return '<i class="qi-302"></i>';break;
            case "暴雨":return '<i class="qi-310"></i>';break;
            case "雾":  return '<i class="qi-501"></i>';break;
            case "大风":return '<i class="qi-503"></i>';break;
            case "雪":  return '<i class="qi-499"></i>';break;
            case "冰雹":return '<i class="qi-1040"></i>';break;
            case "台风":return '<i class="qi-1002"></i>';break;
            case "酷热":return '<i class="qi-900"></i>';break;
            case "流星雨":return '☄';
        }
    }
}
function diary_he_weather($weather){
    if(is_numeric($weather)){
        switch ($weather){
            case "100": return "晴"; break;
            case "101": return "多云"; break;
            case "102": return "少云"; break;
            case "103": return "晴间多云"; break;
            case "104": return "阴"; break;
            case "150": return "晴"; break;
            case "151": return "多云"; break;
            case "152": return "少云"; break;
            case "153": return "晴间多云"; break;
            case "300": return "阵雨"; break;
            case "301": return "强阵雨"; break;
            case "302": return "雷阵雨"; break;
            case "303": return "强雷阵雨"; break;
            case "304": return "雷阵雨伴有冰雹"; break;
            case "305": return "小雨"; break;
            case "306": return "中雨"; break;
            case "307": return "大雨"; break;
            case "308": return "极端降雨"; break;
            case "309": return "毛毛雨/细雨"; break;
            case "310": return "暴雨"; break;
            case "311": return "大暴雨"; break;
            case "312": return "特大暴雨"; break;
            case "313": return "冻雨"; break;
            case "314": return "小到中雨"; break;
            case "315": return "中到大雨"; break;
            case "316": return "大到暴雨"; break;
            case "317": return "暴雨到大暴雨"; break;
            case "318": return "大暴雨到特大暴雨"; break;
            case "350": return "阵雨"; break;
            case "351": return "强阵雨"; break;
            case "399": return "雨"; break;
            case "400": return "小雪"; break;
            case "401": return "中雪"; break;
            case "402": return "大雪"; break;
            case "403": return "暴雪"; break;
            case "404": return "雨夹雪"; break;
            case "405": return "雨雪天气"; break;
            case "406": return "阵雨夹雪"; break;
            case "407": return "阵雪"; break;
            case "408": return "小到中雪"; break;
            case "409": return "中到大雪"; break;
            case "410": return "大到暴雪"; break;
            case "456": return "阵雨夹雪"; break;
            case "457": return "阵雪"; break;
            case "499": return "雪"; break;
            case "500": return "薄雾"; break;
            case "501": return "雾"; break;
            case "502": return "霾"; break;
            case "503": return "扬沙"; break;
            case "504": return "浮尘"; break;
            case "507": return "沙尘暴"; break;
            case "508": return "强沙尘暴"; break;
            case "509": return "浓雾"; break;
            case "510": return "强浓雾"; break;
            case "511": return "中度霾"; break;
            case "512": return "重度霾"; break;
            case "513": return "严重霾"; break;
            case "514": return "大雾"; break;
            case "515": return "特强浓雾"; break;
            case "800": return "新月"; break;
            case "801": return "蛾眉月"; break;
            case "802": return "上弦月"; break;
            case "803": return "盈凸月"; break;
            case "804": return "满月"; break;
            case "805": return "亏凸月"; break;
            case "806": return "下弦月"; break;
            case "807": return "残月"; break;
            case "900": return "热"; break;
            case "901": return "冷"; break;
            case "999": return "未知";
        }
    }else{
        return $weather;
    }
}
function diary_logo_mood($mood){
    switch ($mood){
        case "愉快":return "😀";break;
        case "开心":return "😁";break;
        case "失望":return "😞";break;
        case "无语":return "😑";break;
        case "惊讶":return "😯";break;
        case "笑哭":return "🤣";break;
        case "疲惫":return "😒";break;
        case "伤心":return "😥";break;
        case "愤怒":return "😡";break;
        case "无聊":return "🙄";break;
        case "无情":return "😶";break;
        case "流泪":return "😭";break;
        case "shit":return "💩";break;
        case "death":return "💀";
    }
}
function diary_logo_status($mood){
    switch ($mood){
        case "学习":return "📖";break;
        case "搬砖":return "🏗️";break;
        case "摸鱼":return "🐟";break;
        case "干饭":return "🍚";break;
        case "娱乐":return "🎤";break;
        case "演奏":return "🎸";break;
        case "打电动":return "🎮";break;
        case "做运动":return "🏀";break;
        case "下午茶":return "🍵";break;
        case "购物":return "🛒";break;
        case "遛狗":return "🦮";break;
        case "聚餐":return "🍻";break;
        case "约会":return "👒";break;
        case "闭关":return "⛔";
    }
}
function diary_logo_temperature($temperature){
    if ($temperature < -10) {
        return "❄️";
    } elseif($temperature >= -10 && $temperature < 5) {
        return "☃️";
    } elseif($temperature >= 5 && $temperature < 20) {
        return "🌷";
    } elseif($temperature >= 20 && $temperature < 30) {
        return "🏖️";
    } else {
        return "🔥";
    }
}
function compressHtml($html_source) {
    $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
    $compress = '';
    foreach ($chunks as $c) {
        if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
            $c = substr($c, 19, strlen($c) - 19 - 20);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
            $c = substr($c, 12, strlen($c) - 12 - 13);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
            $compress .= $c;
            continue;
        }
        $c = preg_replace('/[\\r\\t]+/', ' ', $c);
        $c = preg_replace('/\\s{2,}/', ' ', $c);
        $c = preg_replace('/>\\s</', '> <', $c);
        $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
        $c = preg_replace('/<!--[^!]*-->/', '', $c);
        $compress .= $c;
    }
    return $compress;
}
?>