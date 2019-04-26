@extends('layouts.admin')

@section('posttag_section')
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover" id="posttags-table">
                <thead>
                    <tr class="post-row">
                        <th>#</th>
                        <th>Post_id</th>
                        <th>Tag_id</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            
            {{-- Modal show chi tiết tag --}}
    <div class="modal fade" id="modal-show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Show product</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h2>Post Tag:</h2>
                    <h4 id="id"></h4>
                    <h4 id="post_id"></h4>
                    <h4 id="tag_id"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal thêm mới posttag --}}
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="#" data-url="{{ route('posttags.store') }}" id="form-add" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add post tag</h4>
			</div>
			<div class="modal-body">
				
					<div class="form-group">
						<label for="">Post_id</label>
						<select class="form-control" name="post_id_add">
                            @foreach ($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->title }}</option>
                            @endforeach
                        </select>
					</div>
                    <div class="form-group">
                        <label for="">Tag_id</label>
                        <select class="form-control" name="tag_id_add">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
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

{{-- Modal sửa tag --}}
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="#" id="form-edit" role="form" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit tag</h4>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="">Post_id</label>
                        <select class="form-control" name="post_id_edit">
                            @foreach ($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tag_id</label>
                        <select class="form-control" name="tag_id_edit">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
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
@section('footer_posttag')
<script type="text/javascript" charset="utf-8" src="/blog_assets/blog_admin/js/posttag.js"></script>
@endsection