@extends('Admin_Layout')
@section('admin_content')
    <head>
        <link  href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">   	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Lập phiếu hủy
                </header>
<div class="panel-body">
<form role="form" action="{{URL::to('/save_phieuhuy')}}" method="post">
        {{ csrf_field() }}
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Nguyên liệu</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn vị tính</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>
                                        <th scope="col">
                                            <select name="nguyenlieu_name[]" class="form-control input-sm m-bot15">
                                            @foreach($name_nguyenlieu as $key => $add)
                                            <option value="{{$add->nguyenlieu_id}}">{{$add->nguyenlieu_name}}</option>
                                            @endforeach
                                            </select>
                                        </th>
                                        <th scope="col"><input type="text"; width="100%"name="phieuhuyDetail_nums[]"></th>
                                        <th scope="col">
                                            <select name="dvt[]" class="form-control input-sm m-bot15">
                                                <option>KG</option>
                                                <option>Thùng</option>
                                                <option>Lô</option>
                                                <option>Túi</option>
                                                <option>Vỉ</option>
                                            </select>
                                        </th>
                                        <th scope="col"><input type="text" width="100%" name="phieuhuyDetail_cost[]"></th>
                                        <th scope="col"><input type="text" width="100%" name="phieuhuyDetail_reason[]"></th>
                                        <th ><button class="btn btn-success" type="button" id="add_more_detail">Thêm chi tiết</button></th>
                                </tbody>
                            </table>
                            <div id="newRow"></div>
                </div>
                <button type="submit"  name="add_phieuhuy" class="btn btn-info">Thêm phiếu hủy</button>
                </form>
            </section>
        </div>
    </div>
                <script type="text/javascript">
                    // add row
                    $("#add_more_detail").click(function () {
                        var html = '';
                        html += '<div id="inputFormRow">';
                        html += '<table class="table table-bordered">';
                        html += '  <tbody>';
                        html += '  <th scope="col">';
                        html += '  <select name="nguyenlieu_name[]" class="form-control input-sm m-bot15">';
                        html += '  @foreach($name_nguyenlieu as $key => $add)';
                        html += '  <option value="{{$add->nguyenlieu_id}}">{{$add->nguyenlieu_name}}</option>';
                        html += '  @endforeach';
                        html += '  </select>';
                        html += '  </th>';
                        html += '  <th scope="col"><input type="text"; width="100%" name="phieuhuyDetail_nums[]"></th>';
                        html += '  <th scope="col">';
                        html += '  <select name="dvt[]" class="form-control input-sm m-bot15">';
                        html += '  <option>KG</option>';
                        html += '  <option>Thùng</option>';
                        html += '  <option>Lô</option>';
                        html += '  <option>Túi</option>';
                        html += '  </select>';
                        html += '  </th>';
                        html += '  <th scope="col"><input type="text" width="100%" name="phieuhuyDetail_cost[]"></th>';
                        html += '  <th scope="col"><input type="text" width="100%" name="phieuhuyDetail_reason[]></th>';
                        html += '<div class="input-group-append">';
                        html += '<th><button id="removeRow" type="button" class="btn btn-danger">Remove</button></th>';
                        html += '</div>';
                        html += '</tbody>';
                        html +='</table>';
                        html += '</div>';

                        $('#newRow').append(html);
                    });
                    // remove row
                    $(document).on('click', '#removeRow', function () {
                        $(this).closest('#inputFormRow').remove();
                    });
                </script>
@endsection

