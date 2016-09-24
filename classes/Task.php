<?php
class Task {
	public $id;
	public $name;
	public $description;
	public $dateAdded;
	function __construct($data) {
		$this->id = (isset ( $data ['id'] )) ? $data ['id'] : "";
		$this->name = (isset ( $data ['name'] )) ? $data ['name'] : "";
		$this->description = (isset ( $data ['description'] )) ? $data ['description'] : "";
		$this->dateAdded = (isset ( $data ['date_added'] )) ? $data ['date_added'] : "";
	}
	public function save($isNewTask = false, $responsibleId, $coauthorsId) {
		$db = new DB ();
		if (isset ( $_SESSION ['taskActive'] )) {
			$taskActive = unserialize ( $_SESSION ['taskActive'] );
		}
		$data = array (
				"name" => "'$this->name'",
				"description" => "'$this->description'",
				"responsible_user_id" => "'$responsibleId'" 
		);
		if (! $isNewTask) {
			$data ['date_added'] = "'$taskActive->dateAdded'";
			$id = $db->update ( $db->connect (), $data, 'tasks', 'id=' . $taskActive->id );
			$db->delete ( $db->connect (), 'coauthors', 'task_id=' . $taskActive->id );
			if (! empty ( $coauthorsId [0] )) {
				for($i = 0; $i < count ( $coauthorsId ); $i ++) {
					$dataCoauthors = array (
							"task_id" => "'$taskActive->id'",
							"user_id" => "'$coauthorsId[$i]'" 
					);
					$db->insert ( $db->connect (), $dataCoauthors, 'coauthors' );
				}
			}
		} else {
			$id = $db->insert ( $db->connect (), $data, 'tasks' );
			$taskTools = new TaskTools ();
			if (! empty ( $coauthorsId [0] )) {
				for($i = 0; $i < count ( $coauthorsId ); $i ++) {
					$dataCoauthors = array (
							"task_id" => "'$id'",
							"user_id" => "'$coauthorsId[$i]'" 
					);
					$db->insert ( $db->connect (), $dataCoauthors, 'coauthors' );
				}
			}
		}
		return $id;
	}
}
?>