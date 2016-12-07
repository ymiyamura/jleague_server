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
	
	public function teams()
	{
		$leagues = array(self::J1, self::J2, self::J3);

		foreach ($leagues as $league) {
			$this->registerTeams($league);
		}
	}

	public function games()
	{
		// 2016年の全日程
		$url = 'https://data.j-league.or.jp/SFMS01/search?competition_years=2016&competition_frame_ids=1&competition_frame_ids=2&competition_frame_ids=3&tv_relay_station_name=';

		// #search-list > div:nth-child(3) > table > tbody > tr:nth-child(1)
		$html = file_get_contents($url);
		$doc = phpQuery::newDocument($html);
		$path = '#search-list > div:nth-child(3) > table > tbody > tr';
		$i = 0;
		foreach($doc[$path] as $row) {
			$params = array();
			// 年
			$params['year'] = pq($row)->find('td:eq(0)')->text();
			// リーグ
			$params['league_id'] = $this->makeLeagueId(pq($row)->find('td:eq(1)')->text());
			// 節
			$params['section'] = $this->makeSection(pq($row)->find('td:eq(2)')->text());
			// 日程
			$params['date'] = $this->makeDate(pq($row)->find('td:eq(3)')->text(), $params['year']);
			// スタジアム
			$params['stadium'] = trim(pq($row)->find('td:eq(8)')->text());
			// 開始時間
			$params['start'] = trim(pq($row)->find('td:eq(4)')->text());
			// ホームチーム
			$params['home_team_id'] = $this->makeTeamId(pq($row)->find('td:eq(5)>a')->text());
			// アウェイチーム
			$params['away_team_id'] = $this->makeTeamId(pq($row)->find('td:eq(7)>a')->text());
			// $this->out($params);
			$this->Game->create();
			$this->Game->save($params);
			$i++;
		}
		$this->out($i . '件の登録が完了しました。');
	}

	private function makeLeagueId($input)
	{
		$str = mb_convert_kana(mb_substr($input, 0, 2), "a");
		if ($str == "J1") {
			return self::J1;
		} elseif ($str == "J2") {
			return self::J2;
		} elseif ($str == "J3") {
			return self::J3;
		}
		return 0;
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

	private function makeTeamId($input)
	{
		$namemap = $this->Team->namemap();
		return $namemap[$input];
	}

	private function getUrlForTeams($league)
	{
		switch ($league) {
			case self::J1:
				$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%91%E3%83%AA%E3%83%BC%E3%82%B0+%EF%BC%91%EF%BD%93%EF%BD%94&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=411&competitionSectionId=1&search=search';
				break;
			case self::J2:
				$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%92%E3%83%AA%E3%83%BC%E3%82%B0&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=413&competitionSectionId=1&search=search';
				break;
			case self::J3:
				$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%93%E3%83%AA%E3%83%BC%E3%82%B0&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=414&competitionSectionId=1&search=search';
				break;
			
			default:
				$url = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%91%E3%83%AA%E3%83%BC%E3%82%B0+%EF%BC%91%EF%BD%93%EF%BD%94&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=411&competitionSectionId=1&search=search';
				break;
		}
		return $url;
	}

	private function registerTeams($league)
	{
		$url = $this->getUrlForTeams($league);
		// 順位表を取得
		$html = file_get_contents($url);

		// チーム名を取得
		// $('#search_result > tbody:nth-child(2) > tr > td.wd02 > a').each(function(i,elem){console.log($(elem).text());})
		$doc = phpQuery::newDocument($html);

		// 最初に当該リーグのデータを削除
		$shell = new TeamShell();
		$shell->startup();
		$shell->truncate($league);

		$path = '#search_result > tbody:nth-child(2) > tr > td.wd02 > a';
		foreach($doc[$path] as $row) {
			// DBに登録
			$shell = new TeamShell();
			$shell->startup();
			$shell->add($league, pq($row)->text());
		}
	}
}