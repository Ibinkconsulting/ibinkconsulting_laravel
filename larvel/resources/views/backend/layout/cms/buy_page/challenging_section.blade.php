@extends('backend.app')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('title', 'Buy Page - Challenging Section')

@section('content')
    <div class="app-content content">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Challenging Section Settings</h4>

                        <form method="POST" action="{{ route('cms.buy_page.challenging_section.update') }}" class="form">
                            @csrf
                            @method('PATCH')

                            <!-- Main Text -->
                            <div class="row mb-4">
                                <label class="col-3 col-form-label">Main Text</label>
                                <div class="col-9">
                                    <textarea name="main_text" id="main_text" class="summernote form-control" rows="4">
                                        {!! old('main_text', $data->main_text ?? '') !!}
                                    </textarea>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div id="parts-container">
                                @php
                                    $existingParts = old('parts', $parts ?? []);
                                    $fixedCount = 4;
                                @endphp

                                @for ($i = 0; $i < $fixedCount; $i++)
                                    @php
                                        $part = $existingParts[$i] ?? null;
                                        $index = $i;
                                    @endphp

                                    <div class="card mb-4 part-card border-primary">
                                        <div class="card-header bg-light">
                                            <strong>Part #{{ $index + 1 }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <label class="col-3 col-form-label">Title *</label>
                                                <div class="col-9">
                                                    <input type="text" name="parts[{{ $index }}][title]" class="form-control" 
                                                           value="{{ old("parts.$index.title", $part['title'] ?? '') }}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-3 col-form-label">Description *</label>
                                                <div class="col-9">
                                                    <textarea name="parts[{{ $index }}][description]" class="summernote form-control" required>
                                                        {!! old("parts.$index.description", $part['description'] ?? '') !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <!-- Save & Cancel Buttons -->
                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-success px-5">
                                        <i class="fas fa-save me-1"></i> Save Changes
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary ms-2">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </button>
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
            $('.summernote').summernote({
                height: 180,
                placeholder: 'Write text here...',
            });
        });
    </script>
@endpush