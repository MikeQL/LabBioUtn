<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$equipos = Equipo::with('users')->get();
        $equipos = Equipo::all();
        return view('admin.equipos.index',compact("equipos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.equipos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'cantidad'=>'required',
            'codigo'=>'required',
            'ubicacion'=>'required',
            
        ]);

        Equipo::create($request->all());

        //retornar a la vista cuando todo se complete correctamente
        return redirect()->route(route:'admin.equipos.index')
        ->with('mensaje','Equipo registrado correctamente')
        ->with('icono','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('admin.equipos.show',compact("equipo"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('admin.equipos.edit',compact("equipo"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $equipo = Equipo::find($id);
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'cantidad'=>'required',
            'codigo'=>'required',
            'ubicacion'=>'required',
            
        ]);

        $equipo->update($request->all());

        //retornar a la vista cuando todo se complete correctamente
        return redirect()->route(route:'admin.equipos.index')
        ->with('mensaje','Equipo actualizado correctamente')
        ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */

     public function confirmDelete($id)
     {
        $equipo = Equipo::findOrFail($id);
        return view('admin.equipos.delete',compact("equipo"));
     }

    public function destroy($id)
    {
        Equipo::destroy($id);
        //retornar a la vista cuando todo se complete correctamente
        return redirect()->route(route:'admin.equipos.index')
        ->with('mensaje','Equipo eliminado correctamente')
        ->with('icono','success');
    }
}
