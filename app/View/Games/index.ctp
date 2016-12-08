<div class="games index">
	<h2><?php echo __('Games'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('section'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('stadium'); ?></th>
			<th><?php echo $this->Paginator->sort('start'); ?></th>
			<th><?php echo $this->Paginator->sort('home_team_id'); ?></th>
			<th><?php echo $this->Paginator->sort('away_team_id'); ?></th>
			<th><?php echo $this->Paginator->sort('home_team_goals'); ?></th>
			<th><?php echo $this->Paginator->sort('away_team_goals'); ?></th>
			<th><?php echo $this->Paginator->sort('result'); ?></th>
			<th><?php echo $this->Paginator->sort('league_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('stage'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($games as $game): ?>
	<tr>
		<td><?php echo h($game['Game']['id']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['year']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['section']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['date']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['stadium']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['start']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['home_team_id']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['away_team_id']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['home_team_goals']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['away_team_goals']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['result']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($game['League']['name'], array('controller' => 'leagues', 'action' => 'view', $game['League']['id'])); ?>
		</td>
		<td><?php echo h($game['Game']['created']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['modified']); ?>&nbsp;</td>
		<td><?php echo h($game['Game']['stage']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $game['Game']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $game['Game']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $game['Game']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $game['Game']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Game'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Home Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
	</ul>
</div>
