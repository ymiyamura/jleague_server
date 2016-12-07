<?php
/**
* 
*/
class TeamShell extends AppShell
{
	public $uses = array('Team');
	
	public function index()
	{
		foreach ($this->Team->find('all') as $key => $team) {
			$str = $team['League']['name'] . "\t" . $team['Team']['name'];
			$this->out($str);
		}
	}

	public function add($league_id = null, $name = null)
	{
		$params = array();
		$params['league_id'] = ($league_id === null) ? $this->args[0] : $league_id;
		$params['name'] = ($name === null) ? $this->args[1] : $name;
		$this->Team->create();
		$this->Team->save($params);
		$this->out('登録しました。: ' . $params['league_id'] . ' ' . $params['name']);
	}

	/**
	 * $this->args[0]: league_id
	 */
	public function truncate($league_id = null)
	{
		$league_id = ($league_id === null) ? $this->args[0] : $league_id;
		$conditions = array('league_id' => $league_id);
		$this->Team->deleteAll($conditions);
		$this->out('削除しました。');
	}
}