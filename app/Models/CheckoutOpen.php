<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckoutOpen extends Model
{
  use HasFactory;
  protected $fillable = ['montant', 'derniermontant', 'counter_id', 'user_id', 'commentaire'];
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function checkoutclose()
  {
    return $this->hasOne(CheckoutClose::class);
  }
  public function counter()
  {
    return $this->belongsTo(Counter::class);
  }
  public  function close($montant, $comment)
  {

    DB::transaction(function () use ($montant, $comment) {
      $search = $this->counter_id;
      $counter = Counter::where('id', Auth::user()->counter_id)->first('id');
      $openlast = CheckoutOpen::where('counter_id', $counter->id)->where('created_at', '<', $this->created_at)
        ->orderBy('created_at', 'desc')->first();
      $debut = $openlast->checkoutclose->created_at;
      $canceled = CanceledPaiement::where('created_at', '>', $debut)->where('counter_id', $this->counter_id)->get();
      $sumcanceled = array_sum(array_column(
        json_decode(json_encode($canceled), true),
        'montant'
      ));
      //$sumcanceled=
      $paie = Paiement::where('created_at', '>', $debut)->where('counter_id', $this->counter_id)->get();
      $sumpaid = array_sum(array_column(
        json_decode(json_encode($paie), true),
        'montant'
      ));
      $depense = ActionDepense::where('created_at', '>', $debut)->whereHas('depense', function ($query) use ($search) {
        $query->where('counter_id', $search);
      })
        ->where(function ($query) {
          $query->where('action', 'approuvee')
            ->orWhere('action', 'approuvee et modifiee');
        })->get();
      $sumdepense = array_sum(array_column(
        json_decode(json_encode($depense), true),
        'montant'
      ));
      $this->isclosed = 1;
      $this->save();
      $checkoutclose = new CheckoutClose();
      $checkoutclose->calcule = $this->montant + $sumpaid - $sumdepense - $sumcanceled;
      $checkoutclose->constate = $montant;
      $checkoutclose->decalage = $checkoutclose->constate - $checkoutclose->calcule;
      $checkoutclose->paie = $sumpaid;
      $checkoutclose->depense = $sumdepense;
      $checkoutclose->user_id = Auth::user()->id;
      $checkoutclose->annulation = $sumcanceled;
      $checkoutclose->checkout_open_id = $this->id;

      $checkoutclose->commentaire = $comment;
      $checkoutclose->save();
      $checkout = new Checkout();
      $checkout->calcule = $this->montant + $sumpaid - $sumdepense - $sumcanceled;
      $checkout->constate = $montant;
      $checkout->montant = $this->montant;
      $checkout->decalage = $checkoutclose->constate - $checkoutclose->calcule;
      $checkout->paie = $sumpaid;
      $checkout->depense = $sumdepense;
      $checkout->openby = $this->user_id;
      $checkout->closedby = Auth::user()->id;
      $checkout->annulation = $sumcanceled;
      $checkout->counter_id = $this->counter_id;
      $checkout->debutcommentaire = $this->commentaire;
      $checkout->fincommentaire = $checkoutclose->commentaire;
      //$checkout->fincommentaire='no comment';
      $checkout->debut = $debut;

      $checkout->save();
    });
  }
  public static function getCheckoutOpen(Request $request, $isadmin = false)
  {
    $checkouttemp = CheckoutOpen::where('id', '>', 0);
    if ($request->input('nom')) {
      $search = $request->input('nom');
      $checkouttemp = $checkouttemp->whereHas('user', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      });
    }
    if ($request->input('debut')) {
      $checkouttemp = $checkouttemp->where('created_at', '>=', $request->input('debut'));
    }
    if ($request->input('fin')) {
      $checkouttemp = $checkouttemp->where('created_at', '<=', $request->input('fin'));
    }
    if ($isadmin) {

      if ($request->input('counter') and $request->input('counter') !== 'all') {
        $checkouttemp = $checkouttemp->where('counter_id', '=', $request->input('counter'));
      }
    }
    if (!$isadmin) {
      $counter = Counter::where('id', Auth::user()->counter_id)->first('id');
      $checkouttemp = $checkouttemp->where('counter_id', '=', $counter->id);
      // dd( $checkouttemp);
    }
    $checkouts = $checkouttemp->orderBy('created_at', 'DESC')->paginate(5);
    return $checkouts;
  }
}
