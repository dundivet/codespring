<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 5/03/15
 * Time: 19:56
 */

namespace Caribbean\TourismBundle\Command;

use Caribbean\TourismBundle\Entity\POI;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class POICommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('create:poi')
            ->setDescription('Read CSV files and create the POI')
            ->addArgument('file', InputArgument::REQUIRED, 'CSV file with POI description.')
            ->addArgument('index-row', InputArgument::REQUIRED, 'Starting row to read.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $indexRow = $input->getArgument('index-row');

        $columns = array(
            'B' => 'nombre',
            'E' => 'direccion',
            'F' => 'ciudad',
            'H' => 'contacto',
            'J' => 'latitud',
            'K' => 'longitud'
        );

        $notNull = array('B', 'J', 'K');

        if ($file) {
            $objPHPExcel = $this->read($file);

            if ($objPHPExcel) {
                $em = $this->getContainer()->get('doctrine.orm.entity_manager');

                $sheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $sheet->getHighestRow();

                for ($i = $indexRow; $i < $highestRow; $i++) {
                    $poi = new POI();
                    $flag = true;
                    foreach ($columns as $key => $value) {
                        $cell = $sheet->getCell($key.$i)->getValue();

                        if (in_array($key, $notNull) && empty($cell)) {
                            $flag = false;
                            break;
                        }

                        $set = sprintf('set%s', ucfirst($value));
                        $poi->$set($cell);
                    }

                    if ($flag) {
                        $em->persist($poi);
                    }
                }
                $em->flush();

                $output->writeln('All POI were created successfully!');
                return;
            }
        }

        $output->writeln('Something was wrong!');
    }

    /**
     * @param $file
     * @return \PHPExcel
     */
    private function read($file)
    {
        try {
            $objReader = \PHPExcel_IOFactory::createReader('CSV')
                ->setDelimiter(',')
                ->setEnclosure('"')
                ->setSheetIndex(0);

            $objPHPExcelFromCSV = $objReader->load(str_replace('.php', '.csv', $file));

            return $objPHPExcelFromCSV;
        } catch (\Exception $e) {

            return false;
        }
    }
}