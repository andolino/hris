<table id="tbl-payroll" class="display nowrap table table-striped table-bordered table-sm" data-type="1" data-csrf="{{ csrf_token() }}" width="100%">
  <thead>
      <tr id="week_header">
        @for ($i = 0; $i < count($column); $i++)
          <th class="">
              <small class="font-weight-bold">
                  {{ $column[$i] }}
              </small>
          </th>
        @endfor
      </tr>
  </thead>
  <tbody>
  </tbody>
</table>

