@extends('layouts.admin')

@section('tag_section')
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div style="width: 90%; margin:auto; padding-top: 50px">
        <a href="#" class="btn btn-success btn-add">Add</a>
        <div class="table-responsive">
            <table class="table table-hover" id="tags-table">
                <thead>
                    <tr class="post-row">
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
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
                    <h2>Tag:</h2>
                    <h4 id="id"></h4>
                    <h4 id="name"></h4>
                    <h4 id="slug"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal thêm mới tag --}}
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="#" data-url="{{ route('tags.store') }}" id="form-add" method="POST" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add tag</h4>
			</div>
			<div class="modal-body">
				
					<div class="form-group">
						<label for="">Name (*)</label>
						<input type="text" name="name" class="form-control" id="name_add" placeholder="name">
					</div>
                    <div class="form-group">
                        <label for="">Slug (*)</label>
                        <input type="text" name="slug" class="form-control" id="slug_add" placeholder="slug">
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
                        <label for="">Name (*)</label>
                        <input type="text" class="form-control" id="name_edit" name="name" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="">Slug (*)</label>
                        <input type="text" name="slug" class="form-control" id="slug_edit" placeholder="slug">
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
@section('footer_tag')
<script type="text/javascript" charset="utf-8" src="/blog_assets/blog_admin/js/tag.js"></script>
@endsection