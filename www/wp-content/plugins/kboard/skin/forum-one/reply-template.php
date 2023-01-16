<?php while($content = $list->hasNextReply()):?>
<li class="<?php if($content->uid == kboard_uid()):?>kboard-list-selected<?php endif?>">
	<div class="kboard-list-detail">
		<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>#kboard-document">
			<div class="kboard-list-item votes">
				<?php echo __('Votes', 'kboard')?><br>
				<?php echo $content->vote?>
			</div>
			<div class="kboard-list-item comment">
				<?php echo __('Comments', 'kboard')?><br>
				<?php echo intval($content->getCommentsCount('', '', '0'))?>
			</div>
			<div class="kboard-list-item views">
				<?php echo __('Views', 'kboard')?><br>
				<?php echo $content->view?>
			</div>
		</a>
	</div>
	<div class="kboard-list-group">
		<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>#kboard-document">
			<div class="kboard-list-title kboard-forum-one-cut-strings">
				<img src="<?php echo $skin_path?>/images/icon-reply.png" class="kboard-icon-reply" alt="">
				<?php if($content->isNew()):?><span class="kboard-forum-one-new-notify">New</span><?php endif?>
				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-icon-lock" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
				<?php echo $content->title?>
			</div>
			<div class="kboard-list-content kboard-forum-one-cut-strings">
				<?php if($content->category1):?><span class="kboard-category"><?php echo $content->category1?> ·</span><?php endif?>
				<?php if($content->category2):?><span class="kboard-category"><?php echo $content->category2?> ·</span><?php endif?>
				<?php if($content->secret):?>
					<?php echo __('Secret', 'kboard')?>
				<?php else:?>
					<?php
					$content->content = str_replace('[', '&#91;', $content->getContent());
					$content->content = str_replace(']', '&#93;', $content->getContent());
					echo strip_tags($content->content);
					?>
				<?php endif?>
			</div>
		</a>
	</div>
	<div class="kboard-list-moreinfo">
		<div class="kboard-list-item author">
			<?php echo $content->getUserDisplay(sprintf('%s %s', get_avatar($content->getUserID(), 20, '', $content->getUserName()), $content->getUserName()))?>
		</div>
		<div class="kboard-list-item date">
			<?php echo __('Date', 'kboard')?><br>
			<?php echo $content->getDate()?>
		</div>
	</div>
</li>
<?php $boardBuilder->builderReply($content->uid, $depth+1)?>
<?php endwhile?>