@extends('layouts.admin_layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_user.css') }}">
@endsection

@section('content')
<div class="user-list">
    <div class="user-list__header">
        <h1 class="user-list__title">ユーザー一覧</h1>
    </div>
    <div class="user-list__table-container">
        <form action="/admin/announcement" method="post">
            @csrf
            <table class="user-list__table">
                <thead class="user-list__table-head">
                    <tr class="user-list__table-row">
                        <th class="user-list__table-heading">メール送信先</th>
                        <th class="user-list__table-heading">ユーザー名</th>
                        <th class="user-list__table-heading">メールアドレス</th>
                        <th class="user-list__table-heading">パスワード</th>
                        <th class="user-list__table-heading">イメージ画像</th>
                        <th class="user-list__table-heading">郵便番号</th>
                        <th class="user-list__table-heading">住所</th>
                        <th class="user-list__table-heading">建物名</th>
                        <th class="user-list__table-heading">削除</th>
                    </tr>
                </thead>
                <tbody class="user-list__table-body">
                    @foreach($users as $user)
                    <tr class="user-list__table-row">
                        <td class="user-list__table-heading">
                            <input type="checkbox" name="selected_users[]" value="{{ $user->id }}">
                        </td>
                        <td class="user-list__table-cell">
                            {{ $user->name }}
                        </td>
                        <td class="user-list__table-cell">
                            {{ $user->email }}
                        </td>
                        <td class="user-list__table-cell">
                            {{ $user->password }}
                        </td>
                        <td class="user-list__table-cell">
                            {{ $user->user_image }}
                        </td>
                        <td class="user-list__table-cell">
                            {{ $user->post_code }}
                        </td>
                        <td class="user-list__table-cell">
                            {{ $user->address }}
                        </td>
                        <td class="user-list__table-cell">
                            {{ $user->building }}
                        </td>
                        <td class="user-list__table-cell">
                            <form action="/admin/user/delete" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="user-list__button-container">
                                    <button class="user-list__button user-list__button--delete" type="submit">削除</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
            <div class="user-list__button-container">
                <button class="user-list__button user-list__button--send" type="submit">アナウンスメール送信画面</button>
            </div>
        </form>
    </div>
</div>
@endsection