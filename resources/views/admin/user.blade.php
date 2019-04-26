@extends('layouts.admin')

@section('user_section')
    <div style="width: 90%; margin:auto; padding-top: 50px">
        <div class="table-responsive">
            <table class="table table-hover" id="users-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>level</th>
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
                    <h2>User:</h2>
                    <h4 id="id"></h4>
                    <h4 id="name"></h4>
                    <h4 id="email"></h4>
                    <h4 id="level"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
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
                <h4 class="modal-title">Edit user</h4>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" id="name_edit" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" id="email_edit" placeholder="abc@xyz">
                    </div>
                    <div class="form-group">
                        <label for="">Level</label>
                        <input type="text" name="level" class="form-control" id="level_edit" placeholder="0 or 1">
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
@section('footer_user')
<script type="text/javascript" charset="utf-8" src="/blog_assets/blog_admin/js/user.js"></script>
@endsection