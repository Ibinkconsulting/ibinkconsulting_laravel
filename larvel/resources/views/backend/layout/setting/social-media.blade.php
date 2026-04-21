@extends('backend.app')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush

@section('title', 'Social Media Settings')

@section('content')
    <div class="app-content content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Social Media Links</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.socialmediaupdate') }}">
                    @csrf

                    <div class="row">
                        @foreach($platforms as $platform)
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="{{ $platform }}" class="text-capitalize">{{ $platform }}</label>
                                    <input type="url"
                                           id="{{ $platform }}"
                                           name="{{ $platform }}"
                                           class="form-control"
                                           value="{{ $socials[$platform] ?? '' }}"
                                           placeholder="https://{{ $platform }}.com/yourpage"
                                    />
                                    @error($platform)
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection