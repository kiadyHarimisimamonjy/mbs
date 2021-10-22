<?php

namespace App\Contract;

use App\Model\User;
use Illuminate\Support\Collection;

interface DashboardRepositoryInterface
{
    public function getLastCheckouts();
    public function getCountCustomer();
    public function getGraphOne();
    public function getGraphTwo();
}
