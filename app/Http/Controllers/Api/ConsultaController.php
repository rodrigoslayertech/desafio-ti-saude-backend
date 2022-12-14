<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultas;
use Illuminate\Support\Facades\Validator;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pacientes = Consultas::all();
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
            'paciente' => 'required|int|exists:App\Models\Pacientes,id',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'particular' => 'required|boolean',
            'vinculo' => 'nullable|int|exists:App\Models\Vinculos,id|required_if:particular,false',
            'procedimento' => 'nullable|int|exists:App\Models\Procedimentos,id',
            'medico' => 'required|int|exists:App\Models\Medicos,id',
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => count($Validator->errors()) === 0 ? true : false,
                'type' => 'error',
                "errors" => $Validator->errors()
            ]);
        }

        // Create Model data
        $Model = new Consultas;
        $Model->paciente = $input['paciente'];
        $Model->data = $input['data'];
        $Model->hora = $input['hora'];
        $Model->particular = $input['particular'];
        if (@$input['vinculo']) {
            $Model->vinculo = $input['vinculo'];
        }
        if (@$input['procedimento']) {
            $Model->procedimento = $input['procedimento'];
        }
        $Model->medico = $input['medico'];
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
        //
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
    public function destroy($id)
    {
        // Validate the request...

        $deleted = Consultas::destroy($id);

        // Response with JSON status
        return Response()->json([
            "success" => true,
            'type' => 'status',
            "status" => $deleted
        ]);
    }
}
