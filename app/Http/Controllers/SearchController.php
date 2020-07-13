<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function keyword(Request $request)
    {
        \Debugbar::addMessage($request->keyword);
        $keyword = $request->input('keyword');
        $products = DB::table('products')->where('product_name', 'like', '%' .$keyword. '%')->where('status_id', '=', 1)->orderByRaw('updated_at DESC')->paginate(20);

        return view('home', [
            'products' => $products,
            'keyword' => $keyword
        ]);
    }

    public function category($id)
    {
        $products = DB::table('products')->where('category_id', '=', $id)->where('status_id', '=', 1)->orderByRaw('updated_at DESC')->paginate(20);
        $category = DB::table('categories')->where('id', $id)->value('category_name');

        return view('home', [
            'products' => $products,
            'category' => $category
        ]);
    }
}
