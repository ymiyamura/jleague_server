<div class="rankings index">
	<h2><?php echo __('Rankings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('section'); ?></th>
			<th><?php echo $this->Paginator->sort('rank'); ?></th>
			<th><?php echo $this->Paginator->sort('point'); ?></th>
			<th><?php echo $this->Paginator->sort('team_id'); ?></th>
			<th><?php echo $this->Paginator->sort('league_id'); ?></th>
			<th><?php echo $this->Paginator->sort('games_all'); ?></th>
			<th><?php echo $this->Paginator->sort('games_won'); ?></th>
			<th><?php echo $this->Paginator->sort('games_lost'); ?></th>
			<th><?php echo $this->Paginator->sort('games_drawn'); ?></th>
			<th><?php echo $this->Paginator->sort('score_got'); ?></th>
			<th><?php echo $this->Paginator->sort('score_lost'); ?></th>
			<th><?php echo $this->Paginator->sort('score_diff'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($rankings as $ranking): ?>
	<tr>
		<td><?php echo h($ranking['Ranking']['id']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['year']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['section']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['rank']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['point']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ranking['Team']['name'], array('controller' => 'teams', 'action' => 'view', $ranking['Team']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ranking['League']['name'], array('controller' => 'leagues', 'action' => 'view', $ranking['League']['id'])); ?>
		</td>
		<td><?php echo h($ranking['Ranking']['games_all']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['games_won']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['games_lost']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['games_drawn']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['score_got']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['score_lost']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['score_diff']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['created']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ranking['Ranking']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ranking['Ranking']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ranking['Ranking']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ranking['Ranking']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Ranking'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
	</ul>
</div>
