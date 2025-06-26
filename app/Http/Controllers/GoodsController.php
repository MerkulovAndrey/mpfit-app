<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;  
use App\Models\Goods;
use App\Models\Cats as Categories;

class GoodsController extends Controller
{

    private static $categories;

    public function __construct()
    {
        SELF::$categories = Categories::all(['*']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('goodsAll', [
            'goods' => Goods::all(),
            'categories' => SELF::$categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Categories::all(['*']);
        return view('goodsForm', [
            'categories' => SELF::$categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       $request->validate([  
            'name' => 'required',  
            'price' => 'required',  
            'category_id' => 'required',  
        ]);  
        Goods::create($request->post());  
        return redirect()->route('goods.index')->with('success', 'Товар добавлен');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('goodsItem', [
            'model' => Goods::find($id),
            'categories' => SELF::$categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('goodsForm', [
            'model' => Goods::find($id),
            'categories' => SELF::$categories
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
        $request->validate([  
            'name' => 'required',  
            'price' => 'required',  
            'category_id' => 'required',  
        ]);

        $params = $request->input();

        $model = Goods::find($id);
        $model->name = $params['name'];
        $model->description = $params['description'];
        $model->category_id = $params['category_id'];
        $model->price = $params['price'];

        $model->save();
        return redirect()->route('goods.index')->with('success', 'Товар изменён');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Goods::find($id);
        $model->delete($id);
        return redirect()->route('goods.index')->with('success', 'Товар удалён');  
    }

    /**
     * Show the confirmation form for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return view('goodsDelete', [
            'model' => Goods::find($id),
            'categories' => SELF::$categories
        ]);
    }
}
