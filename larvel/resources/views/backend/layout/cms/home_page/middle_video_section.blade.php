@extends('backend.app')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <style>
        .dropify-wrapper .dropify-preview .dropify-render video {
            width: 100%;
            height: auto;
            max-height: 220px;
            object-fit: contain;
        }
    </style>
@endpush

@section('title', 'Home Page - Middle Video Section')

@section('content')
    <div class="app-content content">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Middle Video Section</h4>

                        <form method="POST" action="{{ route('cms.home_page.middle_video_section.update') }}"
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

                            <!-- Save Button & Cancel Button -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save me-1"></i> Save Changes
                                </button>
                                <a href="{{ route('cms.home_page.about_owner_section') }}"
                                    class="btn btn-outline-secondary ms-2">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
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
        });
    </script>
@endpush