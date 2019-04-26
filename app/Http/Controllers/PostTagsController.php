<?php

namespace App\Http\Controllers;

use App\Posttag;
use App\Tag;
use App\Post;
use Illuminate\Http\Request;

class PostTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posttags=Posttag::orderBy('id','desc')->get();
        $tags=Post::orderBy('id','desc')->get();
        $posts=Tag::orderBy('id','desc')->get();
        return view('admin.posttag',compact('posttags', 'posts', 'tags'));
    }

    public function getList()
    {
        $posttags = Posttag::all();
        return datatables()->of($posttags)
            ->addColumn('action', function($posttags){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/posttag/".$posttags->id."'> Details</button>
                <button type='button' class='btn btn-warning btn-edit' data-url='/admin/posttag/".$posttags->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/posttag/".$posttags->id."'> Delete</button>";
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
        $posttags = new Posttag;
        $posttags->post_id = $request->post_id;
        $posttags->tag_id = $request->tag_id;
        $posttags->save();
        return response()->json(['data'=>$posttags]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posttags=Posttag::find($id);
        return response()->json(['data'=>$posttags]);
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
        $posttags=Posttag::find($id)->update($request->all());
        $posttags_new=Posttag::find($id);
        return response()->json(['data'=>$posttags_new],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Posttag::find($id)->delete();
        return response()->json(['id' => $id],200);
    }
}
