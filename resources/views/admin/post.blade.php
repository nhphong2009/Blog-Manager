@extends('layouts.admin')

@section('post_section')
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div style="width: 90%; margin:auto; padding-top: 50px">
        <a href="#" class="btn btn-success btn-add">Add</a>
        <div class="table-responsive">
            <table class="table table-hover" id="posts-table">
                <thead>
                    <tr class="post-row">
                        <th>#</th>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>Description</th>
                        <th>Content</th>
                        <th>Slug</th>
                        <th>User</th>
                        <th>Category</th>
                        <th>View_count</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            
            {{-- Modal show chi tiết post --}}
    <div class="modal fade" id="modal-show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Show product</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h2>Post:</h2>
                    <h4 id="id"></h4>
                    <h4 id="title"></h4>
                    <h4 id="thumbnail"></h4>
                    <h4 id="description"></h4>
                    <h4 id="content"></h4>
                    <h4 id="slug"></h4>
                    <h4 id="user_id"></h4>
                    <h4 id="category_id"></h4>
                    <h4 id="view_count"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal thêm mới post --}}
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="#" data-url="{{ route('posts.store') }}" id="form-add" enctype="multipart/form-data" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add post</h4>
			</div>
			<div class="modal-body">
				
					<div class="form-group">
						<label for="">Title (*)</label>
						<input type="text" name="title" class="form-control" id="title_add" placeholder="title">
					</div>
                    <div class="form-group">
                        <label for="">Thumbnail (*)</label>
                        <input type="file" name="img" class="form-control" id="thumbnail_add">
                    </div>
                    <div class="form-group">
                        <label for="">Description (*)</label>
                        <input type="text" name="description" class="form-control" id="description_add" placeholder="description">
                    </div>
                    <div class="form-group">
                        <label for="">Content (*)</label>
                        <textarea class="form-control" name="content" id="content_add" placeholder="content"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Slug (*)</label>
                        <input type="text" name="slug" class="form-control" id="slug_add" placeholder="slug">
                    </div>
                    <div class="form-group">
                        <label for="">User_id (*)</label>
                        <input type="text" name="user_id" class="form-control" id="user_id_add" value="{{Auth::id()}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Category (*)</label>
                        <select class="form-control" id="category_id_add" name="category_id">
                            @foreach($categories as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">View_count</label>
                        <input type="text" name="view_count" value="0" class="form-control" id="view_count_add" placeholder="view_count" readonly>
                    </div>
				
					
				
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
			</div>
			</form>
		</div>
	</div>
</div>

{{-- Modal sửa post --}}
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" id="form-edit" role="form" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit post</h4>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="">Title (*)</label>
                        <input type="text" class="form-control" id="title_edit" name="title" placeholder="title">
                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail (*)</label>
                        <div id="thumbnail_sss"></div>
                        <input type="file" name="img" class="form-control" id="thumbnail_edit">
                    </div>
                    <div class="form-group">
                        <label for="">Description (*)</label>
                        <input type="text" name="description" class="form-control" id="description_edit" placeholder="description">
                    </div>
                    <div class="form-group">
                        <label for="">Content (*)</label>
                        <textarea class="form-control" name="content" id="content_edit" placeholder="content"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Slug (*)</label>
                        <input type="text" class="form-control" name="slug" id="slug_edit" placeholder="slug">
                    </div>
                    <div class="form-group">
                        <label for="">User_id (*)</label>
                        <input type="text" class="form-control" id="user_id_edit" name="user_id" value="{{Auth::id()}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Category_id (*)</label>
                        <select class="form-control" id="category_id_edit" name="category_id">
                            @foreach($categories as $cate)
                                    <option value="{{$cate->id}}" {{ old('categories') == $cate->id ? 'selected="selected"' : '' }}>{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">View_count</label>
                        <input type="text" class="form-control" name="view_count" id="view_count_edit" placeholder="view_count" readonly>
                    </div>
                
                    
                
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                
            </div>
            </form>
        </div>
    </div>
</div>
        </div>
    </div>
@endsection

@section('footer_post')
<script type="text/javascript" charset="utf-8" src="/blog_assets/blog_admin/js/post.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/tinymce.min.js"></script>

<script>
$(function() {
    tinymce.init({
        selector:'textarea',
        width: '100%',
        height: '150',
        forced_root_block : "",
    });
})
</script>
@endsection