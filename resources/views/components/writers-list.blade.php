@if ($writers->count() > 0)
    @foreach ($writers as $writer)
        <x-writers-list-item :writer="$writer" />
    @endforeach
@else
    <x-no-result />
@endif