<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Tradepair extends Model
{
    protected $table = 'tradepairs';

    protected $connection = 'mysql2';

    protected $fillable = ['id','coinone','cointwo','min_price','max_price','average_price','symbol'];


    public static function index($pair, $pair2)
    {
    	$details = Tradepair::on('mysql2')->where([['coinone', '=', $pair],['cointwo', '=', $pair2]])->orderBy('id', 'asc')->first();

    	return $details;
    }

    public static function pair()
    {
    	$pairs = Tradepair::on('mysql2')->orderBy('id', 'asc')->get();

    	return $pairs;
    }

    public static function trade_search($status, $q){

        $result = Tradepair::where(function($query) use ($q){
            $query->where('coinone', 'LIKE', '%'.$q.'%');
            $query->orWhere('cointwo', 'LIKE', '%'.$q.'%');
            $query->orWhere('symbol', 'LIKE', '%'.$q.'%');
        })->orWhereRaw("concat(coinone, ' ',cointwo) like '%".$q."%'")
        ->orderBy('updated_at', 'desc')
        ->paginate(15);

        if(empty($result)){
         $result =  Tradepair::whereRaw("concat(coinone, ' ', cointwo) like '%?%'", [$q])
          ->orWhereRaw("concat(coinone, ' ', coinetwo) like '%?%'", [$q])
          ->orderBy('updated_at', 'desc')
          ->paginate(15);
        }

        return $result;
    } 

 



}
