<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
?>
<?php $this->need('header.php');?>

<div class="main-content common-page clearfix">
    <div class="common-item">
        <div class="common-title">
            <?php $this->archiveTitle(array(
    'category' => _t('Category : %s'),
    'search' => _t('Search : %s'),
    'tag' => _t('Tag : %s'),
    'author' => _t('Author : %s'),
    'date' => _t('Date : %s'),
), '', '');?>
        </div>
        <div class="post-lists">
			<div class="post-lists-body">
				<?php if ($this->have()): ?>
				<?php while ($this->next()): ?>
				<div class="post-list-item">
					<div class="post-list-item-container <?php if ($this->options->colorBgPosts == 'customColor'): ?><?php if (array_key_exists('green', unserialize($this->___fields()))): ?> bg-green<?php elseif (array_key_exists('red', unserialize($this->___fields()))): ?> bg-red<?php elseif (array_key_exists('yellow', unserialize($this->___fields()))): ?> bg-yellow<?php elseif (array_key_exists('blue', unserialize($this->___fields()))): ?> bg-blue<?php elseif (array_key_exists('purple', unserialize($this->___fields()))): ?> bg-purple<?php else: ?> bg-<?php echo randBgColor(); ?><?php endif;?><?php endif;?>">
						<div class="item-label <?php if ($this->options->colorBgPosts == 'customColor'): ?><?php if (array_key_exists('green', unserialize($this->___fields()))): ?> bg-green<?php elseif (array_key_exists('red', unserialize($this->___fields()))): ?> bg-red<?php elseif (array_key_exists('yellow', unserialize($this->___fields()))): ?> bg-yellow<?php elseif (array_key_exists('blue', unserialize($this->___fields()))): ?> bg-blue<?php elseif (array_key_exists('purple', unserialize($this->___fields()))): ?> bg-purple<?php else: ?> bg-<?php echo randBgColor(); ?><?php endif;?><?php endif;?>">
							<div class="item-title"><a href="<?php $this->permalink()?>"><?php $this->title()?></a></div>
							<div class="item-meta clearfix">
								<?php if (array_key_exists('book', unserialize($this->___fields()))): ?>
								<?php else: ?>
	                            <?php endif;?>
								<div class="item-meta-date"> <?php $this->date('M j, Y');?> </div>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile;?>
				<?php else: ?>
                <div class="post-list-item"><?php _e('没有找到内容,请换别的关键字进行检索');?></div>
		        <?php endif;?>
			</div>
		</div>
	</div>
	<div class="lists-navigator clearfix">
        <?php $this->pageNav('←', '→');?>
    </div>
</div>

<?php $this->need('footer.php');?>