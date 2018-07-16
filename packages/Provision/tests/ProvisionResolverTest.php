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
    public function test(int $incomeAmount, array $partnerDatas, array $expectedProfits): void
    {
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
        $organizerPartnerDataFactory = function (int $expenses): PartnerData {
            return new PartnerData('organizer', 0.25, $expenses);
        };

        $ownerPartnerDataFactory = function (int $expenses): PartnerData {
            return new PartnerData('lector', 0.25, $expenses, true);
        };

        $lectorPartnerDataFactory = function (int $expeses): PartnerData {
            return new PartnerData('lector', 0.5, $expeses);
        };

        // basic
        yield [
            10000,
            [$lectorPartnerDataFactory(0), $organizerPartnerDataFactory(0), $ownerPartnerDataFactory(0)],
            [4450, 2225, 2500],
        ];

        // cover expenses
        yield [
            10000,
            [$lectorPartnerDataFactory(2000), $organizerPartnerDataFactory(0), $ownerPartnerDataFactory(0)],
            [5560, 1780, 2000],
        ];

        yield [
            10000,
            [$lectorPartnerDataFactory(0), $organizerPartnerDataFactory(2000), $ownerPartnerDataFactory(2000)],
            [2670, 3335, 3500],
        ];

        yield [
            10000,
            [$lectorPartnerDataFactory(0), $organizerPartnerDataFactory(0), $ownerPartnerDataFactory(2000)],
            [3560, 1780, 4000],
        ];
    }
}
