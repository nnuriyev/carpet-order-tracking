<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Müştəri</th>
            <th>Sifariş id</th>
            <th>Kateqoriya</th>
            <th>Məhsul</th>
            <th>Status</th>
            <th>Ödəniş</th>
            <th>Ödəniş tipi</th>
            <th>Tarix</th>
        </tr>
    </thead>
    <tbody>
    @foreach($customerPayments as $item)
        <tr>
            <td>{{ $loop->iteration or $item->id }}</td>
            <td>{{ isset($item->order->customer->full_name) ? $item->order->customer->full_name : null }}</td>
            <td>{{ isset($item->order->id) ? $item->order->id : null }}</td>
            <td>{{ isset($item->order->product->category->name) ? $item->order->product->category->name : null }}</td>
            <td>{{ isset($item->order->product->name) ? $item->order->product->name : null }}</td>
            <td>{{ isset($item->order->status) ? $item->order->statusName() : null }}</td>
            <td class="green">{{ $item->amount . ' AZN' }}</td>
            <td>{{ $item->typeName() }}</td>
            <td>{{ date('d-m-Y h:i', strtotime($item->created_at)) }} </td>
        </tr>
    @endforeach
    </tbody>
</table>

