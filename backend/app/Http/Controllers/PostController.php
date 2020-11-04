<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

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
            $tags = Tag::all();
            $posts = Post::where('title', 'like', '%'.$request->get('keyword').'%')
            ->orWhere('content', 'like', '%' . $request->get('keyword').'%')
            ->orderBy('created_at', 'desc')->paginate(5);
             if($posts->isEmpty()){
                 return view('posts.noresults' ,compact('posts','tags'));
                 return view('layouts.sidebar',compact('tags'));
             }else{
                return view('posts.index',compact('posts','tags'));
                return view('layouts.sidebar',compact('tags'));
             }
        }
        else{
            $posts = Post::orderBy('created_at', 'desc')->paginate(5);
            $tags = Tag::all();
        }
        return view('posts.index',compact('posts','tags'));
        return view('layouts.sidebar',compact('tags'));
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
    public function store(PostRequest $request)
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
        \Session::flash('flash_message','投稿成功しました。');
        return redirect(route('posts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $tags = Tag::all();
        return view('posts.show', compact('post','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $hash = '#';
        $before = [];
       foreach($post->tags as $tag){
           array_push($before, $tag->name);
       }
        return view('posts.edit', compact('post','before','hash'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
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
        \Session::flash('flash_message','編集成功しました。');
        return redirect(route('posts.index'));
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
        \Session::flash('flash_message','削除成功しました。');
        return redirect(route('posts.index'));
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

        \Session::flash('flash_message','いいねしました。');
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
