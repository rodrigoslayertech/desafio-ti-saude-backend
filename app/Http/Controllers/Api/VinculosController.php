<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vinculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VinculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Vinculos::all();
        return Response()->json($pacientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $Request)
    {
        // Request Validate input
        $input = $Request->all();
        $Validator = Validator::make($input, [
            'contrato' => 'required|unique:vinculos,contrato',
            'paciente' => 'required|int|exists:App\Models\Pacientes,id',
            'plano' => 'required|int|exists:App\Models\Planos,id',
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => count($Validator->errors()) === 0 ? true : false,
                'type' => 'error',
                "errors" => $Validator->errors()
            ]);
        }

        // Create Model data
        $Vinculo = new Vinculos;
        $Vinculo->contrato = $input['contrato'];
        $Vinculo->paciente = $input['paciente'];
        $Vinculo->plano = $input['plano'];
        $success = $Vinculo->save();

        // Response with JSON status
        return Response()->json([
            'type' => 'success',
            "success" => $success
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
        $data = Vinculos::where('id', $id)->first();
        return Response()->json($data);
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
        // Validate the request...

        $deleted = Vinculos::destroy($id);

        // Response with JSON status
        return Response()->json([
            "success" => true,
            'type' => 'status',
            "status" => $deleted
        ]);
    }
}
