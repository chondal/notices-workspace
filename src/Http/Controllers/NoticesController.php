<?php

namespace Chondal\NoticesWorkspace\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Chondal\NoticesWorkspace\Models\NoticesWorkspace;

class NoticesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alertas = NoticesWorkspace::all();
        return view('NoticesWorkspace::index', compact('alertas'));;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $alerta= NoticesWorkspace::create([
                'title' => $request->title,
                'body' => $request->body,
                'color' => $request->color,
            ]);
            flash("La alerta fue creada con exito.")
            ->success()->important();
            
            return redirect()->route('noticesWorkspace.edit', $alerta);
        }
        catch(\Exception $ex)
        {
           flash("Error: {ex->getMessage()}")->error()->important();
           return back();
        }
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
    public function edit(NoticesWorkspace $alerta)
    {

        return view('NoticesWorkspace::edit', compact(
            'alerta'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NoticesWorkspace $alerta)
    {
        try {
            $alerta->title = $request->title;
            $alerta->body = $request->body;
            $alerta->color = $request->color;
            $alerta->desde = $request->desde;
            $alerta->hasta = $request->hasta;
            $alerta->seccion = $request->seccion;
        
            $alerta->update();
        
            flash("Actualizado Correctamente.")
            ->success()->important();
            
            return back();
        }
        catch(\Exception $ex)
        {
            flash("Error: {ex->getMessage()}")->error()->important();
            return back();
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
        try {
            $alerta= NoticesWorkspace::findOrFail($id);
        
            $alerta->delete();
        
            flash("Eliminado Correctamente.")
            ->success()->important();
            
            return back();
        }
        catch(\Exception $ex)
        {
            flash("Error: {ex->getMessage()}")->error()->important();
            return back();
        }
    }
}
