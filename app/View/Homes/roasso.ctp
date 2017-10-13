<?php //pr($games); ?>
<div class="game">
	<table>
		<tr>
			<td>節</td>
			<td>日</td>
			<td>開始</td>
			<td>ホーム</td>
			<td>結果</td>
			<td>アウェイ</td>
			<td>スタジアム</td>
			<td>結果</td>
		</tr>
		<?php foreach ($games as $key => $game): ?>
			<tr style="background-color: <?php echo $result_colors[$game['Roasso']['result']]; ?>">
				<td><?php echo h($game['Game']['section']); ?></td>
				<td><?php echo h($game['Game']['date']); ?></td>
				<td><?php echo h($game['Game']['start']); ?></td>
				<td><?php echo h($game['HomeTeam']['short_name']); ?></td>
				<td><?php
				if ($game['Game']['result'] > 0) {
					echo $game['Game']['home_team_goals'] . ' - ' . $game['Game']['away_team_goals'];
				} else {
					echo '-';
				}
				?></td>
				<td><?php echo h($game['AwayTeam']['short_name']); ?></td>
				<td><?php echo h($game['Game']['stadium']); ?></td>
				<td><?php echo $results[$game['Roasso']['result']]; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<div class="ranking">
	<p>第<?php echo $section; ?>節</p>
	<table>
		<tr>
			<td>順位</td>
			<td>チーム</td>
			<td>勝点</td>
			<td>試合数</td>
			<td>勝</td>
			<td>分</td>
			<td>負</td>
			<td>得点</td>
			<td>失点</td>
			<td>得失差</td>
		</tr>
		<?php foreach ($ranking as $key => $value): ?>
			<?php
			if ($value['Ranking']['team_id'] == $team_id) {
				$color = '#FF4500';
			} elseif (in_array($value['Ranking']['rank'], array(1, 2))) {
				$color = '#FFA500';
			} elseif (in_array($value['Ranking']['rank'], array(3, 4, 5, 6))) {
				$color = '#FFD700';
			} elseif (in_array($value['Ranking']['rank'], array(21, 22))) {
				$color = '#6495ED';
			}else {
				$color = '#F8F8FF';
			}
			?>
			<tr style="background-color: <?php echo $color; ?>">
				<td><?php echo $value['Ranking']['rank']; ?></td>
				<td><?php echo $value['Team']['name']; ?></td>
				<td><?php echo $value['Ranking']['point']; ?></td>
				<td><?php echo $value['Ranking']['games_all']; ?></td>
				<td><?php echo $value['Ranking']['games_won']; ?></td>
				<td><?php echo $value['Ranking']['games_drawn']; ?></td>
				<td><?php echo $value['Ranking']['games_lost']; ?></td>
				<td><?php echo $value['Ranking']['score_got']; ?></td>
				<td><?php echo $value['Ranking']['score_lost']; ?></td>
				<td><?php echo $value['Ranking']['score_diff']; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
