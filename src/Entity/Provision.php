<?php declare(strict_types=1);

namespace App\Entity;

final class Provision
{
    /**
     * @var int
     */
    private $amount = 0;

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
