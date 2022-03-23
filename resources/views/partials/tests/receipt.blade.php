@extends('layout.main')
@section('content')
    <section class="partials-restaurant-index-header">
        <h1 class="partials-restaurant-index-header-text">Haarlem Festival Receipt</h1>
    </section>


    <?php var_dump($receipt);?>



    @foreach($receipt->item as $item)
        {{$item}}
    @endforeach

@endsection

