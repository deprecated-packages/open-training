<?php declare(strict_types=1);

namespace OpenLecture\Certfificate;

use Nette\Utils\FileSystem;
use Nette\Utils\Strings;
use setasign\Fpdi\Fpdi;

final class CertificateGenerator
{
    /**
     * @var string
     */
    private $outputDirectory;

    public function __construct(string $outputDirectory)
    {
        $this->outputDirectory = $outputDirectory;
        FileSystem::createDir($this->outputDirectory);

        // @todo via ctor!!!
        // required for Fpdi?
        define('FPDF_FONTPATH', __DIR__ . '/../../files/fonts');
    }

    public function generateForTrainingNameDateAndName(string $trainingName, string $date, string $userName): void
    {
        $pdf = new Fpdi('l', 'pt');
        $pdf->AddPage('l');

        $pdf->AddFont('DejaVuSans','','DejaVuSans.php');
        $pdf->AddFont('Georgia','','Georgia.php');

        $pdf->setSourceFile(__DIR__ . '/../../files/certificate.pdf');
        $tppl = $pdf->importPage(1);
        $pdf->useTemplate($tppl, 25, 0);

        $width = (int) $pdf->GetPageWidth();

        $this->addUserName($userName, $pdf, $width);
        $this->addDate($date, $pdf, $width);
        $this->addTrainingName($trainingName, $pdf, $width);

        $pdf->Output(
            'F', // F = "file"
            $this->createDestinationForLectureNameAndUserName($trainingName, $userName)
        );
    }

    private function addTrainingName(string $trainingName, Fpdi $pdf, int $width): void
    {
        $trainingName = iconv('UTF-8', 'windows-1250', $trainingName);

        // resize for long lecture names
        $fontSize = (strlen($trainingName) < 40) ? 23 :
            ((strlen($trainingName) < 45) ? 21 : 18);

        $pdf->SetFont('DejaVuSans', '', $fontSize);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(($width / 2) - ($pdf->GetStringWidth($trainingName) / 2), 350);
        $pdf->Write(0, $trainingName);
    }

    private function addDate(string $date, Fpdi $pdf, int $width): void
    {
        $date = iconv('UTF-8', 'windows-1250', $date);
        $pdf->SetFont('Georgia', '', 13);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(($width / 2) - ($pdf->GetStringWidth($date) / 2), 300);
        $pdf->Write(0, $date);
    }

    private function addUserName(string $name, Fpdi $pdf, int $width): void
    {
        $name = iconv('UTF-8', 'windows-1250', $name);
        $pdf->SetFont('Georgia', '', 32);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(($width / 2) - ($pdf->GetStringWidth($name) / 2), 260);
        $pdf->Write(0, $name);
    }

    private function createDestinationForLectureNameAndUserName(string $trainingName, string $userName): string
    {
        return $this->outputDirectory . DIRECTORY_SEPARATOR .
            sprintf('%s-%s.pdf', Strings::webalize($trainingName), Strings::webalize($userName));
    }
}
