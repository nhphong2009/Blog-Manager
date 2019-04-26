<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\User;
use App\Category;
use App\Posttag;
use Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts=Post::orderBy('id','desc')->get();
        $categories=Category::orderBy('id','desc')->get();
        $tags=Tag::orderBy('id','desc')->get();
        return view('admin.post',compact('posts', 'categories', 'tags'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList()
    {
        $post = Post::all();
        return datatables()->of($post)
            /*->addColumn('user', function($post){
                return $post->user->name;
            })
            ->addColumn('category', function($post){
                return $post->category->name;
            })*/
            ->addColumn('action', function($post){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/post/".$post->id."'> Details</button>
                <button type='button' id=".$post->id." class='btn btn-warning btn-edit' data-url='/admin/post/".$post->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/post/".$post->id."'> Delete</button>";
            })
            ->toJson();
    }


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
            'title' => 'required|max:255',
            'img' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'description' => 'required|max:255',
            'content' => 'required|max:255',
            'slug' => 'required|max:255',
        ],[
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề có tối đa 255 kí tự',
            'img.mimes' => 'Hình ảnh phải chuẩn định dạng jpeg,jpg,png,gif',
            'img.required' => 'Hình ảnh không được để trống',
            'img.max' => 'Hình ảnh có tối đa 10000KB',
            'description.required' => 'Miêu tả không được để trống',
            'description.max' => 'Miêu tả có tối đa 255 ký tự',
            'content.required' => 'Nội dung không được để trống',
            'content.max' => 'Nội dung có tối đa 255 ký tự',
            'slug.required' => 'Đường dẫn không được để trống',
            'slug.max' => 'Đường dẫn có tối đa 255 ký tự',
        ]);
        $posts = new Post;
        $posts->title = $request->title;
        $posts->description = $request->description;
        $posts->content = $request->content;
        $posts->slug = $request->slug;
        $posts->user_id = $request->user_id;
        $posts->category_id = $request->category_id;
        $posts->view_count = $request->view_count;

        if($request->hasFile('img')){
            $file = $request->file('img');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            $file->move('storage/images', $image);
            $posts->thumbnail = $image;
        }
        else{
            $posts->thumbnail = "";
        }
        $posts->save();

        /*if (!empty($request->tags_id)) {
            foreach ($request->tags_id as $tag_id) {
                Posttag::create([
                    'post_id' => $post->id,
                    'tag_id' => $tag_id,
                ]);
            }
        }*/
        

        return response()->json(['data'=>$posts]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts=Post::find($id);
        return response()->json(['data'=>$posts]);
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
            'title' => 'required|max:255',
            'img' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'description' => 'required|max:255',
            'content' => 'required|max:255',
            'slug' => 'required|max:255',
        ],[
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề có tối đa 255 kí tự',
            'img.mimes' => 'Hình ảnh phải chuẩn định dạng jpeg,jpg,png,gif',
            'img.max' => 'Hình ảnh có tối đa 10000KB',
            'description.required' => 'Miêu tả không được để trống',
            'description.max' => 'Miêu tả có tối đa 255 ký tự',
            'content.required' => 'Nội dung không được để trống',
            'content.max' => 'Nội dung có tối đa 255 ký tự',
            'slug.required' => 'Đường dẫn không được để trống',
            'slug.max' => 'Đường dẫn có tối đa 255 ký tự',
        ]);
        
        $posts=Post::find($id);
        
        if($request->hasFile('img')){
            $file = $request->file('img');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            $file->move('storage/images', $image);
            unlink("storage/images/".$posts->thumbnail);
            $posts->thumbnail = $image;
        }
        $posts->title = $request->title;
        $posts->description = $request->description;
        $posts->content = $request->content;
        $posts->slug = $request->slug;
        $posts->user_id = $request->user_id;
        $posts->category_id = $request->category_id;
        $posts->view_count = $request->view_count;

        $posts->save();

        return response()->json(['data'=>$posts],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        /*$post_tag = Post::find($postId);
        $post_tag->tags()->detach($tagId);*/

        return response()->json(['id' => $id],200);
    }
}
