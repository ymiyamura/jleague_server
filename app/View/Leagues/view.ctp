<div class="leagues view">
<h2><?php echo __('League'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($league['League']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($league['League']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($league['League']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($league['League']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit League'), array('action' => 'edit', $league['League']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete League'), array('action' => 'delete', $league['League']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $league['League']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Games'), array('controller' => 'games', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Game'), array('controller' => 'games', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankings'), array('controller' => 'rankings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ranking'), array('controller' => 'rankings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Games'); ?></h3>
	<?php if (!empty($league['Game'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Section'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Stadium'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('Home Team Id'); ?></th>
		<th><?php echo __('Away Team Id'); ?></th>
		<th><?php echo __('Home Team Goals'); ?></th>
		<th><?php echo __('Away Team Goals'); ?></th>
		<th><?php echo __('Result'); ?></th>
		<th><?php echo __('League Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($league['Game'] as $game): ?>
		<tr>
			<td><?php echo $game['id']; ?></td>
			<td><?php echo $game['year']; ?></td>
			<td><?php echo $game['section']; ?></td>
			<td><?php echo $game['date']; ?></td>
			<td><?php echo $game['stadium']; ?></td>
			<td><?php echo $game['start']; ?></td>
			<td><?php echo $game['home_team_id']; ?></td>
			<td><?php echo $game['away_team_id']; ?></td>
			<td><?php echo $game['home_team_goals']; ?></td>
			<td><?php echo $game['away_team_goals']; ?></td>
			<td><?php echo $game['result']; ?></td>
			<td><?php echo $game['league_id']; ?></td>
			<td><?php echo $game['created']; ?></td>
			<td><?php echo $game['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'games', 'action' => 'view', $game['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'games', 'action' => 'edit', $game['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'games', 'action' => 'delete', $game['id']), array('confirm' => __('Are you sure you want to delete # %s?', $game['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Game'), array('controller' => 'games', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Rankings'); ?></h3>
	<?php if (!empty($league['Ranking'])): ?>
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
	<?php foreach ($league['Ranking'] as $ranking): ?>
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
<div class="related">
	<h3><?php echo __('Related Teams'); ?></h3>
	<?php if (!empty($league['Team'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Logo Image'); ?></th>
		<th><?php echo __('Color'); ?></th>
		<th><?php echo __('Short Name'); ?></th>
		<th><?php echo __('League Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($league['Team'] as $team): ?>
		<tr>
			<td><?php echo $team['id']; ?></td>
			<td><?php echo $team['name']; ?></td>
			<td><?php echo $team['logo_image']; ?></td>
			<td><?php echo $team['color']; ?></td>
			<td><?php echo $team['short_name']; ?></td>
			<td><?php echo $team['league_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'teams', 'action' => 'view', $team['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'teams', 'action' => 'edit', $team['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'teams', 'action' => 'delete', $team['id']), array('confirm' => __('Are you sure you want to delete # %s?', $team['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
