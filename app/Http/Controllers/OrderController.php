<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Goods;
use Exception;

class OrderController extends Controller
{

    private static $catalog;


    public function __construct()
    {
        SELF::$catalog = Goods::getCatalog();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orderAll', [
            'orders' => Order::showAll()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orderForm', [
            'catalog' => SELF::$catalog
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
        $res = 'success';
        $message = 'Заказ добавлен';
        
        $request->validate([  
            'client_name' => 'required',  
            'goods' => 'required'
        ]);

        try {
            Order::createOrder($request);
        } catch (Exception $e) {
            $res = 'fail';
            $message = 'Ошибка создания заказа: '.$e->getMessage();
        }
        return redirect()->route('order.index')->with($res, $message);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('orderItem', [
            'model' => Order::showFullOrderInfo($id)
        ]);
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
        $request->validate([  
            'status' => ['required', Rule::in(['выполнен'])],  
        ]);

        $params = $request->input();

        $model = Order::find($id);
        $model->status = $params['status'];

        $model->save();
        return redirect()->route('order.index')->with('success', "Статус заказа заменён на 'выполнен'");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
