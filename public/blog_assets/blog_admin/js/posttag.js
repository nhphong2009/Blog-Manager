$.ajaxSetup({
	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#posttags-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/get-list-posttag',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'post_id', name: 'post_id' },
            { data: 'tag_id', name: 'tag_id' },
            { data: 'action', name: 'action' }
        ]
    });
});
$(document).ready(function () {
	$(document).on('click', '.btn-show', function() {
	//hiện modal show lên
		$('#modal-show').modal('show');
		//lấy dữ liệu từ attribute data-url lưu vào biến url
		var url=$(this).attr('data-url');
		$.ajax({
			//sử dụng phương thức get
			type: 'get',
			url: url,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				//hiển thị dữ liệu được controller trả về vào trong modal
				$('#post_id').text("Post_id: "+response.data.post_id);
				$('#id').text("ID: "+response.data.id);
				$('#tag_id').text("Tag_id: "+response.data.tag_id);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	})
	//bắt sự kiện click vào nút add
	$('.btn-add').click(function (e) {
		e.preventDefault();
		//hiện modal show
		$('#modal-add').modal('show');
	})

	//bắt sự kiện submit form thêm mới
	$('#form-add').submit(function (e) {
		e.preventDefault();
		//lấy attribute data-url của form lưu vào biến url
		var url=$(this).attr('data-url');
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: {
				post_id: $('#post_id_add').val(),
				tag_id: $('#tag_id_add').val(),
			},
			success: function (response) {
				toastr.success('Add new product success!');
				$('#modal-add').modal('hide')
				$('tbody').append(`
					<tr>
                        <td>` +response.data.id+ `</td>
                        <td>` +response.data.post_id+ `</td>
                        <td>` +response.data.tag_id+ `</td>
                        <td>
                            <button type="button" class="btn btn-info btn-show"
                             data-url="/admin/tag/`+response.data.id+`">Details</button>
                            <button type="button" class="btn btn-warning btn-edit"
                             data-url="/admin/tag/`+response.data.id+`">
                            Edit</button>
                            <button type="button" class="btn btn-danger btn-delete"
                             data-url="/admin/tag/`+response.data.id+`">
                            Delete</button>
                        </td>
                    </tr>`
				)
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	});

	// Hàm xóa
	$(document).on('click', '.btn-delete', function(e) {
		e.preventDefault();
	//lấy attribute data-url của nút xoá lưu vào url
		var url=$(this).attr('data-url');
		//hiển thị dialogbox xác nhận xoá
		if (confirm("Bạn có chắc chắn muốn xóa không?")){
			$.ajax({
				//phương thức delete
				type: 'delete',
				url: url,
				success: function (response) {
					//thông báo xoá thành công bằng toastr
					toastr.success('Delete product success!');
					mytable.row($(this).parents('tr')).remove().draw();
					
				},
				error: function (error) {
					
				}
			})
		}
});

	//bắt sự kiện click vào nút edit
		$(document).on('click', '.btn-edit', function() {

		//mở modal edit lên
		$('#modal-edit').modal('show');
		//lấy data-url của nút edit
		var url=$(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function (response) {
				$('#post_id_edit').val(response.data.post_id)
				$('#tag_id_edit').val(response.data.tag_id)
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#form-edit').attr('data-url',"/admin/posttag/"+response.data.id)
			},
			error: function (error) {
				
			}
		})
	})

	//bắt sự kiện submit form edit
	$('#form-edit').submit(function (e) {
		e.preventDefault();
		//lấy data-url của form edit
		var url=$(this).attr('data-url');
		$.ajax({
			//phương thức put
			type: 'put',
			url: url,
			//lấy dữ liệu trong form
			data: {
				post_id: $('#post_id_edit').val(),
				tag_id: $('#tag_id_edit').val(),
			},
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit product success!')
				//ẩn modal edit
				$('#modal-edit').modal('hide');
				$('button#'+response.data.id).parents('tr').replaceWith(`
					<tr>
	                    <td>` +response.data.id+ `</td>
	                    <td>` +response.data.post_id+ `</td>
	                    <td>` +response.data.tag_id+ `</td>
	                    <td>
                            <button type="button" class="btn btn-info btn-show"
                             data-url="/admin/posttag/`+response.data.id+`">Details</button>
                            <button type="button" id="`+response.data.id+`" class="btn btn-warning btn-edit"
                             data-url="/admin/posttag/`+response.data.id+`">
                            Edit</button>
                            <button type="button" class="btn btn-danger btn-delete"
                             data-url="/admin/posttag/`+response.data.id+`">
                            Delete</button>
                        </td>
	                </tr>`
				)
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	})
})