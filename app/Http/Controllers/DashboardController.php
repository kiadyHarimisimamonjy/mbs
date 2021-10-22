<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\DashboardRepository;
use App\Contract\DashboardRepositoryInterface;

class DashboardController extends Controller
{
    protected array  $lastcheckouts;
    protected    DashboardRepositoryInterface $dp;
    function __construct(DashboardRepositoryInterface $dp)
    {
        $this->lastcheckouts = $dp->getLastCheckouts();
        $this->dp = $dp;
    }
    public function getLastCheckouts()
    {
        return response()->json(array('lastCheckout' =>  $this->lastcheckouts), 200);
    }
    public function getCountCustomer()
    {
        return response()->json(array('countCustomer' =>  $this->dp->getCountCustomer()), 200);
    }
    public function getRecette()
    {
        $res = collect($this->lastcheckouts)->sum('paie');
        return response()->json(array('recette' =>  $res), 200);
    }
    public function getDecalage()
    {
        $res = collect($this->lastcheckouts)->sum('decalage');
        return response()->json(array('decalage' =>  $res), 200);
    }
    public function getAnnulation()
    {
        $res = collect($this->lastcheckouts)->sum('annulation');
        return response()->json(array('annulation' =>  $res), 200);
    }
    public function getDepense()
    {
        $res = collect($this->lastcheckouts)->sum('depense');
        return response()->json(array('depense' =>  $res), 200);
    }
    public function getCountClient()
    {
        $res =  $this->dp->getCountCustomer();
        return response()->json(array('count' =>  $res), 200);
    }
    public function getGraphOne()
    {
        $res = $this->dp->getGraphOne();
        return response()->json(array('graphone' =>  $res), 200);
    }
    public function getGraphTwo()
    {
        $res = $this->dp->getGraphTwo();
        return response()->json(array('graphtwo' =>  $res), 200);
    }
}
