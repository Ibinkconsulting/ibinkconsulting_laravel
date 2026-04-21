@extends('backend.app')

@section('title', 'Faq page')

@push('style')
    <style>
        {{-- CKEditor CDN --}} .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
@endpush

@section('content')
    <div class="app-content content ">
        <!-- General setting Form section start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admin Panel Setting</h3>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{ route('faq.update',['faq' => $faq->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-field-wrapper">
                            {{--  title input field --}}
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" required
                                    placeholder="Enter Question" value="{{ old('title', $faq->title) }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-field-wrapper">
                            {{-- short_description input field --}}
                            <div class="form-group">
                                <label for="description">Answer:</label>
                                <textarea name="description" rows="10" class="ck-editor form-control @error('description') is-invalid @enderror">{{ old('description', $faq->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    
@endpush
