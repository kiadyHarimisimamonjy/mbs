<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Counter;
use App\Models\Checkout;
use App\Models\Paiement;
use App\Models\CheckoutOpen;
use Illuminate\Http\Request;
use App\Models\ActionDepense;
use App\Models\CheckoutClose;
use App\Models\CanceledPaiement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

      /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
      public function check($id,$by)
      {
        $checkoutopen = CheckoutOpen::find( $id);
       // $counter= Counter:: where('id',Auth::user()->counter_id)->first('id');
        $openlast=CheckoutOpen::where('counter_id', $checkoutopen->counter->id)->
        where('created_at','<', $checkoutopen->created_at)
            ->orderBy('created_at', 'desc')->first();
        $debut=$openlast->checkoutclose->created_at;
               $fin= $checkoutopen->checkoutclose->created_at;
 $search=$checkoutopen->counter_id;
$data=[];
 $title='';
        if($by==='paie'){
            $title='Liste des paiement du '.$debut.' au '. $fin;
     $data= Paiement::where('created_at','>',$debut)->
     where('created_at','<',$fin)->
     where('counter_id',$checkoutopen->counter_id) ->get();
        }
          if($by==='annulation'){
                 $title='Liste des annulations paiements du '.$debut.' au '. $fin;
 $data= CanceledPaiement::where('created_at','>',$debut)->
  where('created_at','<',$fin)->
 where('counter_id',$checkoutopen->counter_id)->get();
        }


          if($by==='depense'){
              $title='Liste des depenses paiements du '.$debut.' au '. $fin;
  $data=ActionDepense::where('created_at','>',$debut)->
   where('created_at','<',$fin)->

  whereHas('depense', function ($query) use ($search) {
  $query->where('counter_id', $search );
  })
  ->where(function ($query) {
  $query->where('action', 'approuvee')
  ->orWhere('action', 'approuvee et modifiee');
  })
  ->get();
          }
            return view('checkouts.check',compact('data','title','by','id'));

      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  $counter= Counter:: where('id',Auth::user()->counter_id)->first('id');
  $openlast=CheckoutOpen::where('counter_id', $counter->id)->orderBy('created_at', 'desc')->first();

    if( $openlast->checkoutclose===null) {
           return redirect()->route('checkoutcloses.closeform',$openlast->id)->
           withErrors(['msg' => 'Vous devez fermer la caisse precedente']);
    }
    else{
        $lastcash=$openlast->checkoutclose->constate;
        return view('checkouts.create',compact('lastcash'));
    }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        request()->validate([
        'montant' => 'required|integer|gt:0',
        'user_id' => 'required',
        'commentaire' => 'required',
        ]);
        $data=$request->all();
        unset($data["_token"]);
        $checkoutopen = new CheckoutOpen( $data);
         $counter= Counter:: where('id',Auth::user()->counter_id)->first('id');
         $checkoutopen->counter_id=$counter->id;
        // $checkoutopen->counter_id=2;
         $checkoutopen->save();
                 return redirect()->route('checkouts.opened')
                 ->with('success',' successfully');
    }
   /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
   public function opened(Request $request)
   {
    $counters = Counter::all();

     $isadmin = User::isAdmin();
    $checkouts= CheckoutOpen::getCheckoutOpen( $request, $isadmin);
    //dd($checkouts);
    return view('checkouts.opened',compact('checkouts','counters','isadmin'));
   // ->with('i', (request()->input('page', 1) - 1) * 5);
   }
      /**
      * Display the specified resource.
      *
      * @param int $id
      * @return \Illuminate\Http\Response
      */
          public function close(Request $request,$id)
          {
                request()->validate([
                'constate' => 'required|integer|gt:0',
                'user_id' => 'required',
                'commentaire' => 'required',
                ]);

             $checkoutopen = CheckoutOpen::find( $id);
              $checkoutopen->close($request->input('constate'),$request->input('commentaire'));
                return redirect()->route('checkouts.show',$id);
          }
      public function closed(Request $request)
      {

            $counters = Counter::all();
//dd( $counters);
            $isadmin = User::isAdmin();
            $checkouts= CheckoutClose::getCheckoutClose( $request, $isadmin);
          //  dd($checkouts);
            return view('checkouts.closed',compact('checkouts','counters','isadmin'));
      //
      }
    public function closeform($id)
    {
           $checkoutopen = CheckoutOpen::find( $id);
            $lastcash=$checkoutopen->montant;
            return view('checkouts.close',compact('lastcash','checkoutopen'));

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           $checkoutopen = CheckoutOpen::find( $id);
         //  dd( $checkoutopen->checkoutclose);
               return view('checkouts.show',compact('checkoutopen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function openedit($id)
    {
       $checkoutopen = CheckoutOpen::find( $id);
           return view('checkouts.openedit',compact('checkoutopen'));

    }
      public function closedit($id)
      {
      //
      }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateopen(Request $request, $id)
    {
            //

            request()->validate([
            'montant' => 'required|integer|gt:0',
            'user_id' => 'required',
            'commentaire' => 'required',
            ]);
               $checkoutopen = CheckoutOpen::find( $id);
               $checkoutopen->montant=$request->input('montant');
                $checkoutopen->user_id=$request->input('user_id');
                 $checkoutopen->commentaire=$request->input('commentaire');
                 $checkoutopen->save();
                 return redirect()->route('checkouts.opened')
                 ->with('success',' successfully');
    //
    }
     public function updateclose(Request $request, $id)
    {
    //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}