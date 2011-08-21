<?php defined('_JEXEC') or die;
/**
* @package		Unified Template Framework for Joomla!
* @author		Joomla Engineering http://joomlaengineering.com
* @copyright	Copyright (C) 2010, 2011 Matt Thomas | Joomla Engineering. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

$cparams = JComponentHelper::getParams ('com_media');
?>

<div class="blog<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

	<?php if ($this->params->get('show_page_title')) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>

	<?php if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
	<div class="section-desc">
		<?php if ($this->params->get('show_description_image') && $this->section->image) : ?>
			<img src="<?php echo $this->baseurl . $cparams->get('image_path').'/'.$this->escape($this->section->image); ?>" class="image_<?php echo $this->escape($this->section->image_position); ?>" />
		<?php endif; ?>		
		<p class="section-desc-text">
			<?php if ($this->params->get('show_description') && $this->section->description) : ?>
				<?php echo $this->section->description; ?>
			<?php endif; ?>
		</p>		
	</div>
	<?php endif; ?>

	<?php $i = $this->pagination->limitstart;
	$rowcount = $this->params->def('num_leading_articles', 1);?>
	<div class="items-leading">
		<?php for ($y = 0; $y < $rowcount && $i < $this->total; $y++, $i++) : ?>
			<div class="leading-<?php echo $y ;?>">
				<?php $this->item =& $this->getItem($i, $this->params); ?>
				<?php echo $this->loadTemplate('item'); ?>
			</div>
		<?php endfor; ?>
	</div>

	<?php $introcount = (int)$this->params->def('num_intro_articles', 4);
	if ($introcount) :
		$colcount = (int)$this->params->def('num_columns', 2);
		if ($colcount == 0) :
			$colcount = 1;
		endif;
		$rowcount = (int) $introcount / $colcount;
		$ii = 0;
		for ($y = 0; $y < $rowcount && $i < $this->total; $y++) : ?>
			<div class="items-row cols-<?php echo $colcount; ?> row-<?php echo $y; ?>">
				<?php for ($z = 0; $z < $colcount && $ii < $introcount && $i < $this->total; $z++, $i++, $ii++) : ?>
					<div class="item column-<?php echo $z + 1; ?>" >
						<?php $this->item =& $this->getItem($i, $this->params); ?>
						<?php echo $this->loadTemplate('item'); ?>
					</div>
				<?php endfor; ?>
			</div>
		<?php endfor;
	endif; ?>

	<?php $numlinks = (int)$this->params->def('num_links', 4); ?>
	<?php if ($numlinks && $i < $this->total) : ?>	
		<?php $this->links = array_slice($this->items, $i - $this->pagination->limitstart, $i - $this->pagination->limitstart + $numlinks); ?>
		<?php echo $this->loadTemplate('links'); ?>	
	<?php endif; ?>

	<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
		<nav class="pagination">
			<?php if( $this->pagination->get('pages.total') > 1 ) : ?>
				<p class="counter">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
			<?php endif; ?>
		</nav>
	<?php endif; ?>

</div>
