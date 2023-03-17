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
                    <button type="button" class="btn btn-secondary" title="Add Loans" data-form="mod_loans_form" data-type="loans-form" id="show_form"><i class="fa-solid fa-plus"></i></button>
                    {{-- <button type="button" class="btn btn-secondary" title="Salary" data-form="mod_salary_form" data-type="salary-form" id="show_form"><i class="fa-solid fa-coins"></i></button>
                    <button type="button" class="btn btn-secondary" title="Leave"><i class="fa-solid fa-business-time"></i></i></button>
                    <button type="button" class="btn btn-secondary" title="Loan"><i class="fa-solid fa-comment-dollar"></i></button> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <table id="tbl-payroll" class="display nowrap table table-striped table-bordered table-sm" data-type="2" data-csrf="{{ csrf_token() }}" width="100%">
                        <thead>
                            <tr>
                                <th class="">
                                    <small class="font-weight-bold">
                                        NAME
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        BASIC RATE
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        DAYS WORKED
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        OVERTIME
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        SICK LEAVE
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        VACATION LEAVE
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        ALLOWANCE
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        REGULAR HOLIDAY
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        SPECIAL HOLIDAY
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        SUBSIDY
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        LATE
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        UNDERTIME
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        TOTAL DEDUCTION
                                    </small>
                                </th>
                                <th class="">
                                    <small class="font-weight-bold">
                                        ACTION
                                    </small>
                                </th>
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
@include('dashboard.modal.payroll_payslip')
@include('dashboard.modal.post_payroll')
@endsection

@push('script')

<script src="{{ asset('js/payroll.js') }}"></script>
<script>
    
</script>
@endpush