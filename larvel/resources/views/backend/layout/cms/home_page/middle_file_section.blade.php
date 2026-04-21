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
        .dropify-wrapper .dropify-preview .dropify-render img {
            width: 100%;
            height: auto;
            max-height: 220px;
            object-fit: contain;
        }
    </style>
@endpush

@section('title', 'Home Page - Middle File Section')

@section('content')
    <div class="app-content content">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Middle File Section</h4>

                        <form method="POST" action="{{ route('cms.home_page.middle_file_section.update') }}"
                              enctype="multipart/form-data" class="form">
                            @csrf
                            @method('PATCH')

                            <!-- Type Selection -->
                            <div class="row mb-3">
                                <label for="type" class="col-3 col-form-label">Type</label>
                                <div class="col-9">
                                    <select name="type" id="type" class="form-control">
                                        <option value="image" {{ old('type', $data?->type ?? 'image') == 'image' ? 'selected' : '' }}>Image</option>
                                        <option value="video" {{ old('type', $data?->type ?? 'image') == 'video' ? 'selected' : '' }}>Video</option>
                                    </select>
                                    @error('type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image Upload Row -->
                            <div class="row mb-3" id="image-row">
                                <label class="col-3 col-form-label">Image</label>
                                <div class="col-9">
                                    <input type="file"
                                           name="image"
                                           id="image"
                                           class="dropify"
                                           accept="image/*"
                                           data-allowed-file-extensions="jpg jpeg png gif"
                                           data-max-file-size="5M"
                                           data-default-file="{{ $data?->image ? asset($data->image) : '' }}">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Video Upload Row -->
                            <div class="row mb-3" id="video-row" style="display: none;">
                                <label class="col-3 col-form-label">Video</label>
                                <div class="col-9">
                                    <input type="file"
                                           name="video"
                                           id="video"
                                           class="dropify"
                                           accept="video/*"
                                           data-allowed-file-extensions="mp4 webm ogv"
                                           data-max-file-size="50M"
                                           data-default-file="{{ $data?->video ? asset($data->video) : '' }}">

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
                                    @error('video')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                             <!-- Save Button & Cancel Button -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save me-1"></i> Save Changes
                                </button>
                                <a href="{{ route('cms.home_page.middle_file_section') }}"
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

            // Initialize Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag & drop file here or click to browse',
                    'replace': 'Drag & drop or click to replace',
                    'remove':  'Remove',
                    'error':   'Ooops, something wrong happened.'
                }
            });

            // Toggle image/video fields + disable inactive one
            function toggleMediaFields(type) {
                if (type === 'video') {
                    $('#video-row').show();
                    $('#image-row').hide();
                    $('#video').prop('disabled', false).closest('.dropify-wrapper').css('opacity', 1);
                    $('#image').prop('disabled', true).closest('.dropify-wrapper').css('opacity', 0.5);
                } else {
                    $('#image-row').show();
                    $('#video-row').hide();
                    $('#image').prop('disabled', false).closest('.dropify-wrapper').css('opacity', 1);
                    $('#video').prop('disabled', true).closest('.dropify-wrapper').css('opacity', 0.5);
                }
            }

            // Initial setup
            const initialType = $('#type').val() || 'image';
            toggleMediaFields(initialType);

            // On type change
            $('#type').on('change', function () {
                toggleMediaFields($(this).val());
            });

        });
    </script>
@endpush