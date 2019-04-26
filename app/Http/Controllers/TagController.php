<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::orderBy('id','desc')->get();
        $posts=Post::orderBy('id','desc')->get();
        return view('admin.tag',compact('tags', 'posts'));
    }

    public function getList()
    {
        $tag = Tag::all();
        return datatables()->of($tag)
            ->addColumn('action', function($tag){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/tag/".$tag->id."'> Details</button>
                <button type='button' class='btn btn-warning btn-edit' data-url='/admin/tag/".$tag->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/tag/".$tag->id."'> Delete</button>";
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
            'slug' => 'required|max:255',
        ],[
            'name.required' => 'Tiêu đề không được để trống',
            'name.max' => 'Tiêu đề có tối đa 255 kí tự',
            'slug.required' => 'Miêu tả không được để trống',
            'slug.max' => 'Miêu tả có tối đa 255 ký tự',
        ]);

        $tags = new Tag;
        $tags->name = $request->name;
        $tags->slug = $request->slug;
        $tags->save();

        if (!empty($request->tags_id)) {
            foreach ($request->tags_id as $key => $tag_id) {
                 Posttag::create([
                    'post_id' => $post->id,
                    'tag_id' => $tag_id,
                ]);
            }
        }

        /*$tag_post = Tag::find($tagId);
        $tag_post->posts()->attach($postId);*/

        return response()->json(['data'=>$tags]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tags=Tag::find($id);
        return response()->json(['data'=>$tags]);
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
            'slug' => 'required|max:255',
        ],[
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên có tối đa 255 kí tự',
            'slug.required' => 'Đường dẫn không được để trống',
            'slug.max' => 'Đường dẫn có tối đa 255 ký tự',
        ]);

        $tags=Tag::find($id)->update($request->all());
        $tags_new=Tag::find($id);

        /*$tag_post = Tag::find($tagId);
        $tag_post->posts()->attach($postId);*/

        return response()->json(['data'=>$tags_new],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::find($id)->delete();

        /*$tag_post = Tag::find($tagId);
        $tag_post->posts()->detach($postId);*/

        return response()->json(['id' => $id],200);
    }
}
