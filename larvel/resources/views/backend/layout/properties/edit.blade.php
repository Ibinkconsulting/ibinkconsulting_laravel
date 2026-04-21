@extends('backend.app')

@section('title', 'Edit Property')

@push('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        #map {
            height: 300px;
        }

        .popup-card {
            max-width: 300px;
        }

        .popup-img {
            width: 100%;
            height: auto;
        }

        .advanced--search--modal,
        .maps--floating--option--menu {
            display: none;
        }

        .show {
            display: block;
        }

        .preview {
            display: inline-block;
            margin: 10px;
            position: relative;
        }

        .preview img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }

        .remove-image-btn {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            font-size: 12px;
            line-height: 16px;
            border-radius: 50%;
            background: #dc3545;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        #coreAmenitiesContainer {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 8px;
        }

        .amenity-box {
            position: relative;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.12);
            border-radius: 4px;
        }

        .icon-wrapper {
            transition: all 0.2s;
        }

        .icon-wrapper:hover,
        .icon-wrapper.border-success {
            border-color: #28a745 !important;
            background: rgba(40, 167, 69, 0.08);
        }

        .amenity-remove {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            font-size: 14px;
            line-height: 16px;
            border-radius: 50%;
            background: #dc3545;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 0;
        }
    </style>
@endpush

@section('content')
    <div class="app-content content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Property</h3>
            </div>
            <div class="card-body">
                <form class="form" method="POST" id="propertyForm" enctype="multipart/form-data"
                    action="{{ route('admin.property.update', $property->id) }}">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Property Title"
                                    value="{{ old('title', $property->title) }}">
                                <div class="text-danger" id="titleError"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" name="location" class="form-control" placeholder="Enter Location"
                                    value="{{ old('location', $property->location) }}">
                                <div class="text-danger" id="locationError"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Rent Price ($):</label>
                                <input type="number" name="price" class="form-control" placeholder="Enter Rent Price"
                                    value="{{ old('price', $property->price) }}">
                                <div class="text-danger" id="priceError"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apartment_type">Apartment Type:</label>
                                <select name="apartment_type" class="form-control" id="apartment_type">
                                    <option value="">Select Type</option>
                                    <option value="rent" {{ old('apartment_type', $property->apartment_type) == 'rent' ? 'selected' : '' }}>
                                        For Rent</option>
                                    <option value="lease" {{ old('apartment_type', $property->apartment_type) == 'lease' ? 'selected' : '' }}>
                                        For Lease</option>
                                </select>
                                <div class="text-danger" id="apartment_typeError"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="city">City Name:</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter City"
                                    value="{{ old('city', $property->city) }}">
                                <div class="text-danger" id="cityError"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="land_size">Land Size (m²):</label>
                                <input type="number" name="land_size" class="form-control" placeholder="Enter Land Size"
                                    value="{{ old('land_size', $property->land_size) }}">
                                <div class="text-danger" id="land_sizeError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="floor_size">Floor Size (m²):</label>
                                <input type="number" name="floor_size" class="form-control" placeholder="Enter Floor Size"
                                    value="{{ old('floor_size', $property->floor_size) }}">
                                <div class="text-danger" id="floor_sizeError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="bedrooms">Bedrooms:</label>
                                <input type="number" name="bedrooms" class="form-control" placeholder="Enter Bedrooms"
                                    value="{{ old('bedrooms', $property->bedrooms) }}">
                                <div class="text-danger" id="bedroomsError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="bathrooms">Bathrooms:</label>
                                <input type="number" name="bathrooms" class="form-control" placeholder="Enter Bathrooms"
                                    value="{{ old('bathrooms', $property->bathrooms) }}">
                                <div class="text-danger" id="bathroomsError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="garages">Garages:</label>
                                <input type="number" name="garages" class="form-control" placeholder="Enter Garages"
                                    id="garages" value="{{ old('garages', $property->garages) }}">
                                <div class="text-danger" id="garagesError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="open_spaces">Open Spaces:</label>
                                <input type="number" name="open_spaces" class="form-control" placeholder="Enter Open Spaces"
                                    value="{{ old('open_spaces', $property->open_spaces) }}">
                                <div class="text-danger" id="open_spacesError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="establishment_year">Establishment Year:</label>
                                <input type="text" name="establishment_year" class="form-control"
                                    placeholder="Enter Establishment Year"
                                    value="{{ old('establishment_year', $property->establishment_year) }}">
                                <div class="text-danger" id="establishment_yearError"></div>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" rows="10"
                                class="form-control">{{ old('description', $property->description) }}</textarea>
                            <div class="text-danger" id="descriptionError"></div>
                        </div>

                        <div class="col-md-4 my-2">
                            <h4>Core Amenities</h4>
                            <div class="ms-2 d-flex flex-wrap" id="coreAmenitiesContainer"></div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary mt-2" id="addAmenityBtn">+</button>
                            </div>
                        </div>

                        <input type="hidden" id="latitude" name="latitude"
                            value="{{ old('latitude', $property->latitude) }}">
                        <input type="hidden" id="longitude" name="longitude"
                            value="{{ old('longitude', $property->longitude) }}">

                        <div class="col-md-6 mt-3">
                            <h4 class="mb-3">Location</h4>
                            <div style="position: relative">
                                <div id="map"></div>
                                <div class="col-md-3 mt-3"
                                    style="display: flex; position:absolute; top:0; left:50px; z-index: 1111">
                                    <input type="text" id="locationInput" class="form-control"
                                        placeholder="Enter search location name">
                                    <button id="searchButton" class="btn btn-primary btn-sm px-3" style="margin-left: 7px;"
                                        type="button">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4 mt-3">
                                <label>Thumbnail</label>
                                <input type="file" name="thumbnail" class="dropify"
                                    data-default-file="{{ $property->thumbnail ? asset($property->thumbnail->file_path) : '' }}" />
                            </div>

                            <div class="col-md-4 mt-3">
                                <h4 class="mb-3">Images <span>(Multiple)</span></h4>
                                <input type="file" id="file-input" name="images[]" class="form-control" multiple />
                                <div class="text-danger" id="imagesError"></div>
                                <div id="image-previews" class="d-flex flex-wrap mt-3">
                                    @foreach ($property->files ?? [] as $image)
                                        <div class="preview" id="preview-{{ $image->id }}">
                                            <img src="{{ asset($image->file_path) }}" alt="Image Preview" />
                                            <button type="button" class="remove-image-btn"
                                                data-image="{{ $image->id }}">×</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label>Floor Plan Ground</label>
                                <input type="file" name="ground_plan" class="dropify"
                                    data-default-file="{{ $property->ground_plan ? asset($property->ground_plan) : '' }}" />
                            </div>

                            <div class="col-md-4">
                                <label>Floor Plan First</label>
                                <input type="file" name="first_plan" class="dropify"
                                    data-default-file="{{ $property->first_plan ? asset($property->first_plan) : '' }}" />
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary mr-1">Update</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        ClassicEditor.create(document.getElementById('description'))
            .catch(err => console.error(err));

        $('.dropify').dropify();

        const fileInput = document.getElementById('file-input');
        const previewsContainer = document.getElementById('image-previews');

        fileInput.addEventListener('change', function (e) {
            const files = e.target.files;
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('preview');
                    wrapper.innerHTML = `
                        <img src="${ev.target.result}">
                        <button type="button" class="remove-image-btn">×</button>
                    `;
                    wrapper.querySelector('.remove-image-btn')
                        .addEventListener('click', () => wrapper.remove());
                    previewsContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const removeButtons = document.querySelectorAll('.remove-image-btn');
            removeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const imageId = this.getAttribute('data-image');
                    const previewElement = document.getElementById('preview-' + imageId);

                    fetch('{{ route('admin.property.removeImage') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ image_id: imageId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            previewElement.remove();
                        } else {
                            alert('Error removing image.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            const map = L.map('map').setView([
                {{ $property->latitude ?? 48.8584 }},
                {{ $property->longitude ?? 2.2945 }}
            ], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            @if ($property->latitude && $property->longitude)
                L.marker([{{ $property->latitude }}, {{ $property->longitude }}])
                    .addTo(map)
                    .bindPopup("{{ $property->location }}")
                    .openPopup();
            @endif

            map.on("click", function (e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;
                Swal.fire({
                    icon: "success",
                    title: "Location Picked",
                    showConfirmButton: false,
                    timer: 1000
                });
            });

            document.getElementById('searchButton').addEventListener('click', async () => {
                const query = document.getElementById('locationInput').value;
                if (!query) return alert('Please enter a location.');

                const res = await fetch(
                    `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`
                );
                const data = await res.json();

                if (data.length > 0) {
                    const lat = parseFloat(data[0].lat),
                        lng = parseFloat(data[0].lon);

                    map.setView([lat, lng], 10);

                    map.eachLayer(layer => {
                        if (layer instanceof L.Marker) map.removeLayer(layer);
                    });

                    L.marker([lat, lng]).addTo(map).bindPopup(query).openPopup();
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                } else {
                    alert('Location not found.');
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lucideIcons = [
                "waves", "wifi", "car", "tv", "washing-machine", "cooking-pot",
                "laptop", "droplets", "shield-check", "snowflake", "flame",
                "dumbbell", "bath", "coffee", "map-pin"
            ];

            const externalIcons = [
                { name: "kitchen", url: "/icons/kitchen.svg" },
                { name: "dedicated_workspace", url: "/icons/dedicated_workspace.svg" },
                { name: "pool", url: "/icons/pool.svg" },
                { name: "elevator", url: "/icons/elevator.svg" },
                { name: "commertial", url: "/icons/commertial.svg" },
                { name: "construction", url: "/icons/construction.svg" },
                { name: "carbon_monoxide_alarm", url: "/icons/carbon_monoxide_alarm.svg" },
                { name: "bathroom", url: "/icons/bathroom.svg" },
                { name: "bed", url: "/icons/bed.svg" },
                { name: "garage", url: "/icons/garage.svg" },
                { name: "open_space", url: "/icons/open_space.svg" },
                { name: "land_area", url: "/icons/land_area.svg" },
                { name: "sqm_floor", url: "/icons/sqm_floor.svg" }
            ];

            let amenityCount = 0;
            const container = document.getElementById('coreAmenitiesContainer');

            function createAmenityInput(existing = null) {
                amenityCount++;

                const wrapper = document.createElement('div');
                wrapper.classList.add('form-check', 'm-2', 'me-4', 'd-inline-block', 'amenity-box', 'position-relative');

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'amenity-remove btn btn-sm btn-danger position-absolute top-0 end-0';
                removeBtn.innerHTML = '×';
                removeBtn.onclick = () => wrapper.remove();
                wrapper.appendChild(removeBtn);

                const iconPicker = document.createElement('div');
                iconPicker.className = 'd-flex flex-wrap gap-2';
                iconPicker.style.maxHeight = '80px';
                iconPicker.style.overflowY = 'auto';
                iconPicker.style.padding = '10px 0';

                const hiddenIcon = document.createElement('input');
                hiddenIcon.type = 'hidden';
                hiddenIcon.name = `amenity_${amenityCount}_icon`;
                iconPicker.appendChild(hiddenIcon);

                lucideIcons.forEach(iconName => {
                    const item = document.createElement('div');
                    item.className = 'icon-wrapper p-2 border rounded';
                    item.style.cursor = 'pointer';
                    item.innerHTML = `<i data-lucide="${iconName}"></i>`;

                    item.onclick = () => {
                        iconPicker.querySelectorAll('.border-success').forEach(el => el.classList.remove('border-success'));
                        item.classList.add('border-success');
                        const svg = item.querySelector('svg');
                        hiddenIcon.value = svg ? svg.outerHTML : iconName;
                    };

                    iconPicker.appendChild(item);
                });

                externalIcons.forEach(ext => {
                    const item = document.createElement('div');
                    item.className = 'icon-wrapper p-2 border rounded';
                    item.style.cursor = 'pointer';
                    item.innerHTML = `<img src="${ext.url}" alt="${ext.name}" style="width:24px; height:24px;">`;

                    item.onclick = () => {
                        iconPicker.querySelectorAll('.border-success').forEach(el => el.classList.remove('border-success'));
                        item.classList.add('border-success');
                        hiddenIcon.value = `<img src="${ext.url}" alt="${ext.name}" style="width:24px;height:24px;">`;
                    };

                    iconPicker.appendChild(item);
                });

                wrapper.appendChild(iconPicker);

                const nameInput = document.createElement('input');
                nameInput.type = 'text';
                nameInput.name = `amenity_${amenityCount}_name`;
                nameInput.className = 'form-control my-2';
                nameInput.placeholder = 'Enter Amenity Name';
                wrapper.appendChild(nameInput);

                if (existing) {
                    nameInput.value = existing.name || '';

                    if (existing.icon && existing.icon.trim() !== '') {
                        const cleanedIcon = existing.icon.trim()
                            .replace(/\s+/g, ' ')
                            .replace(/^\s*<svg/, '<svg')
                            .replace(/<\/svg>\s*$/, '</svg>');

                        hiddenIcon.value = cleanedIcon;

                        const allWrappers = iconPicker.querySelectorAll('.icon-wrapper');
                        allWrappers.forEach(w => {
                            const svg = w.querySelector('svg');
                            const img = w.querySelector('img');
                            if (svg) {
                                const svgHtml = svg.outerHTML.trim().replace(/\s+/g, ' ');
                                if (cleanedIcon === svgHtml || cleanedIcon.includes(`data-lucide="${svg.getAttribute('data-lucide')}"`)) {
                                    w.classList.add('border-success');
                                }
                            } else if (img && cleanedIcon.includes(img.src)) {
                                w.classList.add('border-success');
                            }
                        });
                    }
                }

                container.appendChild(wrapper);
                lucide.createIcons();
            }

            document.getElementById('addAmenityBtn').addEventListener('click', () => createAmenityInput());

            const existingAmenities = @json($amenities ?? []);
            existingAmenities.forEach(item => createAmenityInput(item));

            if (existingAmenities.length === 0) {
                createAmenityInput();
            }
        });
    </script>
@endpush