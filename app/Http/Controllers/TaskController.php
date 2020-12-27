<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
	//$idを受け取って
    public function index(int $id)
    {
    	//フォルダデータをデータベースから取得
    	$folders = Folder::all();

    	//$foldersでviewに渡す
    	return view('tasks/index', [
    		'folders' => $folders,
    		//フォルダ名を色分けして判断するためのもの
    		//ルーティングで定義したカッコと同じもの
    		'current_folder_id' => $id,
    	]);
    }
}