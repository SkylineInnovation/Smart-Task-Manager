@extends('layouts.livewire-index')

@section('content')
    <livewire:task.task-show :task="$task" />
@endsection

{{-- @section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-task-modal').modal('hide');
                $('#update-task-modal').modal('hide');
            });
        });
    </script>
@endsection --}}
