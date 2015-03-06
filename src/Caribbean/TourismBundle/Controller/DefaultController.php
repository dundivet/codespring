<?php

namespace Caribbean\TourismBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController
 * @package Caribbean\TourismBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="tourism_homepage")
     */
    public function indexAction()
    {
        return $this->render('TourismBundle:Default:index.html.twig', array());
    }
}
