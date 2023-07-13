@extends('personal.layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Зміна поста</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('personal.main.index') }}">Головна</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('personal.post.index') }}">Пости</a></li>
                        <li class="breadcrumb-item active">Зміна поста</li>
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
                    <form action="{{ route('personal.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group w-25">
                            <input type="text" class="form-control" name="title" placeholder="Назва Поста"
                                   value="{{ $post->title }}"
                            >
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="content" id="summernote" value="{{ $post->content }}">{{$post->content}}</textarea>
                            @error('content')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="exampleInputFile">Додати превю</label>
                            <div class="w-25 mb-2">
                                <img src="{{ url('storage/' . $post->preview_image) }}" alt="preview_image" class="w-50">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="preview_image">
                                    <label class="custom-file-label">Виберіть картинку</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Завантаження</span>
                                </div>
                            </div>
                            @error('preview_image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50 mb-2">
                            <label for="exampleInputFile">Додати головне фото</label>
                            <div class="w-50">
                                <img src="{{ url('storage/' . $post->main_image) }}" alt="main_image" class="w-50">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="main_image">
                                    <label class="custom-file-label">Виберіть картинку</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Завантаження</span>
                                </div>
                            </div>
                            @error('main_image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label>Виберіть категорію</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $post->category_id ? ' selected' : '' }}
                                    >{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            <select class="select2" name="tag_ids[]" multiple="multiple" data-placeholder="Виберіть теги" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option {{ is_array($post->tags->pluck('id')->toArray()) && in_array($tag->id, $post->tags->pluck('id')->toArray() ) ? ' selected' : '' }} value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Оновити">
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
