<?php declare(strict_types=1);

namespace OpenLecture\Provision\Tests;

use Iterator;
use OpenLecture\Provision\Data\ProvisionData;
use OpenLecture\Provision\ProvisionResolver;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @see https://symfony.com/blog/new-in-symfony-4-1-simpler-service-testing
 */
final class ProvisionResolverTest extends WebTestCase
{
    /**
     * @var ProvisionResolver
     */
    private $provisionResolver;

    protected function setUp(): void
    {
        self::bootKernel();

        // gets the special container that allows fetching private services
        $container = self::$container;

        $this->provisionResolver = $container->get(ProvisionResolver::class);
    }

    /**
     * @dataProvider provideData()
     */
    public function test(
        int $incomeAmount,
        int $lectorExpenses,
        int $organizerExpenses,
        int $ownerExpenses,
        int $expectedLectorProfit,
        int $expectedOrganizerProfit,
        int $expectedOwnerProfit
    ): void {
        $provisionData = new ProvisionData();
        $provisionData->setIncomeAmount($incomeAmount);
        $provisionData->setLectorExpenses($lectorExpenses);
        $provisionData->setOrganizerExpenses($organizerExpenses);
        $provisionData->setOwnerExpenses($ownerExpenses);

        $resolvedProfitData = $this->provisionResolver->resolve($provisionData);

        $this->assertSame($expectedLectorProfit, $resolvedProfitData->getLectorProfit());
        $this->assertSame($expectedOrganizerProfit, $resolvedProfitData->getOrganizerProfit());
        $this->assertSame($expectedOwnerProfit, $resolvedProfitData->getOwnerProfit());
    }

    public function provideData(): Iterator
    {
        yield [1000, 50, 0, 0, 50, 50, 50];
    }
}
