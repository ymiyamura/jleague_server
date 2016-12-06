<div class="rankings view">
<h2><?php echo __('Ranking'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Section'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['section']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rank'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['rank']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Point'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['point']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ranking['Team']['name'], array('controller' => 'teams', 'action' => 'view', $ranking['Team']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('League'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ranking['League']['name'], array('controller' => 'leagues', 'action' => 'view', $ranking['League']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Games All'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['games_all']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Games Won'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['games_won']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Games Lost'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['games_lost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Games Drawn'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['games_drawn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Score Got'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['score_got']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Score Lost'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['score_lost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Score Diff'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['score_diff']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($ranking['Ranking']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ranking'), array('action' => 'edit', $ranking['Ranking']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ranking'), array('action' => 'delete', $ranking['Ranking']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ranking['Ranking']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ranking'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
	</ul>
</div>
