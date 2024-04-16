<htm>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<h2>Employee List</h2>

<div class="col-md-12 text-end py-2">
    <button class="btn btn-primary rounded-0" style="cursor: pointer;" type="button" id="new_employee" onclick="add_employee()"><i class="fa fa-plus"></i> Add New Employee</button>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="5%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr class="bg-dark bg-gradient text-light">
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last NAme</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Hobbies</th>
                    <th>Address</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($employees as $row):
                ?>
                <tr>
                    <td class="py-1 px-2 text-center"><?= $i++ ?></td>
                    <td class="py-1 px-2"><?= $row['id'] ?></td>
                    <td class="py-1 px-2"><?= ucwords($row['first_name']) ?></td>
                    <td class="py-1 px-2"><?= ucwords($row['last_name']) ?></td>
                    <td class="py-1 px-2"><?= ucwords($row['email']) ?></td>
                    <td class="py-1 px-2"><?= ucwords($row['mobile']) ?></td>
                    <td class="py-1 px-2"><?= ucwords($row['gender']) ?></td>
                    <td class="py-1 px-2"><?= ucwords($row['hobbies']) ?></td>
                    <td class="py-1 px-2"><?= ucwords($row['address']) ?></td>
                    <td class="py-1 px-2"><a style="cursor: pointer;" class="dropdown-item" href="<?= base_url('employee/edit/'.$row['id']) ?>">View/Edit</a></td>
                    <td class="py-1 px-2"><a style="cursor: pointer;" class="dropdown-item delete_data" onclick="delete_data('<?= $row['id'] ?>')" data-id="<?= $row['id'] ?>" data-name="<?= $row['id']." - ".(ucwords($row['first_name'])) ?>">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</htm>
<script>
function add_employee(){
  window.location.href = "<?php echo base_url() ?>/employee/create"
}
function delete_data(id){
  var _conf = confirm("Are you sure to delete? This action cannot be undone.")
  if(_conf === true){
      $.ajax({
          url:"<?= base_url("employee/delete") ?>",
          method:'POST',
          data:{id:id},
          dataType:"json",
          error:err=>{
              console.error(err)
              pop_toast("Action Failed due to an error occured.",'danger',2000)
          },
          success:function(resp){
              if(resp.status == 'success'){
                  location.replace("<?= base_url("employee") ?>")
              }else if(!!resp.msg){
              pop_toast(resp.msg,'danger',2000)
              }else{
                  console.error(resp)
                  pop_toast("Action Failed due to an error occured.",'danger',2000)
              }
          }
      })
  }
}
</script>