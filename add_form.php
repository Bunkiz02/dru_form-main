<?PHP 
   session_start();
   
   include ('connect_db.php');

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
     
        <div class="col-md-12 text-center ">
          <h1>ใบเบิกวัสดุ</h1>
        </div>
        <div class="col-md-12 my-5">
       
          <form action="save_document.php" method="POST" onsubmit="return confirm('กรุณาตรวจสอบข้อมูล เนื่องจากหากกดปุ่ม `บันทึก` แล้วจะไม่สามารถแก้ไขเอกสารได้!')">
             <div class="row">
              <div class="col-md-6">
                    <div class="mb-3">
                    <label for="head_year" class="form-label">ปีที่:</label>
                    <?PHP 
                      echo '<select class="form-control" id="head_year" name="head_year" required>';
                      foreach ($yearsBE as $yearBE) {
                        $selected = ($yearBE == $currentYearBE) ? 'selected' : '';
                        echo '<option value="' . $yearBE . '" ' . $selected . '>' . $yearBE . '</option>';
                      }
                      echo '</select>';
                    ?>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                  <label for="head_number" class="form-label">เลขที่เอกสาร:</label>
                  <input type="text" class="form-control" id="head_number" name="head_number" required readonly>
              </div>
                </div>
              
             </div>
            <div class="row">
               <div class="col-md-4">
               <div class="mb-3">
                <label for="head_date" class="form-label">วันที่:</label>
                <input type="text" class="form-control" id="head_date" name="head_date" value="<?PHP echo date('d');?>" required>
            </div>
               </div>
               <div class="col-md-4">
               <div class="mb-3">
                 <label for="head_date_month" class="form-label">เดือน:</label>
                <select name="head_date_month" class="form-control" id="mount_id">
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
                <input type="text" class="form-control" id="head_date_year" name="head_date_year" value="<?PHP echo date('Y')+543;?>" required>
            </div>
               </div>
            </div>
            <div class="mb-3">
                <label for="head_name" class="form-label">ชื่อผู้เบิก:</label>
                <input type="text" class="form-control" id="head_name" name="head_name" required>
            </div>

            <div class="mb-3">
                <label for="head_branch" class="form-label">สาขาวิชา:</label>
                <input type="text" class="form-control" id="head_branch" name="head_branch" required>
            </div>

            <div class="mb-3">
                <label for="head_faculty" class="form-label">ชื่อประธานสาขาวิชา:</label>
                <input type="text" class="form-control" id="head_faculty" name="head_faculty" required>
            </div>
            <div class="row clearfix">
				<div class="col-md-12 table-responsive">
					<table class="table table-bordered table-hover table-sortable" id="tab_logic">
						<thead>
							<tr>
						
								<th class="text-center" width="60%">
									รายการ
								</th>
								<th class="text-center">
									จำนวนที่เบิก
								</th>
							
								<th class="text-center">
                  #
								</th>
							</tr>
						</thead>

						<tbody>

							<tr id='addr0' data-id="0" class="hidden">
					
								<td data-name="list">
									<input type="text" name='list[]' placeholder='กรุณากรอกข้อมูล'
										class="form-control" />
								</td>
								<td data-name="count">
									<input type="text" name='count[]' placeholder='กรุณากรอกข้อมูล'
										class="form-control" />
								</td>
						
								<td data-name="del">
									<button name="del0"
										class='btn btn-danger glyphicon glyphicon-remove row-remove'><span
											aria-hidden="true">×</span></button>
								</td>
							</tr>
						</tbody>
					</table>
          <a id="add_row" class="btn btn-outline-success float-right mb-5">เพิ่มเเถว</a>
				</div>
			</div>
			

            <button type="submit" class="btn btn-primary">บันทึก</button>
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
         var mount = Number("<?PHP echo date('m'); ?>");
         document.getElementById("mount_id").value = mount;
         const currentYear = new Date().getFullYear();
         const thaiYear = currentYear + 543;
         $(document).ready(function(){
              getNumber(thaiYear);

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
