<div class="games form">
<?php echo $this->Form->create('Game'); ?>
	<fieldset>
		<legend><?php echo __('Edit Game'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('year');
		echo $this->Form->input('section');
		echo $this->Form->input('date');
		echo $this->Form->input('stadium');
		echo $this->Form->input('start');
		echo $this->Form->input('home_team_id');
		echo $this->Form->input('away_team_id');
		echo $this->Form->input('home_team_goals');
		echo $this->Form->input('away_team_goals');
		echo $this->Form->input('result');
		echo $this->Form->input('league_id');
		echo $this->Form->input('stage');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Game.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Game.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Games'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Home Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
	</ul>
</div>
