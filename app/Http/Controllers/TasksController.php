<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 別の名前空間のファイルを参照する
use App\Task;

class TasksController extends Controller
{
    
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $task = $user->task()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'task' => $task,
                ];
        }
        
        return view('welcome', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = \App\Task::find($id);
        
        if(\Auth::id() === $task->user_id) {
        
        $task = new Task;
        
        return view('tasks.create', [
            'task' => $task,
            ]);
        }
        
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = \App\Task::find($id);
        
        if(\Auth::id() === $task->user_id) {
            
        $this->validate($request, [
            'content' => 'required|max:10',
            'status' => 'required|max:10', // 追加
        ]);
        
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status; // 追加
        $task->user_id = $request->user()->id; // $request->user()で現在ログインしているユーザーのモデルインスタンスを取得し、->idでそのユーザーのIDを取得している
        $task->save();
        
        }
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = \App\Task::find($id);
        
        if(\Auth::id() === $task->user_id) {

        return view('tasks.show', [
            'task' => $task,
            ]);
        }
        
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = \App\Task::find($id);
        
        if(\Auth::id() === $task->user_id) {
        return view('tasks.edit', [
            'task' => $task,
            ]);
        }
        
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|max:10',
            'status' => 'required|max:10', // 追加
        ]);
        
        $task = \App\Task::find($id);
        
        if(\Auth::id() === $task->user_id) {
            $task->content = $request->content;
            $task->status = $request->status; //追加
            $task->save();
        }
            
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = \App\Task::find($id);
        
        // ユーザーIDが一致していなければ、削除できない
        if(\Auth::id() === $task->user_id) {
            $task->delete();
        }
        
        return redirect('/');
    }
}
