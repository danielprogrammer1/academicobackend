<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$u de User
        $inputs = $request-> input();
        $inputs["password"] = Hash::make(trim($request->password));
        $u = User::create($inputs);
        return response()->json([
            'data'=>$u,
            'mensaje'=>'Registrado con exito'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$u de User
        $u = User::find($id);
        if(isset($u)){
            return response()->json([
                'data'=>$u,
                'mensaje'=>'Encontrado con exito'
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'No existe'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //$u de User
        $u = User::find($id);
        if (isset($u)){
            $u->name = $request->name;
            $u->last_name = $request->last_name;
            $u->email = $request->email;
            $u->password = Hash::make($request->password);
            if($u-> save()){
                return response()->json([
                    'data'=>$u,
                    'mensaje'=>'Actualizado con exito'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaje'=>'No se logro actualizar'
                ]);
            }
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'No existe'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$u de User
        $u = User::find($id);

        if(isset($u)){
            $res = User::destroy($id);
            if($res)
                {return response()->json([
                    'data'=>$u,
                    'mensaje'=>'Eliminado'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaje'=>'No se pudo eliminar'
                ]);
            }
        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>'No existe'
            ]);
        }
    }
}
