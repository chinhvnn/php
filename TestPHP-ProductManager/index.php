<?php
require "./lib/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="container-sm">
    <!-- TOP MENU -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Đăng nhập</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--  -->

    <!-- BỐ CỤC CHÍNH -->
    <div class="container">
        <div class="row">
            <!-- THANH BÊN -->
            <div class="col-md-2 border p-2 m-2">
                <p>Sản phẩm</p>
            </div>
            <!-- CONTENT -->
            <div class="col-sm border p-2 m-2">
                <p>DANH SÁCH SẢN PHẨM</p>
                <form action="" method="post" id='searchForm'>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Tìm kiếm tên sản phẩm" aria-label="Tìm kiếm" aria-describedby="button-addon2" 
                        id='inputSearchName' name='inputSearchName' value="<?php if(isset($_POST['key_search'])){ echo ($_POST['key_search']); } ?>">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="searchClick()">Tìm kiếm </button>
                    </div>
                </form>
                <table class="table border" id='tableData'>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">TÁC VỤ</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyData">
                    <?php
                    if (!empty($product_oj)){
                        foreach ($product_oj as $key => $value) {
                            echo '
                        <tr contenteditable="false" onblur="editBlur(this)">
                            <td scope="row" contenteditable="false">' . $value["p_id"] . '</td>
                            <td>' . $value["p_name"] . '</td>
                            <td>' . $value["p_price"] . '</td>
                            <td>' . $value["p_qty"] . '</td>
                            <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="editClick(this)">SỬA</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteClick(this)">XÓA</button>
                            </td>
                        </tr>
                            ';
                        }
                    }
                    ?>
                    </tbody>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td><input type="text" class="form-control" placeholder="Tên" id="inputAddName"></td>
                            <td><input type="text" class="form-control" placeholder="Giá" id="inputAddPrice"></td>
                            <td><input type="text" class="form-control" placeholder="Số lượng" id="inputAddQty"></td>
                            <td><button type="button" class="btn btn-primary" onclick="addClick(this)">THÊM</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- FOOTER -->
    <div class="container border bg-light">
        <div class="row">
            <div class="col">
                Copyright by BachKhoaShare 2022
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
        </div>
    </div>

    <!--  -->


</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    /////////////////////////////////////////////////////////////////
    //Onlick edit
    function editClick(item){
        let trData = $(item).closest("tr");
        //Set style row
        trData.attr("contenteditable", "true");   //trData.setAttribute()
        trData.css("background-color","grey");  //trData.style.backgroundColor  = "red"
        trData.focus();
    }
    //OnBlur edit
    function editBlur(item){
        let trData = $(item).closest("tr"); 
        let tdDataId = trData.find("td:eq(0)");   //console.log(item.closest("tr").cells[0].firstChild.nodeValue); //cach goi ben JS
        let tdDataName = trData.find("td:eq(1)"); 
        let tdDataPrice = trData.find("td:eq(2)"); 
        let tdDataQty = trData.find("td:eq(3)"); 

        //Reset style row
        trData.attr("contenteditable", "false");   //trData.setAttribute()
        trData.css("background-color","transparent");  //trData.style.backgroundColor  = "transparent"

        // Request Post đến handle.php để xử lý
        $.ajax({
            type: "post",
            url: "./lib/handle.php",
            dataType: "text",  //(text, json, script, xml)
            data: {
                typeCRUD: 'editDb',
                id: tdDataId.text(),
                name: tdDataName.text(),
                price: tdDataPrice.text(),
                qty: tdDataQty.text()
            },
            success: function (response) {
                console.log(response);
            }
        });
    }
    /////////////////////////////////////////////////////////////////
    // ON deleteClick
    function deleteClick(item){
        let trData = $(item).closest("tr"); 
        let tdDataId = trData.find("td:eq(0)");   //console.log(item.closest("tr").cells[0].firstChild.nodeValue); //cach goi ben JS

        // Request Post đến handle.php để xử lý
        $.ajax({
            type: "post",
            url: "./lib/handle.php",
            dataType: "text",  //(text, json, script, xml)
            data: {
                typeCRUD: 'deleteDb',
                id: tdDataId.text(),
            },
            success: function (response) {
                console.log(response);
            }
        });
        // refresh page
        setTimeout(function () { 
            $("#tableData").load(window.location.href + " #tableData" );
        }, 200);
    }
    /////////////////////////////////////////////////////////////////
    // ON addClick
    function addClick(item){
        let inputName = $("#inputAddName").val();
        let inputPrice = $("#inputAddPrice").val();
        let inputQty= $("#inputAddQty").val();

        if ((inputName != "") && (inputPrice !="") && (inputQty != "")){
            // Request Post đến handle.php để xử lý
            $.ajax({
                type: "post",
                url: "./lib/handle.php",
                dataType: "text",  //(text, json, script, xml)
                data: {
                    typeCRUD: 'addDb',
                    name: inputName,
                    price: inputPrice,
                    qty: inputQty
                },
                success: function (response) {
                    console.log(response);
                }
            });
            // refresh page
            setTimeout(function () { 
                $("#tableData").load(window.location.href + " #tableData" );
        }, 200);
        } else alert("Input must be filled before add");
        $("#inputAddName").focus();
    }
    /////////////////////////////////////////////////////////////////
    // ON searchClick
    function searchClick(){
        let inputSearchName = $("#inputSearchName").val();
        
       $.ajax({
                type: "post",
                url: "./lib/handle.php",
                dataType: "text",  //(text, json, script, xml)
                data: {
                    typeCRUD: 'searchDb',
                    key_search: inputSearchName,
                },
                success: function (response) {
                    console.log(response);
                }
            });

            // refresh page
            setTimeout(function () { 
                $("#tableData").load(window.location.href + " #tableData" );
            }, 111);
    }
</script>

</html>