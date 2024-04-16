<!-- <link rel="stylesheet" type="text/css" href="./public/assets/bootstrap/css/bootstrap.css>" /> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<div class="col-md-12">
    <form action="" id="update-details-form">
        <input type="hidden" name="EmployeeModel[id]" value="<?= isset($id)? $id : $model['id'] ?>">
       
        <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true"><b>Personal Information</b></a>
        
            
        </ul>
        <div class="tab-content" id="detailsTabContent">
            <div class="tab-pane fade show active border p-2" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname" class="control-label">Firstname</label>
                            <input type="text" class="form-control form-control-sm" name="EmployeeModel[first_name]" id="firstname" required value="<?= isset($model['first_name']) ? $model['first_name'] : "" ?>">
                        </div>
           
                        <div class="form-group">
                            <label for="lastname" class="control-label">Lastname</label>
                            <input type="text" class="form-control form-control-sm" name="EmployeeModel[last_name]" id="lastname" required value="<?= isset($model['last_name']) ? $model['last_name'] : "" ?>">
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control form-control-sm" name="EmployeeModel[email]" id="email" required value="<?= isset($model['email']) ? $model['email'] : "" ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="address" class="control-label">Address</label>
                            <textarea rows="3" class="form-control form-control-sm" name="EmployeeModel[address]" id="address" style="resize:none" required><?= isset($model['address']) ? $model['address'] : "" ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hobbies" class="control-label">Hobbies</label>
                            <input type="textarea" class="form-control form-control-sm" name="EmployeeModel[hobbies]" id="hobbies" required value="<?= isset($model['hobbies']) ? $model['hobbies'] : "" ?>">
                        </div>
                        <div class="form-group" style="margin-top: 50px;">
                            <label for="gender" class="control-label" >Gender</label>
                            <select class="form-select form-select-sm" name="EmployeeModel[gender]" id="gender" required>
                                <option <?= isset($model['gender']) && $model['gender'] == "Male" ? "selected" : '' ?>>Male</option>
                                <option <?= isset($model['gender']) && $model['gender'] == "Female" ? "selected" : '' ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-top: 40px;">
                            <label for="contact" class="control-label">Contact No</label>
                            <span>
                              <select class="form-control-sm" name="EmployeeModel[country_code]" required>
                                <option selected value="">Select </option>
                                <?php foreach ($country_code_details as $key => $value) {
                                  if (isset($model['country_code']) && $value['id'] == $model['country_code']) { ?>
                                     <option selected value="<?= $value['id'] ?>"> <?= $value['country_code'].'-'.$value['country_name']; ?> </option>
                                  <?php }else{ ?>
                                       <option value="<?= $value['id'] ?>"> <?= $value['country_code'].'-'.$value['country_name']; ?> </option>
                                  <?php }
                                } ?>
                                </select>
                            <input type="text" class="form-control-sm" name="EmployeeModel[mobile]" id="contact" required value="<?= isset($model['mobile']) ? $model['mobile'] : "" ?>">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </form>
    <div class="form-group py-2">
        <center>
            
            <?php if (isset($model['id'])) { ?>
              <button class="btn btn-primary rounded-0 col-2" form="update-details-form"><i class="fa fa-save" style="cursor: pointer;" ></i> Update</button>
              <button class="btn btn-danger rounded-0 col-2" onclick="delete_data('<?= $model['id']; ?>')" id="delete_data" type="button" data-id="<?= $model['id']; ?>" data-name="<?= $model['id']." - ".(ucwords($model['first_name'])) ?>" style="cursor: pointer;" ><i class="fa fa-trash"></i> Delete</button>
           <?php  }else{ ?>
            <button class="btn btn-primary rounded-0 col-2" form="update-details-form" style="cursor: pointer;" ><i class="fa fa-save"></i> Add</button>
          <?php  } ?>
           
            <a class="btn btn-dark rounded-0 col-2" href="<?= base_url("/employee") ?>" style="cursor: pointer;" ><i class="fa fa-angle-left"></i> Back to List</a>
        </center>
    </div>
</div>

<script type="text/javascript">
    var emp_id = "<?= isset($model['id'])?$model['id']:''; ?>"
$('#update-details-form').on('submit',function(e){
            e.preventDefault();
            var frm = $(this)[0];
            // console.log(frm)
            console.log(frm.checkValidity())
            if(!frm.checkValidity()){
                frm.reportValidity()
                return false;
            }
            $.ajax({
                url:"<?= base_url() ?>/employee/save_employee",
                method:'POST',
                data: new FormData($(this)[0]),
                dataType:'json',
                async:false,
                cache: false,
                contentType: false,
                processData: false,
                error:function(err){
                    console.error(err)
                    //alert('an error occurred')
                },
                success:function(resp){
                  console.log(resp)
                    if(resp.status =='success'){
                      alert("Sucessfully Saved")
                      if (emp_id == '') {
                         window.location.href = "<?php echo base_url() ?>/employee"
                      }else{
                         location.reload()
                      }
                    }else{
                        var el = $('div')
                            el.addClass('alert alert-danger pop-msg')
                            el.hide()
                            el.text(resp.msg)
                            _this.prepend(el)
                            el.show('hide')
                    }
                }
            })
        })

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