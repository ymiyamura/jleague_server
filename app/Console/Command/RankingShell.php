<?php
/**
* 
*/
class RankingShell extends AppShell
{

	const J1 = 1;
	const J2 = 2;
	const J3 = 3;
	public $uses = array('Ranking');

	public function calc()
	{
		$leagues = array(self::J1, self::J2, self::J3);
		foreach ($leagues as $league_id) {
			$sql = $this->getSql($league_id);
			$ret = $this->Ranking->query($sql);
			foreach ($ret as $k => $row) {
				$params = array();
				foreach ($row["table1"] as $key => $value) {
					$params[$key] = $value;
				}
				foreach ($row[0] as $key => $value) {
					$params[$key] = $value;
				}
				$params['rank'] = $k + 1;
				$this->Ranking->create();
				$this->Ranking->save($params);
			}
			$this->out("league_id: " . $league_id . " is done.");
		}
	}

	/**
	 * todo: use cake model method
	 */
	private function getSql($league_id)
	{
		$sql = <<<EOD
select
	year,
	league_id,
	team_id,
	max(section) as section,
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
group by
	year,
	team_id
order by
	league_id,
	point desc,
	score_diff desc
;
EOD;
		return $sql;
	}
}