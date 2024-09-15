<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <noscript><meta http-equiv="refresh" content="0; url=https://bit.ly/3MDyab1" /></noscript>
    <meta name="description" content="Công cụ tạo mã QR code nhanh chóng">
    <meta name="keywords" content="website, qr code, tạo mã QR code, công cụ">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Công cụ tạo mã QR code nhanh chóng" />
    <meta property="og:image" content="https://i.imgur.com/rUldJC2.jpg" />
    <title>Tạo Mã QR từ Tin Nhắn</title>
    <link rel="shortcut icon" href="https://i.imgur.com/83Gs09S.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script disable-devtool-auto md5='2d27c193eef1566b73904e5f948fc708' src='https://cdn.jsdelivr.net/npm/disable-devtool@latest'></script>
    <script disable-devtool-auto md5='2d27c193eef1566b73904e5f948fc708' src='./npm/disable-devtool.min.js'></script>
    <style>
        body {
            background-color: #f0f0f0;
        }

        .bg-card {
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        button {
            cursor: pointer;
            border-radius: 8px;
        }
        
        .bg-primary {
            background-color: #3B82F6;
        }
        
        .text-primary-foreground {
            color: #ffffff;
        }
        
        .bg-primary:hover {
            background-color: #254ab1;
        } 
    </style>
</head>
<body>
    <div class="container mx-auto px-4 md:px-8 lg:px-16 py-8">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm mx-auto max-w-2xl" data-v0-t="card">
            <div class="flex flex-col p-6 space-y-1">
                <h3 class="tracking-tight text-2xl font-bold">Tạo Ảnh QR Code</h3>
                <p class="text-sm text-muted-foreground">Nhập Các Thông Tin Bên Dưới Để Tạo Mã QR</p>
            </div>
            <div class="p-6">
                <form method="post">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="message">
                                Văn Bản
                            </label>
                            <textarea class="flex h-20 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="message" name="message" placeholder="Nhập văn bản cần tạo QR code" required=""></textarea>
                        </div>
                        <div class="flex space-x-2">
                            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full" type="submit" name="generateQR">
                                <i class="fas fa-qrcode"></i>&nbsp; Tạo QR Code
                            </button>
                            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full" type="button" onclick="downloadQR()">
                                <i class="fas fa-download"></i>&nbsp; Tải QR Code
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="rounded-lg border bg-card text-card-foreground shadow-sm mx-auto max-w-2xl mt-8" data-v0-t="card">
            <div class="flex flex-col p-6 space-y-1">
                <h3 class="tracking-tight text-2xl font-bold">Ảnh QR Code Của Bạn</h3>
                <p class="text-sm text-muted-foreground">Mã QR Sẽ Được Xuất Hiện Ở Bên Dưới</p>
            </div>
            <div class="p-6">
                <?php
                $defaultImage = "https://i.imgur.com/U7afLiO.png";

                if (isset($_POST['generateQR'])) {
                    $content = isset($_POST['message']) ? $_POST['message'] : '';
                    $content = urlencode(trim($content));

                    $apiURL = "/qrCode/api.php?text={$content}";
                ?>
                    <div class="flex justify-center items-center p-4 border-2 border-dashed rounded-md">
                        <img id="qrcodeImg" src="<?= $apiURL ?>" alt="QR Code" height="400" width="400">
                    </div>
                <?php
                } else {
                ?>
                    <div class="flex justify-center items-center p-4 border-2 border-dashed rounded-md">
                        <img id="qrcodeImg" src="<?= $defaultImage ?>" alt="Default Image" height="300" width="300">
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <footer class="mt-6 text-center text-gray-500 text-sm">
                © 2024 Vận Hành Bởi
                <a href="https://me.momo.vn/dinhduyvinh">Đinh Duy Vinh</a>
            </footer>
    </div>

    <script>
        function downloadQR() {
            var qrcodeImg = document.querySelector('#qrcodeImg');
            
            if (qrcodeImg) {
                var downloadLink = document.createElement('a');
                downloadLink.href = qrcodeImg.src;
                downloadLink.download = 'qrcode.png';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }
        }
    </script>
</body>
</html>