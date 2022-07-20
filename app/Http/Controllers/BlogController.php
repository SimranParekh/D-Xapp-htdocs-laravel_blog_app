<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs = Blog::with(['Category'])->paginate(15);
        
        
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categorys = Category::get();
        
        return view('blogs.create', compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input = $request->all();
        $category_id = $request->input('category_id');
        $categoryArray = array();
        foreach($category_id as $cat){
            $categoryArray[] = $cat;
        }
        $input['name'] = $request->input('name');
        $input['description'] = $request->input('description');
        $input['category_id'] = json_encode($categoryArray);
        Blog::create($input);
        return redirect()->route('blogs')->with('success','Blog Added.!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $data = Blog::get();
        if(request()->ajax()){
            $start_date = Carbon::parse($request->created_at)
                             ->toDateTimeString();
            if($request->created_at != ''){
                $data = Blog::whereDate('created_at', [$start_date])->get();
            }
            else{
                $data = Blog::get();
            }
            
            return datatables()->of($data)->make(true);
        }

        

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
    public function destroy($id)
    {
        //
    }
}
