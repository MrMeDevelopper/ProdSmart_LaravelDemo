<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    //
    public function index(){

        $users = \App\User::all();
      //  return $projects; //para API's ja retornava em JSON
        return view('users',['users'=>$users]);
    }


    public function edit($id){

        $user = User::findOrFail($id);
 
        return view('user_view',['user'=>$user]);
    }

    public function update($id){ ///projects/{{ project->id }}
    //dd(request()->all())

   
    
    $user = User::find($id);
    /*$project->title = request('title');
    $project->description = request('description');
    $project->save();*/

    $user->update([
      'name' => request('name'),
      'email' => request('email')
    ]);
    return redirect('/users');
  }


  public function destroy($id){
    User::find($id)->delete();
    return redirect('/users');
  }




/*

    public function create(){
      return view('projects.create');
    }

    public function edit($id){ ///site.com/projects/{project}/edit
      $project = Project::findOrFail($id);
 
      return view('projects.edit',['project'=>$project]);
    }

    public function destroy($id){
      Project::find($id)->delete();
      return redirect('/projects');
    }

    public function update($id){ ///projects/{{ project->id }}


     
      
      $project = Project::find($id);


      $project->update([
        'title' => request('title'),
        'description' => request('description')
      ]);
      return redirect('/projects');
    }

    public function show($id){
      $project = Project::find($id);
      return view('projects.show',['project'=>$project]);
    }

    public function store(){


      $validated = request()->validate([
        'title' => ['required','min:3','max:255'],
        'description' => 'required'
      ]);
      Project::create($validated);


      return redirect('/projects');
    }*/
}
