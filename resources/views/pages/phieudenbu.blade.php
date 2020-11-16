@extends('welcome')
@section('content')
	<head>
        <link  href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">   	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

<form name="row-phieudenbu" action="{{URL::to('/save-phieu-den-bu')}}" method="post">
	@csrf
	<table class="table">
	  <thead>
	    <tr>

	      <th scope="col">Tên thiết bị</th>
	      <th scope="col">Đơn giá</th>
	      <th scope="col">Số lượng</th>
	      <th scope="col">Lý do</th>
	      <th scope="col">Ghi chú</th>
	      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>

	    <tr>
	      <td><input type="text" name="thietbi_name[]"></td>
	      <td><input type="text" name="phieudenbuDetail_cost[]"></td>
	      <td><input type="text" name="phieudenbuDetail_nums[]"></td>
	      <td><input type="text" name="phieudenbuDetail_reason[]"></td>
	      <td>
	      		<textarea name="phieudenbuDetail_note[]" rows="2" style="width: 300px"></textarea>
	      </td>
	      <td>
	      		<button class="btn btn-success" type="button" id="add_more_detail">Thêm chi tiết</button>
		  </td>
	    </tr>
	  </tbody>
	</table>
	<div id="newRow"></div>
	<button type="submit"  name="add_phieudenbu" class="btn btn-info">Thêm phiếu</button>
</form>



	<script type="text/javascript">
                    // add row
                    $("#add_more_detail").click(function () {
                        var html = '';
                        html += '<div id="inputFormRow">';
                        html += '<table class="table">';
                        html += '  <tbody>';
                        html += '  <tr>';
                        html += '  <td><input type="text" name="tenthietbi[]"></td>';
                        html += '  <td><input type="text" name="gia[]"></td>';
                        html += '  <td><input type="text" name="soluong[]"></td>';
                        html += '  <td><input type="text" name="lydo[]"></td>';
                        html += '  <td> <textarea id="exampleFormControlTextarea1" name="ghichu[]" rows="2" style="width:300px"> </textarea> </td>';
                        html += '<td><button id="removeRow" type="button" class="btn btn-danger">Remove</button></td>';
                        html += '  </tr>';
                        html += '  </tbody>';
                        html += '  </table>';
                        html += '</div>';

                        $('#newRow').append(html);
                    });
                    // remove row
                    $(document).on('click', '#removeRow', function () {
                        $(this).closest('#inputFormRow').remove();
                    });
                </script>
@endsection