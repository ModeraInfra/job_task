<?php

namespace Modera\Bundle\ServiceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Sensio;
use Modera\Bundle\ServiceBundle\Tree\Tree;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Modera\Bundle\ServiceBundle\Service\TreeService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package Modera\Bundle\ServiceBundle\Controller
 *
 * Entry point for REST service
 */
class DefaultController extends Controller
{

    private $testData = <<<DATA
1|0|Electronics
1|0|Electronics
2|0|Video
3|0|Photo
4|1|MP3 player
5|1|TV
6|4|iPod
7|6|Shuffle
8|3|SLR
9|8|DSLR
10|9|Nikon
11|9|Canon
12|11|20D
DATA;

    /**
     * @return TreeService
     */
    private function getTreeService()
    {
        return $this->get('modera_service.tree_service');
    }

    /**
     *
     * @Sensio\Route("/get_data")
     *
     */
    public function getDataAction(Request $request)
    {

        $treeService = $this->getTreeService();

        /* @var $tree Tree */
        $tree = $treeService->processingInputData($this->testData);

        return new JsonResponse($tree->generateJSON());
    }

    /**
     * @Sensio\Route("/get_text_data")
     *
     */
    public function getTextDataAction()
    {
        $treeService = $this->getTreeService();

        $tree = $treeService->processingInputData($this->testData);

        $content = $tree->generateTextRepresentation();

        $content = nl2br($content);

        return new Response($content);
    }


}
