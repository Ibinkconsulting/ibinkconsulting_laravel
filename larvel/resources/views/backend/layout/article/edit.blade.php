@extends('backend.app')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        .dropify-wrapper .dropify-preview .dropify-render video {
            width: 100%;
            height: auto;
            max-height: 220px;
            object-fit: contain;
        }

        .dropify-wrapper .dropify-preview .dropify-render img {
            width: 100%;
            height: auto;
            max-height: 220px;
            object-fit: contain;
        }
    </style>
@endpush
@section('title', 'Article Edit')
@section('content')
    <div class="app-content content ">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Article Edit</h3>
                <div>
                    <a href="{{ route('admin.article.index') }}" class="btn btn-primary" type="button">
                        <span>Article List</span>
                    </a>
                </div>

            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.article.update', $article->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- category -->
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select id="category_id" class="form-control" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- title -->
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control"
                                    value="{{ old('title', $article->title) }}" placeholder="Article Title" name="title" />
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                       

                        <!-- description -->
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control summernote"
                                    name="description">{{ old('description', $article->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- image -->
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" id="image" class="dropify" accept="image/*"
                                    data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"
                                    data-default-file="{{ $article->image ? asset($article->image) : '' }}" name="image" />
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                         <!-- year -->
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="text" id="year" class="form-control" value="{{ old('year', $article->year) }}"
                                    placeholder="Article Year" name="year" />
                                @error('year')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- order -->
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="order">Order</label>
                                <input type="number" id="order" class="form-control"
                                    value="{{ old('order', $article->order) }}" placeholder="Article Order" name="order" />
                                @error('order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                            <a href="{{ route('admin.article.index') }}" class="btn btn-outline-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


        <script>
            $(document).ready(function () {
                // Initialize Summernote
                $('.summernote').summernote({
                    height: 250,
                    placeholder: 'Enter text here...',
                });


                // Initialize Dropify
                $('.dropify').dropify({
                    messages: {
                        'default': 'Drag & drop file here or click to browse',
                        'replace': 'Drag & drop or click to replace',
                        'remove': 'Remove',
                        'error': 'Ooops, something wrong happened.'
                    }
                });

            });
        </script>
    @endpush
@endsection