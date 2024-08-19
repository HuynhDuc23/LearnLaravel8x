<h1>This is blade</h1>
@if (!empty($dataArr))
    @foreach ($dataArr as $item)
        <h1> @{{ $item }}</h1>
        {{-- Chan không cho phép blade render ra data --}}
    @endforeach
@endif

<h2>{!! !empty($message) ? $message : '' !!}</h2>

<h2>{{ request()->key }}</h2>

@for ($i = 0; $i <= 10; $i++)
    <h1>{{ $i }}</h1>
@endfor

@foreach ($dataArr as $key => $item)
    <h1> {{ $item }} - {{ $key }}</h1>
@endforeach

@if ($check)
    <div>{{ $check }}</div>
@endif

@if ($check == false)
    <div>{{ $check }}</div>
@else
    <div>{{ $check }}</div>
@endif

@forelse ($dataArr as $item)
    <h1>{{ $item }}</h1>
@empty
    <h1>Data is empty</h1>
@endforelse

@while ($index < 10)
    <h1>{{ $index }}</h1>
    @php
        $index++;
    @endphp
@endwhile
