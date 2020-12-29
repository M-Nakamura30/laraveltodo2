<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
	//$idを受け取って
	//フォルダとそれに基づくタスクを取得する
    public function index(int $id)
    {
    	//全てのフォルダを取得する
    	$folders = Folder::all();

    	//選ばれたフォルダを取得
    	$current_folder = Folder::find($id);

    	//選ばれたフォルダに紐づくタスクを取得
    	//フォルダIDに基づくを取得
    	//第一引数がカラム名。第二引数が比較する値
    	//外部キー
    	// $tasks = Task::where('folder_id', $current_folder->id)->get();
    	//Tasks::where('folder_id', '=', $current_folder->id)->get();
    	$tasks = $current_folder->tasks()->get();

    	//フォルダ、フォルダID、タスクをviewに渡す
    	return view('tasks/index', [
    		'folders' => $folders,
    		//フォルダ名を色分けして判断するためのもの
    		//ルーティングで定義したカッコと同じもの
    		'current_folder_id' => $current_folder->id,
    		'tasks' => $tasks,
    	]);
    }
}