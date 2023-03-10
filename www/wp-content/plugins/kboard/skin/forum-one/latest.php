<div id="kboard-forum-one-latest">
	<table>
		<thead>
			<tr>
				<th class="kboard-latest-title"><?php echo __('Title', 'kboard')?></th>
				<th class="kboard-latest-date"><?php echo __('Date', 'kboard')?></th>
			</tr>
		</thead>
		<tbody>
			<?php while($content = $list->hasNext()):?>
			<tr>
				<td class="kboard-latest-title">
					<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
						<div class="kboard-forum-one-cut-strings">
							<?php if($content->isNew()):?><span class="kboard-forum-one-new-notify">N</span><?php endif?>
							<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-icon-lock" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
							<?php echo $content->title?>
							<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
						</div>
					</a>
				</td>
				<td class="kboard-latest-date"><?php echo $content->getDate()?></td>
			</tr>
			<?php endwhile?>
		</tbody>
	</table>
</div>