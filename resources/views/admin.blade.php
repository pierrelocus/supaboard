@extends('layouts.app')

@section('content')
<h1 class="text-center my-1">Widgets Manager</h1>

<div class="container mt-5 bg-light">
    <?php if (isset($widgets) && isset($widgets[0])): ?>
        <table class="table" id="widgets-dt">
            <thead>
                <?php $keys = array_keys($widgets[0]); ?>
                <?php foreach ($keys as $key): ?>
                    <th><?php echo $key; ?></th>
                <?php endforeach; ?>
            </thead>
            <tbody>
                <?php foreach ($widgets as $widget): ?>
                    <tr>
                        <?php foreach ($widget as $prop): ?>
                            <td><?php echo $prop; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#widgets-dt').DataTable();
    });
</script>
@endsection
