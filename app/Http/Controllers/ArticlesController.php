<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function getList(Request $request)
    {
        $data = Article::all();
        return response()->json($data);
    }
}
