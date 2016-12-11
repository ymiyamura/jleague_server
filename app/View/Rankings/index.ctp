<div class="rankings index">
	<h2><?php echo __('Rankings'); ?></h2>
	<div>
		<?php echo $this->Html->link('J1', array('controller' => 'rankings', 'action' => 'index', 'league' => 1, 'year' => 2016, 'section' => 17)); ?>
		<?php echo $this->Html->link('J2', array('controller' => 'rankings', 'action' => 'index', 'league' => 2, 'year' => 2016, 'section' => 42)); ?>
		<?php echo $this->Html->link('J3', array('controller' => 'rankings', 'action' => 'index', 'league' => 3, 'year' => 2016, 'section' => 30)); ?>
		<?php 
			echo $this->Form->create(null, array(
				'type' => 'get',
				'url' => array(
					'controller' => 'rankings',
					'action' => 'index',
					'league' => $this->params['named']['league'],
					'section' => $this->params['named']['section'],
				),
			));
			echo $this->Form->input('year', array(
				'type'=>'select',
				'div'=>false,
				'label'=>false,
				'options'=>$years,
				'default'=> $this->params['named']['year'],
				'onChange' => 'return this.form.submit();'
			));
			echo $this->Form->end();
		?>
		<?php 
			echo $this->Form->create(null, array(
				'type' => 'get',
				'url' => array(
					'controller' => 'rankings',
					'action' => 'index',
					'league' => $this->params['named']['league'],
					'year' => $this->params['named']['year'],
				),
			));
			echo $this->Form->input('section', array(
				'type'=>'select',
				'div'=>false,
				'label'=>false,
				'options'=>$sections,
				'default'=> $this->params['named']['section'],
				'onChange' => 'return this.form.submit();'
			));
			echo $this->Form->end();
		?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('rank', '順位'); ?></th>
			<th><?php echo $this->Paginator->sort('team_id', 'チーム'); ?></th>
			<th><?php echo $this->Paginator->sort('point', '勝点'); ?></th>
			<th><?php echo $this->Paginator->sort('games_all', '試合'); ?></th>
			<th><?php echo $this->Paginator->sort('games_won', '勝'); ?></th>
			<th><?php echo $this->Paginator->sort('games_lost', '負'); ?></th>
			<th><?php echo $this->Paginator->sort('games_drawn', '分'); ?></th>
			<th><?php echo $this->Paginator->sort('score_got', '得点'); ?></th>
			<th><?php echo $this->Paginator->sort('score_lost', '失点'); ?></th>
			<th><?php echo $this->Paginator->sort('score_diff', '得失'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($rankings as $ranking): ?>
	<tr>
		<td><?php echo h($ranking['Ranking']['rank']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ranking['Team']['name'], array('controller' => 'teams', 'action' => 'view', $ranking['Team']['id'])); ?>
		</td>
		<td><?php echo h($ranking['Ranking']['point']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['games_all']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['games_won']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['games_lost']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['games_drawn']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['score_got']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['score_lost']); ?>&nbsp;</td>
		<td><?php echo h($ranking['Ranking']['score_diff']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ranking['Ranking']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ranking['Ranking']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ranking['Ranking']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ranking['Ranking']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
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
<script>
		
</script>
