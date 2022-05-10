<?php
require "./db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ////////////////////////////////////////////////////////////////////
    //Handle EDIT data DB
    if (isset($_POST['typeCRUD']) && $_POST['typeCRUD'] == 'editDb') {
        $id_update = $_POST['id'];
        $name_update = $_POST['name'];
        $price_update = $_POST['price'];
        $qty_update = $_POST['qty'];

        //SQL query for update data;
        $sql_product_update = "UPDATE product SET p_name = '$name_update', p_price = $price_update, p_qty = $qty_update WHERE product.p_id = $id_update;";
        // Thực thi câu truy vấn\
        if (mysqli_query($conn, $sql_product_update)) {
            echo ('update successfull/ ');
        } else  echo ('update fail/ ' . mysqli_error($conn));
    }
    ////////////////////////////////////////////////////////////////////
    //Handle DELETE data DB
    if (isset($_POST['typeCRUD']) && $_POST['typeCRUD'] == 'deleteDb') {
        $id_update = $_POST['id'];

        //SQL query for update data;
        $sql_product_delete = "DELETE FROM product WHERE product.p_id = $id_update;";
        // Thực thi câu truy vấn\
        if (mysqli_query($conn, $sql_product_delete)) {
            echo ('delete successfull id= '. $id_update . ' / ');
        } else  echo ('delete fail/ ' . mysqli_error($conn));
    }
    ////////////////////////////////////////////////////////////////////
    //Handle ADD data DB
    if (isset($_POST['typeCRUD']) && $_POST['typeCRUD'] == 'addDb') {
        $name_add = $_POST['name'];
        $price_add = $_POST['price'];
        $qty_add = $_POST['qty'];
        $last_id = $conn->insert_id; //LAY GIA TRI ID CUOI CUNG

        //SQL query for add data;
        $sql_product_add = "INSERT INTO product (p_id, p_name, p_price, p_qty) VALUES ($last_id, '$name_add', '$price_add', $qty_add);";
        // Thực thi câu truy vấn\
        if (mysqli_query($conn, $sql_product_add)) {
            echo ('add successfull');
        } else  echo ('add fail/ ' . mysqli_error($conn));
    }
    
    //close connect db
    mysqli_close($conn);
}

?>