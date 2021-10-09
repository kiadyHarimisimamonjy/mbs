<?php

namespace App\Models;

use Exception;
use Illuminate\Http\Request;
use App\Models\ActionDepense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depense extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id' ,
        'montant' ,
        'commentaire' ,
        'action',
        'counter_id'
    ];
    public function actiondepense()
    {
        return $this->hasOne(ActionDepense::class);
    }
    public function action(Request $request)
    {
        DB::beginTransaction();
        try {
            $actiondepense=new ActionDepense();

            if(is_null($request->input('commentaire')))$actiondepense->commentaire='pas de commentaire';
            else $actiondepense->commentaire=$request->input('commentaire');
            $actiondepense->user_id=Auth::user()->id;
            if($request->input('ask')===$request->input('montant')){
                if( $request->input('action')==='Approuver'){
                    $this->etat='approuvee';
                    $actiondepense->montant=$request->input('montant');
                    $actiondepense->action='approuvee';
                }
                if( $request->input('action')==='Recaler') {
                    $this->etat='refusee';
                    $actiondepense->action='refusee';
                    $actiondepense->montant=0;
                }
            }
            else{
                if( $request->input('action')==='Approuver') {
                    $this->etat='approuvee et modifiee';
                    $actiondepense->action='approuvee et modifiee';
                    $actiondepense->montant=$request->input('montant');
                }
                if( $request->input('action')==='Recaler') {
                    $this->etat='refusee';
                    $actiondepense->action='refusee';
                    $actiondepense->montant=0;
                }

            }
            $this->save();
            $actiondepense->depense()->associate($this);
            $actiondepense->save();
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
    public  function saveAndApprouved()
    {
        DB::beginTransaction();
        try {
            $this->etat='approuvee';

            $this->save();
            $actiondepense=new ActionDepense();
            $actiondepense->montant=$this->montant;
            $actiondepense->commentaire=$this->commentaire;
            $actiondepense->user_id=$this->user_id;
            $actiondepense->action='approuvee';
            $actiondepense->depense()->associate($this);

            $actiondepense->save();
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }
    public static function getDepenses(Request $request,$isadmin=false)
    {
        $depensetemp= Depense::where('canceled', 0);
        if( $request->input('etat') and $request->input('etat') !=='all' ){
           $depensetemp = $depensetemp->where('etat','=', $request->input('etat'));
          }

          if( $request->input('debut')){
           $depensetemp = $depensetemp->where('created_at','>=', $request->input('debut'));
          }
          if( $request->input('fin')){
           $depensetemp = $depensetemp->where('created_at','<=', $request->input('fin'));
          }
          if($isadmin){
                if( $request->input('nom')  ){
                    $search=$request->input('nom') ;
                    $depensetemp = $depensetemp->
                    whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                });
                }

          }
          if(!$isadmin){
            $depensetemp = $depensetemp->where('user_id','=', Auth::user()->id );
          //  dd( $depensetemp);
          }
          $depenses = $depensetemp->orderBy('created_at', 'DESC')->paginate(5);
          return $depenses;
    }
}