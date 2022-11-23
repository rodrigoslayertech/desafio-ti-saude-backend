<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planos;
use Illuminate\Support\Facades\Validator;

class PlanosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $Planos = Planos::with(['vinculos'])->get();
        return Response()->json($Planos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $Request)
    {
        // Request Validate input
        $input = $Request->all();
        $Validator = Validator::make($input, [
            'descricao' => 'required',
            'telefone' => 'required'
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => true,
                'type' => 'message',
                "message" => 'Validação falhou.'
            ]);
        }

        // Create Paciente
        $Paciente = new Planos;
        $Paciente->descricao = $input['descricao'];
        $Paciente->telefone = $input['telefone'];
        $saved = $Paciente->save();

        // Response with JSON status
        return Response()->json([
            "success" => true,
            'type' => 'status',
            "status" => $saved
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        $data = Planos::where('id', $id)->with(['vinculos'])->first();
        #dd($paciente, $id);
        return Response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $Request, $id)
    {
        // Request Validate input
        $input = $Request->all();
        $Validator = Validator::make($input, [
            'descricao' => 'required',
            'telefone' => 'required'
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => count($Validator->errors()) === 0 ? true : false,
                'type' => 'error',
                "errors" => $Validator->errors()
            ]);
        }

        // Set input data
        $updated = Planos::where('id', $id)->update([
            'descricao' => $input['descricao'],
            'telefone' => $input['telefone']
        ]);

        // Response with JSON status
        return Response()->json([
            "success" => true,
            'type' => 'status',
            "status" => $updated
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        // Validate the request...

        $deleted = Planos::destroy($id);

        // Response with JSON status
        return Response()->json([
            "success" => true,
            'type' => 'status',
            "status" => $deleted
        ]);
    }
}
