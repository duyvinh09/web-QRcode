<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["text"])) {
    $content = $_GET["text"];
    // Nhập domain, subdomain của web bạn vào đây nếu bạn không muốn người khác sài api của bạn
    // $allowedDomains = array("code.x10.mx", "www.code.x10.mx", "chongluadao.x10.bz", "www.chongluadao.x10.bz");

    // if (isset($_SERVER['HTTP_REFERER'])) {
    //     $refererDomain = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

    //     if (!in_array($refererDomain, $allowedDomains)) {
    //         header("HTTP/1.1 403 Forbidden");
    //         echo "Từ chối truy cập - Tên miền không hợp lệ. Vui lòng liên hệ zalo.me/duyvinh09";
    //         exit;
    //     }
    // } else {
    //     header("HTTP/1.1 403 Forbidden");
    //     echo "Từ chối truy cập - Thiếu tên miền gọi API.";
    //     exit;
    // }

    $apiUrl = "https://quickchart.io/qr?text=" . urlencode($content) . "&size=1000";

    $qrCodeImage = file_get_contents($apiUrl);

    if ($qrCodeImage === false) {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Lỗi khi gọi API Đinh Duy Vinh.";
        exit;
    }

    header("Content-Type: image/png");
    echo $qrCodeImage;
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Yêu cầu không hợp lệ - Thiếu tham số 'text'";
}
?>