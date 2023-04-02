@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Додавання користувача</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Головна</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.user.index') }}">Користувачі</a></li>
                        <li class="breadcrumb-item active">Додавання користувача</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.user.store') }}" method="POST" class="w-25">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Імя користувача">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Пошта">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <input type="text" class="form-control" name="password" placeholder="Пароль">--}}
{{--                            @error('password')--}}
{{--                            <div class="text-danger">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
                        <div class="form-group w-50">
                            <label>Виберіть роль</label>
                            <select name="role" class="form-control">
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}"
                                        {{ $id == 'role_id' ? ' selected' : '' }}
                                    >{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary" value="Додати">
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
