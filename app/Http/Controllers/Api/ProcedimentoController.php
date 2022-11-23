<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedimentos;
use Illuminate\Support\Facades\Validator;
use Money\Money;
use Money\Currency;

class ProcedimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pacientes = Procedimentos::all();
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
            'valor' => 'required',
        ]);

        if ( $Validator->fails() ) {
            return Response()->json([
                "success" => count($Validator->errors()) === 0 ? true : false,
                'type' => 'error',
                "errors" => $Validator->errors()
            ]);
        }

        // Create Model data
        $Model = new Procedimentos;
        $Model->nome = $input['nome'];
        $Model->valor = new Money
        (
            $input['valor'],
            new Currency('BRL')
        );
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
    public function show ($id)
    {
        $data = Procedimentos::where('id', $id)->first();
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
    public function destroy($id)
    {
        // Validate the request...

        $deleted = Procedimentos::destroy($id);

        // Response with JSON status
        return Response()->json([
            "success" => true,
            'type' => 'status',
            "status" => $deleted
        ]);
    }
}
