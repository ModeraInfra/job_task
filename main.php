<?php
	require 'node.php';

	$rootNode = new Node(0, 0, "[ROOT]");
	$lvlOneNode = $rootNode;
	$nodes = array();
	
	if (file_exists($_GET["file"])) {
		$handle = fopen($_GET["file"], "r");
	    
	    while (($line = fgets($handle)) !== false) {
	    	$tokens = explode("|", $line);
	        $node = new Node($tokens[0], $tokens[1], $tokens[2]);
	        
	        if ($node->parentNodeId > 0) {
	       		$node->level = $nodes[$node->parentNodeId]->level + 1;
	       		if ($nodes[$node->parentNodeId]->childNode != null) {
	       			$nodes[$node->parentNodeId]->childNode->nextNode = $node;
	       		} else {
	        		$nodes[$node->parentNodeId]->childNode = $node;
	       		}
	       	}

	        $nodes[$node->id] = $node;

	        if ($node->level == 0) {
	        	$lvlOneNode->nextNode = $node;
	        	$lvlOneNode = $node;
	        }
	    }
		
		$rootNode->nextNode->printNode();
		fclose($handle);
	} else {
	    echo "Unable to open the file \"" . $_GET["file"] 
	    . "\"<br />Please specify file as GET parameter like this: ?file=data.txt";
	}
?>