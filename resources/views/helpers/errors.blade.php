@if(!empty(\Matrix\Managers\SessionManager::getSessionManager()->has("validation_errors")))

    <div>

    @foreach(\Matrix\Managers\SessionManager::getSessionManager()->get("validation_errors") as $error)

        @if(is_array($error))
            @foreach($error as $suberr)
                <div>{{$suberr}}</div>
            @endforeach
        @else
            <div>{{$error}}</div>
        @endif
    @endforeach
    </div>
@endif