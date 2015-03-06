<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 5/03/15
 * Time: 19:56
 */

namespace Caribbean\TourismBundle\Command;

use Caribbean\TourismBundle\Entity\Imagen;
use Caribbean\TourismBundle\Entity\POI;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class RandomImagesCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('random:images')
            ->setDescription('Read images files and asociates with the POI')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = Finder::create();
        $fotos = $finder
            ->files()
            ->name('*.jpg')
            ->in(__DIR__.'/../../../../web/uploads');

        $fotoNames = array();
        foreach($fotos as $foto) {
            $fotoNames[] = $foto->getFilename();
        }

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $puntos = $em->getRepository('TourismBundle:POI')->findAll();
        foreach ($puntos as $punto) {
            for ($i = 0; $i < 4; $i++) {
                $imagen = new Imagen();
                $imagen->setRuta($fotoNames[rand(0, count($fotoNames) - 1)]);
                $imagen->setPoi($punto);

                $em->persist($imagen);
            }
            $em->flush();
        }
    }
}