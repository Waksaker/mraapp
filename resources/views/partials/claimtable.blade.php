<div class="mt-3" align="right">
    <a href="" target="_blank" class="btn btn-primary">PRINT</a>
    <button href="" class="btn btn-warning" onclick="">Delete All</button>
</div>
<br>
<div class="row">
    <div class="col-12">
        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Date</th>
                    <th style="text-align: center;">Purpose</th>
                    <th style="text-align: center;">Details</th>
                    <th style="text-align: center;">Amounts</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($claims->isEmpty())
                    <tr>
                        <td colspan="7" style="text-align: center; color: red;">TIADA REKOD</td>
                    </tr>
                @else
                    @foreach ($claims as $key => $claim)
                        <tr>
                            <td style="text-align: center;">{{ $key + 1 }}</td>
                            <td style="text-align: center;">{{ $claim->name ?? '-' }}</td>
                            <td style="text-align: center;">{{ \Carbon\Carbon::parse($claim->date)->format('d/m/Y') ?? '-' }}</td>
                            <td style="text-align: center;">{{ $claim->purpose ?? '-' }}</td>
                            <td style="text-align: center;">{{ $claim->details ?? '-' }}</td>
                            <td style="text-align: center;">{{ $claim->amount ?? '-' }}</td>
                            <td style="text-align: center;">
                                <a href="" class="btn btn-danger">DELETE</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            scrollX: true,   // Enable horizontal scrolling
            autoWidth: false // Prevent automatic width limitation
        });

        console.log("DataTable Columns:", table.columns().header().toArray());
        console.log("DataTable Rows Count:", table.rows().count());
    });
</script>
