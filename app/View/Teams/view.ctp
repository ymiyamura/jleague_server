<div class="teams view">
<h2><?php echo __('Team'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($team['Team']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($team['Team']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logo Image'); ?></dt>
		<dd>
			<?php echo h($team['Team']['logo_image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($team['Team']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
			<?php echo h($team['Team']['short_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('League Id'); ?></dt>
		<dd>
			<?php echo h($team['Team']['league_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Team'), array('action' => 'edit', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Team'), array('action' => 'delete', $team['Team']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $team['Team']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankings'), array('controller' => 'rankings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ranking'), array('controller' => 'rankings', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Rankings'); ?></h3>
	<?php if (!empty($team['Ranking'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Section'); ?></th>
		<th><?php echo __('Rank'); ?></th>
		<th><?php echo __('Point'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('League Id'); ?></th>
		<th><?php echo __('Games All'); ?></th>
		<th><?php echo __('Games Won'); ?></th>
		<th><?php echo __('Games Lost'); ?></th>
		<th><?php echo __('Games Drawn'); ?></th>
		<th><?php echo __('Score Got'); ?></th>
		<th><?php echo __('Score Lost'); ?></th>
		<th><?php echo __('Score Diff'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($team['Ranking'] as $ranking): ?>
		<tr>
			<td><?php echo $ranking['id']; ?></td>
			<td><?php echo $ranking['year']; ?></td>
			<td><?php echo $ranking['section']; ?></td>
			<td><?php echo $ranking['rank']; ?></td>
			<td><?php echo $ranking['point']; ?></td>
			<td><?php echo $ranking['team_id']; ?></td>
			<td><?php echo $ranking['league_id']; ?></td>
			<td><?php echo $ranking['games_all']; ?></td>
			<td><?php echo $ranking['games_won']; ?></td>
			<td><?php echo $ranking['games_lost']; ?></td>
			<td><?php echo $ranking['games_drawn']; ?></td>
			<td><?php echo $ranking['score_got']; ?></td>
			<td><?php echo $ranking['score_lost']; ?></td>
			<td><?php echo $ranking['score_diff']; ?></td>
			<td><?php echo $ranking['created']; ?></td>
			<td><?php echo $ranking['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rankings', 'action' => 'view', $ranking['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rankings', 'action' => 'edit', $ranking['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rankings', 'action' => 'delete', $ranking['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ranking['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ranking'), array('controller' => 'rankings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
