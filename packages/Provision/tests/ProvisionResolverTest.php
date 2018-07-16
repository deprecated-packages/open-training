<?php declare(strict_types=1);

namespace OpenLecture\Provision\Tests;

use Iterator;
use OpenLecture\Provision\Data\PartnerData;
use OpenLecture\Provision\Data\ProvisionData;
use OpenLecture\Provision\ProvisionResolver;
use PHPUnit\Framework\TestCase;

final class ProvisionResolverTest extends TestCase
{
    /**
     * @var ProvisionResolver
     */
    private $provisionResolver;

    protected function setUp(): void
    {
        $this->provisionResolver = new ProvisionResolver();
    }

    /**
     * @dataProvider provideData()
     * @param PartnerData[] $partnerDatas
     * @param int[] $expectedProfits
     */
    public function test(int $incomeAmount, array $partnerDatas, array $expectedProfits): void {
        $provisionData = new ProvisionData($incomeAmount, $partnerDatas);

        $this->provisionResolver->resolve($provisionData);

        $i = 0;
        foreach ($provisionData->getPartnerDatas() as $partnerData) {
            $this->assertSame($expectedProfits[$i], $partnerData->getProfit());
            ++$i;
        }
    }

    public function provideData(): Iterator
    {
        $lectorPartnerData = new PartnerData('lector', 0.5, 0);
        $organizerPartnerData = new PartnerData('organizer', 0.25, 0);
        $ownerPartnerData = new PartnerData('lector', 0.25, 0);

        // basic
        yield [10000, [$lectorPartnerData, $organizerPartnerData, $ownerPartnerData], [4450, 2225, 2225]];
    }
}
