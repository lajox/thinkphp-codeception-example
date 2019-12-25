<?php
class UpdateBalance
{
    public $balanceRepository;

    public function __construct(BalanceRepositoryInterface $balanceRepository)
    {
        $this->balanceRepository = $balanceRepository;
    }

    public function fetchAmount($price, $number) : int
    {
        return $this->balanceRepository->fetchAmount($price, $number);
    }
}

interface BalanceRepositoryInterface {
    function fetchAmount($price, $number): int;
}