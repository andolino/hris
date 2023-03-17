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
<link rel="stylesheet" href="{{ asset('css/custom.css?random=') . mt_rand() }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

@endpush
@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-dark">
                <div class="btn-group" role="group" aria-label="Basic example">
                    {{-- data-toggle="modal" data-target="#emp_form" --}}
                    <button type="button" class="btn btn-secondary" title="Add Employee" data-form="mod_emp_form" data-type="employee-form" id="show_form"><i class="fa-solid fa-plus"></i></button>
                    <button type="button" class="btn btn-secondary" title="Salary" data-form="mod_salary_form" data-type="salary-form" id="show_form"><i class="fa-solid fa-coins"></i></button>
                    <button type="button" class="btn btn-secondary" title="Leave"><i class="fa-solid fa-business-time"></i></i></button>
                    <button type="button" class="btn btn-secondary" title="Loan"><i class="fa-solid fa-comment-dollar"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="tbl-employees-list" class="display nowrap table table-striped table-bordered table-sm" data-employee="{{ $uri_route }}" data-csrf="{{ csrf_token() }}" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    ID CODE
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    LASTNAME
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    FIRSTNAME
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    MIDDLENAME
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    GENDER
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    CIVIL STATUS
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    DEPT.
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    ADDRESS
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    DATE OF HIRED
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    STATUS
                                </small>
                            </th>
                            <th class="text-center">
                                <small class="font-weight-bold">
                                    ACTION
                                </small>
                            </th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                       @forelse ($employee as $emp)
                            <tr>
                                <td class="text-center">{{ $emp->idcode }}</td>
                                <td class="text-center">{{ $emp->full_name }}</td>
                                <td class="text-center">{{ $emp->gender }}</td>
                                <td class="text-center">{{ $emp->civil_status }}</td>
                                <td class="text-center">{{ $emp->department }}</td>
                                <td class="text-center">{{ $emp->address }}</td>
                                <td class="text-center">{{ $emp->date_hired }}</td>
                                <td class="text-center">{{ $emp->employee_status }}</td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" class="text-primary" data-form="mod_emp_form" data-value="{{ $emp->idcode }}" data-type="employee-form-edit" id="show_form"><i class="fa-solid fa-eye"></i></a>
                                    <a href="#" class="text-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                       @empty

                       @endforelse
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>
@include('dashboard.modal.add_emp')
@include('dashboard.modal.salary')
@endsection

@push('script')

<script src="{{ asset('js/employee.js') }}"></script>
<script>
    
</script>
@endpush