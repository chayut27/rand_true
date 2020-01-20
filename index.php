<?php

$ranges = Array(
    Array(0,25,75), // [0-25] on 75% chance
    Array(26,51,13),
    Array(52,76,6),
    Array(77,115,4),
    Array(115,200,2)
);
$sel = rand(0,99);
do {
    $pick = array_shift($ranges);
    $sel -= $pick[2];
} while($pick && $sel >= 0);
$random = rand($pick[0],$pick[1]);

// echo $random;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <style>
        body {
            background: #E74C3C;
        }

        .t-14px {
            font-size: 14px;
        }


        img {
            width: 100px;
            cursor: pointer;
            /* transition: .5s ease; */
        }

        .disabled img{
            opacity:0.5;
        }

        img:hover {
            animation: shake 0.5s;
            animation-iteration-count: infinite;
            /* transform: scale(1.2); */
        }

        .not-choose img{
            cursor: not-allowed;
            animation: none !important;
        }

        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }

            10% {
                transform: translate(-1px, -2px) rotate(-1deg);
            }

            20% {
                transform: translate(-3px, 0px) rotate(1deg);
            }

            30% {
                transform: translate(3px, 2px) rotate(0deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            50% {
                transform: translate(-1px, 2px) rotate(-1deg);
            }

            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }

            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }

            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            90% {
                transform: translate(1px, 2px) rotate(0deg);
            }

            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card border-0 shadow">
                <div class="card-header">
                <i class="fas fa-info-circle"></i> จับรางวัล
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 mx-auto">
                                <div class="alert alert-primary box-info t-14px d-none" role="alert">
                                    <i class="fas fa-info-circle"></i> เลือกกล่องที่จะทำการเปิดเพื่อสุ่มบัตรทรูมันนี่
                                </div>
                                <div class="alert alert-primary box-processing t-14px d-none" role="alert">
                                    <i class="fas fa-spinner fa-spin"></i> กำลังเปิดกล่องของคุณ...
                                </div>
                                <div class="alert alert-danger box-failed t-14px d-none" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> แย่จัง! วันนี้ดวงไม่ดีเลย
                                </div>
                                <div class="alert alert-success box-success t-14px d-none" role="alert">
                                    <i class="fas fa-check-circle"></i> <b>ยินดีด้วย!</b> คุณได้รับเงินสดจำนวน <span>50</span> บาท
                                </div>
                                <div class="text-center mt-4 mb-5 d-none">
                                    <h5><i class="fas fa-hand-holding-usd"></i> ราคาสุ่ม 25 Point/ครั้ง</h5>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="box choose">
                                            <img src="i.png">
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="box choose">
                                            <img src="i.png">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="box choose">
                                            <img src="i.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="box choose">
                                            <img src="i.png">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="box choose">
                                            <img src="i.png">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="box choose">
                                            <img src="i.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.1.6/dist/sweetalert2.all.min.js"></script>
    <script>


        $("body").on("click", ".choose", function(){
            $.ajax({
                url: "process.php",
                method: "POST",
                beforeSend(xhr){
                    $(".box-info").addClass("d-none");
                    $(".box-failed").addClass("d-none");
                    $(".box-success").addClass("d-none");
                    $(".box-processing").removeClass("d-none");
                },
                success: function(result){
                    $(".box").removeClass("choose").addClass("not-choose").addClass("disabled");
                    setTimeout(() => {
                        // alert(result);
                        if(result == 0){
                            $(".box-processing").addClass("d-none");
                            $(".box-failed").removeClass("d-none");
                            $(".box").addClass("choose").removeClass("not-choose").removeClass("disabled");
                        }else{
                            $(".box-success").find("span").text(result);
                            $(".box-processing").addClass("d-none");
                            $(".box-success").removeClass("d-none");
                            $(".box").addClass("choose").removeClass("not-choose").removeClass("disabled");
                        }
                    }, 5000);
                }
            });
            
        })
        // $(function () {
        //  Swal.fire({

        //                     title: 'สุ่มได้',
        //                         showClass: {
        //                             popup: 'animated fadeInDown faster'
        //                         },
        //                         hideClass: {
        //                             popup: 'animated fadeOutUp faster'
        //                         },
        //                         html: '<h4>50 บาท</h4>',
        //                         icon: 'success',
        //                         confirmButtonColor: '#e74c3c',
        // });
        // });
    </script>
</body>

</html>