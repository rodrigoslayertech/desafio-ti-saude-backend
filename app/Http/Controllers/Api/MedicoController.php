<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicos;
use Illuminate\Support\Facades\Validator;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pacientes = Medicos::all();
        return Response()->json($Pacientes);
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
            'nome' => 'required',
            'CRM' => 'required|unique:medicos',
            'especialidade' => 'required|int|exists:App\Models\Especialidades,id',
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => count($Validator->errors()) === 0 ? true : false,
                'type' => 'error',
                "errors" => $Validator->errors()
            ]);
        }

        // Create Model data
        $Model = new Medicos;
        $Model->nome = $input['nome'];
        $Model->CRM = $input['CRM'];
        $Model->especialidade = $input['especialidade'];
        $success = $Model->save();

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
        $data = Medicos::where('id', $id)->first();
        return Response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        // Validate deletion
        $Validator = Validator::make(['id' => $id], [
            'id' => 'required|int|unique:App\Models\Consultas,medico'
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => count($Validator->errors()) === 0 ? true : false,
                'type' => 'error',
                "errors" => [true] // Este Medico existe na tabela consultas.
            ]);
        }

        $deleted = Medicos::destroy($id);

        // Response with JSON status
        return Response()->json([
            "success" => true,
            'type' => 'status',
            "status" => $deleted
        ]);
    }
}
