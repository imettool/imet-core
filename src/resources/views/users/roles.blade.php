<?php
/** @var \ImetCore\Controllers\UsersController $controller */
/** @var string $role */

/** @var \Illuminate\Database\Eloquent\Collection $users_and_roles */

use \ImetCore\Models\User\Role;

?>

@extends('modular-forms::layouts.forms')

@section('content')
    @include('imet-core::users.menu')
    @include('imet-core::users.__menu', ['selected' => $role])

    <div id="users" class="module-container">

        <div class="module-header">
            <div class="module-title col-lg-12">
                {{  ucfirst(trans_choice('imet-core::users.role.'. $role, 2)) }}
            </div>
        </div>

        <div class="module-body">

            {{--  Form to update user roles --}}
            {{--  The form is submitted via the Vue component --}}
            <form method="PATCH" id="roles-form" action="{{ route('imet-core::users_update') }}">
                @method('PATCH')
                @csrf

                <input type="hidden" name="role_type" id="role_type" value="{{ $role }}"/>

                <table class="table module-table">

                    <thead>
                    <tr>
                        <th class="text-center" colspan="2">User</th>
                        @if($role!==Role::ROLE_ADMINISTRATOR)
                            <th class="text-center" colspan="2">Country</th>
                            <th class="text-center" colspan="2">WDPA</th>
                        @endif
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(record, index) in records" :key="index" class="module-table-item">
                        <!-- user selector -->
                        <td colspan="2">
                            <selector-user
                                    search-url="{{ route('imet-core::selector.users.search') }}"
                                    label-url="{{ route('imet-core::selector.users.labels') }}"
                                    v-model="record['user']"
                                    :id="'records_'+index+'_user'"
                                    data-class="field-edit"
                            ></selector-user>
                        </td>

                        @if($role!==Role::ROLE_ADMINISTRATOR)

                            <!-- Country selector -->
                            <td colspan="2">
                                <div class="mx-auto" style="max-width: 450px; min-width: 80px">
                                    <dropdown
                                            :multiple="true"
                                            data-values='@json(\ImetCore\Models\Country::selectionList())'
                                            v-model="record['role_isos']"
                                            :id="'records_'+index+'_isos'"
                                            data-class="field-edit"
                                    ></dropdown>
                                </div>
                            </td>
                            <!-- WDPA selector -->
                            <td colspan="2">
                                <selector-wdpa
                                        search-url="{{ route('imet-core::selector.pas.search') }}"
                                        label-url="{{ route('imet-core::selector.pas.labels') }}"
                                        v-model="record['role_wdpas']"
                                        :id="'records_'+index+'_wdpas'"
                                        data-class="field-edit"
                                        :multiple="true"
                                ></selector-wdpa>
                            </td>

                        @endif
                        <td colspan="1">
                            <input type="hidden"
                                   v-model="record['changed']"
                                   :id="'records_'+index+'_changed'"/>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        {{-- save action bars --}}
        @include('modular-forms::module.components.bars.save')

    </div>

@endsection



@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Roles({
            records: @json($users_and_roles),
            empty_record: {
                'role_isos': null,
                'role_wdpas': [],
                'user': null,
                changed: false
            }
        })).mount('#users');
    </script>
@endpush
