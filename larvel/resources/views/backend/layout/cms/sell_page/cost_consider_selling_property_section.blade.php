@extends('backend.app')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('title', 'Sell Page - Cost Consider Selling Property')

@section('content')
    <div class="app-content content">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Cost Consider Selling Property Section</h4>

                        <form method="POST" action="{{ route('cms.sell_page.cost_consider_selling_property_section.update') }}" 
                              enctype="multipart/form-data" class="form">
                            @csrf
                            @method('PATCH')

                            <!-- Main Text / Title -->
                            <div class="row mb-3">
                                <label class="col-3 col-form-label">Main Title *</label>
                                <div class="col-9">
                                    <input type="text" name="main_text" class="form-control" required
                                           value="{{ old('main_text', $data->main_text ?? '') }}">
                                    @error('main_text') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row mb-4">
                                <label class="col-3 col-form-label">Description *</label>
                                <div class="col-9">
                                    <textarea name="description" class="summernote form-control" required rows="4">
                                        {!! old('description', $data->description ?? '') !!}
                                    </textarea>
                                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Image -->
                            <div class="row mb-4">
                                <label class="col-3 col-form-label">Image</label>
                                <div class="col-9">
                                    <input type="file" name="image" class="dropify"
                                           accept="image/*"
                                           data-default-file="{{ $data->image ? asset($data->image) : '' }}">
                                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Dynamic Parts -->
                            <div id="parts-container">
                                @php $existingParts = old('parts', $parts ?? []); @endphp

                                @foreach($existingParts as $index => $part)
                                    <div class="card mb-4 border-primary part-group">
                                        <div class="card-header bg-primary mb-2 bg-opacity-10 d-flex justify-content-between align-items-center">
                                            <strong>Part {{ $index + 1 }}</strong>
                                            <button type="button" class="btn btn-sm btn-danger remove-part">× Remove</button>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <label class="col-3 col-form-label">Key Title *</label>
                                                <div class="col-9">
                                                    <input type="text" name="parts[{{ $index }}][key_title]" class="form-control" required
                                                           value="{{ old("parts.$index.key_title", $part['key_title'] ?? '') }}">
                                                    @error("parts.$index.key_title") <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-3 col-form-label">Points</label>
                                                <div class="col-9">
                                                    <div class="points-container" data-part-index="{{ $index }}">
                                                        @foreach($part['points'] ?? [] as $pIndex => $point)
                                                            <div class="input-group mb-2 point-item">
                                                                <input type="text" name="parts[{{ $index }}][points][{{ $pIndex }}][point_title]" 
                                                                       class="form-control" required placeholder="Point Title *"
                                                                       value="{{ old("parts.$index.points.$pIndex.point_title", $point['point_title'] ?? '') }}">
                                                                <button type="button" class="btn btn-outline-danger remove-point">×</button>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <button type="button" class="btn btn-sm btn-outline-primary add-point mt-2" 
                                                            data-part-index="{{ $index }}">
                                                        + Add Point
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-end mb-4">
                                <button type="button" id="add-part" class="btn btn-primary">
                                    + Add New Part
                                </button>
                            </div>

                            <div class="row mt-5">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({ height: 180 });
            $('.dropify').dropify();

            let partIndex = {{ count($existingParts) }};

            $('#add-part').click(function () {
                let html = `
                    <div class="card mb-4 border-primary part-group">
                        <div class="card-header bg-primary mb-2 bg-opacity-10 d-flex justify-content-between align-items-center">
                            <strong>Part ${partIndex + 1}</strong>
                            <button type="button" class="btn btn-sm btn-danger remove-part">× Remove</button>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-3 col-form-label">Key Title *</label>
                                <div class="col-9">
                                    <input type="text" name="parts[${partIndex}][key_title]" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-3 col-form-label">Points</label>
                                <div class="col-9">
                                    <div class="points-container" data-part-index="${partIndex}"></div>
                                    <button type="button" class="btn btn-sm btn-outline-primary add-point mt-2" data-part-index="${partIndex}">
                                        + Add Point
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $('#parts-container').append(html);
                partIndex++;
            });

            $(document).on('click', '.remove-part', function () {
                $(this).closest('.part-group').remove();
            });

            $(document).on('click', '.add-point', function () {
                let partIdx = $(this).data('part-index');
                let container = $(this).siblings('.points-container');
                let pointCount = container.children('.point-item').length;

                let html = `
                    <div class="input-group mb-2 point-item">
                        <input type="text" name="parts[${partIdx}][points][${pointCount}][point_title]" 
                               class="form-control" required placeholder="Point Title *">
                        <button type="button" class="btn btn-outline-danger remove-point">×</button>
                    </div>`;

                container.append(html);
            });

            $(document).on('click', '.remove-point', function () {
                $(this).closest('.point-item').remove();
            });
        });
    </script>
@endpush