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
    </style>
@endpush

@section('title', 'MasterClass Page - Masterclass Section')

@section('content')
    <div class="app-content content">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Masterclass Section Settings</h4>

                        <form method="POST" action="{{ route('cms.masterclass_page.masterclass_section.update') }}"
                            enctype="multipart/form-data" class="form">
                            @csrf
                            @method('PATCH')

                            <!-- Video -->
                            <div class="row mb-3">
                                <label for="video" class="col-3 col-form-label">Video</label>
                                <div class="col-9">
                                     <input type="file" 
                                        name="video" 
                                        id="video" 
                                        class="dropify"
                                        accept="video/*"
                                        data-allowed-file-extensions="mp4 webm ogv avi mkv" 
                                        data-max-file-size="50M"
                                        data-default-file="{{ isset($data->video) ? asset($data->video) : '' }}">

                                    @if($data?->video)
                                        <input type="hidden" name="current_video" value="{{ $data->video }}">
                                        <div id="current-video-preview" class="mt-3">
                                            <label class="form-label">Current Video:</label>
                                            <video controls style="max-width:100%; max-height:280px; background:#000;"
                                                class="rounded">
                                                <source src="{{ asset($data->video) }}" type="video/mp4">
                                            </video>
                                        </div>
                                    @endif
                                </div>
                            </div>

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

                            <!-- Sub Title -->
                            <div class="row mb-3">
                                <label for="sub_title" class="col-3 col-form-label"><i>Sub Title</i></label>
                                <div class="col-9">
                                    <textarea 
                                        name="sub_title" 
                                        id="sub_title" 
                                        class="summernote form-control @error('sub_title') is-invalid @enderror"
                                        required>{!! old('sub_title', $data?->sub_title) !!}</textarea>
                                    @error('sub_title') 
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
                                        placeholder="Enter button text..."
                                        required>
                                    @error('button_text') 
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
            const dropify = $('.dropify').dropify({
                messages: {
                    'default': 'Drag & drop video or click to browse',
                    'replace': 'Drag & drop or click to replace',
                    'remove': 'Remove',
                }
            });

            dropify.on('change', function () {
                $('#current-video-preview').hide();
            });

            dropify.on('dropify.beforeClear', function () {
                setTimeout(() => {
                    $('#current-video-preview').show();
                }, 100);
            });
            dropify.on('dropify.beforeClear', function () {
                setTimeout(() => {
                    $('#current-video-preview').show();
                }, 100);
            });

            // Initialize Summernote
            $('.summernote').summernote({
                height: 250,
                placeholder: 'Enter text here...',
            });
        });
    </script>
@endpush