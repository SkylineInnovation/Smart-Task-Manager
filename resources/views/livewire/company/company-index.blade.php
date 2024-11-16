<div>

    @include('livewire.company.company-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($companies->currentPage() - 1) * $perPage;
    @endphp

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td>

                    {{-- 
                        @if ($admin_view_status != 'deleted')
                            <td style="width: 75px"> {{ __('global.select') }} </td>
                        @endif
                    --}}

                    @if ($showColumn['id'])
                        <td>{{ __('global.id') }}</td>
                    @endif

                    @if ($showColumn['slug'])
                        <td>{{ __('global.slug') }}</td>
                    @endif


                    @if ($showColumn['name'])
                        <td>{{ __('company.name') }}</td>
                    @endif

                    @if ($showColumn['address'])
                        <td>{{ __('company.address') }}</td>
                    @endif

                    @if ($showColumn['phone'])
                        <td>{{ __('company.phone') }}</td>
                    @endif

                    @if ($showColumn['number'])
                        <td>{{ __('company.number') }}</td>
                    @endif

                    @if ($showColumn['fax'])
                        <td>{{ __('company.fax') }}</td>
                    @endif

                    @if ($showColumn['email'])
                        <td>{{ __('company.email') }}</td>
                    @endif

                    @if ($showColumn['website'])
                        <td>{{ __('company.website') }}</td>
                    @endif

                    @if ($showColumn['commercial_register'])
                        <td>{{ __('company.commercial_register') }}</td>
                    @endif

                    @if ($showColumn['technical_director_id'])
                        <td>{{ __('company.technical_director') }}</td>
                    @endif

                    @if ($showColumn['financial_director_id'])
                        <td>{{ __('company.financial_director') }}</td>
                    @endif

                    @if ($showColumn['logo'])
                        <td>{{ __('company.logo') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-company|delete-company|restore-company')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedCompanies.{{ $company->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $company->id }}" id="company-{{ $company->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $company->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $company->slug }} </td>
                        @endif


                        @if ($showColumn['name'])
                            <td> {{ $company->name }} </td>
                        @endif

                        @if ($showColumn['address'])
                            <td> {{ $company->address }} </td>
                        @endif

                        @if ($showColumn['phone'])
                            <td> {{ $company->phone }} </td>
                        @endif

                        @if ($showColumn['number'])
                            <td> {{ $company->number }} </td>
                        @endif

                        @if ($showColumn['fax'])
                            <td> {{ $company->fax }} </td>
                        @endif

                        @if ($showColumn['email'])
                            <td> {{ $company->email }} </td>
                        @endif

                        @if ($showColumn['website'])
                            <td> {{ $company->website }} </td>
                        @endif

                        @if ($showColumn['commercial_register'])
                            <td> {{ $company->commercial_register }} </td>
                        @endif

                        @if ($showColumn['technical_director_id'])
                            <td>
                                @if ($company->technical_director)
                                    {{ $company->technical_director->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['financial_director_id'])
                            <td>
                                @if ($company->financial_director)
                                    {{ $company->financial_director->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['logo'])
                            <td>
                                @if ($company->logo)
                                    <img src='{{ asset($company->logo) }}' width='75px' height='75px'>
                                @else
                                    <p>{{ __('company.logo') }}</p>
                                @endif
                            </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($company->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($company->created_at)) }} </td>
                        @endif

                        @permission('edit-company|delete-company|restore-company')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-company')
                                        <button data-toggle="modal" data-target="#update-company-modal"
                                            wire:click="edit({{ $company->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-company')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-company-{{ $company->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-company-{{ $company->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-company-{{ $company->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-company-{{ $company->id }}-title">
                                                            {{ $company->crud_name() }}
                                                        </h5>
                                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2>{{ __('global.confirm-delete') }} ?</h2>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary close-btn"
                                                            data-dismiss="modal">
                                                            {{ __('global.close') }}
                                                        </button>

                                                        <button wire:click="delete({{ $company->id }})" class="btn btn-danger"
                                                            data-dismiss="modal">
                                                            {{ __('global.delete') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                @endif

                                @if ($admin_view_status == 'deleted')
                                    @permission('restore-company')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-company-{{ $company->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-company-{{ $company->id }}"
                                            aria-labelledby="restore-company-{{ $company->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="restore-company-{{ $company->id }}-title">
                                                            {{ $company->crud_name() }}
                                                        </h5>
                                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2>{{ __('global.confirm-restore') }} ?</h2>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary close-btn"
                                                            data-dismiss="modal">
                                                            {{ __('global.close') }}
                                                        </button>

                                                        <button wire:click="restore({{ $company->id }})"
                                                            class="btn btn-danger" data-dismiss="modal">
                                                            {{ __('global.restore') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                @endif

                            </td>
                        @endpermission
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $companies->links() }}
    </div>
</div>
