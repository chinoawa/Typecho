<?php if($this->options->cat_indexcard_welcome == 'on') :?>
	<li>
		<?php  
			$header_username = ($this->user->hasLogin() ? $this->user->screenName : $this->remember('author', true));
			$header_usermail = ($this->user->hasLogin() ? $this->user->mail : $this->remember('mail', true));
		?>
		<div class="box_out" style="padding: 1rem;overflow: hidden;height: 100%;">
			<div style="line-height: 2rem;text-align:left;">
				<?php if(empty($header_username)):?>
					❤ 新朋友！欢迎来访！
				<?php else:?>
					<?php echo $header_username; ?>～
					<?php if(date("H") >= 22 || date("H") < 5){
						echo '夜深了，早些休息';
					}elseif(date("H") >= 18 && date("H") < 22){
						echo '晚上好！';
					}elseif(date("H") >= 13 && date("H") < 18){
						echo '下午好！';
					}elseif(date("H") >= 11 && date("H") < 23){
						echo '中午好！';
					}elseif(date("H") >= 8 && date("H") < 11){
						echo '早上好！';
					}elseif(date("H") >= 5 && date("H") < 8){
						echo '起的真早！';
					}
					?>
				<?php endif; ?>
				<?php echo '<br>' . date("Y年n月j日",time()); ?>
				<?php 
					$weekarray=array("日","一","二","三","四","五","六");
					echo '<br>' . "星期". $weekarray[date("w")];
				?>
				<br>
				<?php if(!empty($_COOKIE['chouqian'])){
						$qian = ['大凶','凶','末吉','吉','小吉','中吉','大吉','大大吉'];
						echo '<div class="chouqianed" style="display:block;">' . $qian[$_COOKIE['chouqian']] . '</div>';
					}else{
						echo '  <div class="chouqian">点击抽取今日运势</div>
								<div class="chouqianed">已抽签</div>';
					}
				?>
			</div>
			<?php if(!empty($header_username)):?>
				<img style="width: 6rem;height: 6rem;position: absolute;border-radius: 30%;right: -0.5rem;bottom: -0.5rem;transform: rotate(-15deg);opacity: 0.7;" class="avatar lazyload" src="<?php get_AvatarLazyload(); ?>" data-src="<?php
					$dr_userEmail = ($this->user->hasLogin()? $this->user->mail:$this->remember('mail', true) );
					if(!empty($dr_userEmail)){
						echo get_AvatarByMail($dr_userEmail);
					}
				?>" alt="检测到用户">
			<?php endif; ?>
		</div>
	</li>
<?php endif;?>
<?php if($this->options->cat_indexcard_muyu == 'on') :?>
	<li style="background-color: #8abbff;">
	    <div class="little_card_flex" style="background:#8abbff;justify-content: center;">
            <div class="muyu">
                <div class="gongde"></div>
                <img id="muyu-img" src="data:image/webp;base64,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" />
            </div>
        </div>
	</li>
<?php endif;?>
<?php if($this->options->cat_index_welove) :?>
	<li>
		<?php 
			$cat_we_love = explode("||", $this->options->cat_index_welove);
		?>
		<div class="box_out cat_welove">
			<div class="cat_welove_info">
				<img referrerpolicy="no-referrer" class="echarts_avatar avatar lazyload" data-src="<?php echo 'http://q1.qlogo.cn/g?b=qq&nk='.trim($cat_we_love[0]).'&s=100'; ?>" src="<?php get_AvatarLazyload() ?>">
				<p class="cat_welove_name"><?php echo get_QqName(trim($cat_we_love[0])) ?></p>
			</div>
			<i class="ri-heart-pulse-fill"></i>
			<div class="cat_welove_info">
				<img referrerpolicy="no-referrer" class="echarts_avatar avatar lazyload" data-src="<?php echo 'http://q1.qlogo.cn/g?b=qq&nk='.trim($cat_we_love[1]).'&s=100'; ?>" src="<?php get_AvatarLazyload() ?>">
				<p class="cat_welove_name"><?php echo get_QqName(trim($cat_we_love[1])) ?></p>
			</div>
		</div>
		<div class="box_out cat_welove" style="font-size: 0.75rem;line-height: 1.5rem;margin-top: -0.5rem;">我们相恋啦!</div>
		<div class="box_out cat_welove"><?php echo getBuildTime(trim($cat_we_love[2]),false,true) ?></div>
	</li>
<?php endif;?>
<?php if($this->options->cat_index_countdownday) :?>
	<li>
		<?php 
			$countdownday = explode("||", $this->options->cat_index_countdownday);
		?>
		<div class="box_out cat_welove cat_welove_name" style="margin: 1.5rem 0 0.75rem;">距离<span style="font-size:2rem;margin: 0.5rem;color:var(--theme-60);"><?php echo trim($countdownday[0]) ?></span>还有</div>
		<div class="box_out cat_welove" style="font-size: 2.5rem;"><?php echo getBuildTime(trim($countdownday[1]),true,true) ?></div>
	</li>
<?php endif;?>
<?php if($this->options->cat_index_ppt) :?>
	<li>
	    <?php
			$carousel = [];
			$carousel_text = $this->options->cat_index_ppt;
			if ($carousel_text) {
				$carousel_arr = explode("\r\n", $carousel_text);
				if (count($carousel_arr) > 0) {
					for ($i = 0; $i < count($carousel_arr); $i++) {
						$img = explode("||", $carousel_arr[$i])[0];
						$url = explode("||", $carousel_arr[$i])[1];
						$carousel[] = array("img" => trim($img), "url" => trim($url));
					};
				}
			}
		?>
		<?php if (sizeof($carousel) > 0) : ?>
			<div class="swiper" style="z-index: 0;">
				<div class="swiper-wrapper">
					<?php foreach ($carousel as $item) : ?>
						<div class="swiper-slide">
						    <a class="item" href="<?php echo $item['url'] ?>" target="_blank" rel="noopener noreferrer nofollow">
							    <img class="box_img" style="height: 100%;" src="<?php echo $item['img'] ?>" alt="幻灯片" />
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		<?php endif; ?>
	</li>
<?php endif;?>
<?php echo $this->options->cat_Index_user_cards ? $this->options->cat_Index_user_cards : '' ?>
	