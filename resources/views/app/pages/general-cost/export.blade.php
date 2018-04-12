
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Tip</th>
            <th>Məbləğ</th>
            <th>Qeyd</th>
            <th>Tarix</th>
        </tr>
    </thead>
    <tbody>
    @foreach($generalcost as $item)
        <tr>
            <td>{{ $loop->iteration or $item->id }}</td>
            <td>{{ $item->typeName() }}</td>
            <td>{{ $item->amount }} AZN</td>
            <td>{{ $item->note }}</td>
            <td>{{ date('d-m-Y h:i', strtotime($item->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

