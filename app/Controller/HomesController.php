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
	);

	public function index()
	{
	}

	public function roasso()
	{
		$team_id = $this->Team->field('id', array(
			'name' => 'ロアッソ熊本',
			'year' => date('Y'),
		));
		$this->log($team_id);
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
		$this->set(compact('games', 'results', 'result_colors'));
	}
}
