<?PHP 
   session_start();
   
   if(!isset($_SESSION['user_id'])){
       header('Location: login.php');
       exit;
   }
   include ('connect_db.php');
   $id = $_GET['view'];
   $sqlview = "SELECT * FROM tb_date_form WHERE head_id = '$id'";
   $queryview = mysqli_query($mysqli,$sqlview);
   $row2 = mysqli_fetch_array($queryview);

   $currentYearGregorian = date("Y");
   $currentYearBE = $currentYearGregorian + 543;
   $startYearBE = $currentYearBE - 10;
   $endYearBE = $currentYearBE + 10;
   
   $yearsBE = range($startYearBE, $endYearBE);
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="dynamic.js"></script>
    <link rel="stylesheet" href="css/style_print.css">
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>

<body>
    <div class="paper-shadow">
        <div class="Title-Top">
            <h2>ใบเบิกวัสดุ</h2>
        </div>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>

                                <b class="original">ใบเบิกที่</b>......
                                <?PHP echo $row2['head_number'];?> /
                                <?PHP echo $row2['head_year'];?>......<br />
                                <br />
                                <b class="original">เรื่อง</b> ขออนุมัติเบิกวัสดุของใช้สำนักงาน<br />
                                <br />
                                <b class="original">เรื่อง</b> คณบดี<br />
                    </td>
                </tr>
            </table>
            </td>
            <td colspan="2">
                <table>
                    <tr>
                        <td class="day-mount-year">
                            <b>วันที่ </b>......
                            <?PHP echo $row2['head_date'];?>......
                            <b>เดือน</b>......
                            <?PHP echo $row2['head_date_month'];?>.......
                            <b>พ.ศ.</b>......
                            <?PHP echo $row2['head_date_year'];?>......
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
            </table>
            <div class="day-mount-year">
                <b>ตามที่</b>
                <?PHP echo $row2['head_name'];?>
                <b>สาขาวิชา</b>
                <?PHP echo $row2['head_branch'];?> <br />
            </div>
            <br />
            <div class="invoice-box">
                <p>มีความประสงค์ขอเบิกวัสดุสำนักงานของคณะวิทยาศาสตร์เเละเทคโนโลยีเพื่อใช้ราชการ ดังต่อไปนี้ .-</p>
            </div>
           

        </div>
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    ที่
                                </th>
                                <th class="text-center">
                                    รายการ
                                </th>
                                <th class="text-center">
                                    จำนวนที่เบิก
                                </th>
                                <th class="text-center">
                                    จำนวนที่รับ
                                </th>
                                <th class="text-center">
                                    หมายเหตุ
                                </th>
                                <th class="text-center"
                                    style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?PHP 
                                $sql3 = "SELECT * FROM tb_optional WHERE option_head_id = '$id'";
                                $query3 = mysqli_query($mysqli, $sql3);
                                while ($row3 = mysqli_fetch_array($query3)) {

                            ?>
                            <tr id='addr0' data-id="0" class="hidden">
                                <td data-name="list">
                                    <input type="text" name='list[]' class="form-control" readonly
                                        value="<?PHP echo $row3['option_name'];?>" />
                                    <input type="hidden" name="option_id[]" value="<?PHP echo $row3['option_id'];?>">
                                </td>
                                <td data-name="count1">
                                    <input type="text" name='count[]' class="form-control" readonly
                                        value="<?PHP echo $row3['option_quantity'];?>" />
                                </td>
                                <td data-name="count_provide">
                                    <input type="text" name='count_provide[]' class="form-control" />
                                </td>
                                <td data-name="remark">
                                    <input type="text" name='remark[]' class="form-control" />

                                </td>
                            </tr>
                            <?PHP 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br />

        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <b class="original_boss4">
                                      (ลงชื่อ)...............................................ผู้เบิก</b><br />
                                    <br />
                                    
                                    <b class="original_boss3">
                                        
                                        ( </b>......
                                    <?PHP echo $row2['head_name'];?>......<b></b> )</b><br />
                                    <br />
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="invoicet">
                                    <b class="original_boss">
                                    (ลงชื่อ)...................................................ประธานหลักสูตร</b><br />
                                    <br />
                                    <b class="original_boss1">( </b>......
                                    <?PHP echo $row2['head_faculty'];?>......<b> )</b>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <hr>

            <div class="container">
                <table cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <div class="div2 col-sm-10">

                                            <div class="form-check">
                                                <br /><input type="radio" class="form-check-input" id="radio1"
                                                    name="optradio" value="option1" checked> อนุญาตให้เบิกได้
                                                <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <br />
                                            <div class="form-check">
                                                <br /><input type="radio" class="form-check-input" id="radio2"
                                                    name="optradio" value="option2">
                                                <label class="form-check-label" for="radio2"> ไม่อนุญาตเนื่องจาก</b>
                                                ......<?PHP echo $row2['head_faculty'];?>......</label>
                                            </div>
                                            <br />
                                            <b class="xx">(ลงชื่อ)</b>...................................<b>หัวหน้าพัสดุ</b><br />  
                                            <b class="xr">
                                                (</b><?PHP echo $row2['head_name'];?><b>)</b><br />
                                            <br />
                                        </div>
                                    </td>
                                </tr>

                            </table>

                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <div class="div3 col-sm-10">
                                            <br />
                                            <b class="mx">ครบถ้วนถูกต้องเเล้วได้รับของครบถ้วนถูกต้องเเล้ว</b></b><br />
                                            <br />
                                            
                                            <b class="xc">(ลงชื่อ)</b>...................................<b>ผู้รับของ</b><br />
                                           
                                            <b class="xq">
                                                (</b><?PHP echo $row2['head_name'];?><b>)</b><br />
                                            <hr>

                                            <b class="xc">(ลงชื่อ)</b>...................................<b>ผู้จ่าย</b><br />
                                         
                                            <b class="xq">
                                                (</b><?PHP echo $row2['head_name'];?><b>)</b><br />
                                            <br/>
                                          
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success material-symbols-outlined"
                    onclick="window.print();">พิมพ์</button>
            </div>



        </div>



    </div>
    </div>




</body>

</html>