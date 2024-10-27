@extends('layouts.livewire-index')

@section('content')
    <div class="card">

        <div class="card-body">
            <livewire:branch.branch-show :branch="$branch" />
        </div>
    </div>

    {{--  --}}

    <div class="card">

        <div class="card-header">
            <h4>{{ __('global.departments') }} </h4>
        </div>


        <div class="card-body">
            <livewire:department.department-index :the_branch="$branch" />
        </div>
    </div>
@endsection

@section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-branch-modal').modal('hide');
                $('#update-branch-modal').modal('hide');
            });
        });
    </script>
@endsection
