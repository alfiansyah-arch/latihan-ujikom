@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-header">{{ __('Table Users') }}</div>
  
                <div class="card-body">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                        <b>Tambah User</b>
                    </a>
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Pengguna</th>
                                <th scope="col">Email</th>
                                <th scope="col">Hak Akses</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($users as $row)
                            <?php $no++ ?>
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{$row->nm_pengguna}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->hak_akses}}</td>
                                <?php
                                    if($row->status=="active"){
                                        echo "<td style='background-color:green;color:white;'><b>Active</b></td>";
                                    }else{
                                        echo "<td style='background-color:red;color:white;'><b>Inactive</b></td>";
                                    }
                                    ?>
                                <td> 
                                    <a style="color: white;" href="{{ route('users.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                        <b>Edit</b>
                                    </a>
                                    <form action="{{ route('users.destroy',$row->id) }}" method="POST"
                                    style="display: inline;" onsubmit="return confirm('Do you really want to delete {{ $row->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="text-muted">
                                        <b style="color:white;">Delete</b>
                                    </span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection