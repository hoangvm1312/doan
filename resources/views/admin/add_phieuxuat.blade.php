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
                    Phiếu xuất hàng hóa
                </header>
<div class="panel-body">
<form role="form" action="{{URL::to('/save_phieuxuat')}}" method="post">
        {{ csrf_field() }}
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Mã lô</th>
                                    <th scope="col">Nguyên liệu</th>
                                    <th scope="col">Số lượng xuất</th>
                                    <th scope="col">Đơn vị tính</th>
                                    <th scope="col">Ngày sản xuất</th>
                                    <th scope="col">Hạn sử dụng</th>
                                    <th scope="col">Sản phẩm</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                        <th scope="col"><input type="text"; width="100%" name="phieunhapDetail_malo[]"></th>

                                        <th scope="col-md-4">
                                            <select name="nguyenlieu_name[]" class="form-control input-sm m-bot15">
                                            @foreach($name_nguyenlieu as $key => $add)
                                            <option value="{{$add->nguyenlieu_id}}">{{$add->nguyenlieu_name}}</option>
                                            @endforeach
                                            </select>
                                        </th>

                                        <th scope="col"><input type="text"; width="100%" name="phieuxuatDetail_nums[]"></th>

                                        <th scope="col">
                                            <select name="dvt[]" class="form-control input-sm m-bot15">
                                                <option>KG</option>
                                                <option>Thùng</option>
                                                <option>Lô</option>
                                                <option>Túi</option>
                                                <option>Vỉ</option>
                                            </select>
                                        </th>

                                        <th scope="col"><input type="date"; width="100%" name="phieunhapDetail_hsx[]"></th>
                                        <th scope="col"><input type="date"; width="100%" name="phieunhapDetail_hsd[]"></th>

                                        <th scope="col-md-4">
                                            <select name="sanpham_name[]" class="form-control input-sm m-bot15">
                                            @foreach($sanpham_name as $key => $add)
                                            <option value="{{$add->sanpham_id}}">{{$add->sanpham_name}}</option>
                                            @endforeach
                                            </select>
                                        </th>

                                        <th ><button class="btn btn-success" type="button" id="add_more_detail">Thêm</button></th>
                                </tbody>
                            </table>
                            <div id="newRow"></div>
                </div>
                <button type="submit"  name="add_phieuxuat" class="btn btn-info">Thêm phiếu</button>
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
                        html += '  <th scope="col"><input type="text"; width="100%" name="phieunhapDetail_malo[]"></th>';
                        html += '  <th scope="col">';
                        html += '  <select name="nguyenlieu_name[]" class="form-control input-sm m-bot15">';
                        html += '  @foreach($name_nguyenlieu as $key => $add)';
                        html += '  <option value="{{$add->nguyenlieu_id}}">{{$add->nguyenlieu_name}}</option>';
                        html += '  @endforeach';
                        html += '  </select>';
                        html += '  </th>';
                        html += '  <th scope="col"><input type="text"; width="100%" name="phieuxuatDetail_nums[]"></th>';
                        html += '  <th scope="col">';
                        html += '  <select name="dvt[]" class="form-control input-sm m-bot15">';
                        html += '  <option>KG</option>';
                        html += '  <option>Thùng</option>';
                        html += '  <option>Lô</option>';
                        html += '  <option>Túi</option>';
                        html += '  </select>';
                        html += '  </th>';
                        html += '  <th scope="col"><input type="date"; width="100%" name="phieunhapDetail_hsx[]"></th>';
                        html += '  <th scope="col"><input type="date"; width="100%" name="phieunhapDetail_hsd[]"></th>';
                        html += '  <th scope="col>';
                        html += '  <select name="sanpham_name[]" class="form-control input-sm m-bot15">';
                        html += '  @foreach($sanpham_name as $key => $add)';
                        html += '  <option value="{{$add->sanpham_id}}">{{$add->sanpham_name}}</option>';
                        html += '  @endforeach';
                        html += '  </select>';
                        html += '  </th>';
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

