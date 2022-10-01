<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\models\Post;

use App\models\Reply;

class HomeController extends Controller
{

    public function index()
    {
        return view('home.index');
    }

    public function redirect()
    {

        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $post = post::all();
            $reply = reply::all();
            return view('user.home', compact('post', 'user_id', 'reply'));
        } else {

            return view('dashboard');
        }
    }

    public function post_message(Request $request)
    {

        $post = new Post();
        $post->status = $request->message;
        $post->postBy = Auth::user()->id;
        $post->postByName = Auth::user()->name;
        $request->validate([
            'image' => 'required',
        ]);
        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('picture', $imagename);
        $post->image = $imagename;

        $post->save();

        return redirect('/redirect');
    }

    public function post_delete($id)
    {
        $user_id = Auth::user()->id;
        $post = post::find($id);
        if ($user_id != $post->postBy) {
        } else {

            $post->delete();
        }

        return redirect('/redirect');
    }

    public function post_edit_show(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $post = post::find($id);

        if ($user_id != $post->postBy) {

            return redirect('/redirect');
        } else {

            return view('user.edit', compact('post'));
        }
    }

    public function post_edit(Request $request, $id)
    {
        $post = post::find($id);

        $post->status = $request->message;
        $image = $request->image;

        if ($image) {

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('picture', $imagename);
            $post->image = $imagename;
        }
        $post->save();

        return redirect('/redirect');
    }

    public function post_search(Request $request)
    {
        $search_text = $request->search;
        $post = post::where('status', 'LIKE', "%$search_text%")->orWhere('postByName', 'LIKE', "$search_text")->get();
        return view('user.post_search', compact('post'));
    }

    public function my_post_list()
    {
        $user_id = Auth::user()->id;
        $post = post::where('postBy', '=', $user_id)->get();
        $reply = reply::all();
        return view('user.my_post_list', compact('post', 'reply'));
    }

    public function post_reply(Request $request)
    {
        $reply = new Reply;
        $reply->name = Auth::user()->name;
        $reply->message_id = $request->replyId;
        $reply->reply = $request->reply;
        $reply->user_id = Auth::user()->id;

        $reply->save();

        return redirect('/redirect');

    }
}
