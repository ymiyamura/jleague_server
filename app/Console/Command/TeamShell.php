<?php
/**
*
*/
class TeamShell extends AppShell
{
	public $uses = array('Team');

	function _welcome()
	{
	}

	public function index()
	{
		foreach ($this->Team->find('all') as $key => $team) {
			$str = $team['League']['name'] . "\t" . $team['Team']['name'];
			$this->out($str);
		}
	}

	public function add($league_id = null, $name = null, $year)
	{
		$params = array();
		$params['year'] = $year;
		$params['league_id'] = ($league_id === null) ? $this->args[0] : $league_id;
		$params['name'] = ($name === null) ? $this->args[1] : $name;
		$params['short_name'] = $this->Team->shortNames[$params['name']];
		$this->Team->create();
		$this->Team->save($params);
		$this->out('登録しました。: ' . $params['league_id'] . ' ' . $params['name']);
	}

	/**
	 * $this->args[0]: league_id
	 */
	public function truncate($league_id = null, $year)
	{
		$league_id = ($league_id === null) ? $this->args[0] : $league_id;
		$conditions = array('league_id' => $league_id, 'year' => $year);
		$this->Team->deleteAll($conditions);
		$this->out('削除しました。');
	}
}
