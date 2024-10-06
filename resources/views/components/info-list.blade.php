@php
    // Obtém os dados passados
    $data = $data ?? [];
@endphp
<div>
    @foreach($data as $label => $value)
        <div class="flex justify-between">
            <strong>{{ $label }}:</strong>
            <span>{{ $value }}</span>
        </div>
    @endforeach
</div>