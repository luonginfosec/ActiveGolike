# QUÁ TRÌNH LÀM RA ACTIVE TOOL GOLIKE

# Tổng quan
## Phân tích file bằng DIE

Khi thả file vào **DIE**, ta nhận thấy đây là file viết bằng **C#**. Tiếp theo, mở công cụ **dnSpy** để phân tích chi tiết hơn.

<p align="center">
  <img src="./img/image.png" alt="DIE Analysis">
</p>

## Phân tích với dnSpy

Tiếp tục mở **dnSpy** để xem có gì khả quan hơn.

<p align="center">
  <img src="./img/image-1.png" alt="dnSpy Analysis">
</p>

Mặc dù code đã bị mã hóa + làm rối nhưng tên các hàm vẫn không bị làm sao, phân tích dễ dàng ta quan tâm đến các function và method trong hàm **LoginAuto** này. Ta dễ dàng đoán được app này check key trên con sever sau đó trả về thông tin cũng như message của người dùng.

**Mục đích của chúng ta bây giờ là tìm con sever đấy là gì địa chỉ như thế nào ? trả về cái gì chỉ cần biết như vậy là có thể fake sever để giả lại kết quả giúp chúng ta active được phần mềm thành công.**

## Tiến hành dùng Charles bật SSL để bắt gói tin

<p align="center">
  <img src="./img/image-2.png">
  <hr>
  <img src="./img/image-3.png">
</p>
Đúng vậy đã bắt được gói tin, khi đăng nhập vào, như vậy khi ấn đăng nhập sẽ POST lên 1 request gồm user và pass và nhận kết quả phản hồi từ sever. Lúc này tôi đã đi mượn 1 account đã đăng kí và khi đăng nhập thành công request từ sever đã trả về 1 thông tin khá thú vị.
<p align="center">
  <img src="./img/image-5.png">
  <hr>
  <img src="./img/image-4.png">
</p>

Vậy là khi login với tài khoản còn hạn sever sẽ trả về dữ liệu dưới dạng json với url **http://autogolike-sv.onrender.com/api/auth/login**, tên đăng nhập cùng với hạn sử dụng còn lại. Ý tưởng của chúng là bây giờ là code fake sever để trỏ về local giúp chỉnh sửa được thông tin user + hạn sử dụng mà chúng ta mong muốn.

---

## Sử dụng xampp + code để fake sever 
<p style="color:red;">Ý tưởng của tôi là code 1 đoạn code php luôn trả về dữ liệu đúng tại địa chỉ url http://autogolike-sv.onrender.com/api/auth/login rồi trỏ nó về local.</p>

Sau một hồi thử tôi đã code ra 2 file là login.json , và login.php mục đích là fake dữ liệu

```Php
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
```

```Php
<?php
header('Content-Type: application/json; charset=utf-8');

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'user' && $password === 'pass') {
    $data = [
        'user' => [
            '_id' => '63e8573a2f1d5c2310f5ab3b',
            'username' => 'vuducluong',
            'email' => 'ducluongvuit@gmail.com',
            'fullname' => 'Vũ Đức Lương',
            'total_coin' => 0,
            'current_coin' => 0,
            'active' => true,
            'golike_accounts' => [],
            'logs' => [],
            'createdAt' => '2023-02-12T03:04:26.295Z',
            'updatedAt' => '2023-02-12T03:04:26.295Z'
        ],
        'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI2M2U4NTczYTJmMWQ1YzIzMTBmNWFiM2IiLCJpYXQiOjE2NzYxNzg4OTZ9.-82zTJauw7TtXy46eyos8LHo7hBN7zMmoJWb-lBMZbM'
    ];
    
    $response = [
        'success' => true,
        'message' => 'Đăng nhập thành công!',
        'data' => $data,
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Sai tên đăng nhập hoặc mật khẩu!',
    ];
}

echo json_encode($response);

```


**Tiến hành install cert SSL và fake sever**

### **Bước 1: Cài Đặt XAMPP**  
1. **Tải và cài đặt** [XAMPP](https://www.apachefriends.org/index.html) trên hệ thống.  
2. Sau khi cài đặt xong, mở thư mục cài đặt XAMPP:  
   **`C:\xampp\apache`**  
3. **Dán folder** `crt` vào thư mục này rồi install.  


### **Bước 2: Cài Đặt Chứng Chỉ SSL**  
1. Truy cập đường dẫn:  
   **`C:\xampp\apache\crt\autogolike-server.onrender.com`**  
2. Mở file **`server.crt`**, sau đó làm theo các bước sau:  
   - Nhấn **"Install Certificate..."**  
   - Chọn **"Local Machine"** → Nhấn **"Next"**  
   - Chọn **"Place all certificates in the following store"**  
   - Nhấn **"Browse..."**, chọn **"Trusted Root Certification Authorities"**, nhấn **"OK"**  
   - Nhấn **"Next" → "Finish" → "OK"** để hoàn tất.  
<p align="center">
  <img src="./img/image-6.png">
</p>

### **Bước 3: Cấu Hình Apache & Domain**  
1. **Cấu hình Virtual Host:**  
   - Truy cập đường dẫn: **`C:\xampp\apache\conf\extra`**  
   - Dán đè file **`httpd-vhost.conf`** vào đây.  

2. **Thêm Source Code vào XAMPP:**  
   - Truy cập: **`C:\xampp\htdocs`**  
   - Dán folder **`autogolike-server.onrender.com`** vào đây.  

3. **Cấu hình File Hosts:**  
   - Truy cập: **`C:\Windows\System32\drivers\etc`**  
   - Dán đè file **`hosts`** vào đây.  
    <p align="center">
        <img src="./img/image-7.png">
    </p>
---

### **Bước 4: Khởi Động XAMPP**  
1. Truy cập thư mục **`C:\xampp`** 
2. Mở ứng dụng **"xampp-control"**  
3. Nhấn **"Start"** để chạy Apache.  
- <p align="center">
    <img src="./img/image-10.png">
 
</p>
---

## **Cập Nhật Khi Đổi Server**  
Nếu cần thay đổi server, thực hiện lại các bước sau:  
1. Truy cập: **`C:\xampp\apache\conf\extra`**  
2. Dán đè file **`httpd-vhost.conf`**  
3. Truy cập: **`C:\xampp\htdocs`**  
4. Dán folder **`autogolike-server.onrender.com`**  

- Sau khi hoàn thành quá trình trỏ về local chúng ta thử truy cập và đăng nhập thử 
- <p align="center">
    <img src="./img/image-8.png">
    <hr>
    <img src="./img/image-9.png">
</p>
Như vậy chúng ta đã thành công tạo thành active hoàn toàn tùy ý chỉnh sửa được nội dụng mà chúng ta muốn.