@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="card-body">
                        <img class="rounded img-fluid" src="{{ Gravatar::src(Auth::user()->email, 500) }}" alt="">
                    </div>
                </div>
            </aside>
            <div class="col-sm-8">
                <h3>タスク管理一覧</h3>
                @if (count($task) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>番号</th>
                            <th>ユーザー</th>
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
                {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        </div>
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