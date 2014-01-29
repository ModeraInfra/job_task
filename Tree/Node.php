<?php
// Node.php
/**
 * Created by PhpStorm.
 * User: juriem
 * Date: 24/01/14
 * Time: 05:53
 * To change this template use File | Settings | File Templates.
 */

namespace Modera\Bundle\ServiceBundle\Tree;

/**
 * Class Node
 * @package Modera\Bundle\ServiceBundle\Tree
 *
 */
final class Node
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var
     */
    private $children = array();

    /**
     * @var Node
     */
    private $parent = null;

    /**
     *
     * @param int $id
     * @param string $name
     * @param Node $parent
     *
     * Constructor
     *
     */
    public function __construct($id, $name, Node $parent = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * Return node id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Get all children
     *
     * @return array
     */
    public function getChildren()
    {

        return $this->children;
    }

    /**
     * Return parent node
     * @return Node
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child to node
     *
     * @param Node $node
     *
     * @return $this
     */
    public function addChild(Node $node)
    {
        $this->children[spl_object_hash($node)] = $node;

        return $this;
    }

    /**
     * Get
     * @return int
     */
    public function getLevel()
    {
        $level = 1;
        if ($this->parent !== null){
            $level += $this->parent->getLevel();
        }

        return $level;
    }

    /**
     * Text
     * @return string
     */
    public function __toString()
    {
        $level = $this->getLevel();
        $result = str_repeat('-', $level-1) . $this->name . "\n";
        if (count($this->children) > 0){
            foreach($this->children as $child){
                /* @var $child Node */
                $result .= (string)$child;
            }
        }
        return $result;
    }

    /**
     * Transform node to array
     *
     * @return array
     */
    public function toArray()
    {
        $result = array('text'=>$this->name);

        if (count($this->children) == 0){
            $result['leaf'] = true;
        } else {
            $result['children'] = array();
            $result['expanded'] = true;
        }


        /*
         * Processing children
         */

        foreach($this->children as $child)
        {
            /* @var $child Node */
            $result['children'][] = $child->toArray();
        }

        return $result;
    }


} 