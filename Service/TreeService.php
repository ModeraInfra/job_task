<?php
// TreeService.php
/**
 * Created by PhpStorm.
 * User: juriem
 * Date: 24/01/14
 * Time: 06:17
 * To change this template use File | Settings | File Templates.
 */

namespace Modera\Bundle\ServiceBundle\Service;

use Modera\Bundle\ServiceBundle\Tree\Tree;
use Modera\Bundle\ServiceBundle\Tree\Node;

/**
 * Class TreeService
 * @package Modera\Bundle\ServiceBundle\Service
 *
 * Service for processing input data
 *
 */
class TreeService
{
    /**
     *
     * @param string $input
     */
    public function processingInputData($input)
    {

        $lines = explode("\n", $input);

        $tree = new Tree();

        foreach ($lines as $line) {

            if (preg_match('/^(.*)\|(.*)\|(.*)$/iU', $line, $matches)){
                $id = $matches[1];
                $parentId = $matches[2];
                $name = $matches[3];

                $parent = $tree->getNodeById($parentId);

                $node = new Node($id, $name, $parent);

                $tree->addNode($node);

            }

        }

        return $tree;
    }
} 