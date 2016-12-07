<?php 
App::import('Vendor', 'phpQuery-onefile');
App::uses('TeamShell', 'Console/Command');
/**
* 
*/
class ImportShell extends AppShell
{
	const J1 = 1;
	const J2 = 2;
	const J3 = 3;
	
	public function teams()
	{
		$leagues = array(self::J1, self::J2, self::J3);

		foreach ($leagues as $league) {
			$this->registerTeams($league);
		}
	}

	public function schedules()
		{
			// 2016年の全日程
			$url = 'https://data.j-league.or.jp/SFMS01/search?competition_years=2016&competition_frame_ids=1&competition_frame_ids=2&competition_frame_ids=3&tv_relay_station_name=';
			
			// #search-list > div:nth-child(3) > table > tbody > tr:nth-child(1)
			$html = file_get_contents($url);
			$doc = phpQuery::newDocument($html);
			$path = '#search-list > div:nth-child(3) > table > tbody > tr';
			foreach($doc[$path] as $row) {
				$this->out(pq($row)->find('td:eq(1)')->text());
			}

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