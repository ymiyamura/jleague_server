<?php
App::uses('AppModel', 'Model');
/**
 * Team Model
 *
 * @property League $League
 * @property Ranking $Ranking
 */
class Team extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'league_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'League' => array(
			'className' => 'League',
			'foreignKey' => 'league_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Ranking' => array(
			'className' => 'Ranking',
			'foreignKey' => 'team_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public $shortNames = array(
		'ヴァンフォーレ甲府' => '甲府',
		'浦和レッズ' => '浦和',
		'アルビレックス新潟' => '新潟',
		'サガン鳥栖' => '鳥栖',
		'ベガルタ仙台' => '仙台',
		'鹿島アントラーズ' => '鹿島',
		'大宮アルディージャ' => '大宮',
		'川崎フロンターレ' => '川崎Ｆ',
		'名古屋グランパス' => '名古屋',
		'柏レイソル' => '柏',
		'湘南ベルマーレ' => '湘南',
		'アビスパ福岡' => '福岡',
		'ＦＣ東京' => 'FC東京',
		'横浜Ｆ・マリノス' => '横浜FM',
		'ジュビロ磐田' => '磐田',
		'ガンバ大阪' => 'Ｇ大阪',
		'サンフレッチェ広島' => '広島',
		'ヴィッセル神戸' => '神戸',
		'ザスパクサツ群馬' => '群馬',
		'ジェフユナイテッド千葉' => '千葉',
		'Ｖ・ファーレン長崎' => '長崎',
		'東京ヴェルディ' => '東京Ｖ',
		'セレッソ大阪' => 'Ｃ大阪',
		'カマタマーレ讃岐' => '讃岐',
		'ギラヴァンツ北九州' => '北九州',
		'ロアッソ熊本' => '熊本',
		'水戸ホーリーホック' => '水戸',
		'京都サンガF.C.' => '京都',
		'ファジアーノ岡山' => '岡山',
		'レノファ山口ＦＣ' => '山口',
		'清水エスパルス' => '清水',
		'愛媛ＦＣ' => '愛媛',
		'ツエーゲン金沢' => '金沢',
		'徳島ヴォルティス' => '徳島',
		'北海道コンサドーレ札幌' => '札幌',
		'モンテディオ山形' => '山形',
		'ＦＣ町田ゼルビア' => '町田',
		'横浜ＦＣ' => '横浜FC',
		'松本山雅ＦＣ' => '松本',
		'ＦＣ岐阜' => '岐阜',
		'セレッソ大阪Ｕ－２３' => 'Ｃ大23',
		'ＳＣ相模原' => '相模原',
		'大分トリニータ' => '大分',
		'ＦＣ琉球' => '琉球',
		'ブラウブリッツ秋田' => '秋田',
		'福島ユナイテッドＦＣ' => '福島',
		'栃木ＳＣ' => '栃木',
		'Ｙ．Ｓ．Ｃ．Ｃ．横浜' => 'YS横浜',
		'カターレ富山' => '富山',
		'ガイナーレ鳥取' => '鳥取',
		'鹿児島ユナイテッドＦＣ' => '鹿児島',
		'ガンバ大阪Ｕ－２３' => 'Ｇ大23',
		'ＡＣ長野パルセイロ' => '長野',
		'藤枝ＭＹＦＣ' => '藤枝',
		'ＦＣ東京Ｕ－２３' => 'Ｆ東23',
		'グルージャ盛岡' => '盛岡',
	);

	public $namemap = array();

	public function namemap()
	{
		if (empty($this->namemap)) {
			$teams = $this->find('all');
			$this->namemap = Hash::combine($teams, '{n}.Team.short_name', '{n}.Team.id');
		}
		return $this->namemap;
	}
}
