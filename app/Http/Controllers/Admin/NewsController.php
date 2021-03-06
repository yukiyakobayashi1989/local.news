<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;
use App\History;
use Carbon\Carbon;
use Storage;

class NewsController extends Controller
{
  public function add()
  {
      return view('admin.news.create');
  }

  public function create(Request $request)
  {

      // Varidationを行う
      $this->validate($request, News::$rules);

      $news = new News;
      $form = $request->all();

      // formに画像があれば、保存する
      if (isset($form['image'])) {
          $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
          $news->image_path = Storage::disk('s3')->url($path);
        } else {
            $news->image_path = null;
        }

      unset($form['_token']);
      unset($form['image']);
      // データベースに保存する
      $news->fill($form);
      $news->save();

      return redirect('admin/news/create');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      $cond_maintext = $request->cond_maintext;
      if ($cond_title != '') {
          $posts = News::where('title', $cond_title)->get();
      }elseif($cond_maintext != ''){
          $posts = News::where('body', $cond_maintext)->get();
      }else {
          $posts = News::all();
      }
      $sort_cond  = '';
      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title, 'sort_cond' => $sort_cond, 'cond_maintext' => $cond_maintext]);
  }

  // 以下を追記

  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $news = News::find($request->id);
      if (empty($news)) {
        abort(404);
      }
      return view('admin.news.edit', ['news_form' => $news]);
  }


  public function update(Request $request)
    {
        $this->validate($request, News::$rules);
        $news = News::find($request->input('id'));
        $news_form = $request->all();
        if ($request->input('remove')) {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
            $news_form['image_path'] = Storage::disk('s3')->url($path);
        } else {
            $news_form['image_path'] = $news->image_path;
        }

        unset($news_form['_token']);
        unset($news_form['image']);
        unset($news_form['remove']);
        $news->fill($news_form)->save();

        // 以下を追記
        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/news/');
    }

    //ソート機能追加課題
    public function sort(Request $request)
    {
        $sort_cond = $request->sort_cond;
        if ($sort_cond == '' || $sort_cond == '昇順' ){
           $posts = News::orderBy('title','desc')->get();
           $sort_cond = '降順';
        }else{
          $posts = News::orderBy('title','asc')->get();
          $sort_cond = '昇順';
        }
        $cond_title  = '';
        $cond_maintext = '';
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title, 'sort_cond' => $sort_cond, 'cond_maintext' => $cond_maintext]);
    }
}
