<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::all()->toArray();
        return array_reverse($articulos);
    }

    public function add(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'precio' => 'required',
            'stock' => 'required'
        ]);

        $articulo =new Articulo();
        $articulo->descripcion= $request->descripcion;
        $articulo->precio= $request->precio;
        $articulo->stock= $request->stock;
        $articulo->save();



        return response()->json(['success'=> 'Articulo created successfully']);

    }

    public function edit($id)
    {
        $articulo = Articulo::find($id);
        return response()->json($articulo);
    }

    public function update($id, Request $request)
    {
        $articulo = Articulo::find($id);
        $request->validate([
            'descripcion' => 'required',
            'precio' => 'required',
            'stock' => 'required'
        ]);

            $articulo->update([
                'descripcion'=> $request->descripcion,
                'precio'=> $request->precio,
                'stock'=> $request->stock,
            ]);



        return response()->json(['success'=> 'Articulo update successfully']);
    }

    public function delete($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
        return response()->json(['success'=> 'Articulo deleted successfully']);

    }
}
