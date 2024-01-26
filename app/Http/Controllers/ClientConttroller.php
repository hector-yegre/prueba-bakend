<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use App\Http\Requests\ClientPostRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\FlareClient\Http\Exceptions\BadResponse;

class ClientConttroller extends Controller
{
    //
    public function index(Request $request){
        try{

            $sort = ($request->orderBy)?$request->orderBy:'desc';

            $clients = DB::table('clients')
                    ->where('license', 'like', "%$request->cedula%")
                    ->orderBy('id',"asc")
                    ->where('status','1')
                    ->paginate(6); 

            if(!$clients){
                return response()->json(['msg' => "No se econtraron clientes"],200);
            }
    
            return response()->json([
                    'data' => $clients
            ],200);

        }catch(\Exception $e){
            return response()->json([
                'msg'=> 'Contact Your Administrator'.$e->getMessage() 
            ],500);
        }
        
    }

    public function store(ClientPostRequest $request){
        try {
            
            $usuario = Client::where('email',$request->email)->first();
            if($usuario){
               return response()->json([
                'msg'=> 'El correo Ingresado Ya se encuentra registrado'
               ],404);
            }

            Client::create($request->all());

            return response()->json([
                'ok'=>true,
                'msg' => 'registro Exitoso',
            ],201);  

        } catch (\Exception $e) {
            return response()->json([
                'msg'=> 'Contact Your Administrator'.$e->getMessage() 
            ],500);

        }
    }

    public function update(ClientPostRequest $request,$id){
        try {
            
            $clients = Client::find($id);
            if(!$clients){
                return response()->json([
                    'msg' => 'Cliente no Econtrado',
                ],404); 
            }
            $clients->update($request->all());
            return response()->json([
                'ok'=>true,
                'msg' => 'Cliente Actualizado Correctamente',
            ],201);  

        } catch (\Exception $e) {
            return response()->json([
                'msg'=> 'contacte con su administrador'.$e->getMessage() 
            ],500);
        }
    }

    public function destroy(Request $request){
        try {
            $clients = Client::find($request->id);
            if(!$clients){
                return response()->json([
                    'msg' => 'Cliente no Econtrado',
                ],404); 
            } 
            $clients->status = 0;
            $clients->save();
            return response()->json([
                'ok'=>true,
                'msg' => 'Cliente Eliminado',
            ],200); 
        } catch (\Exception $e) {

            return response()->json([
                'msg'=> 'contacte con su administrador'.$e->getMessage() 
            ],500);

        }
    }


    public function getById(Request $request){
        try {
            $clients = Client::find($request->id);
            if(!$clients){
                return response()->json([
                    'msg' => 'Cliente no Econtrado',
                ],404); 
            } 
             
            return response()->json([
                'ok'=>true,
                $clients,
            ],200); 

        } catch (\Exception $e) {

            return response()->json([
                'msg'=> 'contacte con su administrador'.$e->getMessage() 
            ],500);

        }
    }
}
