<?php namespace App\Models;

use CodeIgniter\Model;

class CountryCodeModel extends Model
{
    protected $table = 'country_code';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'country_code', 'name'
    ];

}
?>