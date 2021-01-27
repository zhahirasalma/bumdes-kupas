@extends('backend.layout.master')
@section('title')
Users
@endsection


@section('content')

<div class="col-xl-12">
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">@yield('title')</h3>
                </div>
                <div class="col text-right">
                    <a href="{{route('users.create')}}" class="btn btn-success">Tambah</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">
                            {{$user->id}}
                        </th>
                        <td>
                            {{$user->nama}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            {{$user->role}}
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Edit"><i class="far fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Delete" type="submit"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
