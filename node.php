<?php
	class Node {
		public $id;
		public $parentNodeId;
		private $name;
		public $level;
		public $childNode;
		public $nextNode;

		public function __construct($id, $parentNodeId, $name) {
			$this->id = $id;
			$this->parentNodeId = $parentNodeId;
			$this->name = $name;
			$this->level = 0;
		}

		public function printNode() {
			for ($i = 0; $i < $this->level; $i++) {
				echo "-";
			}
			echo "$this->name<br />";
			
			if ($this->childNode != null) {
				$this->childNode->printNode();
			}

			if ($this->nextNode != null) {
				$this->nextNode->printNode();
			}
		}
	}
?>