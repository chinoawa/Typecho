<?php
function themeFields($layout) {
    $uri = $_SERVER['REQUEST_URI'];
        $post_icon = new Typecho_Widget_Helper_Form_Element_Text(
            'post_icon',
            null,
            null,
            '图标标识',
            '介绍：此处填写喜爱的图标代码或<a href="https://www.emojidaquan.com/" target="_blank"> Emoji </a>符号<br>
             说明：默认使用<a href="https://remixicon.com/" target="_blank"> Remixicon </a>图标库<br>
             示例：ri-book-2-fill 或 📚<br>
             <span style="color:#E53333;">重要：*如果是新建的页面（page）类型，此项为必填，会影响页面侧栏的图标显示<br>
             　　　如果不填写，则会以标题开头文字代替</span>'
        );
        $layout->addItem($post_icon);
        $post_title_img = new Typecho_Widget_Helper_Form_Element_Text(
            'post_title_img',
            null,
            null,
            '头部图片 / 列表缩略图',
            '介绍：为文章 / 页面选择一张头部图片，输入url地址<br>
             说明：文章不填则会调用文章第一张图，若文章无图 / 页面不填则会调用用户设置中的“自定义默认图”'
        );
        $layout->addItem($post_title_img);
        $post_keywords = new Typecho_Widget_Helper_Form_Element_Text(
            'post_keywords',
            null,
            null,
            '关键词（SEO）',
            '介绍：文章 / 页面的关键词。<br>
             注意：若不填写，则文章会自动使用标签内容。<br>
             　　　多个关键词使用英文逗号进行隔开'
        );
        $layout->addItem($post_keywords);
        $post_abstract = new Typecho_Widget_Helper_Form_Element_Textarea(
            'post_abstract',
            null,
            null,
            '摘要内容（SEO）',
            '介绍：文章 / 页面的摘要内容。<br>
             注意：若不填写，则会自动截取内容。'
        );
        $layout->addItem($post_abstract);
        $post_h1h2h3 = new Typecho_Widget_Helper_Form_Element_Select(
            'post_h1h2h3',
            array(
                'off' => '无序号（默认）',
                'on' => '添加序号'
            ),
            'off',
            '标题序号',
            '介绍：开启此项会在H1、H2、H3标题前添加序号，H4、H5、H6不受影响'
        );
        $layout->addItem($post_h1h2h3);
    if (strstr($uri, "write-post")) {
        $post_copyright_select = new Typecho_Widget_Helper_Form_Element_Select(
            'post_copyright_select',
            array(
                'off'   => '原创（默认）',
                'reship' => '全文转载',
                'quote'  => '引用资料'
            ),
            'off',
            '<span style="color:blue;">文章版权信息分类</span>',
            '介绍：选择合适的文章版权信息分类，并会在文章下方展示当前文章的相关信息。</span>'
        );
        $layout->addItem($post_copyright_select);
        $post_copyright_reshipauthor = new Typecho_Widget_Helper_Form_Element_Text(
            'post_copyright_reshipauthor',
            null,
            null,
            '<span style="color:blue;">全文转载——作者</span>',
            '介绍：输入原作者姓名'
        );
        $layout->addItem($post_copyright_reshipauthor);
        $post_copyright_reshiptitle = new Typecho_Widget_Helper_Form_Element_Text(
            'post_copyright_reshiptitle',
            null,
            null,
            '<span style="color:blue;">全文转载——原文链接</span>',
            '介绍：输入原文链接和标题，标题可省略。中间使用 || 分隔，且由 https:// 开头<br>
             参考：https://www.mmbkz.cn/mydiary.html || MyDiary主题官网'
        );
        $layout->addItem($post_copyright_reshiptitle);
        $post_copyright_quotelinks = new Typecho_Widget_Helper_Form_Element_Textarea(
            'post_copyright_quotelinks',
            null,
            null,
            '<span style="color:blue;">引用资料——原文链接</span>',
            '介绍：输入原文链接和标题，标题可省略。一行一条，中间使用 || 分隔，且由 https:// 开头<br>
             参考：https://www.mmbkz.cn/mydiary.html || MyDiary主题官网'
        );
        $layout->addItem($post_copyright_quotelinks);
        $post_top_info_select = new Typecho_Widget_Helper_Form_Element_Select(
            'post_top_info_select',
            array(
                'post'  => '文章（默认）',
                'album' => '相册',
                'book'  => '图书',
                'movie' => '影视',
                'music' => '音乐',
                'steam' => '游戏',
                'tour'  => '旅行'
            ),
            'off',
            '<span style="color:green;">文章类型</span>',
            '介绍：选择合适的文章类型，并会在文章上方展示当前文章的相关信息。<br>
            　　　相册，书评，影评，旅行分类将会在“专题页面”进行聚合展示<br>
             说明：例如想写一篇关于《机器喵》的读后感，可以添加相关作者，评分等信息。<br>
            　　　若选择为相册，则会过滤文字并将显示所有图片，推荐十张图以上'
        );
        $layout->addItem($post_top_info_select);
        $post_top_info_album_grid = new Typecho_Widget_Helper_Form_Element_Select(
            'post_top_info_album_grid',
            array(
                'grid'   => '网格（默认）',
                'column' => '水平瀑布流'
            ),
            'grid',
            '<span style="color:green;">相册布局</span>',
            '介绍：选择合适的相册布局。<br>
             说明：默认使用网格布局，实用性更强。如果图片过多可以尝试使用水平瀑布流布局。'
        );
        $layout->addItem($post_top_info_album_grid);
        $post_top_info_album_size = new Typecho_Widget_Helper_Form_Element_Select(
            'post_top_info_album_size',
            array(
                'large' => '较大图',
                'small' => '较小图'
            ),
            'large',
            '<span style="color:green;">图片展示尺寸</span>',
            '介绍：选择默认的图片展示尺寸，可在文章页内自由调节<br>
             说明：默认使用较大图'
        );
        $layout->addItem($post_top_info_album_size);
        $post_top_info_post_abstract = new Typecho_Widget_Helper_Form_Element_Select(
            'post_top_info_post_abstract',
            array(
                'off'   => '不显示（默认）',
                'on' => '显示'
            ),
            'off',
            '<span style="color:green;">顶部显示摘要</span>',
            '介绍：顶部是否显示摘要内容卡片。'
        );
        $layout->addItem($post_top_info_post_abstract);
        $post_top_info_post_name = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_post_name',
            null,
            null,
            '<span style="color:green;">文章专题分类名称</span>',
            '文章填写相同的专题名称，会在专题页面自动建立文集分类。（名称不要有空格，斜线等特殊符号，可下划线）<br>
             <span style="color:red;">切记：切换文章类型时请手动清空该选项，否则仍会显示在文章专题分类内。</span>'
        );
        $layout->addItem($post_top_info_post_name);
        $post_top_info_album_name = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_album_name',
            null,
            null,
            '<span style="color:green;">相册分类名称</span>',
            '相册填写相同的相册名称，会自动建立相册分类。（名称不要有空格，斜线等特殊符号，可下划线）'
        );
        $layout->addItem($post_top_info_album_name);
        $post_top_info_book_fenlei = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_book_fenlei',
            null,
            null,
            '<span style="color:green;">书籍分类名称</span>',
            '书籍填写相同的书单名称，会自动建立书单分类。（名称不要有空格，斜线等特殊符号，可下划线）'
        );
        $layout->addItem($post_top_info_book_fenlei);
        $post_top_info_book_img = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_book_img',
            null,
            null,
            '<span style="color:green;">书籍封面</span>',
            '请输入一张图片url地址作为书籍封面，尺寸比例为1 : 1.414'
        );
        $layout->addItem($post_top_info_book_img);
        $post_top_info_book_name = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_book_name',
            null,
            null,
            '<span style="color:green;">书籍名称</span>',
            '图书的名称'
        );
        $layout->addItem($post_top_info_book_name);
        $post_top_info_book_author = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_book_author',
            null,
            null,
            '<span style="color:green;">书籍作者</span>',
            '书籍作者姓名'
        );
        $layout->addItem($post_top_info_book_author);
        $post_top_info_book_star = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_book_star',
            null,
            null,
            '<span style="color:green;">书籍评分</span>',
            '书籍的个人评分，范围为0-10，支持一位小数。如：9.5（整数不带小数点）'
        );
        $layout->addItem($post_top_info_book_star);
        $post_top_info_movie_img = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_movie_img',
            null,
            null,
            '<span style="color:green;">影视封面</span>',
            '请输入一张图片url地址作为视频 / 电影的封面，尺寸比例为1 : 1.414'
        );
        $layout->addItem($post_top_info_movie_img);
        $post_top_info_movie_name = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_movie_name',
            null,
            null,
            '<span style="color:green;">影视名称</span>',
            '视频 / 电影的名称'
        );
        $layout->addItem($post_top_info_movie_name);
        $post_top_info_movie_author = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_movie_author',
            null,
            null,
            '<span style="color:green;">影视导演 / 作者</span>',
            '影视影片的导演 / 作者姓名'
        );
        $layout->addItem($post_top_info_movie_author);
        $post_top_info_movie_star = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_movie_star',
            null,
            null,
            '<span style="color:green;">视频评分</span>',
            '视频的个人评分，范围为0-10，支持一位小数。如：9.5（整数不带小数点）'
        );
        $layout->addItem($post_top_info_movie_star);
        $post_top_info_movie_more = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_movie_more',
            null,
            null,
            '<span style="color:green;">视频B站BV号</span>',
            '如果视频来自B站，则此处可填写B站BV号，视频将会在文章侧栏展示。并会在文章顶层展示栏替代视频封面。但是在文章列表中仍会展示视频封面图片'
        );
        $layout->addItem($post_top_info_movie_more);
        $post_top_info_music_author = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_music_author',
            null,
            null,
            '<span style="color:green;">音乐人，歌手</span>',
            '音乐人，创作者，歌手的姓名'
        );
        $layout->addItem($post_top_info_music_author);
        $post_top_info_music_img = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_music_img',
            null,
            null,
            '<span style="color:green;">专辑封面</span>',
            '请输入一张图片url地址作为音乐专辑的封面，尺寸比例为1 : 1'
        );
        $layout->addItem($post_top_info_music_img);
        $post_top_info_music_star = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_music_star',
            null,
            null,
            '<span style="color:green;">音乐评分</span>',
            '音乐的个人评分，范围为0-10，支持一位小数。如：9.5（整数不带小数点）'
        );
        $layout->addItem($post_top_info_music_star);
        $post_top_info_music_more = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_music_more',
            null,
            null,
            '<span style="color:green;">网易云音乐ID（推荐填写）</span>',
            '请在此处请填写网易云音乐的音乐ID，可在头部，文章列表内展示音乐播放内容。<a href="https://music.163.com/" target="_blank">网易云官网</a>'
        );
        $layout->addItem($post_top_info_music_more);
        $post_top_info_steam_more = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_steam_more',
            null,
            null,
            '<span style="color:green;">游戏的APPID</span>',
            '如果为steam游戏，此处请填写steam游戏的Appid。可在<a href="https://steamdb.info/" target="_blank">SteamDB</a>查询游戏的APPID。若为其他平台游戏，可以输入小黑盒游戏的Appid。具体方法可参照：<a href="https://www.wolai.com/dorcandy/tNAVMkrTsXj8d4w1BeWCp" target="_blank">这里</a>'
        );
        $layout->addItem($post_top_info_steam_more);
        $post_top_info_tour_more = new Typecho_Widget_Helper_Form_Element_Text(
            'post_top_info_tour_more',
            null,
            null,
            '<span style="color:green;">旅行位置坐标</span>',
            '此处请填写地理位置坐标，可在<a href="https://lbs.amap.com/tools/picker" target="_blank">此处</a>选取目的地坐标'
        );
        $layout->addItem($post_top_info_tour_more);
    }elseif(strstr($uri, "write-page")){
        $page_footer = new Typecho_Widget_Helper_Form_Element_Select(
            'page_footer',
            array(
                'off'   => '隐藏（默认）',
                'on' => '显示'
            ),
            'off',
            '页面分类，右侧栏快捷按钮',
            '介绍：会在页面分类的右侧侧边栏显示快捷按钮。'
        );
        $layout->addItem($page_footer);
        $page_footer_user = new Typecho_Widget_Helper_Form_Element_Textarea(
            'page_footer_user',
            null,
            null,
            '页面右侧侧栏自定义按钮',
            '简介：此处填写自定义按钮的样式，链接和说明，一行一个，中间使用 || 分隔<br>
             说明：第一个位置，填写喜爱的图标代码或<a href="https://www.emojidaquan.com/" target="_blank"> Emoji </a>符号，默认使用<a href="https://remixicon.com/" target="_blank"> Remixicon </a>图标库。<br>
             　　　第二个位置，填写页面链接地址，外链开头为 “ https:// ”，内链开头为 “ / ”。<br>
             　　　第二个位置，填写光标悬浮显示提示文字，不填写则会显示页面标题。<br>
             示例：ri-subway-line || https://travellings.link/ || 开往<br>
             　　　📔 || /cat_diary.html || 日记<br>
             <span style="color:red;">注意：仅普通页面有效</span>'
        );
        $layout->addItem($page_footer_user);
    }
        $cat_close_post = new Typecho_Widget_Helper_Form_Element_Select(
            'cat_close_post',
            array(
                'off' => '正常（默认）',
                'on' => '关闭'
            ),
            'off',
            '关闭正文区域',
            '介绍：开启此项会<span style="color:red;">关闭正文区域</span><br>
             注意：此功能可隐藏“留言板”、“友链申请”等页面的说明文字，也可搭配下方的开启个人摘录功能打造微博页面<br>
             <span style="color:red;">警告：如果关闭评论区也会关闭个人摘录功能，且此功能仅文章页、普通页面、友链页面与留言板页面有效。</span>'
        );
        $layout->addItem($cat_close_post);
        $post_change_comment = new Typecho_Widget_Helper_Form_Element_Select(
            'post_change_comment',
            array(
                'off' => '评论区（默认）',
                'on' => '摘录区'
            ),
            'off',
            '个人摘录功能',
            '介绍：开启此项会<span style="color:red;">关闭评论区</span>留言，并开启个人摘录功能<br>
             注意：个人摘录可搭配“书评”、“影评”等文章类型，在下方记录个人读后感等<br>
             <span style="color:red;">警告：如果关闭评论区也会关闭个人摘录功能，且此功能仅文章页与普通页面有效。</span>'
        );
        $layout->addItem($post_change_comment);
    }
?>