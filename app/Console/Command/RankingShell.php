<?php
/**
* 
*/
class RankingShell extends AppShell
{

	const J1 = 1;
	const J2 = 2;
	const J3 = 3;
	public $uses = array('Ranking', 'Game');

	public function calcall()
	{
		$year = date('Y');
		if ($this->args && $this->args[0] && is_numeric($this->args[0])) {
			$year = intval($this->args[0]);
		}
		$leagues = array(self::J1, self::J2, self::J3);
		foreach ($leagues as $league_id) {
			if ($league_id == self::J1) {
				// J1 1st, 2nd
				$stages = array(1, 2);
				foreach ($stages as $stage) {
					$this->Ranking->deleteAll(array('Ranking.league_id' => $league_id, 'Ranking.stage' => $stage));
					$this->registerRanking($year, $league_id, $stage);
				}
				// J1 年間
				// 1st最終節＋2nd毎節を加算していく
				$this->Ranking->deleteAll(array('Ranking.league_id' => $league_id, 'Ranking.stage' => 0));
				$maxSection = $this->Game->maxSection($year, $league_id, 1);
				for ($section=1; $section <= $maxSection; $section++) {
					$sql = $this->getSqlFor2stage($league_id, $year, $section, $maxSection);
					$ret = $this->Ranking->query($sql);
					$this->saveRankings($ret);
				}
			} else {
				$this->Ranking->deleteAll(array('Ranking.league_id' => $league_id));
				$this->registerRanking($year, $league_id, 1);
			}

			$this->out("league_id: " . $league_id . " is done.");
		}
	}

	private function registerRanking($year, $league_id, $stage)
	{
		// stageの集計を行う
		$maxSection = $this->Game->maxSection($year, $league_id, $stage);
		for ($section=1; $section <= $maxSection; $section++) { 
			$sql = $this->getSql($league_id, $year, $stage, $section);
			$ret = $this->Ranking->query($sql);
			$this->saveRankings($ret);
		}
	}

	// public function calc()
	// {
	// 	if ($this->args[0] && is_numeric($this->args[0])) {
	// 		$league_id = intval($this->args[0]);
	// 	}
	// 	if ($this->args[1] && is_numeric($this->args[1])) {
	// 		$year = intval($this->args[1]);
	// 	}
	// 	if ($this->args[2] && is_numeric($this->args[2])) {
	// 		$section = intval($this->args[2]);
	// 	}
	// 	$leagues = array(self::J1, self::J2, self::J3);
	// 	foreach ($leagues as $league_id) {
	// 		$sql = $this->getSql($league_id, $year, $section);
	// 		$ret = $this->Ranking->query($sql);
	// 		$this->saveRankings($ret);
	// 		$this->out("league_id: " . $league_id . " is done.");
	// 	}
	// }

	private function saveRankings($rankings)
	{
		foreach ($rankings as $k => $row) {
			$params = array();
			foreach ($row as $arr) {
				foreach ($arr as $key => $value) {
					$params[$key] = $value;
				}
			}
			$params['rank'] = $k + 1;
			$this->Ranking->create();
			$this->Ranking->save($params);
		}
	}

	/**
	 * todo: use cake model method
	 */
	private function getSql($league_id, $year, $stage, $section = null)
	{
		if ($section != null && is_numeric($section)) {
			$section_conditon = " and section <= " . $section;
		}

		$sql = <<<EOD
select
	year,
	league_id,
	team_id,
	max(section) as section,
	stage,
	count(*) as games_all,
	sum(wins) as games_won,
	sum(loses) as games_lost,
	sum(draws) as games_drawn,
	sum(kachiten) as point,
	sum(goals_get) as score_got,
	sum(goals_lost) as score_lost,
	(sum(goals_get) - sum(goals_lost)) as score_diff,
	now(),
	now()
from
(select
	year,
	league_id,
	section,
	stage,
	home_team_id as team_id,
	home_team_goals as goals_get,
	away_team_goals as goals_lost,
	case result
		when 1 then 3
		when 2 then 0
		when 3 then 1
	end kachiten,
	case result when 1 then 1 else 0 end wins,
	case result when 2 then 1 else 0 end loses,
	case result when 3 then 1 else 0 end draws
from
	games
union all
select
	year,
	league_id,
	section,
	stage,
	away_team_id as team_id,
	away_team_goals as goals_get,
	home_team_goals as goals_lost,
	case result
		when 1 then 0
		when 2 then 3
		when 3 then 1
	end kachiten,
	case result when 1 then 1 else 0 end loses,
	case result when 2 then 1 else 0 end wins,
	case result when 3 then 1 else 0 end draws
from
	games
) as table1
where
	league_id = $league_id
	and year = $year
	and stage = $stage
	$section_conditon
group by
	year,
	team_id
order by
	point desc,
	score_diff desc
;
EOD;
		return $sql;
	}

	private function getSqlFor2stage($league_id, $year, $section, $max_section)
	{
		$sql = <<<EOD
select
	r1.year,
	r1.league_id,
	r1.team_id,
	r1.section + r2.section as section,
	0 as stage,
	r1.games_all + r2.games_all as games_all,
	r1.games_won + r2.games_won as games_won,
	r1.games_lost + r2.games_lost as games_lost,
	r1.games_drawn + r2.games_drawn as games_drawn,
	r1.point + r2.point as point,
	r1.score_got + r2.score_got as score_got,
	r1.score_lost + r2.score_lost as score_lost,
	r1.score_diff + r2.score_diff as score_diff
from
(select
	*
from
	rankings
where
	year = $year
	and
	league_id = $league_id
	and
	stage = 1
	and
	section = $max_section
) as r1
left join
(
select
	*
from
	rankings
where
	year = $year
	and
	league_id = $league_id
	and
	stage = 2
	and
	section = $section
) as r2
on r1.team_id = r2.team_id
order by
	point desc,
	score_diff desc
;
EOD;
		return $sql;
	}
}