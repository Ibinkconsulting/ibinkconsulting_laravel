@extends('backend.app')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('title', 'About Page - About Us Section')

@section('content')
    <div class="app-content content">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">About Us Section</h4>

                        <form method="POST" action="{{ route('cms.about_page.about_us_section.update') }}"
                            enctype="multipart/form-data" class="form">
                            @csrf
                            @method('PATCH')

                            <!-- Title -->
                            <div class="row mb-3">
                                <label for="title" class="col-3 col-form-label"><i>Title</i></label>
                                <div class="col-9">
                                    <input type="text" 
                                        name="title" 
                                        id="title" 
                                        class="form-control"
                                        value="{{ old('title', $data?->title) }}" 
                                        placeholder="Enter section title..."
                                        required>
                                    @error('title') 
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row mb-3">
                                <label for="description" class="col-3 col-form-label"><i>Description</i></label>
                                <div class="col-9">
                                    <textarea 
                                        name="description" 
                                        id="description" 
                                        class="summernote form-control @error('description') is-invalid @enderror"
                                        required>{!! old('description', $data?->description) !!}</textarea>
                                    @error('description') 
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Save Button & Cancel Button -->
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="fas fa-save me-1"></i> Save Changes
                                        </button>
                                        <button type="reset" class="btn btn-outline-danger ms-2">
                                            <i class="fas fa-times me-1"></i> Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize Summernote
            $('.summernote').summernote({
                height: 250,
                placeholder: 'Enter text here...',
            });
        });
    </script>
@endpush