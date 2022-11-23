<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Paciente;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;


class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $Pacientes = Paciente::all();
        return Response()->json($Pacientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        $paciente = Paciente::where('id', $id)->get();
        #dd($paciente, $id);
        return Response()->json($paciente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $id)
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
        //
    }
}