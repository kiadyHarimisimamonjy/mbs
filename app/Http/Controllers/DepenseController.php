<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Depense;
use App\Models\Itinerary;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $isadmin = User::isAdmin();
        $depenses = Depense::getDepenses($request, $isadmin);
        return view('depenses.index', compact('depenses', 'isadmin'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $counters = Counter::all();
        $isadmin = User::isAdmin();
        return view('depenses.create', compact('counters', 'isadmin'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'montant' => 'required|integer|gt:0',
            'user_id' => 'required',
            'commentaire' => 'required',
        ]);
        $depense = new Depense($request->all());
        $isadmin = User::isAdmin();
        if ($isadmin) {
            $depense->saveAndApprouved();
        } else {
            $counter = Counter::where('id', Auth::user()->counter_id)->first('id');
            $depense->counter_id = $counter->id;
            $depense->save();
        }
        return redirect()->route('depenses.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function show(Depense $depense)
    {

        $isadmin = User::isAdmin();
        return view('depenses.show', compact('depense', 'isadmin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function edit(Depense $depense)
    {

        return view('depenses.edit', compact('depense'));
        //
    }
    public function action(Request $request,  $iddepense)
    {
        request()->validate([
            'montant' => 'required|integer|gt:0',
        ]);
        $depense = Depense::find($iddepense);
        //dd($depense);
        $depense->action($request);
        return redirect()->route('depenses.index')
            ->with('success', 'Boat updated successfully');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Depense $depense)
    {

        request()->validate([
            'montant' => 'required|integer|gt:0',
            'commentaire' => 'required',
        ]);
        if ($request->input('action') === 'Modifier') {
            $array = array('montant' => $request->input('montant'), 'commentaire' => $request->input('commentaire'));
            $depense->update($array);
        } elseif ($request->input('action') === 'Supprimer') {
            $depense->canceled = 1;

            $depense->save();
        }
        return redirect()->route('depenses.index')
            ->with('success', 'Boat updated successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depense $depense)
    {
        //
    }
}
