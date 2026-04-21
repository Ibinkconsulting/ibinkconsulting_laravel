@extends('backend.app')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

@endpush

@section('title', 'Sell Page - Get Clarity Section')

@section('content')
    <div class="app-content content">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Get Clarity Section</h4>

                        <form method="POST" action="{{ route('cms.sell_page.get_clarity_section.update') }}"
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

                            <!-- Button Text -->
                            <div class="row mb-3">
                                <label for="button_text" class="col-3 col-form-label"><i>Button Text</i></label>
                                <div class="col-9">
                                    <input type="text" 
                                        name="button_text" 
                                        id="button_text" 
                                        class="form-control"
                                        value="{{ old('button_text', $data?->button_text) }}" 
                                        placeholder="e.g., Read More"
                                        required>
                                    @error('button_text') 
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Button URL -->
                            <div class="row mb-3">
                                <label for="link_url" class="col-3 col-form-label"><i>Button URL (Optional)</i></label>
                                <div class="col-9">
                                    <input type="url" 
                                        name="link_url" 
                                        id="link_url" 
                                        class="form-control"
                                        accept="url"
                                        value="{{ old('link_url', $data?->link_url) }}" 
                                        placeholder="https://example.com">
                                    @error('link_url') 
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image -->
                            <div class="row mb-3">
                                <label for="image" class="col-3 col-form-label"><i>Image</i></label>
                                <div class="col-9">
                                    <input type="file" 
                                        name="image" 
                                        id="image" 
                                        class="dropify"
                                        accept="image/*"
                                        data-allowed-file-extensions="png jpg jpeg"
                                        data-max-file-size="5M"
                                        data-default-file="{{ isset($data->image) ? asset($data->image) : '' }}">
                                    @error('image') 
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize Dropify for all file inputs
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happened.'
                }
            });

            // Initialize Summernote
            $('.summernote').summernote({
                height: 250,
                placeholder: 'Enter text here...',
            });
        });
    </script>
@endpush