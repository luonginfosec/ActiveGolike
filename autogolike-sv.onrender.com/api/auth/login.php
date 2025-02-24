<?php
header("Content-Type: application/json");
if (1>0) {
    $user = array(
        "_id" => "63be2127e950b73cf2540b25",
        "username" => "xuanman123",
        "email" => "hoxuanman054@gmail.com",
        "fullname" => "Hồ Xuân Mẫn",
        "total_coin" => 20000,
        "current_coin" => 2000,
        "active" => true,
        "golike_accounts" => array(
        	array(
            "golike_username" => "@ALL",
            "joined_date" => "28/01/2023",
            "expired_date" => "04/02/2024",
            "_id" => "63d49d921daaeca431694cae"       
       		),
       		array(
            "golike_username" => "ho",
            "joined_date" => "28/01/2023",
            "expired_date" => "04/02/2024",
            "_id" => "63d49d921daaeca431694cae"),
            array(
            "golike_username" => "luong10a2",
            "joined_date" => "28/01/2023",
            "expired_date" => "04/02/2024",
            "_id" => "63d49d921daaeca431694cae"),
            array(
            "golike_username" => "luong12",
            "joined_date" => "28/01/2023",
            "expired_date" => "04/02/2024",
            "_id" => "63d49d921daaeca431694cae"),
       	),
        "logs" => array(array(
            "content" => "Thêm Golike hoxuanquynhanh trừ -18000. Số dư: 2000",
            "time" => "2023-01-21T22:33:59.774Z"
        )),
        "createdAt" => "2023-01-11T02:38:31.951Z",
        "updatedAt" => "2023-01-28T03:59:14.323Z"
    );
    $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI2M2JlMjEyN2U5NTBiNzNjZjI1NDBiMjUiLCJpYXQiOjE2ODI2NjA0ODN9.ItNnLBj8zSGXg3Ms6BVAuBrIo3uhac8l4n3524f7vk0";
    $response = array("success" => true, "message" => "Đăng nhập thành công!", "data" => array("user" => $user, "token" => $token));
} else {
    $response = array("success" => false, "message" => "Tên đăng nhập hoặc mật khẩu không đúng!");
}
echo json_encode($response);
?>