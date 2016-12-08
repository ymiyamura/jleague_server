<div class="games view">
<h2><?php echo __('Game'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($game['Game']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($game['Game']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Section'); ?></dt>
		<dd>
			<?php echo h($game['Game']['section']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($game['Game']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stadium'); ?></dt>
		<dd>
			<?php echo h($game['Game']['stadium']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start'); ?></dt>
		<dd>
			<?php echo h($game['Game']['start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Home Team Id'); ?></dt>
		<dd>
			<?php echo h($game['Game']['home_team_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Away Team Id'); ?></dt>
		<dd>
			<?php echo h($game['Game']['away_team_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Home Team Goals'); ?></dt>
		<dd>
			<?php echo h($game['Game']['home_team_goals']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Away Team Goals'); ?></dt>
		<dd>
			<?php echo h($game['Game']['away_team_goals']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Result'); ?></dt>
		<dd>
			<?php echo h($game['Game']['result']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('League'); ?></dt>
		<dd>
			<?php echo $this->Html->link($game['League']['name'], array('controller' => 'leagues', 'action' => 'view', $game['League']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($game['Game']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($game['Game']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stage'); ?></dt>
		<dd>
			<?php echo h($game['Game']['stage']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Game'), array('action' => 'edit', $game['Game']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Game'), array('action' => 'delete', $game['Game']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $game['Game']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Games'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Game'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Home Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
	</ul>
</div>
