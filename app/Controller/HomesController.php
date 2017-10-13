<?php
App::uses('AppController', 'Controller');
/**
 * Homes Controller
 */
class HomesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public $helpers = array("RankingTable");

	public $uses = array(
		'Team',
		'Game',
		'Ranking',
	);

	public function index()
	{
	}

	public function roasso()
	{
		$team = $this->Team->find('first', array(
			'conditions' => array(
				'name' => 'ロアッソ熊本',
				'year' => date('Y'),
			),
			'recursive' => -1,
		));
		$team_id = $team['Team']['id'];
		$league_id = $team['Team']['league_id'];
		$this->log($team_id);

		// チームの成績
		$games = $this->Game->find('all', array(
			'conditions' => array(
				'Game.year' => date('Y'),
				'OR' => array(
					'home_team_id' => $team_id,
					'away_team_id' => $team_id,
				),
			),
			'order' => 'section desc',
		));
		foreach ($games as &$game) {
			if ($game['Game']['home_team_id'] == $team_id) {
				$game['Roasso']['result'] = $game['Game']['result'];
			} else {
				switch ($game['Game']['result']) {
					case 1:
						$game['Roasso']['result'] = 2;
						break;
					case 2:
						$game['Roasso']['result'] = 1;
						break;
					default:
						$game['Roasso']['result'] = $game['Game']['result'];
						break;
				}
			}
		}

		// 最新の順位表
		// 直近の節
		$recent_game = $this->Game->find('first', array(
			'fields' => array(
				'section',
				'stage',
			),
			'conditions' => array(
				'Game.year' => date('Y'),
				'result >' => 0,
				'OR' => array(
					'home_team_id' => $team_id,
					'away_team_id' => $team_id,
				),
			),
			'order' => 'section desc',
		));

		$section = 1;
		$stage = 1;
		if (!empty($recent_game)) {
			$section = $recent_game['Game']['section'];
			$stage = $recent_game['Game']['stage'];
		}

		$ranking = $this->Ranking->find('all', array(
			'conditions' => array(
				'Ranking.year' => date('Y'),
				'Ranking.league_id' => $league_id,
				'Ranking.section' => $section,
				'Ranking.stage' => $stage,
			),
			'order' => 'rank',
		));

		$results = array(
			0 => '-',
			1 => '◯',
			2 => '×',
			3 => '△'
		);

		$result_colors = array(
			0 => '#F8F8FF',
			1 => '#FFC0CB',
			2 => '#ADD8E6',
			3 => '#FAFAD2',
		);
		$this->set(compact('games', 'results', 'result_colors', 'ranking', 'section', 'team_id'));
	}
}
