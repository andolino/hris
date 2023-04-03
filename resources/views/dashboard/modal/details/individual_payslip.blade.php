<div class="card-header bg-secondary">
  <span>DETAILS</span>
</div>
<table class="table table-bordered table-hover table-fixed" id="infoTbl">
  <thead>
      <tr>
          <th>Description</th>
          <th>Days</th>
          <th>Hrs</th>
          <th>Night Diff'l.</th>
          <th>Leave Balance</th>
          <th>Debit</th>
          <th>Credit</th>
      </tr>
  </thead>
  <tbody>
      @php
          $gross = 0;
          $ded = 0;
          $net = 0;
      @endphp
      @foreach ($details as $item)
          @if ($item->description != '')
              <tr data-refno="{{ $item->ref_no }}">
                  <td>{{ $item->description }}</td>
                  <td class="text-right">{{ $item->no_of_day }}</td>
                  <td class="text-right">{{ $item->hrs }}</td>
                  <td class="text-right">{{ $item->nd_hrs }}</td>
                  <td class="text-right">{{ $item->leave_balance }}</td>
                  <td class="text-right">{{ $item->debit == '' ? '' : number_format($item->debit, 2) }}</td>
                  <td class="text-right">{{ $item->credit == '' ? '' : number_format($item->credit, 2) }}</td>
              </tr>
              @php
                  $gross += floatval(str_replace(',', '', $item->debit));
                  $ded += floatval(str_replace(',', '', $item->credit));
              @endphp
          @endif
      @endforeach

      {{-- @if (!empty($details) && $details[0]->payroll_schedule_id ==  1)
        <tr>
            <td>SSS</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @switch($details[0]->every_collect_sss)
                @case(0)
                    <td class="text-right">{{ number_format((floatval(str_replace(',', '', $deductions['sss'])) / 2), 2) }}</td>
                    @break
                @case(1)
                    <td class="text-right">{{ number_format(floatval(str_replace(',', '', $deductions['sss'])), 2) }}</td>
                    @break
                @default
                    <td class="text-right">{{ number_format(floatval(str_replace(',', '', $deductions['sss'])), 2) }}</td>
            @endswitch
        </tr>
        <tr>
            <td>Philhealth</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @switch($details[0]->every_collect_sss)
                @case(0)
                    <td class="text-right">{{ number_format((floatval(str_replace(',', '', $deductions['philhealth'])) / 2), 2) }}</td>
                    @break
                @case(1)
                    <td class="text-right">{{ number_format(floatval(str_replace(',', '', $deductions['philhealth'])), 2) }}</td>
                    @break
                @default
                    <td class="text-right">{{ number_format(floatval(str_replace(',', '', $deductions['philhealth'])), 2) }}</td>
            @endswitch
        </tr>
        <tr>
            <td>Pagibig</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @switch($details[0]->every_collect_sss)
                @case(0)
                    <td class="text-right">{{ number_format((floatval(str_replace(',', '', $deductions['pagibig'])) / 2), 2) }}</td>
                    @break
                @case(1)
                    <td class="text-right">{{ number_format(floatval(str_replace(',', '', $deductions['pagibig'])), 2) }}</td>
                    @break
                @default
                    <td class="text-right">{{ number_format(floatval(str_replace(',', '', $deductions['pagibig'])), 2) }}</td>
            @endswitch
        </tr>
        <tr>
            <td>Income TAX</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @switch($details[0]->every_collect_sss)
                @case(0)
                    <td class="text-right">{{ number_format((floatval(str_replace(',', '', $deductions['incomeTax'])) / 2), 2) }}</td>
                    @break
                @case(1)
                    <td class="text-right">{{ number_format(floatval(str_replace(',', '', $deductions['incomeTax'])), 2) }}</td>
                    @break
                @default
                    <td class="text-right">{{ number_format(floatval(str_replace(',', '', $deductions['incomeTax'])), 2) }}</td>
            @endswitch
        </tr>
        @php
            $ded += floatval(str_replace(',', '', $deductions['sss']));
            $ded += floatval(str_replace(',', '', $deductions['philhealth']));
            $ded += floatval(str_replace(',', '', $deductions['pagibig']));
            $ded += floatval(str_replace(',', '', $deductions['incomeTax']));
            // $net = $gross - $ded;
        @endphp
      @endif --}}
      
      
      {{-- @if (!empty($details) && $details[0]->payroll_schedule_id ==  2 && $details[0]->week_count == 4)
        <tr>
            <td>SSS</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">{{ $deductions['sss'] }}</td>
        </tr>
        <tr>
            <td>Philhealth</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">{{ $deductions['philhealth'] }}</td>
        </tr>
        <tr>
            <td>Pagibig</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">{{ $deductions['pagibig'] }}</td>
        </tr>
        <tr>
            <td>Income TAX</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">{{ $deductions['incomeTax'] }}</td>
        </tr>
        @php
            $ded += floatval(str_replace(',', '', $deductions['sss']));
            $ded += floatval(str_replace(',', '', $deductions['philhealth']));
            $ded += floatval(str_replace(',', '', $deductions['pagibig']));
            $ded += floatval(str_replace(',', '', $deductions['incomeTax']));
            // $net = $gross - $ded;
        @endphp
      @endif --}}

  </tbody>
</table>
<div class="card-body">
  <div class="callout callout-danger">
      <h5>TOTAL DEDUCTIONS</h5>
      <p>{{ number_format($ded, 2); }}</p>
  </div>
  <div class="callout callout-warning">
      <h5>GROSS PAY</h5>
      <p>{{ number_format($gross, 2); }}</p>
  </div>
  <div class="callout callout-success">
      <h5>NET PAY</h5>
      <p>{{ number_format($gross - $ded, 2); }}</p>
  </div>
</div>

<script>
    $( document ).ready(function() {
        
    });
</script>