@extends('layouts.app')

@section('custom-css')

@endsection

@section('content')

<!-- Table -->
<div class="row">
    <div class="col-lg-12">
        <div class="card m-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="card-header">
                Forms List
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($forms as $form)
                        <tr class="text-center">
                            <td>{{ $form->name }}</td>
                            <td>
                                <a href="{{ URL('edit-form-builder', $form->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="#" class="btn btn-sm btn-success">Show</a>
                                <!-- Delete Form -->
                                <form action="{{route('delete.form', $form->id)}}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this form?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center">
                                <p>No forms added yet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="text-center">
            <a href="{{ route('create-form') }}" class="btn btn-primary mb-3">Create</a>
        </div>
    </div>
</div>


@endsection
