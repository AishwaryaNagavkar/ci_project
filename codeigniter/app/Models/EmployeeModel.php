<?php namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'first_name', 'last_name', 'email', 'country_code', 'mobile',
        'address', 'gender', 'hobbies', 'photo'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';  // Not using an updated field here


    public function max_id()
    {
		$data  = $this->db->table('employee')
                ->select("max(id) as max_id")
                ->get()->getRow();
		return $data->max_id;
	}

	public function getData($id){
		$model = new EmployeeModel();
        $data = $model->find($id);
		return $data;
	}
    function saverecords($data)
	{
		// echo "<pre>";print_r($data);die;
		if ($this->getData($data['id']) == null) {
			$table_builder = $this->db->table('employee')->insert($data);
		}else{
			$model = new EmployeeModel();
			$model->update($data['id'],$data);
		}
        return 1;
	}

}
?>