@extends('layouts.admin_layout')

@section('css')

@endsection

@section('content')
<div>
    <div>
        <form action="/admin/announcement" method="post">
            @csrf
            <table>
                <tr>
                    <th>メール送信先</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>パスワード</th>
                    <th>パスワード</th>
                    <th>イメージ画像</th>
                    <th>郵便番号</th>
                    <th>住所</th>
                    <th>建物名</th>
                    <th>削除</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>
                        <input type="checkbox" name="selected_users[]" value="{{ $user->id }}">
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->password }}
                    </td>
                    <td>
                        {{ $user->user_image }}
                    </td>
                    <td>
                        {{ $user->post_code }}
                    </td>
                    <td>
                        {{ $user->address }}
                    </td>
                    <td>
                        {{ $user->building }}
                    </td>
                    <td>
                        <form action="/admin/user/delete" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div>
                                <button type="submit">削除</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach  
            </table>
            <div>
                <button type="submit">アナウンスメール送信画面</button>
            </div>
        </form>
    </div>
</div>
@endsection