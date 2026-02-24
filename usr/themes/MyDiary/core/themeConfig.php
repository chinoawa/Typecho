<div id="jihuo">🔐 激活</div>
<div class="typecho-option jihuo_block">
    <label class="typecho-label">感谢选择 MyDiary 主题</label>
    <div style="text-align:center;">
    	<img src="<?php Helper::options()->themeUrl('/screenshot.png') ?>" alt="主题展示图" />
    </div>
    <div class="description"><strong style="color:#649bff;border-bottom: 2px dashed #649bff;">使用本主题之前，请先联系火喵购买本主题。并在购买之前详细阅读注意事项，以及主题使用手册。</strong>
        <br>请在下方填入购买时的qq号和自设的token令牌。显示激活成功后会自动刷新此页面。如刷新后未成功进入设置页面则请手动刷新此页面。
    	<br>1. 偶尔出现未激活状态，点击激活按钮重新激活即可。
    	<br>2. [Typecho设置-基本设置-站点地址]是否填错地址（注意有无www）。
    	<br>3. 确保网站根目录已开启755权限。
    	<br>4. 若仍显示此界面，请联系喵喵。
    	<br><span style="color:red;">主题官群：103659317</span>
    </div>
</div>
<div class="mydiary_title">🌸𝕸𝖞𝕯𝖎𝖆𝖗𝖞</div>
<div class="cat_option_menu">
    <ul class="menulist">
        <li class="menu" id="cat_notice">🎉 欢迎</li>
        <li class="menu" id="cat_key">🔐 激活</li>
        <li class="menu" id="cat_basic">🌸 基本</li>
        <li class="menu" id="cat_menu">🚏 导航</li>
        <li class="menu" id="cat_index">🏡 主页</li>
        <li class="menu" id="cat_page">📖 内页</li>
        <li class="menu" id="cat_article">📃 文章</li>
        <li class="menu" id="cat_link">🖇️友链</li>
        <li class="menu" id="cat_comment">💬 评论</li>
        <li class="menu" id="cat_effect">🛠️ 扩展</li>
        <li class="menu" id="cat_user">🎲 个性</li>
    </ul>
</div>
<?php
$str1 = explode('/themes/', Helper::options()->themeUrl);
$str2 = explode('/', $str1[1]);
$name=$str2[0];
$db = Typecho_Db::get();
$sjdq=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name));
$ysj = isset($sjdq['value'])?$sjdq['value']:'';
if(isset($_POST['type'])) {
	if($_POST["type"]=="备份模板设置数据") {
		if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))) {
			$update = $db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?', 'theme:'.$name.'bf');
			$updateRows= $db->query($update);
			echo '<div class="typecho-option" style="display: block;"><div style="font-size:20px;color:green;" class="tongzhi home">备份已更新，请等待自动刷新！如果等不到请点击';
			?>    
			<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div></div>
			<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);
			</script>
			<?php
		} else {
			if($ysj) {
				$insert = $db->insert('table.options')
				    ->rows(array('name' => 'theme:'.$name.'bf','user' => '0','value' => $ysj));
				$insertId = $db->query($insert);
				echo '<div class="typecho-option" style="display: block;"><div style="font-size:20px;color:green;" class="tongzhi home">备份完成，请等待自动刷新！如果等不到请点击';
				?>    
				<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div></div>
				<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);
				</script>
				<?php
			}
		}
	}
	if($_POST["type"]=="还原模板设置数据") {
		if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))) {
			$sjdub=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'));
			$bsj = $sjdub['value'];
			$update = $db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?', 'theme:'.$name);
			$updateRows= $db->query($update);
			echo '<div class="typecho-option" style="display: block;"><div style="font-size:20px;" class="tongzhi home">检测到模板备份数据，恢复完成，请等待自动刷新！如果等不到请点击';
			?>    
			<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div></div>
			<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);
			</script>
			<?php
		} else {
			echo '<div class="typecho-option" style="display: block;"><div style="font-size:20px;color:red;" class="tongzhi home">没有模板备份数据，恢复不了哦！</div></div>';
		}
	}
	if($_POST["type"]=="删除备份数据") {
		if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))) {
			$delete = $db->delete('table.options')->where ('name = ?', 'theme:'.$name.'bf');
			$deletedRows = $db->query($delete);
			echo '<div class="typecho-option" style="display: block;"><div style="font-size:20px;color:green;" class="tongzhi home">删除成功，请等待自动刷新，如果等不到请点击';
			?>    
			<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div></div>
			<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);
			</script>
			<?php
		} else {
			echo '<div class="typecho-option" style="display: block;"><div style="font-size:20px;color:orange;" class="tongzhi home">不用删了！备份不存在！！！</div></div>';
		}
	}
}
?>
<div class="typecho-option cat_notice" style="display: block;">
<label class="typecho-label">欢迎使用</label>
<div class="description">
    <span style="color:chocolate;">首次使用本主题之前，请详细阅读<a href="https://www.mmbkz.cn/mydiary_note" target="_blank">主题使用手册</a>，否则会出现预料之外的问题。</span><br>
        博主昵称，请在<span style="color:cornflowerblue;"> 控制台-个人设置-昵称 </span>里修改<br>
        站点名称与站点描述，请在<span style="color:cornflowerblue;"> 设置-基本 </span>里修改<br>
        当前主题的版本号，请在博客页面点击F12查看控制台<br>
        - 作者：<a href="https://www.mmbkz.cn/" target="_blank">火喵酱</a><br>
        - 商城：<a href="https://store.mmbkz.cn/" target="_blank">喵喵的主题小店</a><br>
        - 日志：<a href="https://store.mmbkz.cn/index.php/MyDiary.html#fh5co-pricing" target="_blank">点此前往查看更新日志</a><br>
        - 官群：103659317</div>
</div>
<div class="typecho-option cat_notice" style="display: block;">
        <label class="typecho-label">备份选项</label>
        <form class="protected home" action="?'.$name.'bf" method="post">
        <input type="submit" name="type" class="backup_botton backup_botton_green" value="备份模板设置数据" /><input type="submit" name="type" class="backup_botton backup_botton_green" value="还原模板设置数据" /><input type="submit" name="type" class="backup_botton backup_botton_red" value="删除备份数据" /></form></div>
<div class="typecho-option cat_notice" style="text-align:center;display: block;">
        <div class="typecho-label"><span style="color:#ff6a6a;">❤❤❤</span>
        <span style="color:#E56600;"><b><a href="https://www.mmbkz.cn/" target="_blank">火喵博客</a> Copyright ©</b></span></div></div>
<?php
    $cat_buy_key_qq = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_buy_key_qq',
        null,
        null,
        '购买QQ号',
        '介绍：输入购买时所记录的QQ号'
    );
    $cat_buy_key_qq->setAttribute('class', 'typecho-option cat_key');
    $form->addInput($cat_buy_key_qq);
    $cat_buy_key_mima = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_buy_key_mima',
        null,
        null,
        'token令牌',
        '介绍：输入自设的token令牌'
    );
    $cat_buy_key_mima->setAttribute('class', 'typecho-option cat_key');
    $form->addInput($cat_buy_key_mima);
    $cat_favicon = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_favicon',
        null,
        null,
        '设置网站favicon',
        '介绍：输入favicon地址，使用ico格式'
    );
    $cat_favicon->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_favicon);
    $cat_hidetitle = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_hidetitle',
        null,
        null,
        '网站隐藏时的标题',
        '介绍：当前页面未激活时显示的文字'
    );
    $cat_hidetitle->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_hidetitle);
    $cat_birthday = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_birthday',
        NULL,
        NULL,
        '网站成立日期',
        '介绍：用于显示当前站点已经运行了多少时间。<br>
         注意：填写时务必保证填写正确！例如：2022/6/22 00:00:00 <br>
         其他：不填写则不显示'
    );
    $cat_birthday->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_birthday);
    $cat_Index_user_avatar = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_Index_user_avatar',
        NULL,
        NULL,
        '首页 & 侧边栏自定义头像',
        '介绍：可输入首页 & 侧边栏自定义头像地址，不输入则默认调用博主邮箱头像。'
    );
    $cat_Index_user_avatar->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_Index_user_avatar);
    $cat_baidutongji = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_baidutongji',
        NULL,
        NULL,
        '百度统计',
        '介绍：百度统计代码<br>
         说明：仅需输入百度统计代码号中问号后方的字符串，即下面示例中XXXXXX。不输入则不显示<br>
         示例：https://hm.baidu.com/hm.js?XXXXXX'
    );
    $cat_baidutongji->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_baidutongji);
    $cat_51tongji_id = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_51tongji_id',
        NULL,
        NULL,
        '51LA统计ID',
        '介绍：51LA统计代码-id值<br>
         说明：仅需输入51LA统计代码号中id后方的字符串，即下面示例中XXXXXX。不输入则不显示<br>
         示例：LA.init({id: "XXXXXX",ck: "---"})'
    );
    $cat_51tongji_id->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_51tongji_id);
    $cat_51tongji_ck = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_51tongji_ck',
        NULL,
        NULL,
        '51LA统计CK',
        '介绍：51LA统计代码-ck值<br>
         说明：仅需输入51LA统计代码号中ck后方的字符串，即下面示例中XXXXXX。不输入则不显示<br>
         示例：LA.init({id: "---",ck: "XXXXXX"})'
    );
    $cat_51tongji_ck->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_51tongji_ck);
    $cat_moeicp = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_moeicp',
        NULL,
        NULL,
        '萌国ICP备案号',
        '介绍：页面底部显示<a href="https://icp.gov.moe/" target="_blank"> 萌国ICP </a>备案号，请输入纯数字字符。<br>
         示例：20210005'
    );
    $cat_moeicp->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_moeicp);
    $cat_icp = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_icp',
        NULL,
        NULL,
        'ICP网备',
        '介绍：页面底部显示工信部备案号<br>
         示例：京ICP证030173号'
    );
    $cat_icp->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_icp);
    $cat_gwab = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_gwab',
        NULL,
        NULL,
        '公网安备',
        '介绍：页面底部显示公网安备备案号<br>
         示例：京公网安备11000002000001号'
    );
    $cat_gwab->setAttribute('class', 'typecho-option cat_basic');
    $form->addInput($cat_gwab);
    $cat_menu_mood = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_menu_mood',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '页面左侧——侧栏心情 / 状态展示',
        '介绍：左侧侧栏头像是否显示近期心情 / 状态，为最新一篇日记的心情 / 状态'
    );
    $cat_menu_mood->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_menu_mood->multiMode());
    $cat_user_menu = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_user_menu',
        null,
        null,
        '页面左侧——侧栏自定义按钮',
        '简介：此处填写自定义按钮的样式，链接和说明，一行一个，中间使用 || 分隔<br>
         说明：第一个位置，填写喜爱的图标代码或<a href="https://www.emojidaquan.com/" target="_blank"> Emoji </a>符号，默认使用<a href="https://remixicon.com/" target="_blank"> Remixicon </a>图标库。如 ri-subway-line 或 🚇<br>
            &emsp;&emsp;&emsp;第二个位置，填写页面链接地址，外链开头为 “ https:// ”，内链开头为 “ / ”。如 https://travellings.link/ 或 /cat_diary.html <br>
            &emsp;&emsp;&emsp;第二个位置，填写光标悬浮显示提示文字，不填写则会显示页面标题。如 开往<br>
         示例：ri-subway-line || https://travellings.link/ || 开往<br>
            &emsp;&emsp;&emsp;📔 || /cat_diary.html || 日记<br>
            &emsp;&emsp;&emsp;📔 || /index.php/cat_diary.html || 日记'
    );
    $cat_user_menu->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_user_menu);
    $cat_musicmode = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_musicmode',
        array(
            'zero' => '关闭按钮',
            'one' => '网易云一键播放',
            'two' => '网易云单曲弹窗',
            'three' => '网易云列表弹窗',
            'qqtwo' => 'QQ音乐单曲弹窗',
            'qqthree' => 'QQ音乐列表弹窗',
            'qqfour' => 'QQ音乐专辑弹窗'
        ),
        'zero',
        '<span style="color:green;">页面左侧——音乐显示模式</span>',
        '介绍：若填写了上方的“音乐播放列表”，此处可以选择音乐按钮的模式。'
    );
    $cat_musicmode->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_musicmode->multiMode());
    $cat_musiclist_one = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_musiclist_one',
        NULL,
        NULL,
        '<span style="color:green;">页面左侧——音乐播放列表</span>',
        '介绍：侧栏自定义音乐播放列表<br>
         说明：每行一个网易云音乐id，音乐将会随机播放<br>
         注意：不填写则不显示按钮<br>'
    );
    $cat_musiclist_one->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_musiclist_one);
    $cat_musiclist_three = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_musiclist_three',
        NULL,
        NULL,
        '<span style="color:green;">页面左侧——音乐播放列表</span>',
        '介绍：侧栏自定义音乐播放列表<br>
         说明：请填写网易云歌单的id值（可能不支持个人歌单）<br>
         注意：不填写则不显示按钮<br>'
    );
    $cat_musiclist_three->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_musiclist_three);
    $cat_musiclist_qqtwo = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_musiclist_qqtwo',
        NULL,
        NULL,
        '<span style="color:green;">页面左侧——音乐播放列表</span>',
        '介绍：侧栏自定义音乐播放列表<br>
         说明：每行一个QQ音乐id，音乐将会随机播放<br>
         注意：不填写则不显示按钮<br>'
    );
    $cat_musiclist_qqtwo->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_musiclist_qqtwo);
    $cat_musiclist_qqthree = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_musiclist_qqthree',
        NULL,
        NULL,
        '<span style="color:green;">页面左侧——音乐播放列表</span>',
        '介绍：侧栏自定义音乐播放列表<br>
         说明：请填写QQ音乐歌单的id值（音乐地址栏含playlist字样）<br>
         注意：不填写则不显示按钮<br>'
    );
    $cat_musiclist_qqthree->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_musiclist_qqthree);
    $cat_musiclist_qqfour = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_musiclist_qqfour',
        NULL,
        NULL,
        '<span style="color:green;">页面左侧——音乐播放列表</span>',
        '介绍：侧栏自定义音乐播放列表<br>
         说明：请填写QQ音乐歌单的id值（音乐地址栏含albumDetail字样）<br>
         注意：不填写则不显示按钮<br>'
    );
    $cat_musiclist_qqfour->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_musiclist_qqfour);
    $cat_darkmode = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_darkmode',
        array(
            'auto' => '自动切换',
            'day' => '朝阳',
            'star' => '星光',
            'night' => '静夜'
        ),
        'auto',
        '页面左侧——昼夜模式显示',
        '介绍：可自定义昼夜模式默认显示样式。<br>
         自动切换：默认是按照当地时间，18:00至22:00为星光模式，22:00至次日5:00为静夜模式，5:00至6:00为星光模式，6:00至18:00为朝阳模式。<br>
         手动切换：如果访客点击了左下角的模式切换按钮，即在点击按钮三小时之内，以访客所选择的模式为准。超过三个小时恢复时间切换模式。'
    );
    $cat_darkmode->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_darkmode->multiMode());
    $cat_menu_foot_allchoose = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'cat_menu_foot_allchoose',
        [
            'quanping'  => '显示“全屏”按钮',
            'fanyi'     => '显示“繁简转换”按钮'
        ],
        ['quanping', 'fanyi'],
        '页面右侧——侧栏默认按钮显示开关（全局）'
    );
    $cat_menu_foot_allchoose->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_menu_foot_allchoose->multiMode());
    $cat_user_addr = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_user_addr',
        NULL,
        NULL,
        '用户页面地址',
        '介绍：填写用户页面的地址<br>
         说明：首页右侧用户头像按钮点击即访问的用户页面。不填则此按钮不会跳转'
    );
    $cat_user_addr->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_user_addr);
    $cat_menu_foot_indexchoose = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'cat_menu_foot_indexchoose',
        [
            'category'  => '显示“文章分类”按钮（已存在于文章页面）',
            'search'    => '显示“文章搜索”按钮（已存在于文章页面）',
            'email'     => '显示“电子邮箱”按钮',
            'dashang'   => '显示“打赏”按钮（已存在于文章内面）'
        ],
        ['category', 'search', 'email', 'dashang'],
        '页面右侧——侧栏默认按钮显示开关（主页）'
    );
    $cat_menu_foot_indexchoose->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_menu_foot_indexchoose->multiMode());
    $cat_user_footer_indexmenu = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_user_footer_indexmenu',
        null,
        null,
        '页面右侧——侧栏自定义按钮（主页）',
        '简介：此处填写自定义按钮的样式，链接和说明，一行一个，中间使用 || 分隔<br>
         说明：同“左侧侧栏自定义按钮”的说明<br>
         示例：ri-mail-line || mailto:admin@dorcandy.cn || 电子邮件'
    );
    $cat_user_footer_indexmenu->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_user_footer_indexmenu);
    $cat_float_title = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_float_title',
        array(
            'off' => '底部（默认）',
            'on' => '顶部'
        ),
        'off',
        '浮动标题栏显示位置',
        '介绍：浮动标题栏显示的位置'
    );
    $cat_float_title->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_float_title->multiMode());
    $cat_footer_upyun = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_footer_upyun',
        array(
            'off' => '不显示（默认）',
            'on' => '显示'
        ),
        'off',
        '页面底部——网站已加入又拍云联盟',
        '介绍：网站如果已加入又拍云联盟，则开启此项会在底部显示预设内容。'
    );
    $cat_footer_upyun->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_footer_upyun->multiMode());
    $cat_footer_icon = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_footer_icon',
        null,
        null,
        '页面底部——自定义图标按钮',
        '简介：此处填写自定义按钮的样式，链接和说明，一行一个，中间使用 || 分隔<br>
         说明：图标样式可填写&lt;img&gt;，&lt;svg&gt;或&lt;i&gt;标签（其中&lt;i&gt;标签为remax图标）<br>
         示例：&lt;i class="ri-rss-fill"&gt;&lt;/i&gt; || /feed || RSS订阅'
    );
    $cat_footer_icon->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_footer_icon);
    $cat_user_footinfo = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_user_footinfo',
        NULL,
        NULL,
        '页面底部——自定义footer信息。',
        '介绍：可在页面底部添加一行自定义内容，支持html标签。<br>
         其他：不填则不显示。'
    );
    $cat_user_footinfo->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_user_footinfo);
    $cat_copyright = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_copyright',
        array(
            'off' => '显示（默认）',
            'on' => '隐藏'
        ),
        'off',
        '页面底部——主题版权信息',
        '介绍：是否关闭页底主题版权信息，喵喵希望不要关闭，让更多人知晓这个主题😣。'
    );
    $cat_copyright->setAttribute('class', 'typecho-option cat_menu');
    $form->addInput($cat_copyright->multiMode());
    $cat_IndexBackgroundSwitch = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_IndexBackgroundSwitch',
        array(
            'image' => '显示图片（默认）',
            'video' => '显示视频',
            'pics' => '显示幻灯片'
        ),
        'image',
        '开屏显示模式',
        '介绍：可以选择想要的首页开屏样式'
    );
    $cat_IndexBackgroundSwitch->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_IndexBackgroundSwitch->multiMode());
    $cat_IndexBackgroundImage = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_IndexBackgroundImage',
        NULL,
        NULL,
        '开屏显示——图片背景',
        '介绍：请输入需要显示的背景图<br>
         说明：若想多图显示可使用api图片地址'
    );
    $cat_IndexBackgroundImage->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_IndexBackgroundImage);
    $cat_IndexBackgroundVideo = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_IndexBackgroundVideo',
        NULL,
        NULL,
        '开屏显示——视频背景',
        '介绍：请输入需要显示的背景视频<br>
         说明：若想多图显示可使用api视频地址'
    );
    $cat_IndexBackgroundVideo->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_IndexBackgroundVideo);
    $cat_IndexBackgroundPics = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_IndexBackgroundPics',
        null,
        null,
        '开屏显示——幻灯片背景',
        '介绍：用于显示首页轮播图，格式为：图片地址 || 跳转链接 || 标题 （中间使用两个竖杠分隔）<br>
         例如：<br>
         https://api.dorcandy.cn/img/api-mc.php || https://baike.baidu.com/item/七濑胡桃 || 可爱的七濑胡桃<br>
         /usr/themes/MyDiary/screenshot.png || https://www.mmbkz.cn/mydiary.html || 本站使用MyDiary主题'
    );
    $cat_IndexBackgroundPics->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_IndexBackgroundPics);
    $cat_IndexDescription = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_IndexDescription',
        null,
        null,
        '标题文字',
        '介绍：首页显示的标题文字<br>
         注意：一行一句话，随机显示，不填写则会调用网站名称'
    );
    $cat_IndexDescription->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_IndexDescription);
    $user_webdesc = new Typecho_Widget_Helper_Form_Element_Textarea(
        'user_webdesc',
        NULL,
        NULL,
        '描述短语',
        '介绍：首页显示的描述短语，位于标题文字下方<br>
         说明：一行一句话，随机显示，不输入则显示网站描述'
    );
    $user_webdesc->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($user_webdesc);
    $cat_notice = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_notice',
        NULL,
        NULL,
        '滚动文本框（公告）',
        '介绍：首页显示的滚动文本框，可以用作小站公告，需结合页面模板使用，请输入用作公告页面的slug名（缩略名）。<br>
         说明：具体使用方法可参看【<a href="https://flowus.cn/dorcandy/share/54742724-a9a4-43f3-823a-f7a01e988453" target="_blank">这里</a>】。显示在封面下方，不输入则不显示。'
    );
    $cat_notice->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_notice);
    $cat_diary_slug = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_diary_slug',
        NULL,
        NULL,
        '首页显示日记的页面选择',
        '介绍：填写日记页面的slug名<br>
         说明：slug即页面编辑的地址栏黄色的需要手填的地方。'
    );
    $cat_diary_slug->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_diary_slug);
    $cat_IndexTopPost = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_IndexTopPost',
        NULL,
        NULL,
        '置顶文章',
        '介绍：请输入想置顶的文章的cid，<span style="color:red;">限制两篇</span>。不填则会显示阅读量最高的两篇<br>
         说明：输入文章的cid，用 || 分隔<br>
         格式：cid || cid'
    );
    $cat_IndexTopPost->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_IndexTopPost);
    $cat_hotpost = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_hotpost',
        array(
            'off' => '浏览量（默认）',
            'zan' => '点赞数',
            'ping' => '评论数',
            'user' => '自定义推荐'
        ),
        'off',
        '热门文章',
        '介绍：首页的六篇热门文章的排列依据。可选择自定义推荐文章。'
    );
    $cat_hotpost->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_hotpost->multiMode());
    $cat_hotpost_user = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_hotpost_user',
        NULL,
        NULL,
        '自定义推荐文章',
        '介绍：若上方热门文章选择自定义推荐，则请在此处填写自定义文章的cid<br>
         说明：输入文章的cid，用 || 分隔，为达到完美的显示效果，推荐填写六篇。<br>
         格式：cid || cid || cid || cid || cid || cid'
    );
    $cat_hotpost_user->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_hotpost_user);
    $cat_Indexcardsay_news = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_Indexcardsay_news',
        array(
            'off' => '关闭（默认）',
            'anime' => '动漫语录',
            'poem' => '经典诗词',
            'famous' => '名人名言',
            'user' => '自定义一言'
        ),
        'off',
        '随机一言',
        '介绍：首页日记卡片图片下随机的一句话'
    );
    $cat_Indexcardsay_news->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_Indexcardsay_news->multiMode());
    $cat_Indexcardsay_user = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_Indexcardsay_user',
        null,
        null,
        '自定义一言',
        '介绍：如果上方选择“自定义一言”，则此项生效 <br>
         注意：每行一句话'
    );
    $cat_Indexcardsay_user->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_Indexcardsay_user);
    $cat_Indexcardimg_news = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_Indexcardimg_news',
        array(
            'off' => '必应每日壁纸（默认）',
            'on' => '每日彩色卡',
            'pics' => '自定义幻灯片'
        ),
        'off',
        '首页焦点卡片——图片',
        '介绍：焦点卡片的图片内容。使用“每日彩色卡”若想换图，请自行替换“/img/weeks”目录下图片，并使文件名保持一致。'
    );
    $cat_Indexcardimg_news->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_Indexcardimg_news->multiMode());
    $cat_Indexcardimg_news_pics = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_Indexcardimg_news_pics',
        null,
        null,
        '首页焦点卡片——自定义幻灯片内容',
        '介绍：需上方选项已选择显示为幻灯片选项。格式为：图片地址 || 跳转链接 || 标题 （中间使用两个竖杠分隔）<br>
         其他：一行一条<br>
         例如：<br>
         https://api.dorcandy.cn/img/api-mc.php || https://baike.baidu.com/item/七濑胡桃 || 可爱的七濑胡桃<br>
         /usr/themes/MyDiary/screenshot.png || https://www.mmbkz.cn/mydiary.html || 本站使用MyDiary主题'
    );
    $cat_Indexcardimg_news_pics->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_Indexcardimg_news_pics);
    $cat_Indexcardaddr_news = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_Indexcardaddr_news',
        NULL,
        NULL,
        '首页焦点卡片——内容',
        '介绍：请输入首页焦点卡片的rss订阅地址，不输入则展示本站最新文章列表。<br>
         示例：中新网新闻：https://www.chinanews.com.cn/rss/scroll-news.xml'
    );
    $cat_Indexcardaddr_news->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_Indexcardaddr_news);
    $cat_indexcard_welcome = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_indexcard_welcome',
        array(
            'off' => '隐藏（默认）',
            'on' => '显示'
        ),
        'off',
        '顶部卡片——欢迎卡片',
        '介绍：是否显示欢迎小卡片。'
    );
    $cat_indexcard_welcome->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_indexcard_welcome->multiMode());
    $cat_indexcard_muyu = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_indexcard_muyu',
        array(
            'off' => '隐藏（默认）',
            'on' => '显示'
        ),
        'off',
        '顶部卡片——电子木鱼'
    );
    $cat_indexcard_muyu->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_indexcard_muyu->multiMode());
    $cat_index_welove = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_index_welove',
        NULL,
        NULL,
        '顶部卡片——我们相恋啦',
        '介绍：主页显示的我们相恋啦卡片，请在此处填写：QQ号1 || QQ号2 || 纪念日期<br>
         注意：请在此处按照正确格式填写，请注意日期格式。不填写则不开启此卡片。<br>
         示例：10086 || 10010 || 2022/6/22'
    );
    $cat_index_welove->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_index_welove);
    $cat_index_countdownday = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_index_countdownday',
        NULL,
        NULL,
        '顶部卡片——倒数日',
        '介绍：主页显示的倒数日卡片，请在此处填写：事件类型 || 倒数日期<br>
         注意：请在此处按照正确格式填写，请注意日期格式。不填写则不开启此卡片。<br>
         示例：高考 || 2024/6/7'
    );
    $cat_index_countdownday->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_index_countdownday);
    $cat_index_ppt = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_index_ppt',
        NULL,
        NULL,
        '顶部卡片——幻灯片图片',
        '介绍：用于显示首页轮播图，格式为：图片地址 || 跳转链接（中间使用两个竖杠分隔）<br>
         其他：一行一个<br>
         例如：<br>
         https://api.dorcandy.cn/img/api-mc.php || https://baike.baidu.com/item/七濑胡桃<br>
         /usr/themes/MyDiary/screenshot.png || https://www.mmbkz.cn/mydiary.html'
    );
    $cat_index_ppt->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_index_ppt);
    $cat_Index_user_cards = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_Index_user_cards',
        NULL,
        NULL,
        '顶部卡片——自定义卡片',
        '介绍：可以自定义自己的卡片，每个卡片使用&lt;li&gt;标签包含，因此可以创建多个卡片。<br>
         示例：&lt;li&gt;&lt;a href="https://www.mmbkz.cn/mydiary.html" target="_blank"&gt;&lt;img src="/usr/themes/MyDiary/screenshot.png" style="width: 100%;height: 100%;border-radius: var(--radius);object-fit: cover;" alt="" /&gt;&lt;/a&gt;&lt;/li&gt;'
    );
    $cat_Index_user_cards->setAttribute('class', 'typecho-option cat_index');
    $form->addInput($cat_Index_user_cards);
    $cat_Diary_img_model = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_Diary_img_model',
        array(
            'left' => '左侧（默认）',
            'top' => '顶部'
        ),
        'left',
        '日记页面——特色图片显示位置',
        '介绍：选择电脑端特色图片显示位置，手机端则默认显示在顶部'
    );
    $cat_Diary_img_model->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_Diary_img_model->multiMode());
    $cat_diary_weather = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_diary_weather',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '<span style="color:green;">日记页面——使用和风天气api</span>',
        '介绍：日记发布框自动填入天气信息'
    );
    $cat_diary_weather->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_diary_weather->multiMode());
    $cat_diary_weather_key = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_diary_weather_key',
        NULL,
        NULL,
        '<span style="color:green;">日记页面——和风天气——Key</span>',
        '介绍：请在此处填写和风天气key值<br>
         说明：请在登录和风天气开发者账号后，点击<a href="https://console.qweather.com/#/apps/create-app/create" target="_blank">【此处】</a>创建项目，将代码串中的key值填入此处。具体请点击<a href="https://flowus.cn/dorcandy/share/6717147b-05aa-47f2-b81b-92d6e3d1e6c7" target="_blank">【教程】</a>查看。<br>
         <span style="color:#E53333;">注意：还需填入下方的“日记&专题页面——个人位置坐标”选项则可使用此功能。</span>'
    );
    $cat_diary_weather_key->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_diary_weather_key);
    $cat_map_key3 = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_map_key3',
        NULL,
        NULL,
        '<span style="color:green;">日记</span>&专题页面——个人位置坐标',
        '介绍：请输入高德地图个人位置坐标<br>
         注意：此处请填写地理位置坐标，可在【<a href="https://lbs.amap.com/tools/picker" target="_blank">此处</a>】选取目的地坐标<br>
         其他：此处会结合使用和风天气api，自动获取天气信息，并会在专题页面——旅行页面上方地图显示个人坐在位置，不填则不显示。<br>
         示例：121.613741,38.899769'
    );
    $cat_map_key3->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_map_key3);
    $cat_map_key1 = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_map_key1',
        NULL,
        NULL,
        '专题页面——旅行页面——Key',
        '介绍：请输入高德地图Web端api的Key<br>
         注意：请在【<a href="https://lbs.amap.com/" target="_blank">此处</a>】申请高德地图API的Key和安全密钥，绑定服务类型选择Web端。 <br>
         其他：与下方安全密钥同时填写即可展示旅行地图'
    );
    $cat_map_key1->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_map_key1);
    $cat_map_key2 = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_map_key2',
        NULL,
        NULL,
        '专题页面——旅行页面——安全密钥',
        '介绍：请输入高德地图Web端api的安全密钥<br>
         注意：请在【<a href="https://lbs.amap.com/" target="_blank">此处</a>】申请高德地图API的Key和安全密钥，绑定服务类型选择Web端。 <br>
         其他：与上方Key同时填写即可展示旅行地图'
    );
    $cat_map_key2->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_map_key2);
    $cat_steamid = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_steamid',
        NULL,
        NULL,
        '专题页面——Steam页面——SteamID',
        '介绍：请输入 Steam 64位ID<br>
         注意：请在【<a href="https://steamdb.info/" target="_blank">此处</a>】查询SteamID，<span style="color:#E53333;">因steam被墙，开启此功能会使专题页面访问迟缓，可考虑修改下方steam加速cdn</span><br>
         其他：与下方key同时填写即可展示steam游戏页面'
    );
    $cat_steamid->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_steamid);
    $cat_steamkey = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_steamkey',
        NULL,
        NULL,
        '专题页面——Steam页面——SteamKey',
        '介绍：请输入 Steam 网页 API 密钥<br>
         注意：请在【<a href="https://steamcommunity.com/dev/apikey" target="_blank">此处</a>】申请steam密钥，<span style="color:#E53333;">因steam被墙，开启此功能会使专题页面访问迟缓，可考虑修改下方steam加速cdn</span><br>
         其他：与上方id同时填写即可展示steam游戏页面'
    );
    $cat_steamkey->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_steamkey);
    $cat_steamcdn = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_steamcdn',
        NULL,
        NULL,
        '专题页面——Steam页面——Steam加速cdn',
        '介绍：请输入 Steam加速cdn的地址<br>
         说明：因为steam访问困难，可在此处更换steam加速cdn。默认使用“ https://media.st.dl.eccdnx.com ”<br>
         参考：https://cdn.cloudflare.steamstatic.com<br>
               https://media.st.dl.eccdnx.com<br>
               https://steamcdn-a.akamaihd.net<br>
               https://media.st.dl.pinyuncloud.com<br>
               https://cdn.origin.steamstatic.com'
    );
    $cat_steamcdn->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_steamcdn);
    $cat_steam_updatetime = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_steam_updatetime',
        null,
        null,
        '专题页面——Steam页面——Steam页面缓存时间',
        '介绍：<span style="color:#E53333;">如果开启了steam页面，因每次从目标网站读取内容会耗费大量的系统资源，以及GFW的问题，所以在此处设置缓存时间来提升加载速度</span><br>
         示例：请填写秒数，默认值259200（3天）'
    );
    $cat_steam_updatetime->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_steam_updatetime);
    $cat_github = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_github',
        NULL,
        NULL,
        '专题页面——Github项目页面',
        '介绍：请输入 Github 账户 username<br>
         注意：填写即可展现“Github项目”页面，不填写则不展示（页面更新频率为一小时）'
    );
    $cat_github->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_github);
    $cat_bili = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_bili',
        NULL,
        NULL,
        '专题页面——番剧页面',
        '介绍：请输入 Bilibili 账户 uid<br>
         说明：填写即可展现“番剧”页面，不填写则不展示<br>
         注意：需公开bilibili追番追剧功能，<a href="https://flowus.cn/dorcandy/share/5b449f37-36c6-4a0b-99d8-ee80ea239eb6" target="_blank">参考这里</a>。另外追番请大于六部作品，否则专题主页可能不会显示图片'
    );
    $cat_bili->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_bili);
    $cat_Guestbook_top30 = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_Guestbook_top30',
        array(
            'off' => '关闭（默认）',
            'on' => '显示'
        ),
        'off',
        '留言板页面——显示留言排行榜',
        '介绍：留言页是否显示留言排行榜（请至少含有一条访客评论）'
    );
    $cat_Guestbook_top30->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_Guestbook_top30->multiMode());
    $cat_echarts_map = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_echarts_map',
        array(
            'off' => '关闭（默认）',
            'on' => '显示'
        ),
        'off',
        '统计页面——显示留言地图',
        '介绍：统计页面是否显示留言地图<br>
         <span style="color:#E53333;">注意：此功能需开启“评论者地理位置信息”，并选择“省份（推荐）”，其他项或未开启则此项无效。</span><br>
         　　　在窗口宽度小于750px时也会隐藏。'
    );
    $cat_echarts_map->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_echarts_map->multiMode());
    $cat_echarts_jianlong_id = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_echarts_jianlong_id',
        NULL,
        NULL,
        '统计页面——UptimeRobot Api Keys',
        '介绍：支持 Monitor-Specific 和 Read-Only 两只 Api Key，可在<a href="https://uptimerobot.com/" target="_blank">UptimeRobot官网</a>申请key。<br>
         注意：不填写则不生效'
    );
    $cat_echarts_jianlong_id->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_echarts_jianlong_id);
    $cat_echarts_jianlong_days = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_echarts_jianlong_days',
        NULL,
        NULL,
        '统计页面——UptimeRobot 检测天数',
        '介绍：可选30/60/90，默认30天，选择90天会使监控加载变慢。<br>
         注意：key不填写则此处不生效，建议为空'
    );
    $cat_echarts_jianlong_days->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_echarts_jianlong_days);
    $cat_category_muban = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_category_muban',
        NULL,
        NULL,
        '分类页面——使用时间轴模板的分类',
        '介绍：希望展示为时间轴的分类模板，填入分类的mid值。多个分类值之间使用“||”分隔。<br>
         示例：diary||riji'
    );
    $cat_category_muban->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_category_muban);
    $cat_postlist_simple = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_postlist_simple',
        array(
            'off' => '标准（默认）',
            'big' => '卡片',
            'on' => '列表'
        ),
        'off',
        '文章列表页面——卡片显示样式',
        '介绍：文章列表页面——卡片显示的样式（本功能对于使用时间轴模板的分类文章列表无效）。<br>
         注意：默认标准样式为电脑页面显示为列表样式，宽度小于750px则切换为卡片样式。'
    );
    $cat_postlist_simple->setAttribute('class', 'typecho-option cat_page');
    $form->addInput($cat_postlist_simple->multiMode());
    $post_overtime = new Typecho_Widget_Helper_Form_Element_Select(
        'post_overtime',
        array(
            'off' => '关闭（默认）',
            '3' => '大于3天',
            '7' => '大于7天',
            '15' => '大于15天',
            '30' => '大于30天',
            '60' => '大于60天',
            '90' => '大于90天',
            '120' => '大于120天',
            '180' => '大于180天'
        ),
        'off',
        '文章更新时间过期提示',
        '介绍：开启后如果文章在多少天内无任何修改，则进行提示'
    );
    $post_overtime->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($post_overtime->multiMode());
    $cat_post_title_ex = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_post_title_ex',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '文章标题处信息自动展开',
        '介绍：文章头部标题信息是否在页面加载完成时自动展开（展示为满屏大幅特色图片）'
    );
    $cat_post_title_ex->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_post_title_ex->multiMode());
    $cat_deepseek_modle = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_deepseek_modle',
        NULL,
        NULL,
        '<span style="color:brown;">模型名称</span>',
        '以DeepSeek为例：DeepSeek专用模型名称，示例：deepseek-chat'
    );
    $cat_deepseek_modle->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_deepseek_modle);
    $cat_deepseek_apikey = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_deepseek_apikey',
        NULL,
        NULL,
        '<span style="color:brown;">API Key</span>',
        '以DeepSeek为例：从DeepSeek控制台获取的API密钥'
    );
    $cat_deepseek_apikey->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_deepseek_apikey);
    $cat_deepseek_address = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_deepseek_address',
        NULL,
        NULL,
        '<span style="color:brown;">API基础地址</span>',
        '以DeepSeek为例：DeepSeek API基础地址，示例：https://api.deepseek.com/v1/chat/completions'
    );
    $cat_deepseek_address->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_deepseek_address);
    $cat_deepseek_length = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_deepseek_length',
        NULL,
        NULL,
        '<span style="color:brown;">摘要长度</span>',
        '说明：生成摘要的最大长度（中文字数）'
    );
    $cat_deepseek_length->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_deepseek_length);
    $cat_article_indent = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_article_indent',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '文章段落首行缩进',
        '介绍：段落首行是否缩进两格，仅影响文章正文'
    );
    $cat_article_indent->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_article_indent->multiMode());
    $cat_diary_indent = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_diary_indent',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '日记段落首行缩进',
        '介绍：段落首行是否缩进两格，仅影响日记页面'
    );
    $cat_diary_indent->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_diary_indent->multiMode());
    $cat_article_wordline = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_article_wordline',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '正文格式线',
        '介绍：段落正文是否显示格式线，会影响日记页面与文章正文'
    );
    $cat_article_wordline->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_article_wordline->multiMode());
    $cat_article_codetheme = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_article_codetheme',
        array(
            'theme_Default' => 'Default',
            'theme_Okaidia' => 'Okaidia',
            'theme_Coy' => 'Coy',
            'theme_SolarizedLight' => 'Solarized Light',
            'theme_TomorrowNight' => 'Tomorrow Night'
        ),
        'off',
        '代码高亮皮肤',
        '介绍：选择一款代码高亮皮肤。比如Solarized Light就很搭配“皮纸”皮肤哦~'
    );
    $cat_article_codetheme->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_article_codetheme->multiMode());
    $cat_article_firstletter = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_article_firstletter',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '正文首字下沉',
        '介绍：段落正文是否首字下沉，仅影响文章正文，建议不要和首行缩进与正文下划线功能同时开启（因为不好看）'
    );
    $cat_article_firstletter->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_article_firstletter->multiMode());
    $cat_post_album_text = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_post_album_text',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '正文内图片显示描述',
        '介绍：正文内图片下侧是否显示图片描述'
    );
    $cat_post_album_text->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_post_album_text->multiMode());
    $cat_article_end = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_article_end',
        null,
        null,
        '正文末尾自定义',
        '介绍：正文末尾自定义内容，可填写文章结束标识，或者广告信息，不填则不显示。'
    );
    $cat_article_end->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_article_end);
    $cat_article_bottom_info = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_article_bottom_info',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '文章底部显示文章信息',
        '介绍：文章底部是否显示相关文章信息，因为已经在文章封面展示了文章的相关信息，所以此处默认关闭。'
    );
    $cat_article_bottom_info->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_article_bottom_info->multiMode());
    $cat_article_correlation = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_article_correlation',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '文章底部显示相关文章',
        '介绍：文章底部是否显示相关文章推荐，至多显示四个。'
    );
    $cat_article_correlation->setAttribute('class', 'typecho-option cat_article');
    $form->addInput($cat_article_correlation->multiMode());
    echo '<div class="typecho-option cat_link" style="display: none;">';
    echo '<label class="typecho-label">友情链接说明</label>';
    echo '<div class="description">
            本主题使用文章订阅方式增加友链页面的丰富性，提供“传统”，“智能”，“订阅（RSS和Atom）”三种方式填写，每条友链可酌情任选一处填写即可<br>
            填写格式使用两种颜色区分。其中 <span style="background-color:#E56600;color:#FFFFFF;">&nbsp;必填&nbsp;</span><span style="background-color:#DFC5A4;color:#FFFFFF;"> 选填&nbsp;</span><br>
            邮箱作为友情链接的判断依据，可以在访客评论后面的卡片中标识为“<span style="background-color:#ff6a6a;color:#FFFFFF;">&nbsp;好友&nbsp;</span>”。<br>
            每次更改完友情链接的配置之后，请手动点击友情链接前台页面的右下方进行手动刷新；亦可待到达间隔时间进行自动刷新';
    echo '</div></div>';
    $cat_links_nofeed = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_links_nofeed',
        null,
        null,
        '友情链接(传统)',
        '介绍：可以在此处填写友情链接基本信息<br>
         注意：每行一个友链，考虑到自定义性质，头像不会使用邮箱头像，但考虑到评论者名片的显示，所以仍推荐为必填<br>
         格式：<span style="background-color:#E56600;color:#FFFFFF;">名称 || 链接 || 头像 || 描述</span><span style="background-color:#DFC5A4;color:#FFFFFF;"> || 邮箱</span>。<br>
         示例：火喵酱 || https://dorcandy.cn || https://www.mmbkz.cn/logo || 世人皆萌，唯我独帅！ || admin@dorcandy.cn'
    );
    $cat_links_nofeed->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_nofeed);
    $cat_links_auto = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_links_auto',
        null,
        null,
        '友情链接(智能)',
        '介绍：如果网站无网站基本信息，可在此处填写链接可智能获取网站信息（部分网站会获取不到）<br>
         注意：邮箱用来显示头像以及评论卡片，每行一个友链，若不填写邮箱，则会调用主题自带api获取网站favicon。<br>
         格式：<span style="background-color:#E56600;color:#FFFFFF;">网站地址</span><span style="background-color:#DFC5A4;color:#FFFFFF;"> || 邮箱</span><br>
         示例：https://dorcandy.cn/ || admin@dorcandy.cn'
    );
    $cat_links_auto->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_auto);
    $cat_links_rss = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_links_rss',
        null,
        'https://www.mmbkz.cn/feed || admin@dorcandy.cn',
        '友情链接(RSS)',
        '介绍：如果网站提供RSS，可以在此处填写RSS地址，以及好友邮箱。<br>
         注意：邮箱用来显示头像以及评论卡片，每行一个友链，若不填写邮箱，则会调用主题自带api获取网站favicon。<br>
         格式：<span style="background-color:#E56600;color:#FFFFFF;">RSS地址</span><span style="background-color:#DFC5A4;color:#FFFFFF;"> || 邮箱</span><br>
         示例：https://www.mmbkz.cn/feed || admin@dorcandy.cn'
    );
    $cat_links_rss->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_rss);
    $cat_links_atom = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_links_atom',
        null,
        null,
        '友情链接(Atom)',
        '介绍：如果网站提供Atom，可以在此处填写Atom地址，以及好友邮箱。<br>
         注意：邮箱用来显示头像以及评论卡片，每行一个友链，若不填写邮箱，则会调用主题自带api获取网站favicon。<br>
         格式：<span style="background-color:#E56600;color:#FFFFFF;">Atom地址</span><span style="background-color:#DFC5A4;color:#FFFFFF;"> || 邮箱</span><br>
         示例：https://www.mmbkz.cn/feed/atom || admin@dorcandy.cn'
    );
    $cat_links_atom->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_atom);
    $cat_links_updatetime = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_links_updatetime',
        null,
        null,
        '友情链接页面缓存更新时间',
        '介绍：<span style="color:#E53333;">如果使用了从feed获取友情链接信息，因每次从目标网站的feed读取内容会耗费大量的系统资源，所以在此处设置缓存时间来提升加载速度</span><br>
         示例：请填写秒数，默认值28800（8小时）'
    );
    $cat_links_updatetime->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_updatetime);
    $cat_links_duration = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_links_duration',
        null,
        null,
        '友情链接页面缓存刷新超时时间',
        '介绍：<span style="color:#E53333;">如果使用了从feed获取友情链接信息，刷新时页面时的超时时间。</span><br>
         注意：时间越短刷新越快，如果友情链接页面显示出现问题，请适当增大超时时间。<br>
                一般来说5秒即可。但是因为有的网站获取时间过长，可设置为40秒或50秒。<br>
         示例：请填写秒数，默认值30（30秒）'
    );
    $cat_links_duration->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_duration);
    $cat_links_random = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_links_random',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '友情链接随机排序',
        '介绍：是否使友情链接(RSS/Atom/通用)随机排序'
    );
    $cat_links_random->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_random->multiMode());
    $cat_links_showimg = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_links_showimg',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '友情链接显示网站截图',
        '介绍：友情链接是否使用wordpress接口显示网站截图（部分访问迟缓的站点可能会显示404图像）'
    );
    $cat_links_showimg->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_showimg->multiMode());
    $cat_links_nolink = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_links_nolink',
        null,
        null,
        '失联友情链接',
        '介绍：可单独填写失联的友情链接<br>
         注意：每行一个失联友链，不填写则不显示<br>
         格式：<span style="background-color:#E56600;color:#FFFFFF;">&nbsp;名称 || 链接&nbsp;</span><br>
         示例：火喵酱 || https://dorcandy.cn'
    );
    $cat_links_nolink->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_nolink);
    $cat_links_circle = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_links_circle',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '友链圈子',
        '介绍：是否开启友链圈子页面<br>
         说明：会依据使用了订阅方式（即通过RSS,Atom的方式）的友情链接内的订阅链接，自动按时间排序生成最新的圈子卡片页面。其他方式添加的友情链接不会在此页面显示'
    );
    $cat_links_circle->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_circle->multiMode());
    $cat_links_tenyears = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_links_tenyears',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '十年之约订阅',
        '介绍：是否打开十年之约订阅页面'
    );
    $cat_links_tenyears->setAttribute('class', 'typecho-option cat_link');
    $form->addInput($cat_links_tenyears->multiMode());
    $cat_comment_allow = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_comment_allow',
        array(
            'off' => '开启所有评论（默认）',
            'on' => '关闭所有评论'
        ),
        'off',
        '是否关闭所有评论',
        '介绍：将关闭所有页面的游客评论'
    );
    $cat_comment_allow->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_allow->multiMode());
    $cat_comment_placeholder = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_comment_placeholder',
        NULL,
        NULL,
        '自定义评论框内提示文字',
        '介绍：单行文字，不可带html标签'
    );
    $cat_comment_placeholder->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_placeholder);
    $cat_comment_levelcardname = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_comment_levelcardname',
        NULL,
        NULL,
        '自定义评论者等级卡片名称',
        '介绍：根据评论数量，设计标准为：<br>
         Lv.0（< 3条）<br>
         lv.1（3 - 10条）<br>
         lv.2（11 - 20条）<br>
         lv.3（21 - 40条）<br>
         lv.4（41 - 80条）<br>
         lv.5（80 - 120条）<br>
         lv.6（120 - 160条）<br>
         lv.7（160 - 200条）<br>
         lv.8（200 - 250条）<br>
         lv.9（250 - 300条）<br>
         lv.10（> 300条）<br>
         如不填写则默认不显示评论者等级<br>
         格式为：新人 || Lv.1 || Lv.2 || Lv.3 || Lv.4 || Lv.5 || Lv.6 || Lv.7 || Lv.8 || Lv.9 || 贵宾'
    );
    $cat_comment_levelcardname->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_levelcardname);
    $cat_comment_catlevelcardname = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_comment_catlevelcardname',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '博主等级卡片显示',
        '介绍：是否显示博主等级卡片，毕竟是博主嘛，显示太多也没啥用'
    );
    $cat_comment_catlevelcardname->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_catlevelcardname->multiMode());
    $cat_comment_UA = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_comment_UA',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '评论者UA信息',
        '介绍：是否显示评论者操作系统版本以及浏览器版本信息（日记页面不会显示）。'
    );
    $cat_comment_UA->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_UA->multiMode());
    $cat_comment_IP = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_comment_IP',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '<span style="color:green;">评论者地理位置信息</span>',
        '介绍：是否显示评论者的地理位置信息。'
    );
    $cat_comment_IP->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_IP->multiMode());
    $cat_comment_ip_api = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_comment_ip_api',
        NULL,
        NULL,
        '<span style="color:green;">高德地图Web服务KEY值</span>',
        '请在此处填写高德地图Web服务KEY值，则可开启评论者地理位置信息，不填写则评论者地理位置信息不生效。'
    );
    $cat_comment_ip_api->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_ip_api);
    $cat_comment_place = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_comment_place',
        array(
            'province' => '省份（默认）',
            'city' => '城市',
            'both' => '省份+城市'
        ),
        'province',
        '<span style="color:green;">地理位置显示内容</span>',
        '介绍：选择要显示的评论者地理位置信息（日记页面不会显示）。<br>
         注意：若此项变更，则之前已经录入的信息不会改变，仅会对之后的显示信息生效。'
    );
    $cat_comment_place->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_place->multiMode());
    $cat_comment_needchinese = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_comment_needchinese',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '评论至少包含一个中文',
        '介绍：开启后如果评论内容未包含一个中文，则将会把评论置为审核状态<br>
         可有效屏蔽国外机器人刷的全英文垃圾广告信息'
    );
    $cat_comment_needchinese->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_needchinese->multiMode());
    $cat_comment_banword = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_comment_banword',
        NULL,
        NULL,
        '评论敏感词',
        '介绍：用于设置评论敏感词汇，如果用户评论包含这些词汇，则将会把评论置为垃圾评论（若已经触发上方“评论至少包含一个中文”并被设置成审核状态，则会进一步升级为垃圾评论），使用 || 分隔'
    );
    $cat_comment_banword->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_banword);
    $cat_comment_forbidword = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_comment_forbidword',
        NULL,
        NULL,
        '评论禁用词',
        '介绍：用于设置评论禁用词汇，如果用户评论包含这些词汇，则该评论无法发表（若已经触发上方“评论敏感词”并被设置成垃圾评论，则会进一步使该评论失效），使用 || 分隔'
    );
    $cat_comment_forbidword->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_forbidword);
    $cat_comment_IMGcode = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_comment_IMGcode',
        NULL,
        NULL,
        '<span style="color:red;">评论区插入图片关键词设置！</span>',
        '介绍：为了防止图片XSS攻击，评论区禁止访问者发送图片。但是对于博主，可以设置图片代码，个人使用发送图片，以免被访问者使用，造成XSS隐患<br>
         使用：设置几个字母，会替换评论区默认图片短代码。如填写“XXX”，点击图片按钮则显示 {XXX}图片地址{/XXX}。默认值为：IMG'
    );
    $cat_comment_IMGcode->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_IMGcode);
    $cat_comment_IMG_user = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_comment_IMG_user',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '<span style="color:red;">开启访问者评论使用图片的权限！</span>',
        '介绍：访问者留言是否开启图片功能（不建议开启）'
    );
    $cat_comment_IMG_user->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_comment_IMG_user->multiMode());
    $cat_email_switch = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_email_switch',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '<span style="color:green;">是否开启评论邮件通知</span>',
        '介绍：开启后评论内容将会进行邮箱通知<br>
         注意：此项需要您完整无错的填写下方的邮箱设置'
    );
    $cat_email_switch->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_email_switch->multiMode());
    $cat_email_pic = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_email_pic',
        NULL,
        NULL,
        '<span style="color:green;">邮件通知模板图片自定义</span>',
        '填入一张图片的url，不填则默认使用一张薇尔莉特·伊芙加登的图片。'
    );
    $cat_email_pic->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_email_pic);
    $cat_email_host = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_email_host',
        NULL,
        NULL,
        '<span style="color:green;">邮箱服务器地址</span>',
        '例如：smtp.qq.com'
    );
    $cat_email_host->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_email_host);
    $cat_email_ssl = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_email_ssl',
        array(
            'ssl' => 'ssl（默认）',
            'tsl' => 'tsl'
        ),
        'ssl',
        '<span style="color:green;">邮箱服务器加密方式</span>',
        '介绍：用于选择登录鉴权加密方式'
    );
    $cat_email_ssl->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_email_ssl->multiMode());
    $cat_email_port = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_email_port',
        NULL,
        NULL,
        '<span style="color:green;">邮箱服务器端口号</span>',
        '例如：465'
    );
    $cat_email_port->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_email_port);
    $cat_email_nickname = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_email_nickname',
        NULL,
        NULL,
        '<span style="color:green;">发件人昵称</span>',
        '例如：火喵酱'
    );
    $cat_email_nickname->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_email_nickname);
    $cat_email_sendmail = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_email_sendmail',
        NULL,
        NULL,
        '<span style="color:green;">发件人邮箱</span>',
        '例如：10010@qq.com'
    );
    $cat_email_sendmail->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_email_sendmail);
    $cat_email_password = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_email_password',
        NULL,
        NULL,
        '<span style="color:green;">邮箱授权码</span>',
        '介绍：这里填写的是邮箱生成的授权码 <br>
         例如QQ邮箱 > 设置 > 账户 > IMAP/SMTP服务 > 开启'
    );
    $cat_email_password->setAttribute('class', 'typecho-option cat_comment');
    $form->addInput($cat_email_password);
    $cat_welcome_switch = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_welcome_switch',
        array(
            'off' => '关闭（默认）',
            'once' => '仅首次访问',
            'day' => '一天一次',
            'week' => '一周一次'
        ),
        'off',
        '<span style="color:green;">弹窗公告</span>',
        '介绍：设置弹窗公告出现频率'
    );
    $cat_welcome_switch->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_welcome_switch->multiMode());
    $cat_welcome_user = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_welcome_user',
        NULL,
        NULL,
        '<span style="color:green;">弹窗公告的内容</span>',
        '介绍：可以选填弹窗公告的内容，内容不宜过多，可使用html标签'
    );
    $cat_welcome_user->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_welcome_user);
    $cat_welcome_foreverblog = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_welcome_foreverblog',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '“虫洞”访客欢迎语',
        '介绍：是否启用“虫洞”访客欢迎语，凡加入十年之约，并通过虫洞穿梭至此的用户，都会收到欢迎提示语<br>
         项目：https://www.foreverblog.cn/'
    );
    $cat_welcome_foreverblog->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_welcome_foreverblog->multiMode());
    $cat_welcome_travellings = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_welcome_travellings',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '“开往”访客欢迎语',
        '介绍：是否启用“开往”访客欢迎语，凡加入开往，并通过开往穿梭至此的用户，都会收到欢迎提示语<br>
         项目：https://github.com/travellings-link/travellings'
    );
    $cat_welcome_travellings->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_welcome_travellings->multiMode());
    $cat_bili_choose = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_bili_choose',
        array(
            'off' => '原生（默认）',
            'html5' => '原生(html5)',
            'on' => '高清(本地)',
            'office' => '高清（官方）'
        ),
        'off',
        '哔哩哔哩视频解析',
        '介绍：哔哩哔哩视频解析方式。<br>
         原生：直接使用官方iframe框架，清晰度只有360p，但是稳定。<br>
         高清：使用本地高清解析，可以自定义清晰度。<br>
         官方：官方线路为测试用。'
    );
    $cat_bili_choose->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_bili_choose->multiMode());
    $cat_resource_cdn = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_resource_cdn',
        NULL,
        NULL,
        '静态资源自定义cdn加速',
        '介绍：因本主题资源全部本地化，为了提升速度优化访问，可在此处填入自定义的cdn地址。这将自动屏蔽部分本地资源，并使用CDN地址。<br>
         步骤：需要自行将主题目录下<span style="color:#FFFFFF;background-color:#CCCCCC;">&nbsp;resource&nbsp;</span>目录整体上传至你的CDN服务器，在此处填入你的CDN服务器目录地址，并确保资源可以访问到。<br>
         <span style="color:red;">注意：每次更新完主题，需要重新更新CDN资源，并刷新CDN缓存。</span><br>
         备注：如果使用此功能，发现图标显示为方块，请手动添加cdn HTTP响应头配置以解决跨域问题。对象存储可参照<a href="https://cloud.tencent.com/document/product/436/13318">腾讯cos官方的说明文档</a>'
    );
    $cat_resource_cdn->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_resource_cdn);
    $cat_diary_rss = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_diary_rss',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '日记RSS功能',
        '介绍：是否开启日记页面的RSS功能'
    );
    $cat_diary_rss->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_diary_rss->multiMode());
    $cat_html_compress = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_html_compress',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        'Html压缩',
        '介绍：是否开启整站html压缩，提升加载速度'
    );
    $cat_html_compress->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_html_compress->multiMode());
    $cat_static_index = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_static_index',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '<span style="color:red;">首页静态化！</span>',
        '介绍：是否开启首页静态化，提升加载速度<br>
         <span style="color:red;">！！！注意：若开启选项，请将网站默认文档从“index.php”改成“index.html”，关闭则反之。</span>默认缓存十分钟。<br>
         <span style="color:red;">！！！注意：本功能可能会引发不必要的麻烦，不建议开启。</span>'
    );
    $cat_static_index->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_static_index->multiMode());
    $cat_pjax_callback = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_pjax_callback',
        NULL,
        NULL,
        'pjax回调函数',
        '介绍：请填写pjax回调函数'
    );
    $cat_pjax_callback->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_pjax_callback);
    $cat_pwa_switch = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_pwa_switch',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '<span style="color:green;">开启网站PWA功能</span>',
        '介绍：是否开启网站的PWA功能，会在左侧栏添加安装应用按钮。'
    );
    $cat_pwa_switch->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_pwa_switch->multiMode());
    $cat_pwa_image = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_pwa_image',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '<span style="color:green;">PWA缓存用——图片</span>',
        '介绍：是否开启网站的PWA缓存图片功能，有效期7天，节省带宽资源，提升加载速度。<br>
         支援的格式为：jpg、png、gif、apng、svg、webp'
    );
    $cat_pwa_image->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_pwa_image->multiMode());
    $cat_pwa_media = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_pwa_media',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '<span style="color:green;">PWA缓存用——媒体</span>',
        '介绍：是否开启网站的PWA缓存媒体功能，有效期7天，节省带宽资源，提升加载速度。<br>
         支援的格式为：mp4、m3u8、webm'
    );
    $cat_pwa_media->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_pwa_media->multiMode());
    $cat_pwa_cdn = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_pwa_cdn',
        NULL,
        NULL,
        '<span style="color:green;">PWA缓存用——自用cdn</span>',
        '介绍：若开启网站的PWA功能，可在此处填写自用的cdn地址（尾部带/），来支援workbox缓存，减少cdn流量<br>
         注意：没有或者不需要请为空。'
    );
    $cat_pwa_cdn->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_pwa_cdn);
    $cat_ban_mouseleft = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_ban_mouseleft',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '屏蔽鼠标左键选中',
        '介绍：是否屏蔽鼠标左键选中文字功能，若开启可使页面文字内容不可选择。'
    );
    $cat_ban_mouseleft->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_ban_mouseleft->multiMode());
    $cat_ban_mouseright = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_ban_mouseright',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '屏蔽鼠标右键菜单',
        '介绍：是否屏蔽鼠标右键菜单。'
    );
    $cat_ban_mouseright->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_ban_mouseright->multiMode());
    $cat_ban_f12 = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_ban_f12',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '屏蔽控制台',
        '介绍：是否开启屏蔽控制台功能。<br>
         说明：若想自定义屏蔽警示页面的内容，请手动修改api/ban.html内的body标签内的内容，其他代码请勿修改。'
    );
    $cat_ban_f12->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_ban_f12->multiMode());
    $cat_ban_viewsource = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_ban_viewsource',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '屏蔽源码查看快捷键',
        '介绍：是否屏蔽源码查看快捷键，即Ctrl+U。'
    );
    $cat_ban_viewsource->setAttribute('class', 'typecho-option cat_effect');
    $form->addInput($cat_ban_viewsource->multiMode());
    $cat_style_choose = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_style_choose',
        array(
            'fat' => '自适应全宽（默认）',
            'thin' => '单栏'
        ),
        'fat',
        '布局风格选择',
        '介绍：可以选择一种布局风格'
    );
    $cat_style_choose->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_style_choose->multiMode());
    $cat_skin_choose = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_skin_choose',
        array(
            'off' => '轻磨（默认）',
            'parchment' => '羊皮卷',
            'puzzle' => '纸片'
        ),
        'off',
        '<span style="color:green;">主题皮肤选择</span>',
        '介绍：可以选择一款主题'
    );
    $cat_skin_choose->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_skin_choose->multiMode());
    $cat_qingmo_background_choose = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_qingmo_background_choose',
        array(
            'off' => '冬',
            'summer' => '夏',
            'spring' => '春',
            'autumn' => '秋',
            'img' => '图'
        ),
        'off',
        '<span style="color:green;">轻磨主题——背景风格选择</span>',
        '介绍：主题皮肤选择为轻磨主题时，可以自选背景风格。若选择为背景图时，请填写好下方背景图地址。'
    );
    $cat_qingmo_background_choose->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_qingmo_background_choose->multiMode());
    $cat_defaultBackgroundImage = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_defaultBackgroundImage',
        NULL,
        NULL,
        '<span style="color:green;">轻磨主题——自定义背景图</span>',
        '介绍：请输入图片地址。<br>
         说明：建议搭配单栏布局风格，以使壁纸得到良好的展示。<br>
        　　　若想显示无缝平铺图片，请手动填写自定义css样式定义body::before。'
    );
    $cat_defaultBackgroundImage->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_defaultBackgroundImage);
    $user_themecolor = new Typecho_Widget_Helper_Form_Element_Text(
        'user_themecolor',
        NULL,
        NULL,
        '自定义主题色',
        '介绍：可以选择一种自定义主题色（六位字符不要带透明度）<br>
         说明：开头需带 “ # ” ，默认主题色为 #ff6a6a'
    );
    $user_themecolor->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($user_themecolor);
    $cat_defaultImage = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_defaultImage',
        NULL,
        NULL,
        '自定义默认图（缩略图）',
        '介绍：请输入图片地址，不输入则使用默认来自Hippopx的九张精选无版权图片<br>
         说明：可以一行一张图，且支持api图片地址，不会显示同一张图片。'
    );
    $cat_defaultImage->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_defaultImage);
    $cat_defaultImage_diary = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_defaultImage_diary',
        NULL,
        NULL,
        '日记页面自定义初始默认图',
        '介绍：请输入图片地址，不输入则使用自定义默认图设置。（如想修改日记页面头部图片，请在日记页面的后台“页面编辑”页面中，添加特色图片）'
    );
    $cat_defaultImage_diary->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_defaultImage_diary);
    $cat_z_0 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_0',NULL,NULL,'页面头部图片（文章列表、标签、分类、搜索页）','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_0->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_0);
    $cat_z_1 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_1',NULL,NULL,'专题页面--文集页--头部图片','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_1->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_1);
    $cat_z_2 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_2',NULL,NULL,'专题页面--相册页--头部图片','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_2->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_2);
    $cat_z_3 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_3',NULL,NULL,'专题页面--书籍页--头部图片','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_3->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_3);
    $cat_z_4 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_4',NULL,NULL,'专题页面--音乐页--头部图片','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_4->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_4);
    $cat_z_5 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_5',NULL,NULL,'专题页面--电影页--头部图片','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_5->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_5);
    $cat_z_6 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_6',NULL,NULL,'专题页面--游戏页--头部图片','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_6->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_6);
    $cat_z_7 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_7',NULL,NULL,'专题页面--番剧页--头部图片','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_7->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_7);
    $cat_z_8 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_8',NULL,NULL,'专题页面--项目页--头部图片','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_8->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_8);
    $cat_z_9 = new Typecho_Widget_Helper_Form_Element_Text('cat_z_9',NULL,NULL,'专题页面--Steam页--头部图片','介绍：请输入图片地址，不输入则使用自定义默认图设置。');
    $cat_z_9->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_z_9);
    $cat_Lazyload = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_Lazyload',
        null,
        null,
        '自定义懒加载图',
        '介绍：输入图片地址，推荐小体积动态图片'
    );
    $cat_Lazyload->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_Lazyload);
    $user_fonturl = new Typecho_Widget_Helper_Form_Element_Text(
        'user_fonturl',
        null,
        null,
        '自定义字体',
        '介绍：输入字体地址，推荐使用cdn地址，提升网站整体速度'
    );
    $user_fonturl->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($user_fonturl);
    $cat_avatar = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_avatar',
        null,
        null,
        '自定义avatar地址',
        '例如：<br>https://cravatar.cn/avatar/<br>https://gravatar.helingqi.com/wavatar/<br>最后带 “ / ” 符号',
    );
    $cat_avatar->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_avatar);
    $cat_user_owo = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_user_owo',
        null,
        null,
        '自定义评论表情',
        '介绍：请输入自定义表情的json地址<br>
         注意：此方法会替换原有自带表情，若想同时使用自带表情，可手动将原表情OwO.json内容补充至自己的json内。',
    );
    $cat_user_owo->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_user_owo);
    $cat_user_owo_2 = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_user_owo_2',
        null,
        null,
        '自定义日记贴图',
        '介绍：请输入自定义贴图的json地址，具体方法同上方“自定义评论表情”<br>
         注意：自带的默认贴图为Boy of a black cat(sailor suit)，来源为<a href="https://store.line.me/stickershop/product/13116614" target="_blank">Line贴图商店</a>，作者为hashimokikuri。<br>
         　　　此处仅为演示使用，请将个人使用的贴图json地址填入此处',
    );
    $cat_user_owo_2->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_user_owo_2);
    $cat_pjax_animation = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_pjax_animation',
        array(
            'off' => '简洁（默认）',
            'style_1' => '波点',
            'style_2' => '进度条'
        ),
        'off',
        '<span style="color:green;">页面加载效果<span>',
        '介绍：可以选择一款页面加载效果'
    );
    $cat_pjax_animation->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_pjax_animation->multiMode());
    $cat_user_player = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_user_player',
        null,
        null,
        '自定义视频播放器',
        '介绍：请输入自定义视频播放器地址<br>
         示例：https://domain.com/player/?url=',
    );
    $cat_user_player->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_user_player);
    $cat_wechatpay = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_wechatpay',
        null,
        null,
        '微信收款码',
        '说明：填写微信收款二维码图片地址，图片尺寸200px'
    );
    $cat_wechatpay->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_wechatpay);
    $cat_alipay = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_alipay',
        null,
        null,
        '支付宝收款码',
        '说明：填写支付宝收款二维码图片地址，图片尺寸200px'
    );
    $cat_alipay->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_alipay);
    $cat_map_style1 = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_map_style1',
        NULL,
        NULL,
        '旅行地图样式（白天）',
        '介绍：请输入高德地图白天的样式代码，可选项<br>
         注意：可在【<a href="https://geohub.amap.com/mapstyle/index" target="_blank">此处</a>】自定义地图样式，具体方法可翻阅主题文档。<br>
         其他：不填则使用默认样式。'
    );
    $cat_map_style1->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_map_style1);
    $cat_map_style2 = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_map_style2',
        NULL,
        NULL,
        '旅行地图样式（黑夜）',
        '介绍：请输入高德地图黑夜的样式代码，可选项<br>
         注意：可在【<a href="https://geohub.amap.com/mapstyle/index" target="_blank">此处</a>】自定义地图样式，具体方法可翻阅主题文档。<br>
         其他：不填则使用默认样式。'
    );
    $cat_map_style2->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_map_style2);
    $cat_clickword = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_clickword',
        null,
        null,
        '鼠标点击文字特效',
        '说明：词之间使用 || 分隔，不填则不显示<br>
         示例1：富强 || 民主 || 文明 || 和谐 || 自由 || 平等 || 公正 || 法治 || 爱国 || 敬业 || 诚信 || 友善<br>
         示例2：OωO || (☆ω☆) || (/ω＼) || (｡•ˇ‸ˇ•｡) || ╮(╯▽╰)╭ ||  ٩(ˊᗜˋ*)و <br>
         示例3：😀 || 😃 || 😄 || 😆 || 😅 || 🤣 || 😂 || 😉 || 🤩 || 🤗 || 😋 || 😙 || 😚<br>
         示例4：❤'
    );
    $cat_clickword->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_clickword);
    $cat_background = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_background',
        array(
            'off' => '关闭（默认）',
            'sakura' => '樱花飘落',
            'maple' => '枫叶飘落',
            'leaf' => '绿叶飘落',
            'snow' => '雪花飘落',
            'user' => '自定义图案'
        ),
        'off',
        '<span style="color:green;">飘落背景特效</span>',
        '介绍：选择一项飘落背景特效。'
    );
    $cat_background->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_background->multiMode());
    $cat_background_user = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_background_user',
        null,
        null,
        '<span style="color:green;">自定义飘落图案</span>',
        '说明：输入图片地址。'
    );
    $cat_background_user->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_background_user);
    $cat_background_num = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_background_num',
        array(
            '10' => '10（默认）',
            '20' => '20',
            '30' => '30',
            '40' => '40',
            '50' => '50'
        ),
        '10',
        '<span style="color:green;">飘落图案数量</span>',
        '介绍：同时显示在界面中的飘落物的数量'
    );
    $cat_background_num->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_background_num->multiMode());
    $cat_site_black = new Typecho_Widget_Helper_Form_Element_Select(
        'cat_site_black',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '全站黑白',
        '介绍：是否手动开启全站黑白。'
    );
    $cat_site_black->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_site_black->multiMode());
    $cat_site_blackauto = new Typecho_Widget_Helper_Form_Element_Text(
        'cat_site_blackauto',
        null,
        null,
        '全站黑白（自动）',
        '说明：指定日期全站自动黑白滤镜。日期之间使用 || 分隔，不填则不生效。日期格式如下：<br>
         示例：7.7 || 9.18 || 12.13'
    );
    $cat_site_blackauto->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_site_blackauto);
    $cat_user_css = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_user_css',
        NULL,
        NULL,
        '自定义全局css',
        '介绍：请填写自定义CSS内容，填写时无需填写style标签'
    );
    $cat_user_css->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_user_css);
    $cat_user_js = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_user_js',
        NULL,
        NULL,
        '自定义全局js',
        '介绍：请填写自定义JS内容，填写时无需填写script标签'
    );
    $cat_user_js->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_user_js);
    $cat_user_header = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_user_header',
        NULL,
        NULL,
        '&lt;head&gt;&lt;/head&gt;标签内自定义内容',
        '介绍：此处用于在&lt;head&gt;&lt;/head&gt;标签里增加自定义内容<br>
         例如：可以填写引入第三方css等'
    );
    $cat_user_header->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_user_header);
    $cat_user_beforebody = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cat_user_beforebody',
        NULL,
        NULL,
        '&lt;/body&gt;标签前自定义内容',
        '介绍：此处用于在&lt;/body&gt;标签前增加自定义内容<br>
         例如：可以填写引入第三方js等'
    );
    $cat_user_beforebody->setAttribute('class', 'typecho-option cat_user');
    $form->addInput($cat_user_beforebody);