@if ($attan == 'office' )
    <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">Ic</th>
                <th style="text-align: center;">In</th>
                <th style="text-align: center;">Out</th>
                <th style="text-align: center;">Date</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($offices->isEmpty())
                <tr>
                    <td colspan="7" style="text-align: center; color: red;">TIADA REKOD</td>
                </tr>
            @else
                @foreach ($offices as $key1 => $office)
                    <tr>
                        <td style="text-align: center;">{{ $key1 + 1 }}</td>
                        <td style="text-align: center;">{{ $office->name ?? '-' }}</td>
                        <td style="text-align: center;">{{ $office->ic ?? '-' }}</td>
                        <td style="text-align: center;">{{ $office->inoffice ?? '-' }}</td>
                        <td style="text-align: center;">{{ $office->outoffice ?? '-' }}</td>
                        <td style="text-align: center;">{{ \Carbon\Carbon::parse($office->date_apply)->format('d/m/Y') ?? '-' }}</td>
                        <td style="text-align: center;">
                            <button class="btn btn-danger" onclick="">DELETE</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@elseif ($attan == 'outstation')
    <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">Ic</th>
                <th style="text-align: center;">Date</th>
                <th style="text-align: center;">Date Apply</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($outstations->isEmpty())
                <tr>
                    <td colspan="6" style="text-align: center; color: red;">TIADA REKOD</td>
                </tr>
            @else
                @foreach ($outstations as $key2 => $outstation)
                    <tr>
                        <td style="text-align: center;">{{ $key2 + 1 }}</td>
                        <td style="text-align: center;">{{ $outstation->name }}</td>
                        <td style="text-align: center;">{{ $outstation->ic }}</td>
                        <td style="text-align: center;">{{ \Carbon\Carbon::parse($outstation->datestart)->format('d/m/Y') ?? '-' }}</td>
                        <td style="text-align: center;">{{ \Carbon\Carbon::parse($outstation->dateapply)->format('d/m/Y') ?? '-' }}</td>
                        <td style="text-align: center;">
                            <button class="btn btn-danger" onclick="">DELETE</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@elseif ($attan == 'wfh')
    <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">Ic</th>
                <th style="text-align: center;">Purpose</th>
                <th style="text-align: center;">Details</th>
                <th style="text-align: center;">Date Sign</th>
                <th style="text-align: center;">Date Apply</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($wfhs->isEmpty())
                <tr>
                    <td colspan="8" style="text-align: center; color: red;">TIADA REKOD</td>
                </tr>
            @else
                @foreach ($wfhs as $key3 => $wfh)
                    <tr>
                        <td style="text-align: center;">{{ $key3 + 1 }}</td>
                        <td style="text-align: center;">{{ $wfh->name }}</td>
                        <td style="text-align: center;">{{ $wfh->ic }}</td>
                        <td style="text-align: center;">{{ $wfh->purpose }}</td>
                        <td style="text-align: center;">{{ $wfh->details }}</td>
                        <td style="text-align: center;">{{ \Carbon\Carbon::parse($wfh->datesign)->format('d/m/Y') ?? '-' }}</td>
                        <td style="text-align: center;">{{ \Carbon\Carbon::parse($wfh->datesign)->format('d/m/Y') ?? '-' }}</td>
                        <td style="text-align: center;">
                            <button class="btn btn-danger" onclick="">DELETE</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endif
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
