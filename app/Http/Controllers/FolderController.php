<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // Laravel がリクエストの情報を Request クラスのインスタンス $request に詰めて引数として渡してくれる
    //Request クラスのインスタンスにはリクエストヘッダや送信元IPなどいろいろな情報が含まれていますが、その中にフォームの入力値も入っている。

    //引数にインポートしたCreateFolderクラスを受け入れる
    //FormRequest クラスはRequest クラスと互換性がある。
    public function create(CreateFolder $request)
    {
    	//フォルダモデルのインスタンスを作成
    	$folder = new Folder();

    	//タイトルに入力値を代入する
    	$folder->title = $request->title;

    	$folder->save();

    	return redirect()->route('tasks.index', [
    		'id' => $folder->id,
    	]);
    }
}
