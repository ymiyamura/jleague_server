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
	
	public function exec()
	{
		$this->out("hello");

		$leagues = array(self::J1, self::J2, self::J3);

		foreach ($leagues as $league) {
			$this->register($league);
		}

		// // j1第1節の順位表を取得
		// $html = file_get_contents('https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%91%E3%83%AA%E3%83%BC%E3%82%B0+%EF%BC%91%EF%BD%93%EF%BD%94&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=411&competitionSectionId=1&search=search');

		// // チーム名を取得
		// // $('#search_result > tbody:nth-child(2) > tr > td.wd02 > a').each(function(i,elem){console.log($(elem).text());})
		// $doc = phpQuery::newDocument($html);
		// // echo $doc["title"]->text();
		// // var_dump(pq('#search_result > tbody:nth-child(2) > tr > td.wd02 > a'));

		// foreach($doc['#search_result > tbody:nth-child(2) > tr > td.wd02 > a'] as $row) {
		// 	// DBに登録
		// 	$this->out(pq($row)->text());
		// 	$shell = new TeamShell();
		// 	$shell->startup();
		// 	$shell->add(1, pq($row)->text());
		// }

		// $url_j2 = 'https://data.j-league.or.jp/SFRT01/?competitionSectionIdLabel=%E7%AC%AC%EF%BC%91%E7%AF%80&competitionIdLabel=%E6%98%8E%E6%B2%BB%E5%AE%89%E7%94%B0%E7%94%9F%E5%91%BD%EF%BC%AA%EF%BC%92%E3%83%AA%E3%83%BC%E3%82%B0&yearIdLabel=2016%E5%B9%B4&yearId=2016&competitionId=413&competitionSectionId=1&search=search';


	}

	private function getUrl($league)
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

	private function register($league)
	{
		$url = $this->getUrl($league);
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