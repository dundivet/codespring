<?php

namespace Caribbean\TourismBundle\Controller;

use Caribbean\TourismBundle\Entity\POI;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
        $finder = Finder::create();
        $fotos = $finder
            ->files()
            ->name('*.jpg')
            ->size('>140000')
            ->in(__DIR__.'/../../../../web/uploads');

        $fotoNames = array();
        foreach($fotos as $foto) {
            $fotoNames[] = $foto->getFilename();
        }

        return $this->render('TourismBundle:Default:index.html.twig', array(
            'images' => $fotoNames,
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/markers.{_format}", name="tourism_markers_data", defaults={"_format":"json"}, methods={"GET"}, options={"expose":true})
     */
    public function getMarkersDataAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $criteria = $request->query->get('search', null);
        $results = $em->getRepository('TourismBundle:POI')->findPOIByCriteria($criteria);

        $data = array();
        foreach ($results as $poi) {
            /** @var \Caribbean\TourismBundle\Entity\POI $poi */
            $data[] = array(
                'id' => $poi->getId(),
                'nombre' => $poi->getNombre(),
                'descripcion' => $poi->getDescripcion(),
                'lat' => $poi->getLatitud(),
                'lng' => $poi->getLongitud(),
                'popover' => $this->renderView('@Tourism/POI/popover/popover_template.html.twig', array('entity' => $poi))
            );
        }

        return new JsonResponse($data);
    }
}
