<?php declare(strict_types=1);

namespace OpenLecture\Certfificate;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symplify\PackageBuilder\Console\Command\CommandNaming;

final class GenerateCertificatedCommand extends Command
{
    protected function configure()
    {
        $this->setName(CommandNaming::classToName(self::class));

        // old approach
        $this->addArgument('csv-file', InputArgument::REQUIRED, 'Path to .csv file with structured data - lecture name | date | user name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFile = $input->getFirstArgument();

        // make output path smart to the path where the file was provided in
        $ouputDirectory = dirname($csvFile);

        $certificateGenerator = new CertificateGenerator($ouputDirectory);

        $data = array_map('str_getcsv', file($csvFile));

        foreach ($data as $item) {
            $certificateGenerator->generateForTrainingNameDateAndName(
                (string) $item[0],
                (string) $item[1],
                (string) $item[2]
            );

            $output->writeln(sprintf('Generated for "%s"', $item[2]));
        }
    }
}