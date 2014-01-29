<?php
// Tree.php
/**
 * Created by PhpStorm.
 * User: juriem
 * Date: 24/01/14
 * Time: 05:55
 * To change this template use File | Settings | File Templates.
 */

namespace Modera\Bundle\ServiceBundle\Tree;

/**
 * Class Tree
 * @package Modera\Bundle\ServiceBundle\Tree
 *
 * Tree object
 *
 */
final class Tree
{
    /**
     * Nodes
     *
     * @var array
     */
    private $nodes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nodes = array();
    }

    /**
     * Return all nodes
     *
     * @return array
     */
    public function getNodes()
    {

        return $this->nodes;
    }

    /**
     * Add node to tree
     *
     * @param Node $node
     */
    public function addNode(Node $node)
    {
        /*
         * Check if node exists
         *
         */
        if (null !== $this->getNodeById($node->getId())){

            return false;
        }

        /*
         * Find parent
         */
        $parent = null;
        if ($node->getParent() !== null){
            $parent = $this->getNodeById($node->getParent()->getId());
        }

        /*
         * Add node to parent
         */
        if ($parent !== null){
            $parent->addChild($node);
        }

        $this->nodes[spl_object_hash($node)] = $node;

        return $this;
    }

    /**
     * Find node by id
     *
     * @param int $id
     *
     */
    public function getNodeById($id)
    {
        foreach($this->nodes as $node){
            /* @var $node Node */
            if ((int)$node->getId() === (int)$id){

                return $node;
            }
        }

        return null;
    }

    /**
     * Generate text representation of Tree
     *
     * @return string
     */
    public function generateTextRepresentation()
    {
        $result = '';

        foreach($this->nodes as $node){
            /* @var $node Node */
            if ($node->getParent() == null){
                $result .= (string)$node;
            }
        }

        return $result;
    }

    /**
     * Generate json for tree
     *
     * @return string
     */
    public function generateJSON()
    {
        $result = array();
        foreach($this->nodes as $node){
            /* @var $node Node */
            $result[] = $node->toArray();
        }

        return json_encode($result);
    }
} 