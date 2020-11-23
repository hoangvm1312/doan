<link rel = "stylesheet" href = "// maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> ---css

<script src = "// ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>---javascript
2 cái này bỏ vào admin layout để khi trang admin chạy nó đồng thời chạy css, java để những cái này có thế chạy được chức năng mà nó được
tạo ra mà ở đây là thêm một dòng, tương tự với những chức năng khác đều cần css và jv.
-----------------------------------------
<form method="post" action="">
    <div class="row">
        <div class="col-lg-12">
            <div id="inputFormRow">--->id của cả 1 trang 
                <div class="input-group mb-3">
                    <input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">
                    <div class="input-group-append">                
                        <button id="removeRow" type="button" class="btn btn-danger">Remove</button>------>nút xóa dòng
                    </div>
                </div>
            </div>

            <div id="newRow"></div>----->cái id newRow có tác dụng sẽ nhận lệnh của javascript
            <button id="addRow" type="button" class="btn btn-info">Add Row</button>---->nút thêm dòng mang id addRow
        </div>
    </div>
</form>
=> đây là cái add-phiếu của mình 
---------------------------------------------------
<script type="text/javascript">
    // add row
    $("#addRow").click(function () {--->gọi id addRow
        var html = '';--->khởi tạo là 1 biến rỗng
        html += '<div id="inputFormRow">';---> từ bước này thì bắt đầu chèn những giá trị html của 1 dòng, bài của mình là nguyên liệu, số lượng, dvt,...
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';---> với mỗi dòng thêm vào thì sẽ gán 1 nút remove(xóa dòng)
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);--->thực hiện lệnh
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();---->thực hiện xóa dòng vừa thêm tác động vào id inputRow
    });
</script>
=> đây là đoạn jv thực hiện chức nawg thêm dòng cũng như xóa



cái bước 4 là mã đầy đủ nhưng mà mình làm trên 1 trang cũng được mà tách ra đều đưuọc
như này
đấy có thế thôi