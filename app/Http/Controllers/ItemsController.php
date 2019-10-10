<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
     //
     public function index(){

        $items = \App\Item::all();
      //  return $projects; //para API's ja retornava em JSON
        return view('items',['items'=>$items]);
    }

    public function create(){
        return view('items_create');
      }

    public function edit($id){

        $item = Item::findOrFail($id);
 
        return view('item_view',['item'=>$item]);
    }

    public function update($id){ ///projects/{{ project->id }}
    //dd(request()->all())

   
    
    $item = Item::find($id);

    $item->update([
      'name' => request('name')
    ]);
    return redirect('/items');
  }

    public function store(){


      $validated = request()->validate([
        'name' => ['required','min:3','max:255']
      ]);
      Item::create($validated);

      return redirect('/items');
    }

    public function destroy($id){
        Item::find($id)->delete();
        return redirect('/items');
    }
}
