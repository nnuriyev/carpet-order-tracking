
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Birth date</th>
            <th>Gender</th>
            <th>Type</th>
            <th>Status</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
    @foreach($customer as $item)
        <tr>
            <td>{{ $loop->iteration or $item->id }}</td>
            <td>{{ $item->full_name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{ $item->birth_date }}</td>
            <td>{{ config('staticData')['gender'][$item->gender] }}</td>
            <td>{{ config('staticData')['customerType'][$item->type] }}</td>
            <td>{{ config('staticData')['customerStatus'][$item->status] }}</td>
            <td>{{ $item->note }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
