@extends('layouts.app')

@section('content')
<h1>stories</h1>
<div class="row">
    @foreach ($stories as $story)
    <div class="col-md-3">
        <div class="stories">
            <div class="stories-container">
                <h3>{{ $story['title'] }}</h3>
                <p>{{ $story['description'] ?? 'Descripción no disponible' }}</p>
            </div>
            <div class="stories-image">
                @if ($story['comics']['returned'] != 0)
                <h5 style="color:red; background:white; text-align:center;">Comics in which the story appears</h5>
                <ul>
                    @foreach ($story['comics']['items'] as $comic)
                        <li style="color:black; background:white;">{{ $comic['name'] }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
<div id="pagination">
    {{ $stories->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection
