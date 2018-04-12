<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Emalatxana</th>
        <th>Sifariş Id</th>
        <th>Qeyd</th>
        <th>Borc</th>
        <th>Ödəniş</th>
        <th>Tarix</th>
    </tr>
    </thead>
    <tbody>
    @foreach($workshopdebt as $item)
        <tr>
            <td>{{ $loop->iteration or $item->id }}</td>
            <td>{{ $item->workshop->name }}</td>
            <td>{{ $item->order_id }}</td>
            <td>{{ $item->note }}</td>
            <td>{{ $item->debt != null ? $item->debt . ' AZN': null }}</td>
            <td>{{ $item->paid != null ? $item->paid . ' AZN': null }}</td>
            <td>{{ date('d-m-Y h:i', strtotime($item->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>