$.ajaxSetup({
	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#posts-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/get-list-post',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            {	
            	data: 'thumbnail',
            	name: 'thumbnail' ,
            	"render": function (data, type, full, meta) {
			        return "<img src=\"../storage/images/" + data + "\" width=\"50px\" height=\"50px\"/>";
			    },
			    "title": "Image",
			    "orderable": true,
			    "searchable": true
         	},
            { data: 'description', name: 'description' },
            { data: 'content', name: 'content' },
            { data: 'slug', name: 'slug' },
            { data: 'user_id', name: 'user' },
            { data: 'category_id', name: 'category' },
            { data: 'view_count', name: 'view_count' },
            { data: 'action', name: 'action' }
        ]
    });
});
$(document).ready(function () {
	$('#title_add').keyup(function(){
		var title, slug;
		title = $(this).val();
		slug = title.toLowerCase();
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

	$('#title_edit').keyup(function(){
		var title, slug;
		title = $(this).val();
		slug = title.toLowerCase();
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
				console.log(response)
				//hiển thị dữ liệu được controller trả về vào trong modal
				$('#title').text("Title: "+response.data.title);
				$('#id').text("ID: "+response.data.id);
				$('#thumbnail').html("Thumbnail: <img src='../storage/images/"+response.data.thumbnail+"' name='image' alt='"+response.data.thumbnail+"' style='width:50px; height:50px'>");
				$('#description').text("Description: "+response.data.description);
				$('#content').text("Content: "+response.data.content);
				$('#slug').text("Slug: "+response.data.slug);
				$('#user_id').text("User_id: "+response.data.user_id);
				$('#category_id').text("Category_id: "+response.data.category_id);
				$('#view_count').text("View_count: "+response.data.view_count);
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
		formdata = new FormData($(this)[0]);
		var content = tinymce.get('content_add').getContent()
		formdata.append("content", content)
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: formdata,
			contentType: false,
			processData: false,
			success: function (response) {
				console.log(response)
				toastr.success('Add new product success!');
				$('#modal-add').modal('hide')
				$('tbody').append(`
					<tr>
                        <td>` +response.data.id+ `</td>
                        <td>` +response.data.title+ `</td>
                        <td><img src='../storage/images/` +response.data.thumbnail+ `' name='img' alt='` +response.data.thumbnail+ `' style='width:50px; height:50px'></td>
                        <td>` +response.data.description+ `</td>
                        <td>` +response.data.content+ `</td>
                        <td>` +response.data.slug+ `</td>
                        <td>` +response.data.user_id+ `</td>
                        <td>` +response.data.category_id+ `</td>
                        <td>` +response.data.view_count+ `</td>
                        <td>
                            <button type="button" class="btn btn-info btn-show"
                             data-url="/admin/post/`+response.data.id+`">Details</button>
                            <button type="button" id="`+response.data.id+`" class="btn btn-warning btn-edit"
                             data-url="/admin/post/`+response.data.id+`">
                            Edit</button>
                            <button type="button" class="btn btn-danger btn-delete"
                             data-url="/admin/post/`+response.data.id+`">
                            Delete</button>
                        </td>
                    </tr>`
				)
				$('#title_add').val('')
				$('#description_add').val('')
				$('#thumbnail_add').val('')
				$('#content_add').val('')
				$('#slug_add').val('')
				$('#category_id_add').val('')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.title[0]+ '</p>').insertAfter('#title_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.img[0]+ '</p>').insertAfter('#thumbnail_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.description[0]+ '</p>').insertAfter('#description_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.content[0]+ '</p>').insertAfter('#content_add')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.slug[0]+ '</p>').insertAfter('#slug_add')
			}
		})
	});

	// Hàm xóa
	$(document).on('click', '.btn-delete', function(e) {
		e.preventDefault();
	//lấy attribute data-url của nút xoá lưu vào url
		var mytable = $('#posts-table').DataTable();
		var url=$(this).attr('data-url');
		//hiển thị dialogbox xác nhận xoá
		if (confirm("Bạn có chắc chắn muốn xóa không?")){
			$.ajax({
				//phương thức delete
				type: 'delete',
				url: url,
				success: function (response) {
					//thông báo xoá thành công bằng toastr
					//$('#del-post-' + response.id +'').parents("tr").remove();
					toastr.success('Delete product success!');
					mytable.row($(this).parents('tr')).remove().draw();
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
				$('#title_edit').val(response.data.title)
				$('#description_edit').val(response.data.description)
				tinymce.get('content_edit').setContent(response.data.content)
				$('#slug_edit').val(response.data.slug)
				$('#thumbnail_edit').html(`<img src='../storage/images/` +response.data.thumbnail+ `' name='img' alt='` +response.data.thumbnail+ `' style='width:50px; height:50px'>`)
				$('#user_id_edit').val(response.data.user_id)
				$('#category_id_edit').val(response.data.category_id)
				$('#view_count_edit').val(response.data.view_count)
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#form-edit').attr('data-url',"/admin/post/"+response.data.id)
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
		formdata = new FormData($("#form-edit")[0]);
		var content = tinymce.get('content_edit').getContent()
		formdata.append("content", content)
		$.ajax({
			//phương thức put
			type: 'post',
			url: url,
			//lấy dữ liệu trong form
			data: formdata,
			contentType: false,
			processData: false,
			success: function (response) {
				//thông báo update thành công
				toastr.success('Edit product success!')
				//ẩn modal edit
				$('#modal-edit').modal('hide');
				$('button#'+ response.data.id).parents('tr').replaceWith(`
					<tr>
	                        <td>` +response.data.id+ `</td>
	                        <td>` +response.data.title+ `</td>
	                        <td><img src='../storage/images/` +response.data.thumbnail+ `' name='img' alt='` +response.data.thumbnail+ `' style='width:50px; height:50px'></td>
	                        <td>` +response.data.description+ `</td>
	                        <td>` +response.data.content+ `</td>
	                        <td>` +response.data.slug+ `</td>
	                        <td>` +response.data.user_id+ `</td>
	                        <td>` +response.data.category_id+ `</td>
	                        <td>` +response.data.view_count+ `</td>
	                        <td>
                            <button type="button" class="btn btn-info btn-show"
                             data-url="/admin/post/`+response.data.id+`">Details</button>
                            <button type="button" id="`+response.data.id+`" class="btn btn-warning btn-edit"
                             data-url="/admin/post/`+response.data.id+`">
                            Edit</button>
                            <button type="button" class="btn btn-danger btn-delete"
                             data-url="/admin/post/`+response.data.id+`">
                            Delete</button>
                        </td>
	                </tr>`
				)
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.title[0]+ '</p>').insertAfter('#title_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.img[0]+ '</p>').insertAfter('#thumbnail_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.description[0]+ '</p>').insertAfter('#description_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.content[0]+ '</p>').insertAfter('#content_edit')
				$('<p style="background: red; color: white;">' +jqXHR.responseJSON.errors.slug[0]+ '</p>').insertAfter('#slug_edit')
			}
		})
	})
})