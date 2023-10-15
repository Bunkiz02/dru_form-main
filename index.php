<?PHP 
   session_start();
   if(!isset($_SESSION['user_id'])){
       header('Location: login.php');
       exit;
   }
   include ('connect_db.php');

   $sql = "SELECT * FROM tb_date_form group by  head_year order by head_year ASC"; 
   $query = mysqli_query($mysqli ,$sql);

    $sql2 = "SELECT * FROM tb_date_form  order by head_id  ASC"; 
   $query2 = mysqli_query($mysqli ,$sql2);
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
        <div class="col-md-12 mt-5">
          <a href="add_form.php" class="btn btn-primary">+ เพิ่มข้อมูล</a>
          <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalId" >ส่งออก Excel</a>
          <table class="table table-borderd">
            <thead>
              <tr>
                <th>#</th>
                <th>เลขที่เบิก</th>
                <th>วันที่</th>
                <th>ชื่อผู้เบิก</th>
                <th>สาขาวิชา</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
              </tr>
            </thead>
            <tbody>
              <?PHP 
                  $i =1;
                  while ($row2 = mysqli_fetch_array($query2)){
              ?>
              <tr>
                <td><?PHP echo  $i++;  ?></td>
                <td><?PHP echo $row2['head_number'];?> / <?PHP echo $row2['head_year'];?></td>
                <td><?PHP echo $row2['head_date'];?>/<?PHP echo $row2['head_date_month'];?>/<?PHP echo $row2['head_date_year'];?></td>
                <td><?PHP echo $row2['head_name'];?></td>
                <td><?PHP echo $row2['head_branch'];?></td>
                <td><?PHP if($row2['head_status'] == 'A'){ echo 'ปกติ'; }else{ echo 'ยกเลิก'; } ?></td>
                <td>
                  <a href="edit_form_admin.php?view=<?PHP echo $row2['head_id']; ?>" class="btn btn-warning btn-sm">
                    <span class="material-symbols-outlined"> edit </span
                    >แก้ไข</a
                  >
                  <!-- <a href="#" class="btn btn-danger btn-sm">
                    <span class="material-symbols-outlined"> delete </span>
                    ยกเลิก</a
                  > -->
                  <a href="print_form.php?view=<?PHP echo $row2['head_id']; ?>" class="btn btn-primary btn-sm">
                    <span class="material-symbols-outlined" > print </span>
                    พิมพ์</a
                  >
                  <!-- <a href="print_form.php" class="btn btn-primary btn-sm">
                    <span class="material-symbols-outlined" > print </span>
                    พิมพ์</a
                  > -->
                </td>
              </tr>
              <?PHP } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
   
     
     <!-- Modal Body -->
     <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
     <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">เลือกปีสำหรับ ส่งออกข้อมูล</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="export_excel.php" method="POST">
                  <div class="mb-3">
                    <label for="" class="form-label">ปี</label>
                    <select name="year" class="form-control" id="">
                        <?PHP 
                          while ($row = mysqli_fetch_array($query)){
                        ?>
                           <option ><?PHP echo $row['head_year']?></option>
                        <?PHP } ?>
                    </select>
                    
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <button type="button" class="btn btn-success">ส่งออก Excel</button>
          </div>
        </div>
      </div>
     </div>
     
     
     <!-- Optional: Place to the bottom of scripts -->
     <script>
      const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
     
     </script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
