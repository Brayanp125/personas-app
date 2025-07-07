<?php

namespace App\Http\Controllers;

use App\Models\Comuna;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $comunas = DB::table('tb_comuna')
        ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
        ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
        ->join('tb_pais', 'tb_departamento.pais_codi', '=', 'tb_pais.pais_codi')
        ->select('tb_comuna.*', 'tb_municipio.muni_nomb', 'tb_departamento.depa_nomb', 'tb_pais.pais_nomb')
        ->get();

    return view('comuna.index', ['comunas' => $comunas]);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = DB::table('tb_municipio')
        ->orderBy('muni_nomb')
        ->get();

          $paises = DB::table('tb_pais')
        ->orderBy('pais_nomb')
        ->get();

        return view('comuna.new', ['municipios' => $municipios,  'paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
    {
        $comuna = new Comuna();
        $comuna->comu_nomb = $request->comu_nomb;
        $comuna->muni_codi = $request->muni_codi;
        $comuna->save();

        return redirect()->route('comunas.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    // Traer la comuna
    $comuna = DB::table('tb_comuna')
        ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
        ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
        ->join('tb_pais', 'tb_departamento.pais_codi', '=', 'tb_pais.pais_codi')
        ->select('tb_comuna.*', 'tb_municipio.muni_codi', 'tb_departamento.depa_codi', 'tb_pais.pais_codi')
        ->where('comu_codi', $id)
        ->first();

    // Traer todos los municipios
    $municipios = DB::table('tb_municipio')
        ->orderBy('muni_nomb')
        ->get();

    // Traer todos los países
    $paises = DB::table('tb_pais')
        ->orderBy('pais_nomb')
        ->get();

    return view('comuna.edit', [
        'comuna' => $comuna,
        'municipios' => $municipios,
        'paises' => $paises
    ]);
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
    $comuna = Comuna::findOrFail($id);

    $comuna->comu_nomb = $request->comu_nomb;
    $comuna->muni_codi = $request->muni_codi;
    $comuna->save();

    // Actualizar el país en el departamento relacionado
    $municipio = DB::table('tb_municipio')->where('muni_codi', $request->muni_codi)->first();

    DB::table('tb_departamento')
        ->where('depa_codi', $municipio->depa_codi)
        ->update(['pais_codi' => $request->pais_codi]);

    // Traer listado con los joins correctos
    $comunas = DB::table('tb_comuna')
        ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
        ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
        ->join('tb_pais', 'tb_departamento.pais_codi', '=', 'tb_pais.pais_codi')
        ->select('tb_comuna.*', 'tb_municipio.muni_nomb', 'tb_departamento.depa_nomb', 'tb_pais.pais_nomb')
        ->get();

    return view('comuna.index', ['comunas' => $comunas]);
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function destroy($id)
{
    $comuna = Comuna::findOrFail($id);
    $comuna->delete();

    return redirect()->route('comunas.index');
}

}
