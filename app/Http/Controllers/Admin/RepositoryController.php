<?php

namespace App\Http\Controllers\Admin;
use App\Models\Repository;
use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Models\Area;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\repositoryinterface\UserRepositoryInterface;
use App\repository\DbUsersRepository;
use Illuminate\Support\Arr;


class RepositoryController extends Controller
{
   private $userRepository ;

    function __construct(UserRepositoryInterface $userRepository)
    {
       $this->userRepository= $userRepository;
    }
      

    public function index(Request $request)
    {
       $users = $this->userRepository->all();
      
       
      return view('Admin.repository.show',compact('users'));
    }


    public function create()
    {
      return view('Admin.repository.form');
      
    }

    public function store(Request $request)
    {
        
       
    $this->userRepository->create($request->all());
    
    return back();
      
    }



    public function edit($id)
    {
  

    $user= $this->userRepository->get_by_id($id);
    
    return view('Admin.repository.edit',compact('user'));
      

    }

    public function update(Request $request, $id)
    {
        
           $values = Arr::except($request->all(), ['_token','_method']);
           //Repository::where('id', $id)->update($values);
           $this->userRepository->updatedb($values,$id);
             return redirect('admin/repository');
    }


    public function destroy($id)
    {
    $this->userRepository->deleted($id);
    return redirect('admin/repository');
    }//end fun
    
    
    public function custom_insert(Request $request)
    {
        $this->userRepository->create($request->all());
    
       return back();
    }
    public function custom_update(Request $request)
    {
        
    }
    

}
