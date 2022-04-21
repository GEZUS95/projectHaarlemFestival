@if(!empty(\Matrix\Managers\SessionManager::getSessionManager()->has("validation_errors")))

    <style>

        .errors-container {
            display: flex;
            position: absolute;
            width: 100%;
            justify-content: center;
            align-items: flex-start;
        }

        .errors-container-modal {
            margin-top: 50px;
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .errors-container {
            -moz-animation: cssAnimation 0s ease-in 10s forwards;
            /* Firefox */
            -webkit-animation: cssAnimation 0s ease-in 10s forwards;
            /* Safari and Chrome */
            -o-animation: cssAnimation 0s ease-in 10s forwards;
            /* Opera */
            animation: cssAnimation 0s ease-in 10s forwards;
            -webkit-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
        }

        @keyframes cssAnimation {
            to {
                width: 0;
                height: 0;
                overflow: hidden;
            }
        }

        @-webkit-keyframes cssAnimation {
            to {
                width: 0;
                height: 0;
                visibility: hidden;
            }
        }
    </style>

    <div class="errors-container">
        <div class="errors-container-modal">
            <div></div>

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
    </div>
@endif