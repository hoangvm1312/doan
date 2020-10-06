<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('public/js/clickevent.js')}}"></script>
</head>
<body>
    <div class="header-cashier">
        <div class="container-fluid">
            <div class="row ft-tabs">
                <div class="col-md-3">
                    <ul class="tabs-list">
                        <li><a  href="{{(URL::to('/'))}}" >Bàn cafe</a></li>
                        <li><a  href="{{URL::to('/loai-phong')}}" >Phòng Karaoke</a></li>
                        <li><a  href="{{URL::to('/menu')}}" >Thực đơn</a></li>
                    </ul>
                </div>
                <div class="col-md-4 cashier-search">
                    <input type="text" name="txtnamemenu" id="search-menu" placeholder="Nhập tên mặt hàng" class="form-control">
                    <div id="result-menu-post">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end bar -->


    <div class="container-fluid">
        <div class="row content">
           @yield('content')


        <div class="col-md-6 content-listmenu" id="content-listmenu">
                <div class="row" id="bill-info">
                    <div class="col-md-2 table-infor">                     
                    </div>
                </div>
                <div class="row bill-detail">
                    <div class="col-md-12 bill-detail-content">
                        <table class="table table-bordered">
                          <thead class="thead-light">
                            <tr>
                              <th scope="col">STT</th>
                              <th scope="col">Tên sản phẩm</th>
                              <th scope="col">Số lượng</th>
                              <th scope="col">Gía bán</th>
                              <th scope="col">Thành Tiền</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            <th scope="col">1</th>
                            <th scope="col">Thuốc lá</th>
                            <th scope="col">123</th>
                            <th scope="col">1000</th>
                            <th scope="col">3000</th>
                            <th scope="col"></th>
                          </tbody>
                        </table>
                    </div>
                </div>
                <div class="row bill-action">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 p-1">
                                <textarea class="form-control" id="note-order" placeholder="Nhập ghi chú hóa đơn" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6 p-1">
                                <button type="button" class="btn-print" onclick="cms_save_table()"><i class="fa fa-credit-card" aria-hidden="true"></i> Thanh Toán (F9)</button>
                            </div>
                            <div class="col-md-6 col-xs-6 p-1">
                                <button type="button" class="btn-pay" onclick="cms_save_oder()"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu (F10)</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label class="col-form-label col-md-4"><b>Tổng cộng</b></label>
                            <div class="col-md-8">
                                <input type="text" value="0" class="form-control total-pay" disabled="disabled">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-form-label col-md-4"><b>Khách Đưa</b></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control customer-pay" value="0" placeholder="Nhập số điền khách đưa">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-form-label col-md-4"><b>Tiền thừa</b></label>
                            <div class="col-md-8 excess-cash">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>     



        </div>
    </div>
</div>
<div class="alert-login">
</div>
<div class="modal fade" id="ModelAddcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>