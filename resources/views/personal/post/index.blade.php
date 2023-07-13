@extends('personal.layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Пости</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('personal.main.index') }}">Головна</a></li>
                        <li class="breadcrumb-item active">Пости</li>
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
                <div class="col-1 mb-3">
                    <a href="{{ route('personal.post.create') }}" class="btn btn-block btn-primary">Додати</a>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Назва</th>
                                        <th colspan="3" class="text-center">Дія</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td class="text-center"><a href="{{ route('personal.post.show', $post->id) }}"><i class="far fa-eye"></i></a></td>
                                        <td class="text-center"><a href="{{ route('personal.post.edit', $post->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                                        <td class="text-center">
                                            <form action="{{ route('personal.post.delete', $post->id) }}"
                                                  method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="border-0 bg-transparent">
                                                    <i class="fas fa-trash text-danger" role="button"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
