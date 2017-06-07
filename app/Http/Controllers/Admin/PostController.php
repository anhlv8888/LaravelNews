<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
class PostController extends Controller
{
    public function index(Request $request){
    	// 1. Get all cates
    	$cates = Category::all();

        // 2. Get list name
        $nameList = get_options($cates);
        
        for ($i = 0; $i < count($cates); $i++) {
            foreach ($nameList as $key => $value) {
                if("x".$cates[$i]->id == $key){
                    $cates[$i]->name = $value;
                }
            }
        }
        if(!$request->has('keyword') && !$request->has('cate')){

            $posts = Post::paginate(DEFAULT_PAGE_SIZE);
        }else{
            $customUrl = "";
            if($request->has('keyword')){
                $keyword = $request->input('keyword');
                $query = Post::where('title', 'like', "%$keyword%");
                $customUrl .= '?keyword=' . $keyword;
            }

            if($request->has('cate')){
                $cateId = $request->input('cate');
                if(!isset($query)){
                    $query = Post::where('cate_id', $cateId);
                    $customUrl .= "?";
                }else{
                    $query->where('cate_id', $cateId);
                    $customUrl .= "&";
                }
                $customUrl .= 'cate=' . $cateId;
            }

            $posts = $query->paginate(2);
            $posts->withPath($customUrl);

        }

        $searchCateId = $request->input('cate');
        $searchKeyword = $request->input('keyword');
        return view('admin.posts.index', compact('cates', 'posts', 'searchCateId', 'searchKeyword'));
    }
    public function create(){
        // 1. Create new model
    	$model = new Post();
    	
    	// 2. Get all category to set parent id of new category
    	$cates = Category::all();
        $nameList = get_options($cates);
        
        for ($i = 0; $i < count($cates); $i++) {
            foreach ($nameList as $key => $value) {
                if("x".$cates[$i]->id == $key){
                    $cates[$i]->name = $value;
                }
            }
        }

    	// 3. Generate view form
    	return view('admin.posts.form', compact('model', 'cates'));
    }
    public function save(Request $request){
        dd($request->all());
    }
}
