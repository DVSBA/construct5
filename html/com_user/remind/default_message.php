<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

// Joomla 1.5 only

?>

<section class="remind<?php echo htmlspecialchars($this->params->get('pageclass_sfx')) ?>">
	<h2>
		<?php echo htmlspecialchars($this->message->title); ?>
	</h2>
	<p class="message">
		<?php echo htmlspecialchars($this->message->text); ?>
	</p>
</section>