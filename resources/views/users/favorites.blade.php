@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="col-sm-8">
            {{-- タブ --}}
            @include('users.navtabs')
            @if (count($favorites) > 0)
                <ul class="list-unstyled">
                    @foreach ($favorites as $favorite)
                        <li class="media">
                            {{-- ユーザのメールアドレスを元にGravatarを取得して表示 --}}
                            <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                            <div class="media-body">
                                <div>
                                    {{ $favorite->id }}
                                </div>
                                <div>
                                    {{-- ユーザ詳細ページへのリンク --}}
                                    <p>{{ $favorite->content }}</p>
                                </div>    
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{-- ページネーションのリンク --}}
                {{ $users->links() }}
            @endif
        </div>
    </div>
@endsection