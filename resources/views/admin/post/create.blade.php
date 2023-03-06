@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Додавання поста</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
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
                    <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group w-25">
                            <input type="text" class="form-control" name="title" placeholder="Назва Поста"
                            value="{{ old('title') }}"
                            >
                            @error('title')
                                <div class="text-danger">Це поле повинно бути заповнене</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="content" id="summernote">value="{{ old('title') }}"</textarea>
                            @error('content')
                            <div class="text-danger">Це поле повинно бути заповнене</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="exampleInputFile">Додати превю</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="preview_image">
                                    <label class="custom-file-label">Виберіть картинку</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Завантаження</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group w-50">
                            <label for="exampleInputFile">Додати головне фото</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="main">
                                    <label class="custom-file-label">Виберіть картинку</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Завантаження</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Додати">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
