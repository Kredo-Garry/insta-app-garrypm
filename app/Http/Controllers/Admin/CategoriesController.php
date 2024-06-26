<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __construct(Category $category, Post $post){
        $this->category = $category;
        $this->post = $post;
    }

    public function index(){
        $all_categories = $this->category->orderBy('id', 'desc')->paginate(5);
        /** Same as: SELECT * FROM categories ORDER BY updated_at DESC */

        $uncategorized_count = 0;
        $all_posts = $this->post->all(); //SAME AS: SELECT * FROM posts;
        
        foreach ($all_posts as $post) {
            if ($post->categoryPost->count() == 0) { /** if this return true, then the post dont have category */
                $uncategorized_count++; //increment the count
            }
        }


        return view('admin.categories.index')
            ->with('all_categories', $all_categories)
            ->with('uncategorized_count', $uncategorized_count);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name'
        ]);

        $this->category->name = ucwords(strtolower($request->name));
        /**
         * strtolower() -> convert the word in lowercase 
         * ucwords() -> to capitalize the first letter of the word
         */
        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id){
        $request->validate(
            [
                'new_name' => 'required|min:1|max:50|unique:categories,name,' . $id
            ]
        );

        $category = $this->category->findOrFail($id);
        $category->name = ucwords(strtolower($request->new_name));
        $category->save();

        return redirect()->back();
    }

    # Activity: Admin dashboard delete button
    # 1. create the modal 
    # 2. create a method destroy
    # 3. create the route
    # 4. use the route to test if working

    public function destroy($id){
        $this->category->destroy($id);
        return redirect()->back();
    }
}
