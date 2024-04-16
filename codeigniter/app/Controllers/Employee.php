<?php namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\CountryCodeModel;

class Employee extends BaseController
{

  public function __construct(){
        helper('html');
        helper('form');
        $this->employeeModel = new EmployeeModel();
        $this->countryCodeModel = new CountryCodeModel();
        $this->db = \Config\Database::connect();
    }
    
    public function index()
    {
        $model = new EmployeeModel();
        $data['employees'] = $model->findAll();
        echo view('employee/employee_list', $data);
    }

    public function create()
    {
        $id = isset($_GET['id'])?$_GET['id']:'';
        $country_code_details = $this->countryCodeModel->find();
        $model = new EmployeeModel();
        $max_id = $this->employeeModel->max_id();
        $data['model'] = $model->find($id);
        $data['id'] = ($id != '')?$id:$max_id+1;
        $data['country_code_details'] = $country_code_details;
        helper(['form']);
        echo view('employee/employee_form',$data);
    }  
    

    public function save_employee(){
      $result = $this->employeeModel->saverecords($_POST['EmployeeModel']);
      if ($result == 1) {
        $resp['status'] = "success";
        return json_encode($resp);
      }
        return redirect()->to('/employee');
    }
    
    public function edit($id)
    {
        $model = new EmployeeModel();
        $country_code_details = $this->countryCodeModel->find();
        $data['model'] = $model->find($id);
        $data['country_code_details'] = $country_code_details;
        echo view('employee/employee_form', $data);
    }

    public function update($id)
    {
        $model = new EmployeeModel();
        $data = $this->request->getPost();
        if ($this->request->getFile('photo')->isValid() && !$this->request->getFile('photo')->hasMoved()) {
            $photo = $this->request->getFile('photo');
            $photoName = $photo->getRandomName();
            $photo->move('uploads/', $photoName);
            $data['photo'] = $photoName;
        }
        $model->update($id, $data);
        return redirect()->to('/employee');
    }

    public function delete()
    {
        $id = isset($_POST['id'])?$_POST['id']:'';
        $model = new EmployeeModel();
        $model->delete($id);
        $resp['status'] = "success";
        return json_encode($resp);
    }
}
?>