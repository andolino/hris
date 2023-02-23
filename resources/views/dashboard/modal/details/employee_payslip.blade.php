<div class="row">
    {{-- DETAILS --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary">
                <span>DETAILS</span>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Days</th>
                        <th>Hrs</th>
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
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td class="text-right">{{ $item->no_of_day }}</td>
                                <td class="text-right">{{ $item->hrs }}</td>
                                <td class="text-right">{{ $item->leave_balance }}</td>
                                <td class="text-right">{{ $item->debit == '' ? '' : number_format($item->debit, 2) }}</td>
                                <td class="text-right">{{ $item->credit == '' ? '' : number_format($item->credit, 2) }}</td>
                            </tr>
                            @php
                                $gross += $item->debit;
                                $ded += $item->credit;
                            @endphp
                        @endif
                    @endforeach
                    <tr>
                        <td>SSS</td>
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
                        <td class="text-right">{{ $deductions['philhealth'] }}</td>
                    </tr>
                    <tr>
                        <td>Pagibi</td>
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
                        <td class="text-right">{{ $deductions['incomeTax'] }}</td>
                    </tr>
                    @php
                        $ded += floatval(str_replace(',', '', $deductions['sss']));
                        $ded += floatval(str_replace(',', '', $deductions['philhealth']));
                        $ded += floatval(str_replace(',', '', $deductions['pagibig']));
                        $ded += floatval(str_replace(',', '', $deductions['incomeTax']));
                        $net = $gross - $ded;
                    @endphp
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
                    <p>{{ number_format($net, 2); }}</p>
                </div>
            </div>


        </div>
    </div>
    {{-- END PERSONAL INFORMATION --}}
</div>