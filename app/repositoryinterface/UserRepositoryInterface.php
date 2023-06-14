<?php

namespace App\repositoryinterface;


interface UserRepositoryInterface
{
    
    
    public function all();
    
    
    public function create($coloums);
    public function get_by_id($id);
    public function updatedb($data,$id);
    public function deleted($id);
}

































?>