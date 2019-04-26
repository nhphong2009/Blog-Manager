$.ajaxSetup({
	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#tags-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/get-list-tag',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'slug', name: 'slug' },
            { data: 'action', name: 'action' }
        ]
    });
});
$(document).ready(function () {
	$('#name_add').keyup(function(){
		var name, slug;
		name = $(this).val();
		slug = name.toLowerCase();
		slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        $('#slug_add').val(slug);
	})

	$('#name_edit').keyup(function(){
		var name, slug;
		name = $(this).val();
		slug = name.toLowerCase();
		slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        $('#slug_edit').val(slug);
	})

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
				$('#slug').text("Slug: "+response.data.slug);
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
				name: $('#name_add').val(),
				slug: $('#slug_add').val(),
			},
			success: function (response) {
				toastr.success('Add new product success!');
				$('#modal-add').modal('hide')
				$('tbody').append(`
					<tr>
                        <td>` +response.data.id+ `</td>
                        <td>` +response.data.name+ `</td>
                        <td>` +response.data.slug+ `</td>
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
				$('#name_add').val('')
				$('#slug_add').val('')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.name[0]+ '</p>').insertAfter('#name_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.slug[0]+ '</p>').insertAfter('#slug_add')
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
				$('#name_edit').val(response.data.name)
				$('#slug_edit').val(response.data.slug)
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#form-edit').attr('data-url',"/admin/tag/"+response.data.id)
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
				slug: $('#slug_edit').val(),
			},
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit product success!')
				//ẩn modal edit
				$('#modal-edit').modal('hide');
				$('button#'+ response.data.id).parents('tr').replaceWith(`
					<tr>
	                    <td>` +response.data.id+ `</td>
	                    <td>` +response.data.name+ `</td>
	                    <td>` +response.data.slug+ `</td>
	                    <td>
                            <button type="button" class="btn btn-info btn-show"
                             data-url="/admin/tag/`+response.data.id+`">Details</button>
                            <button type="button" id="`+response.data.id+`" class="btn btn-warning btn-edit"
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
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.name[0]+ '</p>').insertAfter('#name_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.slug[0]+ '</p>').insertAfter('#slug_edit')
			}
		})
	})
})