<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;

use Validator;
class PostController extends Controller
{
    //

    public function index(){
        


        //$categories=Post::all();//instead SQL select * from categories
//        return view('showPost')->with('categories',$categories);
  

      return PostResource::collection(Post::paginate(10));


    }

    public function create (){
        $categories=Post::all();//instead SQL select * from categories
        return view('insertPost');
    }


    public function store(Request $r){    //step 2
        $r=request(); //step 3 get data from HTML

        $validated = Validator::make($r->all() ,[
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:3',
        ]);
        if ($validated->fails()) {
            return response()->json(['status'=> false , 'errors' => $validated->errors() ]);
        }
        $post = Post::create([    //step 3 bind data
            'title'=>$r->title, //fullname from HTML
            'body'=> $r->body, //fullname from HTML

        ]);
        return response()->json(['status'=> true , 'data' => $post  ]);

       // Return  redirect('/admin/Post'); // view('insertPost');// step 5 back to last page
    }

    public function update($id){    //step 2
        $r=request(); //step 3 get data from HTML

        $validated = Validator::make($r->all() ,[
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:3',
        ]);
        $post = Post::find($id);
        
        if ($validated->fails() || $post == false) {
            return response()->json(['status'=> false , 'errors' => $validated->errors() ]);
        }
        
        $post->title = $r->title; //fullname from HTML
        $post->body = $r->body; //fullname from HTML
        $post->save();
        
        return response()->json(['status'=> true , 'data' => $post  ]);

    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

                return response()->json(['status'=> true ]);
    }


    public function show(){
        $categories=Post::all();//instead SQL select * from categories
        return view('showPost')->with('categories',$categories);
    }

    public function delete($id){
        $categories=Post::find($id);
        $categories->delete(); //apply delete from categories where id='$id'
        return redirect()->route('showPost');
    }


}
