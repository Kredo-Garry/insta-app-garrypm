<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; //represents the comments table
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id)
    {
        #validate the data first
        $request->validate(
            [
                'comment_body' . $post_id => 'required|max:150'
            ],
            [
                'comment_body' . $post_id . '.required' => 'You cannot submit an empty comment.',
                'comment_body' . $post_id . '.max' => 'Your comment must not have more than 150 characters.'
            ]
        );

        $this->comment->body = $request->input('comment_body' . $post_id);
        $this->comment->user_id = Auth::user()->id; //owner of the comment
        $this->comment->post_id = $post_id;         //id of the post being commented
        $this->comment->save();

        return redirect()->back();                  //go back to the previous page
    }

    public function destroy($id)
    {
        $this->comment->destroy($id);
        return redirect()->back();
    }
}
