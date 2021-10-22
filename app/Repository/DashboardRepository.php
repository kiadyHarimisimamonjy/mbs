<?php

namespace App\Repository;

use App\Model\User;
use App\Models\Checkout;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Contract\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
  public function getLastCheckouts()
  {
    $query = ('select `counter_id`, MAX(created_at) as created_at from `checkouts` group by `counter_id` having MAX(created_at)');
    $key = (DB::select(DB::raw($query)));
    $resut = [];
    foreach ($key as $row) {
      $resut[] = Checkout::where('counter_id', $row->counter_id)->where('created_at', $row->created_at)->firstOrFail();
    }
    return ($resut);
  }
  public function getCountCustomer()
  {
  }
  public function  getGraphOne()
  {
  }
  public function getGraphTwo()
  {
  }
}
