<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
    if (!file_exists(__DIR__ . '/core')) {
        die('核心文件丢失，请重新安装主题。');
    }
    function resource_cdn(){
        if (Helper::options()->cat_resource_cdn){
    	    return Helper::options()->cat_resource_cdn . '/resource/';
    	}else{
    	    return Helper::options()->themeUrl . '/resource/';
    	}
    }
    require_once("core/themeFields.php");
    function themeConfig($form) {
    require_once("core/themeConfig.php");
?>
<link rel="stylesheet" href="<?php echo resource_cdn() . 'css/option.css' ?>" />
<script src="<?php echo resource_cdn() . 'js/jquery.min.js' ?>"></script>
<script src="<?php echo resource_cdn() . 'js/option.js' ?>"></script>
    <?php if(file_exists(__TYPECHO_ROOT_DIR__.'/www.mmbkz.cn')) :?>
        <style>.typecho-option-submit{display:block!important;}#jihuo,.jihuo_block{display:none;}</style>
    <?php else: ?>
        <style>.typecho-option,.jihuo_block{display:block;}.mydiary_title,.typecho-option-submit{display:none;}.typecho-option,.cat_option_menu{display:none!important;}.typecho-option.jihuo_block,.typecho-option.cat_key{display:block!important;}</style>
    <?php endif; ?>
<?php } ?>
<?php
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Editor', 'edit');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Editor', 'edit');
class Editor
{
    public static function edit()
    {
        echo "<link rel='stylesheet' href='" . resource_cdn() . 'css/option.css' . "'>";
		echo "<script>
            window.CAT = {
                BASE_API: `".(Helper::options()->rewrite == 0 ? Helper::options()->rootUrl . '/index.php/' : Helper::options()->rootUrl . '/')."`,
            }
        </script>";
        echo "<script src='" . resource_cdn() . 'js/editor.js' . "'></script>";
    }
}
Typecho_Plugin::factory('Widget_Feedback')->comment = array('Intercept', 'message');
class Intercept
{
    public static function message($comment)
    {
        if (Helper::options()->cat_comment_needchinese === "on") {
            if ((preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) && (preg_match("/\:\@\(aru/", $comment['text']) == 0)) {
                $comment['status'] = 'waiting';
            }
        }   
        if (Helper::options()->cat_comment_banword) {
            if (_checkSensitiveWords(Helper::options()->cat_comment_banword, $comment['text'])) {
                $comment['status'] = 'spam';
            }
        } 
        if (Helper::options()->cat_comment_forbidword) {
            if (_checkSensitiveWords(Helper::options()->cat_comment_forbidword, $comment['text'])) {
                throw new Typecho_Widget_Exception(_t('对不起，检测到违禁词。<a href="javascript:history.back(-1)">返回上一页</a>','评论失败'), 404);
            }
        }
        Typecho_Cookie::delete('__typecho_remember_text');
        return $comment;
    }
}
function _checkSensitiveWords($words_str, $str)
{
	$words = explode("||", $words_str);
	if (empty($words)) {
		return false;
	}
	foreach ($words as $word) {
		if (false !== strpos($str, trim($word))) {
			return true;
		}
	}
	return false;
}
function themeInit($self)
{
    Helper::options()->commentsRequireMail = true;
    Helper::options()->commentsRequireURL = false;
    Helper::options()->commentsThreaded = true;
    Helper::options()->commentsAntiSpam = false;
    Helper::options()->commentsPostIntervalEnable = false;
    Helper::options()->commentsMaxNestingLevels = 999;
    if ($self->request->getPathInfo() == "/") {
        if ($self->request->routeType == 'diary_like') {
            dodianzan($self);
        }
        if ($self->request->routeType == 'get_deepseek_api') {
            get_deepseek_api($self);
        }
    }
}
function get_deepseek_api($self)
{
    header("HTTP/1.1 200 OK");
    header('Access-Control-Allow-Origin:*');
    header("Access-Control-Allow-Headers:Origin, X-Requested-With, Content-Type, Accept");
    $ai_title = $self->request->ai_title;
    $ai_article = $self->request->ai_article;
    $ai_author = $self->request->ai_author;
	if (Helper::options()->cat_deepseek_modle == '') {
		$result = json_encode(['state' => 'error', 'message' => '未填写AI模型']);
		echo $result;
		return;
	}
	if (Helper::options()->cat_deepseek_apikey == '') {
		$result = json_encode(['state' => 'error', 'message' => '未填写APIKEY']);
		echo $result;
		return;
	}
	if (Helper::options()->cat_deepseek_address == '') {
		$result = json_encode(['state' => 'error', 'message' => '未填写API基础地址']);
		echo $result;
		return;
	}
	$apiUrl = rtrim(Helper::options()->cat_deepseek_address, '/');
	$headers = [
		'Content-Type: application/json',
		'Accept: application/json',
		'Authorization: Bearer ' . Helper::options()->cat_deepseek_apikey
	];
	$systemPrompt = "你是一个专业的文本摘要生成器，请根据以下文章内容生成简洁的中文摘要。"
				  . "要求：\n"
				  . "1. 完全基于文章内容\n"
				  . "2. 使用书面化语言\n"
				  . "3. 称呼作者为博主\n"
				  . "4. 摘要控制在" . (Helper::options()->cat_deepseek_length ? Helper::options()->cat_deepseek_length : '100') . "字以内\n"
				  . "5. 直接输出摘要内容，不要额外解释";
	$data = [
		'model' => Helper::options()->cat_deepseek_modle,
		'messages' => [
			['role' => 'system', 'content' => $systemPrompt],
			['role' => 'user', 'content' => "标题：" . $ai_title . "\n文章内容：" . $ai_article . "\n作者：" . $ai_author],
		],
		"temperature" => 0.3,
		"top_p" => 0.5,
		"max_tokens" => Helper::options()->cat_deepseek_length * 2
	];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $apiUrl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$response = curl_exec($ch);
	if ($response === false) {
		$result = json_encode(['state' => 'error', 'message' => 'AI摘要请求失败: ' . curl_error($ch)]);
	} else {
		$responseData = json_decode($response, true);
		if (isset($responseData['choices'][0]['message']['content'])) {
			$result = json_encode(['state' => 'success', 'message' => trim($responseData['choices'][0]['message']['content'])]);
		} else {
			$result = json_encode(['state' => 'error', 'message' => 'AI摘要生成失败: ' . json_encode($responseData)]);
		}
	}
	curl_close($ch);
	echo $result;
	exit;
}
function dodianzan($self)
{
    header("HTTP/1.1 200 OK");
    header('Access-Control-Allow-Origin:*');
    header("Access-Control-Allow-Headers:Origin, X-Requested-With, Content-Type, Accept");
    $name = $self->request->likename;
    $mail = $self->request->likemail;
    $parent = $self->request->likeparent;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $isagree = $db->fetchRow($db
        ->select('agree')
        ->from('table.dianzan')
        ->where('mail = ?', $mail)
        ->where('parent = ?', $parent)
    );
    if (empty ($isagree)){
        $insert = $db->insert('table.dianzan')
                     ->rows(array('name' => $name, 'parent' => $parent, 'mail' => $mail, 'agree' => 1));
        $insertId = $db->query($insert);
    } else {        
    }
}
function agreeNum($cid, &$record = NULL)
{
    $db = Typecho_Db::get();
    $callback = array(
        'agree' => 0,
        'recording' => false
    );
    if (array_key_exists('agree', $data = $db->fetchRow($db->select()->from('table.contents')->where('cid = ?', $cid)))) {
        $callback['agree'] = $data['agree'];
    } else {
        $db->query('ALTER TABLE `' . $db->getPrefix() . 'contents` ADD `agree` INT(10) NOT NULL DEFAULT 0;');
    }
    if (empty($recording = Typecho_Cookie::get('__typecho_agree_record'))) {
        Typecho_Cookie::set('__typecho_agree_record', '[]');
    } else {
        $callback['recording'] = is_array($record = json_decode($recording)) && in_array($cid, $record);
    }
    return $callback;
}
function agree($cid)
{
    $db = Typecho_Db::get();
    if (empty($record)) {
        Typecho_Cookie::set('__typecho_agree_record', "[$cid]");
    } else {
        if ($callback['recording']) {
            return $callback['agree'];
        }
        array_push($record, $cid);
        Typecho_Cookie::set('__typecho_agree_record', json_encode($record));
    }
    $db->query('UPDATE `' . $db->getPrefix() . 'contents` SET `agree` = `agree` + 1 WHERE `cid` = ' . $cid . ';');
    return ++$callback['agree'];
}
function text_change($text)
{
    if(Helper::options()->cat_user_owo){
        $json_owo = file_get_contents(Helper::options()->cat_user_owo ? Helper::options()->cat_user_owo : owo_path() . 'public/OwO.json');
        $arr_owo = json_decode($json_owo,true);
        foreach($arr_owo as $list_owo){
            if($list_owo['type'] == "image"){
                foreach($list_owo['container'] as $one_owo){
                    if (strpos($one_owo['icon'], 'http') === 0) {
                        $text = str_replace($one_owo['data'], '<img class="max-height: 22px;" src="' . $one_owo['icon'] . '"/>', $text);
                    }else{
                        $text = str_replace($one_owo['data'], '<img class="max-height: 22px;" src="' . Helper::options()->themeUrl . '/stickers/' . $one_owo['icon'] . '"/>', $text);
                    }
                }
            }
        }
    }else{
        $text = preg_replace_callback(
            '/\:\@\(\s*(aruA001|aruA002|aruA003|aruA004|aruA005|aruA006|aruA007|aruA008|aruA009|aruA010|aruA011|aruA012|aruA013|aruA014|aruA015|aruA016|aruA017|aruA018|aruA019|aruA020|aruA021|aruA022|aruA023|aruA024|aruA025|aruA026|aruA027|aruA028|aruA029|aruA030|aruA031|aruA032|aruA033|aruA034|aruA035|aruA036|aruA037|aruA038|aruA039|aruA040|aruA041|aruA042|aruA043|aruA044|aruA045|aruA046|aruA047|aruA048|aruA049|aruA050|aruA051|aruA052|aruA053|aruA054|aruA055|aruA056|aruA057|aruA058|aruA059|aruA060|aruA061|aruA062|aruA063|aruA064|aruA065|aruA066|aruA067|aruA068|aruA069|aruA070|aruA071|aruA072|aruA073|aruA074|aruA075|aruA076|aruA077|aruA078|aruA079|aruA080|aruA081|aruA082|aruA083|aruA084|aruA085|aruA086|aruA087|aruA088|aruA089|aruA090|aruA091|aruA092|aruA093|aruA094|aruA095|aruA096|aruA097|aruA098|aruA099|aruA100|aruA101|aruA102|aruA103|aruA104|aruA105|aruA106|aruA107|aruA108|aruA109|aruA110|aruA111|aruA112|aruA113)\s*\)/is',
            function ($match) {
                return '<img style="max-height: 22px;" src="https://jihulab.com/ScarletDor/owo/-/raw/master/owo/aru1/' . $match[1] . '.gif"/>';
            },
            $text
        );
        $text = preg_replace_callback(
            '/\:\@\(\s*(aruB001|aruB002|aruB003|aruB004|aruB005|aruB006|aruB007|aruB008|aruB009|aruB010|aruB011|aruB012|aruB013|aruB014|aruB015|aruB016|aruB017|aruB018|aruB019|aruB020|aruB021|aruB022|aruB023|aruB024|aruB025|aruB026|aruB027|aruB028|aruB029|aruB030|aruB031|aruB032|aruB033|aruB034|aruB035|aruB036|aruB037|aruB038|aruB039|aruB040|aruB041|aruB042|aruB043|aruB044|aruB045|aruB046|aruB047|aruB048|aruB049|aruB050|aruB051|aruB052|aruB053|aruB054|aruB055|aruB056|aruB057|aruB058|aruB059|aruB060|aruB061|aruB062|aruB063|aruB064|aruB065|aruB066|aruB067|aruB068|aruB069|aruB070|aruB071|aruB072|aruB073|aruB074|aruB075|aruB076|aruB077|aruB078|aruB079|aruB080|aruB081|aruB082|aruB083|aruB084|aruB085|aruB086|aruB087|aruB088|aruB089|aruB090|aruB091|aruB092|aruB093|aruB094|aruB095|aruB096|aruB097|aruB098|aruB099|aruB100|aruB101|aruB102|aruB103|aruB104|aruB105|aruB106|aruB107|aruB108|aruB109|aruB110|aruB111|aruB112|aruB113|aruB114|aruB115|aruB116|aruB117|aruB118|aruB119|aruB120|aruB121|aruB122|aruB123|aruB124|aruB125|aruB126|aruB127|aruB128|aruB129|aruB130|aruB131|aruB132|aruB133|aruB134|aruB135|aruB136)\s*\)/is',
            function ($match) {
                return '<img style="max-height: 22px;" src="https://jihulab.com/ScarletDor/owo/-/raw/master/owo/aru2/' . $match[1] . '.gif"/>';
            },
            $text
        );
    }
    if(Helper::options()->cat_user_owo_2){
        $json_owo = file_get_contents(Helper::options()->cat_user_owo_2 ? Helper::options()->cat_user_owo_2 : owo_path() . 'OwO_2.json');
        $arr_owo = json_decode($json_owo,true);
        foreach($arr_owo as $list_owo){
            if($list_owo['type'] == "image"){
                foreach($list_owo['container'] as $one_owo){
                    if (strpos($one_owo['icon'], 'http') === 0) {
                        $text = str_replace($one_owo['data'], '<img class="max-height: 22px;" src="' . $one_owo['icon'] . '"/>', $text);
                    }else{
                        $text = str_replace($one_owo['data'], '<img class="max-height: 22px;" src="' . Helper::options()->themeUrl . '/stickers/' . $one_owo['icon'] . '"/>', $text);
                    }
                }
            }
        }
    }else{
        $text = preg_replace_callback(
            '/\:\@\(\s*(M01|M02|M03|M04|M05|M06|M07|M08|M09|M10|M11|M12|M13|M14|M15|M16|M17|M18|M19|M20|M21|M22|M23|M24|M25|M26|M27|M28|M29|M30|M31|M32|M33|M34|M35|M36|M37|M38|M39|M40)\s*\)/is',
            function ($match) {
                return '<img style="max-height: 22px;" src="https://jihulab.com/ScarletDor/owo/-/raw/master/owo/cat/' . $match[1] . '.webp"/>';
            },
            $text
        );
    }
        if(Helper::options()->cat_comment_IMGcode){
            $text = preg_replace('/{' . Helper::options()->cat_comment_IMGcode . '}([\s\S]*?){\/' . Helper::options()->cat_comment_IMGcode . '}/', '<em><span style="color:var(--theme);"> - 评论图片 - </span></em>', $text);
        }else{
            $text = preg_replace('/{IMG}([\s\S]*?){\/IMG}/', '<em><span style="color:var(--theme);"> - 评论图片 - </span></em>', $text);
        }
        $text = preg_replace('/{linkname name="([\s\S]*?)" link="([\s\S]*?)"}/', '<a style="color: var(--theme);margin: 0 0.25rem;" href="${2}" target="_blank">${1}</a>', $text);
        $text = preg_replace('/{bilibili}([\s\S]*?){\/bilibili}/', '<em><span style="color:var(--theme);"> - 嵌入视频${1} - </span></em>', $text);
        $text = preg_replace('/{netmusic}([\s\S]*?){\/netmusic}/', '<em><span style="color:var(--theme);"> - 嵌入音乐 - </span></em>', $text);
    return $text;
}
require_once("core/phpmailer.php");
require_once("core/smtp.php");
if (
    Helper::options()->cat_email_switch === 'on' &&
    Helper::options()->cat_email_host &&
    Helper::options()->cat_email_port &&
    Helper::options()->cat_email_nickname &&
    Helper::options()->cat_email_sendmail &&
    Helper::options()->cat_email_password &&
    Helper::options()->cat_email_ssl
) {
    Typecho_Plugin::factory('Widget_Feedback')->finishComment = array('Email', 'send');
}
class Email
{
    public static function send($comment)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPSecure = Helper::options()->cat_email_ssl;
        $mail->Host = Helper::options()->cat_email_host;
        $mail->Port = Helper::options()->cat_email_port;
        $mail->FromName = Helper::options()->cat_email_nickname;
        $mail->Username = Helper::options()->cat_email_sendmail;
        $mail->From = Helper::options()->cat_email_sendmail;
        $mail->Password = Helper::options()->cat_email_password;
        $mail->isHTML(true);
        $text = $comment->text;
        $text = text_change($text);
        $html_1 = '
            <div style="width: 550px;margin: 0 auto;border-radius: 8px;overflow: hidden;word-break: break-all; background: linear-gradient(117deg,#ffffff,#fff6f6);">
                <img src="{img}" alt="您的邮件" style="width: 100%;">
                <div style="padding:1rem;position: relative;">
                    <p><b style="color: #ff5850;" title="IP    :{ip}&#10;Mail:{mail}">{author} </b>在 {link} 上给您留言啦：</p>
                    <div style="display: flex;margin-bottom: 5px">
                        <div style="width: auto;flex: none">
                            <img src="{avatar2}" style="width: 40px;height: 40px;border-radius: 5px">
                        </div>
                        <div style="position: relative;margin-left: 10px">
                            <span style="width: 0;height: 0;border-top: 8px solid transparent;border-bottom: 8px solid transparent;border-right: 8px solid;border-right-color: #f4f4f4;left: -7px;right: auto;top: 12px;position: absolute">
                            </span>
                            <div style="background: linear-gradient(117deg,#f3efff,#e7f1ff);padding: 10px;border-radius: 9px;margin-bottom: 3px">{content}</div>
                        </div>
                    </div>
                    <p style="color:#999999;font-size: 0.5rem;">{time}</p>
                    <div style="text-align:center;color:#999999;font-size:0.5rem;font-size: 0.5rem;line-height: 1.5rem;">{copyright}</div>
                    <div style="font-size: 4rem;position: absolute;right: 0;bottom: 0;transform: rotate(-15deg);opacity: 0.5;">🌸</div>
                </div>
            </div>
        ';
        $html_2 = '
            <div style="width: 550px;margin: 0 auto;border-radius: 8px;overflow: hidden;word-break: break-all; background: linear-gradient(117deg,#ffffff,#fff6f6);">
                <img src="{img}" alt="您的邮件" style="width: 100%;">
                <div style="padding:1rem;position: relative;">
                    <p style="display: flex;justify-content: flex-end;">您在 {link} 上的评论：</p>
                    <div style="display: flex;justify-content: flex-end;margin-bottom: 5px">
                        <div style="width: auto;flex: none;order: 2">
                            <img src="{avatar1}" style="width: 40px;height: 40px;border-radius: 5px">
                        </div>
                        <div style="position: relative;margin-right: 10px">
                            <span style="width: 0;height: 0;border-top:8px solid transparent;border-bottom:8px solid transparent;border-left:8px solid;border-left-color:#f4f4f4;border-right:0;border-right-color:transparent;right: -7px;left: auto;top: 12px;position: absolute">
                            </span>
                            <div style="background: linear-gradient(117deg,#f3efff,#e7f1ff);padding: 10px;border-radius: 9px;margin-bottom: 3px">{oldcontent}</div>
                        </div>
                    </div>
                    <p style="color:#999999;font-size: 0.5rem;display: flex;justify-content: flex-end;">{oldtime}</p>
                    <p><b style="color: #ff5850;" title="IP    :{ip}&#10;Mail:{mail}">{author} </b> 给您回复到：</p>
                    <div style="display: flex;margin-bottom: 5px">
                        <div style="width: auto;flex: none">
                            <img src="{avatar2}" style="width: 40px;height: 40px;border-radius: 5px">
                        </div>
                        <div style="position: relative;margin-left: 10px">
                            <span style="width: 0;height: 0;border-top: 8px solid transparent;border-bottom: 8px solid transparent;border-right: 8px solid;border-right-color: #f4f4f4;left: -7px;right: auto;top: 12px;position: absolute">
                            </span>
                            <div style="background: linear-gradient(117deg,#f3efff,#e7f1ff);padding: 10px;border-radius: 9px;margin-bottom: 3px">{content}</div>
                        </div>
                    </div>
                    <p style="color:#999999;font-size: 0.5rem;">{time}</p>
                    <div style="text-align:center;color:#999999;font-size:0.5rem;font-size: 0.5rem;line-height: 1.5rem;">{copyright}</div>
                    <div style="font-size: 4rem;position: absolute;right: 0;bottom: 0;transform: rotate(-15deg);opacity: 0.5;">🌸</div>
                </div>
            </div>
        ';
        if ($comment->authorId != $comment->ownerId && $comment->parent == 0) {
            $db = Typecho_Db::get();
            $authoInfo = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', $comment->ownerId));
            $authorMail = $authoInfo['mail'];
            if ($authorMail) {
                $mail->Body = strtr(
                    $html_1,
                    array(
                        "{title}"       => $comment->title,
                        "{mail}"        => $comment->mail,
                        "{avatar2}"     => 'https://cravatar.cn/avatar/' . md5(strtolower($comment->mail)) . '?&d=mm&s=200',
                        "{author}"      => $comment->author,
                        "{ip}"          => $comment->ip,
                        "{img}"         => Helper::options()->cat_email_pic ? Helper::options()->cat_email_pic : 'https://jihulab.com/ScarletDor/owo/-/raw/master/public/mail1.webp',
                        "{time}"        => date('Y年n月j日 H:i',$comment->created),
                        "{link}"        => '<a style="color: #ff5850;text-decoration: none;" href="' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '" target="_blank">《 ' . $comment->title . ' 》</a>',
                        "{copyright}"   => '此邮件由系统自动发送，请勿直接回复<br>' . '©' . date("Y") . ' - ' . '<a style="color:#999999;text-decoration: none;" href="' . Helper::options()->siteUrl . '" target="_blank">' . Helper::options()->title . '</a> - <a style="color:#999999;text-decoration: none;" href="https://www.mmbkz.cn/mydiary.html" target="_blank">MyDiary主题</a>',
                        "{content}"     => $text,
                    )
                );
                $mail->addAddress($authorMail);
                $mail->Subject = '📧 您的文章 『' . $comment->title . '』 收到一条新的评论！';
                $mail->send();
            }
        } else {
            $db = Typecho_Db::get();
            $parentInfo = $db->fetchRow($db->select('mail','text','created')->from('table.comments')->where('coid = ?', $comment->parent));
            $parentMail = $parentInfo['mail'];
            $parentText = $parentInfo['text'];
            $parentText = text_change($parentText);
            $parentCreated = $parentInfo['created'];
            if ($parentMail != $comment->mail) {
                $mail->Body = strtr(
                    $html_2,
                    array(
                        "{title}"       => $comment->title,
                        "{mail}"        => $comment->mail,
                        "{avatar1}"     => 'https://cravatar.cn/avatar/' . md5(strtolower($parentMail)) . '?&d=mm&s=200',
                        "{avatar2}"     => 'https://cravatar.cn/avatar/' . md5(strtolower($comment->mail)) . '?&d=mm&s=200',
                        "{author}"      => $comment->author,
                        "{ip}"          => $comment->ip,
                        "{img}"         => Helper::options()->cat_email_pic ? Helper::options()->cat_email_pic : 'https://jihulab.com/ScarletDor/owo/-/raw/master/public/mail1.webp',
                        "{time}"        => date('Y年n月j日 H:i',$comment->created),
                        "{oldtime}"     => date('Y年n月j日 H:i',$parentCreated),
                        "{link}"        => '<a style="color: #ff5850;text-decoration: none;" href="' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '" target="_blank">《 ' . $comment->title . ' 》</a>',
                        "{copyright}"   => '此邮件由系统自动发送，请勿直接回复<br>' . '©' . date("Y") . ' - ' . '<a style="color:#999999;text-decoration: none;" href="' . Helper::options()->siteUrl . '" target="_blank">' . Helper::options()->title . '</a> - <a style="color:#999999;text-decoration: none;" href="https://www.mmbkz.cn/mydiary.html" target="_blank">MyDiary主题</a>',
                        "{content}"     => $text,
                        "{oldcontent}"  => $parentText,
                    )
                );
                $mail->addAddress($parentMail);
                $mail->Subject = '📩 新消息：您在 『' . $comment->title . '』 的评论有了新的回复！';
                $mail->send();
            }
        }
    }
}
?>