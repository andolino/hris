<h6 class="mb-0">Existing Loans</h6>
<small class="badge badge-info mb-2"><i>Select a loans you want to renew</i></small>
<table id="" class="display nowrap table table-striped table-bordered table-sm" width="100%">
  <thead>
    <tr id="week_header">
      <th class="">
          <small class="font-weight-bold">Loan Type</small>
      </th>
      <th class="">
          <small class="font-weight-bold">Balance</small>
      </th>
      <th class="">
          <small class="font-weight-bold">Action</small>
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($loans as $item)
      <tr data-id="{{ $item->id }}">
        <td>{{ $item->title }}</td>
        <td>{{ number_format($item->balance, 2) }}</td>
        <td>
          <div class="form-check">
            <input class="form-check-input" id="chk-select-loans" type="checkbox">
          </div>
        </td>
      </tr> 
    @endforeach
  </tbody>
</table>

<script>
  $(document).ready(function () {
    var dLoans = [];
    $(document).on('click', '#chk-select-loans', function (e) {
      if ($(this).is(':checked')) {
        dLoans.push($(this).parents('tr').attr('data-id'));
      } else {
        dLoans.splice(dLoans.indexOf($(this).parents('tr').attr('data-id')), 1);
      }
      $.ajax({
        type: "POST",
        url: "compute-renewal",
        data: { 
          loan_id: dLoans,
          "_token": $('#tbl-loans').attr('data-csrf')
        },
        dataType: "JSON",
        success: function (res) {
          $('#balance').val(res.balance)
        }
      });
    });
  });

</script>