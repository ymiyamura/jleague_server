<div class="headline">
	<div class="next-game">
		<?php if (!empty($next_game)): ?>
			<h2>次の試合</h2>
			<p><?php echo $next_game['Game']['section']; ?>節 <?php echo $next_game['HomeTeam']['name']; ?> vs <?php echo $next_game['AwayTeam']['name']; ?></p>
			<p><?php echo $next_game['Game']['date']; ?> <?php echo $next_game['Game']['start']; ?> <?php echo $next_game['Game']['stadium']; ?></p>
		<?php endif; ?>
	</div>
	<div class="now ranking">
		<p><?php echo $my_ranking['rank']; ?>位 勝点<?php echo $my_ranking['point']; ?></p>
		<p>
		<?php if ($to_up == -1): ?>
			自動昇格圏内
		<?php else: ?>
			自動昇格まで勝点差 <?php echo $to_up; ?>
		<?php endif; ?></p>
		<p>
		<?php if ($to_po == -1): ?>
			<?php if ($to_up != -1): ?>
				プレーオフ進出圏内
			<?php endif; ?>
		<?php else: ?>
			プレーオフ進出まで勝点差 <?php echo $to_po; ?>
		<?php endif; ?>
		</p>
		<p>
		<?php if ($to_down == -1): ?>
			自動降格圏内
		<?php else: ?>
			自動降格まで勝点差 <?php echo $to_down; ?>
		<?php endif; ?>
		</p>
	</div>
</div>
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
<div class="sns">
	<a class="twitter-timeline"  href="https://twitter.com/roasso_fan1/lists/official" data-widget-id="728575309713264645">https://twitter.com/roasso_fan1/lists/officialのツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<a class="twitter-timeline"  href="https://twitter.com/hashtag/roasso" data-widget-id="423819573071060992">#roasso のツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</div>
