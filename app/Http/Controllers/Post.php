<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator,Redirect,Response;


class Post extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    //display all post page
    function allPost(){
        return view('admin.post.allPost');
    }

    //display add post page
    function addPost(){
        return view('admin.post.addPost');
    }

    //display all category page
    function allCategory(){
        return view('admin.post.allCategory');
    }

    function getAllCategory(){
        $category = Category::all();
        return json_encode($category);
    }

    /**
     * @param $id
     * Get one category by their ID
     */
    function getOneCategory($id){
        $category = Category::find($id);
        return json_encode($category);
    }

    /**
     * Update category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function updateCategory(Request $request){
        $validator = Validator::make($request->all(),[
            'category' => 'required|min:3',
            'slug' => 'required|unique:categories,category,'.$request->id
        ]);
        $arr = [];
        if($validator->passes()){
            $arr = ['status' => true];
            $cat = Category::find($request->id);
            $cat->category = $request->category;
            $cat->slug = $request->slug;
            $cat->save();
        }else if($validator->fails()){
            $arr = $validator->messages();
        }
        return response()->json($arr);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * To add category
     */
    function addCategory(Request $request){
        $validator = Validator::make($request->all(),[
            'category' => 'required|min:3',
            'slug' => 'required|unique:categories'
        ]);

        $arr = [];
        if($validator->passes()){
            $arr = ['status' => true];
            $cat = new Category();
            $cat->category = $request->category;
            $cat->slug = $request->slug;
            $cat->save();
        }else if($validator->fails()){
            $arr = $validator->messages();
        }
        return response()->json($arr);
    }

    function deleteCategory(Request $request){
        $arr = ['status' => false];
        $cat = Category::find($request->id);
        $res = $cat->delete();
        if($res == true){
            $arr['status'] = true;
            $arr['message'] = $cat->category . ' has deleted.';
        }else{
            $arr['message'] = 'Can not delete ' . $cat->category. '!';
        }
        return response()->json($arr);
    }
}
