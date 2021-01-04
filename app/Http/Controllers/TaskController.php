<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
	//$idを受け取って
	//フォルダとそれに基づくタスクを取得する
    public function index(int $id)
    {
    	//全てのフォルダを取得する
    	$folders = Auth::user()->folders()->get();

    	//選ばれたフォルダを取得
    	$current_folder = Folder::find($id);

    	//選ばれたフォルダに紐づくタスクを取得
    	//フォルダIDに基づくを取得
    	//第一引数がカラム名。第二引数が比較する値
    	//外部キー
    	//$tasks = Task::where('folder_id', $current_folder->id)->get();
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

    //（/folders/{id}/tasks/create）を作るためにフォルダの ID が必要なので、コントローラーメソッドの引数で受け取って view 関数でテンプレートに渡す。
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);
        //$current_folder に紐づくタスクを作成

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    /**
    * GET /folders/{id}/tasks/{task_id}/edit
    */
    //編集ページにアクセスした時に表示されているようにする
    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    //編集して登録する
    //EditTask使うためにuseでコントローラーを指定
    public function edit(int $id, int $task_id, EditTask $request)
    {
        //タスクデータを取得
        $task = Task::find($task_id);

        //保存
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        //編集対象のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}