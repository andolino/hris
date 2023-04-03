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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css">
@endpush
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-dark">
                <div class="btn-group" role="group" aria-label="Basic example">
                    {{-- data-toggle="modal" data-target="#emp_form" --}}
                    {{-- <button type="button" class="btn btn-secondary" title="Add Loans" data-form="mod_loans_form" data-type="loans-form" id="show_form"><i class="fa-solid fa-plus"></i></button> --}}
                    <div class="input-group date" id="srchPayrollDate" data-type="1" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="srchPayrollDate" data-target="#srchPayrollDate" placeholder="Payroll Date"/>
                        <div class="input-group-append" data-target="#srchPayrollDate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary w-100" title="Add Loans" data-form="mod_compute_outright_form" data-type="compute-outright-ded-form" id="show_form"><i class="fa-solid fa-file-pen"></i> Compute Outright Ded</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-9" id="payroll-tbl">
                    
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.modal.payroll_payslip')
@include('dashboard.modal.post_payroll')
@include('dashboard.modal.compute_outright')
@endsection

@push('script')
<script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
<script src="{{ asset('js/payroll.js') }}"></script>

@endpush