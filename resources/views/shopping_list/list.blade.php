@extends('layout')

{{-- タイトル --}}
@section('title')(詳細画面)@endsection

{{-- メインコンテンツ --}}
@section('contets')
        <h1>買い物の登録</h1>
            @if (session('front.shopping_list_register_success') == true)
                買い物を登録しました！！<br>
            @endif
            @if (session('front.shopping_list_delete_success') == true)
                買い物を削除しました！！<br>
            @endif
            @if (session('front.shopping_list_completed_success') == true)
                買い物を完了にしました！！<br>
            @endif
            @if (session('front.shopping_list_completed_failure') == true)
                買い物の完了に失敗しました....<br>
            @endif
            @if ($errors->any())
                <div>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                </div>
            @endif
            <form action="/shopping_list/register" method="post">
                @csrf
                買い物名:<input name="name" value="{{ old('name') }}"><br>
                
                
                <button>買い物を登録する</button>
            </form>

        <h1>買い物の一覧</h1>
         <a href="/completed_list/list">購入済み「買うもの」一覧</a><br>
         
        <table border="1">
        <tr>
            <th>登録日
            <th>買うもの
           
@foreach ($list as $shoppinglist)
        <tr>
            <td>{{ $shoppinglist->created_at }}
            <td>{{ $shoppinglist->name }}
            <td><form action="{{ route('complete', ['shopping_list_id' => $shoppinglist->id]) }}" method="post"> @csrf <button onclick='return confirm("この「買うもの」を「完了」にします。よろしいですか？");' >完了</button></form>
            <td>
          
         <td><form action="{{ route('delete', ['shopping_list_id' => $shoppinglist->id]) }}" method="post"> @csrf @method("DELETE") <button onclick='return confirm("この「買うもの」を「削除」にします。よろしいですか？");' >削除</button></form>

@endforeach
        </table>
        <!-- ページネーション -->
        {{-- {{ $list->links() }} --}}
        現在 {{ $list->currentPage() }} ページ目<br>
        @if ($list->onFirstPage() === false)
            <a href="/shopping_list/list">最初のページ</a>
        @else
            最初のページ
        @endif
        /
        @if ($list->previousPageUrl() !== null)
            <a href="{{ $list->previousPageUrl() }}">前に戻る</a>
        @else
            前に戻る
        @endif
        /
        @if ($list->nextPageUrl() !== null)
            <a href="{{ $list->nextPageUrl() }}">次に進む</a>
        @else
            次に進む
        @endif
        <br>
        <hr>
        <menu label="リンク">
        <a href="/logout">ログアウト</a><br>
        </menu>
@endsection