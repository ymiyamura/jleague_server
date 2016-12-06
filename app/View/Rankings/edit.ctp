<div class="rankings form">
<?php echo $this->Form->create('Ranking'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ranking'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('year');
		echo $this->Form->input('section');
		echo $this->Form->input('rank');
		echo $this->Form->input('point');
		echo $this->Form->input('team_id');
		echo $this->Form->input('league_id');
		echo $this->Form->input('games_all');
		echo $this->Form->input('games_won');
		echo $this->Form->input('games_lost');
		echo $this->Form->input('games_drawn');
		echo $this->Form->input('score_got');
		echo $this->Form->input('score_lost');
		echo $this->Form->input('score_diff');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Ranking.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Ranking.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Rankings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
	</ul>
</div>
