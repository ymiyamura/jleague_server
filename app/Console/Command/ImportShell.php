<?php
App::import('Vendor', 'phpQuery-onefile');
App::uses('TeamShell', 'Console/Command');
App::uses('CakeTime', 'Utility');
/**
*
*/
class ImportShell extends AppShell
{
	const J1 = 1;
	const J2 = 2;
	const J3 = 3;
	public $uses = array('Team', 'Game');

	public function getOptionParser() {
		$parser = parent::getOptionParser();
		$parser->addOption('year', array(
			'help' => 'sample option',
			'default' => date('Y'),
		));
		return $parser;
	}

	public function teams()
	{
		$year = $this->params['year'];
		$this->out($year);
		$leagues = array(self::J1, self::J2, self::J3);

		foreach ($leagues as $league) {
			$this->registerTeams($league, $year);
		}
	}

	public function games()
	{
		$year = $this->params['year'];
		$this->out($year);

		// 全日程
		$url = 'https://data.j-league.or.jp/SFMS01/search?competition_years=' . $year . '&competition_frame_ids=1&competition_frame_ids=2&competition_frame_ids=3&tv_relay_station_name=';

		// #search-list > div:nth-child(3) > table > tbody > tr:nth-child(1)
		$html = file_get_contents($url);
		$doc = phpQuery::newDocument($html);
		$path = '#search-list > div:nth-child(3) > table > tbody > tr';
		$i = 0;
		foreach($doc[$path] as $row) {
			$params = array();
			// 年
			// $params['year'] = pq($row)->find('td:eq(0)')->text();
			$params['Game.year'] = $year;
			// リーグ
			list($params['Game.league_id'], $params['stage']) = $this->makeLeagueId(pq($row)->find('td:eq(1)')->text());
			// 節
			$params['section'] = $this->makeSection(pq($row)->find('td:eq(2)')->text());
			// ホームチーム
			$params['home_team_id'] = $this->makeTeamId(pq($row)->find('td:eq(5)>a')->text(), $year);
			// アウェイチーム
			$params['away_team_id'] = $this->makeTeamId(pq($row)->find('td:eq(7)>a')->text(), $year);

			$game = $this->Game->find('first', array(
				'conditions' => $params,
				// 'recursive' => -1,
			));
			$params['year'] = $params['Game.year'];
			$params['league_id'] = $params['Game.league_id'];
			unset($params['Game.year']);
			unset($params['Game.league_id']);
			if (empty($game)) {
				$this->Game->create();
				$this->out("create.");
			} else {
				$params['id'] = $game['Game']['id'];
				$this->out("game_id is " . $params['id']);
			}
			// 日程
			$params['date'] = $this->makeDate(pq($row)->find('td:eq(3)')->text(), $params['year']);
			// スタジアム
			$params['stadium'] = trim(pq($row)->find('td:eq(8)')->text());
			// 開始時間
			$params['start'] = trim(pq($row)->find('td:eq(4)')->text());
			// H得点、A得点、結果
			list($params['home_team_goals'], $params['away_team_goals'], $params['result']) = $this->makeResult(pq($row)->find('td:eq(6)>a')->text());
			// $this->out(var_export($params, true));
			// $this->Game->create();
			$this->Game->save($params);
			$i++;
			// if ($i == 10) {
			// 	return;
			// }
		}
		$this->out($i . '件の登録が完了しました。');
	}

	private function makeLeagueId($input)
	{
		$league_id = 0;
		$stage = 1;
		$str = mb_convert_kana(mb_substr($input, 0, 2), "a");
		if ($str == "J1") {
			$league_id = self::J1;
			if (preg_match('/２ｎｄ/', $input)) {
				$stage = 2;
			}
		} elseif ($str == "J2") {
			$league_id = self::J2;
		} elseif ($str == "J3") {
			$league_id = self::J3;
		}
		return array($league_id, $stage);
	}

	private function makeSection($input)
	{
		if (preg_match('/^第(.+)節/', $input, $matches)) {
			return mb_convert_kana($matches[1], "n");
		}
		return 0;
	}

	private function makeDate($input, $year)
	{
		if (preg_match('/^([0-9]{2})\/([0-9]{2})/', $input, $matches)) {
			return date('Y-m-d H:i:s', mktime(0,0,0,$matches[1],$matches[2],$year));
		}
		return null;
	}

	private function makeTeamId($input, $year)
	{
		$namemap = $this->Team->namemap($year);
		return $namemap[$input];
	}

	private function makeResult($input)
	{
		$home_team_goals = 0;
		$away_team_goals = 0;
		$result = 0;
		if (preg_match('/^([0-9]+)-([0-9]+)/', trim($input), $matches)) {
			$home_team_goals = $matches[1];
			$away_team_goals = $matches[2];
			if ($home_team_goals > $away_team_goals) {
				$result = 1;
			} elseif ($home_team_goals < $away_team_goals) {
				$result = 2;
			} elseif ($home_team_goals == $home_team_goals) {
				$result = 3;
			}
		}
		return array($home_team_goals, $away_team_goals, $result);
	}
	private function getUrlForTeams($league, $year)
	{
		switch ($league) {
			case self::J1:
				switch ($year) {
					case '2016':
						$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%91%E3%83%AA%E3%83%BC%E3%82%B0+%EF%BC%91%EF%BD%93%EF%BD%94&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=411&competitionSectionId=1&search=search';
						break;
					case '2017':
						$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E6%9C%80%E6%96%B0%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%91%E3%83%AA%E3%83%BC%E3%82%B0&yearIdLabel=2017%E5%B9%B4&yearId=2017&competitionId=428&competitionSectionId=0&search=search';
						break;

					default:
						# code...
						break;
				}

				break;
			case self::J2:
				switch ($year) {
					case '2016':
						$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%92%E3%83%AA%E3%83%BC%E3%82%B0&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=413&competitionSectionId=1&search=search';
						break;
					case '2017':
						$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E6%9C%80%E6%96%B0%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%92%E3%83%AA%E3%83%BC%E3%82%B0&yearIdLabel=2017%E5%B9%B4&yearId=2017&competitionId=429&competitionSectionId=0&search=search';
						break;
					default:
						# code...
						break;
				}
				break;
			case self::J3:
				switch ($year) {
					case '2016':
						$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%93%E3%83%AA%E3%83%BC%E3%82%B0&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=414&competitionSectionId=1&search=search';
						break;
					case '2017':
						$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E6%9C%80%E6%96%B0%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%93%E3%83%AA%E3%83%BC%E3%82%B0&yearIdLabel=2017%E5%B9%B4&yearId=2017&competitionId=430&competitionSectionId=0&search=search';
						break;
					default:
						# code...
						break;
				}
				break;

			default:
				$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%91%E3%83%AA%E3%83%BC%E3%82%B0+%EF%BC%91%EF%BD%93%EF%BD%94&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=411&competitionSectionId=1&search=search';
				break;
		}
		return $url;
	}

	private function registerTeams($league, $year)
	{
		$url = $this->getUrlForTeams($league, $year);
		// 順位表を取得
		$html = file_get_contents($url);

		// チーム名を取得
		// $('#search_result > tbody:nth-child(2) > tr > td.wd02 > a').each(function(i,elem){console.log($(elem).text());})
		$doc = phpQuery::newDocument($html);

		// 最初に当該リーグのデータを削除
		$shell = new TeamShell();
		$shell->startup();
		$shell->truncate($league, $year);

		$path = '#search_result > tbody:nth-child(2) > tr > td.wd02 > a';
		foreach($doc[$path] as $row) {
			// DBに登録
			$shell = new TeamShell();
			$shell->startup();
			$shell->add($league, pq($row)->text(), $year);
		}
	}
}
