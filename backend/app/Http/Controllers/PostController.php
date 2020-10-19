<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('keyword')) {
            // SQLのlike句でitemsテーブルを検索する
            $posts = Post::where('title', 'like', '%'.$request->get('keyword').'%')
            ->orWhere('content', 'like', '%' . $request->get('keyword').'%')
            ->orderBy('created_at', 'desc')->paginate(5);
        }
        else{
            $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        }
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user_id;

        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);
       $tags = [];
       // $matchの中でも#が付いていない方を使用する(配列番号で言うと1)
       foreach($match[1] as $tag) {
           // firstOrCreateで重複を防ぎながらタグを作成している。
           $record = Tag::firstOrCreate(['name' => $tag]);
           array_push($tags, $record);
       }

       $tags_id = [];
       foreach($tags as $tag) {
           array_push($tags_id, $tag->id);
       }
        // $post->tags()->attach($request->tags);
        $post->save();
        $post->tags()->attach($tags_id);
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user_id;

        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);
        $before = [];
       foreach($post->tags as $tag){
           array_push($before, $tag->name);
       }
       $after = [];
       foreach($match[1] as $tag){
           // 普通に新しいのが来たら新規作成する動き
           $record = Tag::firstOrCreate(['name' => $tag]);
           array_push($after, $record);
       }

       $tags_id = [];
        foreach($after as $tag) {
            array_push($tags_id, $tag->id);
        }
        $post->tags()->sync($tags_id);

        $post->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/');
    }

        /**
     * 引数のIDに紐づくリプライにLIKEする
    *
    * @param $id リプライID
    * @return \Illuminate\Http\RedirectResponse
    */
    public function like($id)
    {
        Like::create([
        'post_id' => $id,
        'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    /**
     * 引数のIDに紐づくリプライにUNLIKEする
     *
     * @param $id リプライID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlike($id)
    {
        $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();

        return redirect()->back();
    }
}
