<table id="data_table" class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th> Actions </th>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->format('Y/m/d') }}</td>
            <td>
                
                    <a href="#"><i class="ik ik-eye"></i></a>
                    <a href="{{ route('customers.edit', $user->id) }}"><i class="ik ik-edit-2"></i></a>
                    <a href="#" data-toggle="modal" data-target="#delete{{ $key }}"><i class="ik ik-trash-2"></i></a>
            </td>
        </tr>
        @include('customers.delete')
        @endforeach
    </tbody>
</table>
