$.ajaxSetup({
	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/get-list-user',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'level', name: 'level' },
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
				$('#name').text("Name: "+response.data.name);
				$('#id').text("ID: "+response.data.id);
				$('#email').html("Email: "+response.data.email);
				$('#level').text("Level: "+response.data.level);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	})

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
					$('#del-' + response.id +'').parents("tr").remove();
					toastr.success('Delete product success!')
					//console.log($('#del-'+response.id+'').parent('.post-row'));
					
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
				$('#name_edit').val(response.data.name)
				$('#email_edit').val(response.data.email)
				$('#level_edit').val(response.data.level)
				$('#form-edit').attr('data-url',"/admin/user/"+response.data.id)
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
				name: $('#name_edit').val(),
				email: $('#email_edit').val(),
				level: $('#level_edit').val(),
			},
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit product success!')
				//ẩn modal edit
				$('#modal-edit').modal('hide');
				$('#' + response.data.id).parents('tr').replaceWith(`
					<tr>
	                        <td>` +response.data.id+ `</td>
	                        <td>` +response.data.name+ `</td>
	                        <td>` +response.data.email+ `</td>
	                        <td>` +response.data.level+ `</td>
	                        <td>
                            <button type="button" class="btn btn-info btn-show"
                             data-url="/admin/user/`+response.data.id+`">Details</button>
                            <button type="button" id="`+response.data.id+`" class="btn btn-warning btn-edit"
                             data-url="/admin/user/`+response.data.id+`">
                            Edit</button>
                            <button type="button" class="btn btn-danger btn-delete"
                             data-url="/admin/user/`+response.data.id+`">
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