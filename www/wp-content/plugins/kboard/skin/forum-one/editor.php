<div id="kboard-forum-one-editor">
	<form class="kboard-form" method="post" action="<?php echo $url->getContentEditorExecute()?>" enctype="multipart/form-data" onsubmit="return kboard_editor_execute(this);">
		<?php $skin->editorHeader($content, $board)?>
		
		<?php foreach($board->fields()->getSkinFields() as $key=>$field):?>
			<?php echo $board->fields()->getTemplate($field, $content, $boardBuilder)?>
		<?php endforeach?>
		
		<div class="kboard-control">
			<div class="left">
				<?php if($content->uid):?>
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>" class="kboard-forum-one-button-small"><?php echo __('Back', 'kboard')?></a>
				<a href="<?php echo $url->getBoardList()?>" class="kboard-forum-one-button-small"><?php echo __('List', 'kboard')?></a>
				<?php else:?>
				<a href="<?php echo $url->getBoardList()?>" class="kboard-forum-one-button-small"><?php echo __('Back', 'kboard')?></a>
				<?php endif?>
			</div>
			<div class="right">
				<?php if($board->isWriter()):?>
				<button type="submit" class="kboard-forum-one-button-small"><?php echo __('Save', 'kboard')?></button>
				<?php endif?>
			</div>
		</div>
	</form>
</div>

<?php wp_enqueue_script('kboard-forum-one-script', "{$skin_path}/script.js", array(), KBOARD_VERSION, true)?>