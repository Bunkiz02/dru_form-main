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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SCI DRU FORM</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
    <link rel="stylesheet" href="css/style.min.css" />
  </head>
  <body>
    <div class="container">
      <div class="row mt-5">
        <div class="col-md-12 text-end">
             สวัสดี , Admin | <a href="logout.php" class="btn btn-outline-danger ">ออกจากระบบ</a>
        </div>
        <div class="col-md-12 text-center ">
          <h1>ใบเบิกวัสดุ</h1>
        </div>
        <div class="col-md-12 my-5">
       
          <form action="update_document.php" method="POST">
             <div class="row">
              <div class="col-md-6">
                    <div class="mb-3">
                    <label for="head_year" class="form-label">ปีที่:</label>
                    <?PHP 
                      echo '<select class="form-control" id="head_year" name="head_year" readonly>';
                      foreach ($yearsBE as $yearBE) {
                        $selected = ($yearBE == $row2['head_year']) ? 'selected' : '';
                        echo '<option value="' . $yearBE . '" ' . $selected . '>' . $yearBE . '</option>';
                      }
                      echo '</select>';
                    ?>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                  <label for="head_number" class="form-label">เลขที่เอกสาร:</label>
                  <input type="text" class="form-control" id="head_number" name="head_number" value="<?PHP echo $row2['head_number']; ?>" required readonly>
              </div>
                </div>
              
             </div>
            <div class="row">
               <div class="col-md-4">
               <div class="mb-3">
                <label for="head_date" class="form-label">วันที่:</label>
                <input type="text" class="form-control" id="head_date" name="head_date" value="<?PHP echo $row2['head_date'];?>" readonly>
            </div>
               </div>
               <div class="col-md-4">
               <div class="mb-3">
                 <label for="head_date_month" class="form-label">เดือน:</label>
                <select name="head_date_month" class="form-control" id="mount_id" readonly>
                    <option value="1">มกราคม</option>
                    <option value="2">กุมภาพันธ์</option>
                    <option value="3">มีนาคม</option>
                    <option value="4">เมษายน</option>
                    <option value="5">พฤษภาคม</option>
                    <option value="6">มิถุนายน</option>
                    <option value="7">กรกฎาคม</option>
                    <option value="8">สิงหาคม</option>
                    <option value="9">กันยายน</option>
                    <option value="10">ตุลาคม</option>
                    <option value="11">พฤศจิกายน</option>
                    <option value="12">ธันวาคม</option>
                </select>

            </div>
               </div>
               <div class="col-md-4">
               <div class="mb-3">
                <label for="head_date_year" class="form-label">ปี:</label>
                <input type="text" class="form-control" id="head_date_year" name="head_date_year" value="<?PHP echo $row2['head_year'];?>" readonly>
                <input type="hidden" class="form-control"  name="id" value="<?PHP echo $row2['head_id'];?>" readonly>
                
            </div>
               </div>
            </div>
            <div class="mb-3">
                <label for="head_name" class="form-label">ชื่อผู้เบิก:</label>
                <input type="text" class="form-control" id="head_name" name="head_name"  value="<?PHP echo $row2['head_name'];?>"  readonly>
            </div>

            <div class="mb-3">
                <label for="head_branch" class="form-label">สาขาวิชา:</label>
                <input type="text" class="form-control" id="head_branch" name="head_branch" value="<?PHP echo $row2['head_branch'];?>" readonly>
            </div>

            <div class="mb-3">
                <label for="head_faculty" class="form-label">ชื่อประธานสาขาวิชา:</label>
                <input type="text" class="form-control" id="head_faculty" name="head_faculty" value="<?PHP echo $row2['head_faculty'];?>" readonly>
            </div>
            <div class="row clearfix">
				<div class="col-md-12 table-responsive">
					<table class="table table-bordered table-hover table-sortable" id="tab_logic">
						<thead>
							<tr>
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
									<input type="text" name='list[]' placeholder='กรุณากรอกข้อมูล'
										class="form-control" readonly value="<?PHP echo $row3['option_name'];?>" />
                                        <input type="hidden" name="option_id[]" value="<?PHP echo $row3['option_id'];?>" >
								</td>
								<td data-name="count1">
									<input type="text" name='count[]' placeholder='กรุณากรอกข้อมูล'
										class="form-control" readonly value="<?PHP echo $row3['option_quantity'];?>" />
								</td>
								<td data-name="count_provide">
									<input type="text" name='count_provide[]' placeholder='กรุณากรอกข้อมูล'
										class="form-control" />
								</td>
								<td data-name="remark">
                                <input type="text" name='remark[]' placeholder='กรุณากรอกข้อมูล'
										class="form-control" />
								
								</td>
							</tr>
                            <?PHP 
                                }
                            ?>
						</tbody>
					</table>
                
				</div>
                <div class="col-md-12 mb-3">
                    <div class="mb-3">
                      <label for="" class="form-label">สถานะ</label>
                         <select name="status" class="form-control" id="">
                             <option value="A" <?PHP if($row2['head_status'] == 'A') echo 'selected'; ?>>ใช้งาน</option>
                             <option value="I" <?PHP if($row2['head_status'] == 'I') echo 'selected'; ?>>ยกเลิก</option>
                         </select>
                    </div>
                </div>
			</div>
			

            <button type="submit" class="btn btn-primary">แก้ไขรายการ</button>
            <a href="index.php" class="btn btn-secondary">ย้อนกลับ</a>
        </form>
        </div>
      </div>
    </div>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dynamic.js"></script>
     <script>
         var mount = Number("<?PHP echo $row2['head_date_month']; ?>");
         document.getElementById("mount_id").value = mount;
         const currentYear = new Date().getFullYear();
         const thaiYear = currentYear + 543;
         $(document).ready(function(){
             
              $('#head_year').change(function(e){
                  getNumber(e.target.value);
              });
         });
         function getNumber(date){
          $.getJSON('load_number.php?date='+date, function(data){
                 document.getElementById('head_number').value = data.year_count;
             });
         }
     </script>
  </body>
</html>
