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

    /**
     * display all post page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function allPost(){
        return view('admin.post.allPost');
    }

    /**
     * display add post page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function addPost(){
        return view('admin.post.addPost');
    }

    /**
     * display all category page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function allCategory(){
        return view('admin.post.allCategory');
    }

    /**
     * display all category page
     * @return false|string
     */
//    function getAllCategory(){
//        $category = Category::all()->except(1);
//
//        return response()->json($category);
//    }

    /**
     * @param $id
     * Get one category by their ID
     */
    function getOneCategory($id){
        $category = Category::find($id);
        return response()->json($category);
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
            $cat->parent_id = $request->parent;
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
            $cat->parent_id = $request->parent;
            $cat->save();
        }else if($validator->fails()){
            $arr = $validator->messages();
        }
        return response()->json($arr);
    }

    /**
     * Delete category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function deleteCategory(Request $request){
        $arr = ['status' => false];
        $cat = Category::find($request->id);
        $find_sub_cat = Category::where('parent_id', $request->id)->get();

        //To clear sub category
        foreach ($find_sub_cat as $value){
            $sub_cat = Category::find($value->id);
            $sub_cat->parent_id = 0;
            $sub_cat->save();
        }
        $res = $cat->delete();
        if($res == true){
            $arr['status'] = true;
            $arr['message'] = $cat->category . ' has been deleted.';
        }else{
            $arr['message'] = 'Can not delete ' . $cat->category. '!';
        }
        return response()->json($arr);
    }

    function categoryTree( &$option,$id, $parent_id = 0, $sub_mark = ''){
        $cat = Category::where('parent_id', $parent_id)->where('id', '!=', $id)->orderBy('id')->get();
        foreach ($cat as $value){
            $option .= '<option value="'. $value->id .'">'. $sub_mark.$value->category .'</option>';
            $this->categoryTree($option, $id, $value->id, $sub_mark.'---');
        }
    }

    function fillCatSelect($id){
        $option = '<option value="0">None</option>';
        $this->categoryTree($option,$id);
        $arr = ['option' => $option];
        return response()->json($arr);
    }

    function getAllCategory(){
        $cats = Category::where('parent_id',0)->get();
        $categories = [];
        foreach ($cats as $cat){
            $categories[] = [
              'category' => $cat->category,
                'slug' => $cat->slug,
                'created_at' => $cat->created_at->format('d/m/Y'),
                'updated_at' => $cat->updated_at->format('d/m/Y'),
                '_children' => $this->sub_category($cat->id),
                'btn_update' => '<button id="btn_update" class="button-small" title="Update"><span id="'.$cat->id.'" class="glyphicon glyphicon-edit"></span></button>',
                'btn_delete' => '<button id="btn_delete" class="button-small-danger" title="Delete"><span id="'.$cat->id.'" class="glyphicon glyphicon-trash"></span></button>'
            ];
        }
        for($i=0;$i < count($categories); $i++){
            if(empty($categories[$i]['_children'])){
                unset($categories[$i]['_children']);
            }
        }
        return response()->json($categories);
    }
    function sub_category($id){
        $cats = Category::where('parent_id',$id)->get();
        $categories = [];
        foreach ($cats as $cat){
            $categories[] = [
                'category' => $cat->category,
                'slug' => $cat->slug,
                'created_at' => $cat->created_at->format('d/m/Y'),
                'updated_at' => $cat->updated_at->format('d/m/Y'),
                '_children' => $this->sub_category($cat->id),
                'btn_update' => '<button id="btn_update" class="button-small" title="Update"><span id="'.$cat->id.'" class="glyphicon glyphicon-edit"></span></button>',
                'btn_delete' => '<button id="btn_delete" class="button-small-danger" title="Delete"><span id="'.$cat->id.'" class="glyphicon glyphicon-trash"></span></button>'
            ];
        }

        for($i=0;$i < count($categories); $i++){
            if(empty($categories[$i]['_children'])){
                unset($categories[$i]['_children']);
            }
        }
        return $categories;
    }
    //For Test
    function viewTest(){
        return view('admin.post.test');
    }

    function testTree( &$tr,$parent_id = 0, $level = 0){
        $cat = Category::where('parent_id', $parent_id)->get();
        foreach ($cat as $value){
            $tr .= '<tr>
                           <td><span class="level-'. $level .'"></span>'. $value->id .'</td>
                           <td><span class="level-'. $level .'"></span>'. $value->category .'</td>
                           <td><span class="level-'. $level .'"></span>'. $value->slug .'</td>
                           <td><span class="level-'. $level .'"></span>'. $value->created_at .'</td>
                       </tr>';
            $this->testTree($tr, $value->id, $level + 1);
        }
    }

    function test(){
        $table = '<table id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>';
        $tr = '';
        $this->testTree($tr);
        $table.= $tr;
        $table .= '</tbody>';
        $table .= '</table>';
        return response()->json($table);
    }
}
