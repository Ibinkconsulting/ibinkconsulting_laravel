@extends('backend.app')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('title', 'Sell Page - Selling Process Section')

@section('content')
    <div class="app-content content">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Selling Process Section Settings</h4>

                        <form method="POST" action="{{ route('cms.sell_page.selling_process_section.update') }}" class="form">
                            @csrf
                            @method('PATCH')

                            <!-- Main Text -->
                            <div class="row mb-4">
                                <label class="col-3 col-form-label">Main Text</label>
                                <div class="col-9">
                                    <input type="text" 
                                        name="main_text" 
                                        id="main_text" 
                                        class="form-control"
                                        value="{{ old('main_text', $data?->main_text) }}" 
                                        placeholder="Enter main text..."
                                        required>
                                </div>
                            </div>

                            <!-- Sub Text -->
                            <div class="row mb-4">
                                <label class="col-3 col-form-label">Sub Text</label>
                                <div class="col-9">
                                    <input type="text" 
                                        name="sub_text" 
                                        id="sub_text" 
                                        class="form-control"
                                        value="{{ old('sub_text', $data?->sub_text) }}" 
                                        placeholder="Enter sub text..."
                                        required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div id="parts-container">
                                @php
                                    $existingParts = old('parts', $parts ?? []);
                                    $fixedCount = 6;
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

                            <hr class="my-4">
                            
                            <!-- Button Text -->
                            <div class="row mb-4">
                                <label class="col-3 col-form-label">Button Text *</label>
                                <div class="col-9">
                                    <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $data->button_text ?? '') }}" required>
                                </div>
                            </div>

                            <!-- Link URL -->
                            <div class="row mb-4">
                                <label class="col-3 col-form-label">Link URL *</label>
                                <div class="col-9">
                                    <input type="url" name="link_url" class="form-control" value="{{ old('link_url', $data->link_url ?? '') }}" required>
                                </div>
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