<?php
/**
 * 统计
 * 
 * @package custom 
 * 
 **/
?>
<!DOCTYPE HTML>
<?php $this->need('parts/header.php'); ?>
<?php $this->need('parts/title.php'); ?>
<div class="main <?php if ($this->options->cat_style_choose && $this->options->cat_style_choose == 'thin'){ echo "main_thin"; } ?>">
    <script src="<?php echo resource_cdn() . 'public/echarts.min.js' ?>"></script>
    <div id="cat_article_start" class="cat_index_start">
        <?php Typecho_Widget::widget('Widget_Stat')->to($item); ?>
        <div class="cat_echarts_infocards">
            <?php
            $logo = array('ri-file-list-3-line','ri-message-3-line','ri-hashtag','ri-file-paper-line','ri-numbers-line','ri-group-line','ri-baidu-line','ri-timer-line','ri-user-follow-line');
            $arr_url = parse_url($this->options->siteUrl);
            $new_url = $this->options->themeUrl . '/api/baidu.php?domain=' . $arr_url['host'];
            $num = array(
                number_format($item->publishedPostsNum),
                number_format($item->publishedCommentsNum),
                number_format($item->categoriesNum),
                number_format($item->publishedPagesNum),
                cat_allviewnum(1,1),
                cat_UV(1),
                get_baidu($new_url),
                timer_stop(),
                online_users()
            );
            $name = array('文章数','评论数','分类数','页面数','人气值','访客数','收录数','加载时间','当前在线');
            $title = array('总博文的数量','累计的评论数','博文的分类数','独立页面数','总博文的阅读量：' . cat_allviewnum(1,0),'统计访客数（UV）：' . cat_UV(0) . '人次','百度收录数','网站加载用时','当前在线访客数（IP）');
            for($i=0; $i<count($logo); $i++){
            ?>
                <div title="<?php echo $title[$i]; ?>" class="friends_block flex_block_add_card">
                    <div style="font-size: 3rem;">
                        <i class="<?php echo $logo[$i]; ?>"></i>
                	</div>
            		<ul style="text-align: center;">
            		    <li><?php echo $num[$i]; ?></li>
            		    <li><?php echo $name[$i]; ?></li>
            		</ul>
                </div>
            <?php } ?>
        </div>
        <?php if($this->options->cat_echarts_jianlong_id) :?>
        <script>
            window.Config = {
              SiteName: '<?php echo $this->title . ' - ' . $this->options->title; ?>',
              ApiKeys: [
                '<?php echo $this->options->cat_echarts_jianlong_id ?>',
              ],
              ShowLink: false,
              CountDays: <?php echo $this->options->cat_echarts_jianlong_days ? $this->options->cat_echarts_jianlong_days : '30' ?>,
            };
        </script>
        <link rel="stylesheet" href="<?php echo resource_cdn() . 'public/jiankong.css'?>">
            <div class="friends_block" style="width:100%;">
                <div id="jiankong"></div>
                <script src="<?php echo resource_cdn() . 'public/jiankong.js' ?>"></script>
            </div>
        <?php endif; ?>
        <?php if($this->options->cat_comment_IP == 'on' && $this->options->cat_comment_ip_api && $this->options->cat_comment_place == 'province' && $this->options->cat_echarts_map == 'on') :?>
            <div class="friends_block flex_block_add cat_echarts_china_map">
                <div id="china_chart" style="max-width: 1200px;margin: auto;aspect-ratio: 16 / 9;"></div>
                <script src="<?php echo resource_cdn() . 'public/china.js'?>"></script>
            </div>
        <?php endif; ?>
        <div class="flex_first">
            <div class="friends_block flex_block_add">
                <div id="echarts_1" class="echarts_normal"></div>
            </div>
            <div class="friends_block flex_block_add">
                <div id="echarts_2" class="echarts_normal"></div>
            </div>
            <div class="friends_block flex_block_add">
                <div id="echarts_3" class="echarts_normal"></div>
            </div>
            <div class="friends_block flex_block_add">
                <div id="echarts_4" class="echarts_normal"></div>
            </div>
            <div class="friends_block flex_block_add">
                <div id="echarts_5" class="echarts_normal"></div>
            </div>
        </div>
        <section>
            <div class="cat_index_guidang">
                <div class="friends_block" style="width:100%;">
                    <div class="box_out">
                        <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($cat_post);
                    		$year = 0;
                    		$mon = 0;
                    		echo '<div class="cat_guidang_years">';
                    		while ($cat_post->next()) :
                    			$year_tmp = date('Y', $cat_post->created);
                    			$mon_tmp = date('n', $cat_post->created);
                    			if ($year != $year_tmp) {
                                    $year = $year_tmp;
                                    echo '<span class="cat_guidang_year" year_id="' . $year . '">' . $year . ' 年</span>';
                                } ?>
                    			<?php
                    		endwhile;
                    		echo '</div>';
                    		echo '<div class="cat_guidang_mons">';
                    		$year = 0;
                    		$mon = 0;
                    		while ($cat_post->next()) :
                    			$year_tmp = date('Y', $cat_post->created);
                    			$mon_tmp = date('n', $cat_post->created);
                    			$m_tmp = date('m', $cat_post->created);
                    			if ($year != $year_tmp) {
                                    $year = $year_tmp;
                                }
                    			if ($mon != $mon_tmp) {
                    				$mon = $mon_tmp;
                    				$m = $m_tmp;
                    				echo '<span class="cat_guidang_mon" year_id="' . $year . '" mon_id="' . $m . '">' . $mon . ' 月</span>';
                    			} ?>
                    			<?php
                    		endwhile;
                    		echo '</div>';
                    	?>
                    </div>
                    <div class="friends_post_post">
                    <?php
                        echo '<ul class="friends_title">';
                    		$year = 0;
                    		$mon = 0;
                    		while ($cat_post->next()) :
                    			$created = date('n月j日', $cat_post->created);
                    			$year_tmp = date('Y', $cat_post->created);
                    			$mon_tmp = date('n', $cat_post->created);
                    			$m_tmp = date('m', $cat_post->created);
                    			if ($year != $year_tmp) {
                                    $year = $year_tmp;
                                }
                    			if ($mon != $mon_tmp) {
                    				$mon = $mon_tmp;
                    				$m = $m_tmp;
                    			} ?>
                    				<li class="cat_guidang_day" year_id="<?php echo $year;?>" mon_id="<?php echo $m;?>">
                    					<a title="<?php echo $cat_post->categories[0]['name'] ?>" href="<?php echo $cat_post->permalink ?>">
                    						<?php echo '<i style="color:var(--theme-60);" class="ri-file-list-3-line"></i> ' . $created . ' - ' . $cat_post->title ?>
                    					</a>
                    				</li>
                    			<?php
                    		endwhile;
                        echo '</ul>';
                    ?>
                    </div>
                </div>
            </div>
        </section>
        <section>
        <ul class="cat_index_tags">
            <?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 50))->to($taglist); ?>
            <?php while ($taglist->next()): ?>
                <li class="friends_block">
                    <a href="<?php $taglist->permalink(); ?>" title="共计 <?php $taglist->count(); ?> 篇"><i class="ri-price-tag-3-line"></i> <?php $taglist->name(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
        </section>
        <section>
            <div class="cat_index_visitors">
                <?php
                $period = time() - 999592000;
                $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                    ->select('COUNT(author) AS cnt', 'author', 'authorId', 'mail')
                    ->from('table.comments')
                    ->where('created > ?', $period)
                    ->where('status = ?', 'approved')
                    ->where('type = ?', 'comment')
                    ->group('author,authorId,mail')
                    ->order('cnt', Typecho_Db::SORT_DESC)
                    ->limit('31')
                );
                $mostactive = '';
                foreach ($counts as $i => $count) {
                    if ($count['authorId'] == '0') { 
                    ?>
                    <div class="friends_block" style="padding: 0.5rem;">
                        <div style="display: flex;">
                    		<img class="echarts_avatar avatar lazyload" data-src="<?php echo get_AvatarByMail($count['mail']) ?>" src="<?php get_AvatarLazyload() ?>">
                    		<ul style="margin: 0 1rem;">
                    		    <li title="<?php echo $count['author'] ?>" class="echarts_name">
                            		<div style="display: inline-block;color: var(--colorD);"><?php echo $i; ?></div>
                        		    <?php echo $count['author'] ?>
                        		</li>
                    		    <div class="echarts_tags">
                        		    <?php cat_comment_levelcard($count['mail']) ?>
                        		    <?php cat_comment_friendcard_nocat($count['mail']) ?>
                        		    <p title="评论 <?php echo $count['cnt'] ?> 次" class="animeinfo"><?php echo $count['cnt'] ?></p>
                        		</div>
                    		</ul>
                    	</div>
                    </div>
                    <?php }
                }
                ?>
            </div>
        </section>
    </div>
</div>
<?php $this->need('parts/footer.php'); ?>
