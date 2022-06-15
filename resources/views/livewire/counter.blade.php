<div>

    <div>
        <h2>ユーザ一覧</h2>
        <ul>
            @foreach($users as $user)
            <li>
                {{ $user->name }} <button wire:click="delUser({{ $user->id }})">削除</button>
            </li>
            @endforeach
        </ul>
    </div>

    <h2>{{ $count }}</h2>
    <p><button wire:click="increment">+1</button></p>

    <hr>

    <p>debounce 500ms</p>
    <input
           type="text"
           wire:model.debounce.500ms="message">

    <hr>

    <p>lazy</p>
    <input
           type="text"
           wire:model.lazy="message">

    @if(!$message)
    <p style="color:red;font-weight:bold">文字を入力してください。</p>
    @else
    <p>文字を入力しました。</p>
    @endif

    {{ $message }}
</div>