@extends('dashboard.layouts')
@section('emp-active')
{{ 'active' }}
@endsection
@section('emp-menu-open')
{{ 'menu-open' }}
@endsection
@push('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('css/all.min.css')}} ">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css?random=') . mt_rand() }}">
@endpush
@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-dark">
                <div class="btn-group" role="group" aria-label="Basic example">
                    {{-- data-toggle="modal" data-target="#emp_form" --}}
                    <button type="button" class="btn btn-secondary" title="Add Department" data-form="mod_leave_req_form" data-type="leave-request-form" id="show_form"><i class="fa-solid fa-plus"></i></button>
                    {{-- <button type="button" class="btn btn-secondary" title="Salary" data-form="mod_salary_form" data-type="salary-form" id="show_form"><i class="fa-solid fa-coins"></i></button>
                    <button type="button" class="btn btn-secondary" title="Leave"><i class="fa-solid fa-business-time"></i></i></button>
                    <button type="button" class="btn btn-secondary" title="Loan"><i class="fa-solid fa-comment-dollar"></i></button> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <table id="tbl-ot-leave-request" class="display nowrap table table-striped table-bordered table-sm" data-csrf="{{ csrf_token() }}" width="100%">
                        <thead>
                            <tr>
                                <th class="">
                                    <small class="font-weight-bold">
                                        NAME
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        TYPE
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        TRANSACTION DATE
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        DATE FROM
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        DATE END
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        NO OF DAYS
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        NO OF HOURS
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        ACTION
                                    </small>
                                </th>
                                {{-- <th class="">
                                    <small class="font-weight-bold">
                                        CREDIT USED
                                    </small>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                          {{-- @forelse ($department as $item)
                                <tr>
                                    <td class="text-center">{{ $item->id }}</td>
                                    <td class="">{{ $item->title }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" class="text-primary" data-form="mod_dep_form" data-value="{{ $item->id }}" data-type="department-form" id="show_form"><i class="fa-solid fa-eye"></i></a>
                                        <a href="#" class="text-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                          @endforelse --}}
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.modal.leave_request_mod')
@endsection

@push('script')

<script src="{{ asset('js/dtr.js') }}"></script>
<script src="{{ asset('js/otRequest.js') }}"></script>
<script>
    
</script>
@endpush