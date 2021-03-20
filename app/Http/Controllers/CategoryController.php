<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Category;
 
class CategoryController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data = Category::paginate(10);
    	return response()->json($data);
    }
}