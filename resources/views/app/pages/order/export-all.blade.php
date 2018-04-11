@php
$adminAndSales = 'admin|sales';
@endphp
<table>
        <thead>
        <tr>
            <th>#</th>
            @hasanyrole($adminAndSales)
            <th>Müştəri</th>
            @endhasanyrole

            <th>Məhsul</th>
            <th>Çərçivə</th>
            <th>Çanta</th>

            @hasanyrole('admin|workshop')
            <th>Maya dəyəri</th>
            {{-- <th>Kargo (Emalatxana)</th> --}}
            @endhasanyrole

            @hasanyrole($adminAndSales)
            <th>Qiymət</th>
            <th>Ödənilmış məbləğ</th>
            <th>Endirim məbləği</th>
            <th>Ödənilməli məbləğ</th>
            <th>Status</th>
            @endhasanyrole

            <th>Kampaniya</th>
            <th>Arzuolunan tarix</th>
            <th>Mərhələ</th>
            <th>Tarix</th>

        </tr>
        </thead>
        <tbody>
        @foreach($orders as $item)
            <tr>
                <td>{{ $item->id }}</td>
                @hasanyrole($adminAndSales)
                <td>{{ isset($item->customer) ? $item->customer->full_name : null }}</td>
                @endhasanyrole
                <td>{{ isset($item->product) ? $item->product->name : null }}</td>
                <td>{{ isset($item->frame) ? $item->frame->name : null }}</td>
                <td>{{ isset($item->case) ? $item->case->name : null }}</td>
                @hasanyrole('admin|workshop')
                <td>{{ $item->product_cost }}</td>
                {{-- <td>{{ $item->cargo_cost }}</td> --}}
                @endhasanyrole
                @hasanyrole($adminAndSales)
                <td>{{ $item->price }}</td>
                <td>{{ $item->totalPaidAmount() }}</td>
                <td>{{ $item->discount_amount }}</td>
                <td>{{ $item->restOfAmount() }}</td>
                <td class="{{$item->status == 3 ? 'red':''}}">{{ config('staticData')['orderStatus'][$item->status] }}</td>
                @endhasanyrole
                <td>{{ isset($item->sale) ? $item->sale->name : null }}</td>
                <td>{{ $item->wanted_date != null ? date('d-m-Y', strtotime($item->wanted_date)): null }}</td>
                <td>{{ isset($item->lastOrderlevel)?$item->lastOrderlevel->name: null }}</td>
                <td>{{ date('d-m-Y h:i', strtotime($item->created_at)) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>