@extends('layouts.app')

@section('content')
<h1 class="text-center my-1">Widgets Manager</h1>

<div class="container mt-5 bg-light">
    @php if (isset($widgets) && isset($widgets[0])): @endphp
        <table class="table" id="widgets-dt">
            <thead>
                @php $keys = array_keys($widgets[0]); @endphp
                @php foreach ($keys as $key): @endphp
                    <th>@php echo $key; @endphp</th>
                @php endforeach; @endphp
            </thead>
            <tbody>
                @php foreach ($widgets as $widget): @endphp
                    <tr>
                        @php foreach ($widget as $prop): @endphp
                            <td>@php echo $prop; @endphp</td>
                        @php endforeach; @endphp
                    </tr>
                @php endforeach; @endphp
            </tbody>
        </table>
    @php endif; @endphp
</div>
@endsection

@push('sscripts')
<script>
    $(document).ready(function(){
        $('#widgets-dt').DataTable();
    });
</script>
@endpush
