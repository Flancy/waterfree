<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Transliterate;
use App\Models\Products;
use App\Models\City;
use App\Models\Firms;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index')->with(['products' => Products::all(), 'cities' => City::all(), 'firms' => Firms::all()]);
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|max:255',
            'liter' => 'required|max:255',
            'city_id' => 'required|max:255',
            'firm_id' => 'required|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = time().'.'.$request->logo->extension();  

        $pathLogo = $request->logo->move(public_path('images/logo_products'), $imageName);

        $firmData = [
            'name' => $request->name,
            'slug' => Transliterate::transliterate($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'liter' => $request->liter,
            'city_id' => $request->city_id,
            'firm_id' => $request->firm_id,
            'hit' => $request->has('hit') ? $request->input('hit') : NULL,
            'logo' => '/images/logo_products/'.$imageName,
        ];

        Products::create($firmData);
   
        return redirect()->route('admin.products.index')->with('status', 'Товар успешно добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('admin.products.show')->with(['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function destroy(Request $request, Products $product)
    {
        $product->delete();
        
        if(!$product) {
            $request->session()->flash('status', 'Ошибка удаления товара!');
            return redirect()->route('admin.products.index');
        }

        $request->session()->flash('status', 'Товар успешно удален!');
        return redirect()->route('admin.products.index');
    }
}
