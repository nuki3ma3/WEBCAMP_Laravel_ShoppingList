@extends('admin.layout')

{{-- メインコンテンツ --}}
@section('contets')
        <h1>ユーザ一覧</h1>
        <table border="1">
        <tr>
            <th>ユーザID
            <th>ユーザ名
            <th>購入した買うものの数
@foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}
            <td>{{ $user->name }}
            <td>{{ $user->shoppinglists_num }}
@endforeach
        </table>
@endsection
