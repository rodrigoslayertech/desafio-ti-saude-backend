<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pacientes;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $pacientes = Pacientes::with(['telefones', 'vinculos'])->get();
        return Response()->json($pacientes);
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
            'nome' => 'required',
            'nascimento' => 'required'
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => true,
                'type' => 'message',
                "message" => 'Validação falhou.'
            ]);
        }

        // Create Paciente
        $Paciente = new Pacientes;
        $Paciente->nome = $input['nome'];
        $Paciente->dataNascimento = $input['nascimento'];
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
        $data = Pacientes::where('id', $id)->first();
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
            'nome' => 'required',
            'nascimento' => 'required'
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => true,
                'type' => 'message',
                "message" => 'Validação falhou.'
            ]);
        }

        // Set input data
        $updated = Pacientes::where('id', $id)->update([
            'nome' => $input['nome'],
            'dataNascimento' => $input['nascimento']
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
        // Validate deletion
        $Validator = Validator::make(['id' => $id], [
            'id' => 'required|int|unique:App\Models\Consultas,paciente'
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => count($Validator->errors()) === 0 ? true : false,
                'type' => 'error',
                "errors" => [true] // Este Paciente existe na tabela consultas.
            ]);
        }

        $deleted = Pacientes::destroy($id);

        // Response with JSON status
        return Response()->json([
            "success" => true,
            'type' => 'status',
            "status" => $deleted
        ]);
    }
}
