job_task
========

Here 2 from 3 parts of testing task. 

1. Main PHP functionality. 

Implemented in service and help classes. 

Service (Service\TreeService.php) processing input data and create object Tree. 

Object Tree (Tree\Tree) contains all method for Tree structure. 
- add new node (class Tree\Node)
- get array of node
- get text representation of tree (generateTextRepresentation)
- get JSON representation of tree (generateJSON)

Class Node (Tree\Node) contains methods
- for creating node
- adding child node 
- get level of node in tree
- get all children of node
- converting node to array format 

2. REST Service

REST service implemented in simple controller Controller\DefaultController

For data used test data from task definition. For getting data in JSON format used uri "HOST/get_data". It returns Processed data in JSON format. For processing used service created in first part of test task. 



