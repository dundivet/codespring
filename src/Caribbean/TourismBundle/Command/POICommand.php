<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 5/03/15
 * Time: 19:56
 */

namespace Caribbean\TourismBundle\Command;

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
            ->addArgument('cols', InputArgument::OPTIONAL, 'Columns from CSV file to read.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');

        if ($file) {
            $objPHPExcel = $this->read($file);

            if ($objPHPExcel) {
                $objPHPExcel->setActiveSheetIndex(0);

                $count = 2;
                while(true) {
                    $value = $objPHPExcel->getActiveSheet()->getCell('A'.$count)->getValue();
                    $count++;
                    $output->writeln($value);
                    if(!$value)
                        break;
                }
                $output->writeln('All POI were created successfully!');
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