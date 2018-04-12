<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Code</th>
            <th>Name</th>
            @role('admin')
            <th>Cost</th>
            @endrole
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
    @foreach($product as $item)
        <tr>
            <td>{{ $loop->iteration or $item->id }}</td>
            <td>{{ isset($item->category->name) ? $item->category->name : null }}</td>
            <td>{{ $item->code }}</td>
            <td>{{ $item->name }}</td>
            @role('admin')
            <td>{{ $item->cost }}</td>
            @endrole
            <td>{{ $item->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

