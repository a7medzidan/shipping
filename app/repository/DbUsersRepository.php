<?php

namespace App\repository;
use App\Models\Repository;

use App\repositoryinterface\UserRepositoryInterface;

  class DbUsersRepository implements UserRepositoryInterface{

   
    public function all()
    {
      return  Repository::all();
    }
    
    
    public function create($coloums)
    {
     return  Repository::create($coloums);
      
    }
    
    public function get_by_id($id)
    {
         return  Repository::find($id);
    }
    
    public function updatedb($data,$id)
    {
       
      return  Repository::where('id', $id)->update($data);
    }
    
    public function deleted($id)
    {
       return  Repository::destroy($id);
    }
    
}



