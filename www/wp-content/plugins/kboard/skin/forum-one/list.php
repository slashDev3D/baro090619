<div id="kboard-forum-one-list">
	
	<!-- 게시판 정보 시작 -->
	<div class="kboard-list-header">
		<div class="kboard-left">
			<!-- 카테고리 시작 -->
			<?php
			if($board->use_category == 'yes'){
				if($board->isTreeCategoryActive()){
					$category_type = 'tree-select';
				}
				else{
					$category_type = 'default';
				}
				$category_type = apply_filters('kboard_skin_category_type', $category_type, $board, $boardBuilder);
				echo $skin->load($board->skin, "list-category-{$category_type}.php", $vars);
			}
			?>
			<!-- 카테고리 끝 -->
		</div>
		
		<div class="kboard-right">
			<form id="kboard-sort-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
				<?php echo $url->set('pageid', '1')->set('category1', '')->set('category2', '')->set('target', '')->set('keyword', '')->set('mod', 'list')->set('kboard_list_sort_remember', $board->id)->toInput()?>
				
				<select name="kboard_list_sort" onchange="jQuery('#kboard-sort-form-<?php echo $board->id?>').submit();">
					<option value="newest"<?php if($list->getSorting() == 'newest'):?> selected<?php endif?>><?php echo __('Newest', 'kboard')?></option>
					<option value="best"<?php if($list->getSorting() == 'best'):?> selected<?php endif?>><?php echo __('Best', 'kboard')?></option>
					<option value="viewed"<?php if($list->getSorting() == 'viewed'):?> selected<?php endif?>><?php echo __('Viewed', 'kboard')?></option>
					<option value="updated"<?php if($list->getSorting() == 'updated'):?> selected<?php endif?>><?php echo __('Updated', 'kboard')?></option>
				</select>
			</form>
		</div>
	</div>
	<!-- 게시판 정보 끝 -->
	
	<?php if($board->use_category == 'yes'):?>
	<div class="kboard-category category-mobile">
		<form id="kboard-category-form-<?php echo $board->id?>-mobile" method="get" action="<?php echo $url->toString()?>">
			<?php echo $url->set('pageid', '1')->set('category1', '')->set('category2', '')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<?php if($board->initCategory1()):?>
				<select name="category1" onchange="jQuery('#kboard-category-form-<?php echo $board->id?>-mobile').submit();">
					<option value=""><?php echo __('All', 'kboard')?></option>
					<?php while($board->hasNextCategory()):?>
					<option value="<?php echo $board->currentCategory()?>"<?php if(kboard_category1() == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
					<?php endwhile?>
				</select>
			<?php endif?>
			
			<?php if($board->initCategory2()):?>
				<select name="category2" onchange="jQuery('#kboard-category-form-<?php echo $board->id?>-mobile').submit();">
					<option value=""><?php echo __('All', 'kboard')?></option>
					<?php while($board->hasNextCategory()):?>
					<option value="<?php echo $board->currentCategory()?>"<?php if(kboard_category2() == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
					<?php endwhile?>
				</select>
			<?php endif?>
		</form>
	</div>
	<?php endif?>
	
	<!-- 리스트 시작 -->
	<ul class="kboard-list">
		<?php while($content = $list->hasNextNotice()):?>
		<li class="kboard-list-notice<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
			<div class="kboard-list-detail">
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>#kboard-document">
					<div class="kboard-list-item votes">
						<?php echo __('Votes', 'kboard')?><br>
						<?php echo $content->vote?>
					</div>
					<div class="kboard-list-item comment">
						<?php if($content->visibleComments()):?><?php echo __('Comments', 'kboard')?><br>
						<?php echo intval($content->getCommentsCount('', '', '0'))?>
						<?php else:?>답글<br>
						<?php echo $content->getReplyCount('%s') ? $content->getReplyCount('%s') : '0'?>
						<?php endif?>
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
						<?php if($content->isNew()):?><span class="kboard-forum-one-new-notify">New</span><?php endif?>
						<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-icon-lock" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
						[<?php echo __('Notice', 'kboard')?>]
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
							echo strip_tags($content->content)
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
		<?php endwhile?>
		<?php while($content = $list->hasNext()):?>
		<li class="<?php if($content->uid == kboard_uid()):?>kboard-list-selected<?php endif?>">
			<div class="kboard-list-detail">
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>#kboard-document">
					<div class="kboard-list-item votes">
						<?php echo __('Votes', 'kboard')?><br>
						<?php echo $content->vote?>
					</div>
					<div class="kboard-list-item comment">
						<?php if($content->visibleComments()):?><?php echo __('Comments', 'kboard')?><br>
						<?php echo intval($content->getCommentsCount('', '', '0'))?>
						<?php else:?>답글<br>
						<?php echo $content->getReplyCount('%s') ? $content->getReplyCount('%s') : '0'?>
						<?php endif?>
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
						<?php if($content->isNew()):?><span class="kboard-forum-one-new-notify">New</span><?php endif?>
						<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-icon-lock" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
						<?php echo $content->title?>
					</div>
					<div class="kboard-list-content kboard-forum-one-cut-strings">
						<?php if($content->category1):?><span class="kboard-category"><?php echo $content->category1?> ·</span><?php endif?>
						<?php if($content->category2):?><span class="kboard-category"><?php echo $content->category2?> ·</span><?php endif?>
						<?php if($content->option->tree_category_1):?>
						<?php for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
						<span class="kboard-category"><?php echo $content->option->{'tree_category_'.$i}?> ·</span>
						<?php endfor?>
						<?php endif?>
						<?php if($content->secret):?>
							<?php echo __('Secret', 'kboard')?>
						<?php else:?>
							<?php
							$content->content = str_replace('[', '&#91;', $content->getContent());
							$content->content = str_replace(']', '&#93;', $content->getContent());
							echo strip_tags($content->content)
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
		<?php if($content->visibleComments()):?>
		<?php $boardBuilder->builderReply($content->uid)?>
		<?php endif?>
		<?php endwhile?>
	</ul>
	<!-- 리스트 끝 -->
	
	<!-- 페이징 시작 -->
	<div class="kboard-pagination">
		<ul class="kboard-pagination-pages">
			<?php echo kboard_pagination($list->page, $list->total, $list->rpp)?>
		</ul>
	</div>
	<!-- 페이징 끝 -->
	
	<!-- 검색폼 시작 -->
	<div class="kboard-search">
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected="selected"<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected="selected"<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected="selected"<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo kboard_keyword()?>">
			<button type="submit" class="kboard-forum-one-button-search" title="<?php echo __('Search', 'kboard')?>"><img src="<?php echo $skin_path?>/images/icon-search.png" alt="<?php echo __('Search', 'kboard')?>"></button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
	<?php if($board->isWriter()):?>
	<div class="kboard-control">
		<a href="<?php echo $url->getContentEditor()?>" class="kboard-forum-one-button-small"><?php echo __('New', 'kboard')?></a>
	</div>
	<?php endif?>
	
	<?php if($board->contribution()):?>
	<div class="kboard-forum-one-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
	</div>
	<?php endif?>
</div>