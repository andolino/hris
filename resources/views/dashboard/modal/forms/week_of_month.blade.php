<div class="form-group">
  <label>Payroll Date:</label>
  <div class="form-group">
    <select class="custom-select form-control-border payroll_date" id="monthData">
        <option value="" hidden selected>Select Date</option>
        @foreach ($saturdays as $item)
          <option value="{{ $item->format('Y-m-d') }}">{{ $item->format('Y-m-d') }}</option>
        @endforeach
    </select>
</div>
</div>
<div class="form-group">
  <label>CSV File:</label>
  <input type="file" name="import_file"/>
</div>