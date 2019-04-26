<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::orderBy('id','desc')->get();
        return view('admin.category',compact('categories'));
    }

    public function getList()
    {
        $categories = Category::all();
        return datatables()->of($categories)
            ->addColumn('action', function($categories){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/category/".$categories->id."'> Details</button>
                <button type='button' class='btn btn-warning btn-edit' data-url='/admin/category/".$categories->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/category/".$categories->id."'> Delete</button>";
            })
            ->toJson();
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
        $this->validate($request,[
            'name' => 'required|max:255',
            'parent_id' => 'required|max:255',
            'slug' => 'required|max:255',
        ],[
            'name.required' => 'Tiêu đề không được để trống',
            'name.max' => 'Tiêu đề có tối đa 255 kí tự',
            'parent_id.required' => 'Số danh mục cha không được để trống',
            'parent_id.max' => 'Số danh mục cha có tối đa 255 kí tự',
            'slug.required' => 'Đường dẫn không được để trống',
            'slug.max' => 'Đường dẫn có tối đa 255 ký tự',
        ]);

        $categories = new Category;
        $categories->name = $request->name;
        $categories->parent_id = $request->parent_id;
        $categories->slug = $request->slug;

        $categories->save();
        return response()->json(['data'=>$categories]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories=Category::find($id);
        return response()->json(['data'=>$categories]);
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
        $this->validate($request,[
            'name' => 'required|max:255',
            'parent_id' => 'required|max:255',
            'slug' => 'required|max:255',
        ],[
            'name.required' => 'Tiêu đề không được để trống',
            'name.max' => 'Tiêu đề có tối đa 255 kí tự',
            'parent_id.required' => 'Số danh mục cha không được để trống',
            'parent_id.max' => 'Số danh mục cha có tối đa 255 kí tự',
            'slug.required' => 'Đường dẫn không được để trống',
            'slug.max' => 'Đường dẫn có tối đa 255 ký tự',
        ]);
        
        $categories=Category::find($id)->update($request->all());
        $categories_new=Category::find($id);
        return response()->json(['data'=>$categories_new],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['id' => $id],200);
    }
}
