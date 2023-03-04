<?php

namespace App\Http\Controllers\Init;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Init\Categorias;
use App\Models\Init\Productos;
use App\Models\Init\Pedidos;

class InitController extends Controller{

    public function Index(){

        $K = Categorias::select('id','name_categ')
            /*->where('id_user', auth()->user()->id)*/
            ->where('state' , '1')
            ->get();
        
        $P = Productos::select('id', 'title', 'description', 'Ingredients', 'Price', 'descuento', 'Coding', 'category', 'image', 'add')
            /*->where('id_user', auth()->user()->id)*/
            ->where('state' , '1')
            ->get();


        $Group = DB::table('products')
            ->select('category', DB::raw('count(category) AS CANTIDAD'))
            /*->where('id_user', auth()->user()->id)*/ 
            ->where('state' , '1')
            ->groupBy('category')
            ->get();

        return view('Init.Index', [

            'Kat' => $K,
            'Pro' => $P,
            'Group' => $Group
        
        ]);
    
    }

    public function Details( request $req, $code = null){

        $dtl = DB::table('products')
            /* ->where('id_user', auth()->user()->id) */
            ->where('Coding', $code)
            ->get();
        
        return $dtl;
    }

    public function SavePedido(Request $req){

        $colores = array("A","B","C","D","E","F","0","1","2","3","4","5","6","7","8","9");
        $Select = '';
        $Code = '';

        for ($i=0; $i < 2; $i++) { 

            for ($j=0; $j < 3; $j++) { 
                $Select = $Select.$colores[array_rand($colores)];
            }
            if($i > 0){
                $Code =  $Code.'-'.$Select;
            }else{
                $Code =  $Code.$Select;
            }

            $Select = '';
        }

        $Ped = new Pedidos;
        $Ped->cod_pedido = $Code;
        $Ped->items = json_encode($req->items);
        $Ped->titular = $req->Props['name'];
        $Ped->documento = $req->Props['doc'];
        $Ped->mesa = $req->Props['tab'];
        $Ped->type = 'RECEIVED';
        $Ped->status = '1';
        $Ped->save(); 

        if($Ped->id){
            return response()->json([
                'state' => 'OK',
                'Code' => $Code
            ]);            
        }

/*         return response()->json([
            'state' => 'OK',
            'items' => $req->items,
            'Props' => $req->Props['name']
        ]);  */ 
        
    }





}
