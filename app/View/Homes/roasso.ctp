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
