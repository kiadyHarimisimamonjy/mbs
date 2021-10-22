<?php

namespace App\Repository;

use App\Model\User;
use App\Models\Travel;
use App\Models\Checkout;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Contract\DashboardRepositoryInterface;
use App\Models\Customer;

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
    $travels = (Travel::where('date', Carbon::today())->get());
    $count = 0;
    foreach ($travels as $travel) {
      $count +=  count($travel->customers);
    }
    return $count;
  }
  public function  getGraphOne()
  {
  }
  public function getGraphTwo()
  {
  }
}
