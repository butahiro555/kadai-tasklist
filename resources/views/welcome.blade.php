@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
                <h1>タスク管理一覧</h1>
                @if (count($task) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>番号</th>
                            <th>ユーザーID</th>
                            <th>タスク内容</th>
                            <th>ステータス</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($task as $task)
                        <tr>
                            <td>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}</td>
                            <td>{{ $task->user_id }}</td>
                            <td>{{ $task->content }}</td>
                            <td>{{ $task->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'btn btn-primary']) !!}
    @else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>タスク管理アプリへようこそ！</h1>
            <p>※機能を利用するにはログインが必要です。</p>
        {!! link_to_route('signup.get', 'アカウントがない場合はこちら', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
    @endif
@endsection