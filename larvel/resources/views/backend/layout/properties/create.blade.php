@extends('backend.app')

@section('title', 'Create Property')

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
                <h3 class="card-title">Create Property</h3>
            </div>
            <div class="card-body">
                <form class="form" method="POST" id="propertyForm" enctype="multipart/form-data"
                    action="{{ route('admin.property.store') }}">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Property Title"
                                    value="{{ old('title') }}">
                                <div class="text-danger" id="titleError"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" name="location" class="form-control" placeholder="Enter Location"
                                    value="{{ old('location') }}">
                                <div class="text-danger" id="locationError"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Rent Price ($):</label>
                                <input type="number" name="price" class="form-control" placeholder="Enter Rent Price"
                                    value="{{ old('price') }}">
                                <div class="text-danger" id="priceError"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apartment_type">Apartment Type:</label>
                                <select name="apartment_type" class="form-control" id="apartment_type">
                                    <option value="">Select Type</option>
                                    <option value="rent">For Rent</option>
                                    <option value="lease">For Lease</option>
                                </select>
                                <div class="text-danger" id="apartment_typeError"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="city">City Name:</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter City"
                                    value="{{ old('city') }}">
                                <div class="text-danger" id="cityError"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="land_size">Land Size (m²):</label>
                                <input type="number" name="land_size" class="form-control" placeholder="Enter Land Size"
                                    value="{{ old('land_size') }}">
                                <div class="text-danger" id="land_sizeError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="floor_size">Floor Size (m²):</label>
                                <input type="number" name="floor_size" class="form-control" placeholder="Enter Floor Size"
                                    value="{{ old('floor_size') }}">
                                <div class="text-danger" id="floor_sizeError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="bedrooms">Bedrooms:</label>
                                <input type="number" name="bedrooms" class="form-control" placeholder="Enter Bedrooms"
                                    value="{{ old('bedrooms') }}">
                                <div class="text-danger" id="bedroomsError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="bathrooms">Bathrooms:</label>
                                <input type="number" name="bathrooms" class="form-control" placeholder="Enter Bathrooms"
                                    value="{{ old('bathrooms') }}">
                                <div class="text-danger" id="bathroomsError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="garages">Garages:</label>
                                <input type="number" name="garages" class="form-control" placeholder="Enter Garages"
                                    value="{{ old('garages') }}">
                                <div class="text-danger" id="garagesError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="open_spaces">Open Spaces:</label>
                                <input type="number" name="open_spaces" class="form-control" placeholder="Enter Open Spaces"
                                    value="{{ old('open_spaces') }}">
                                <div class="text-danger" id="open_spacesError"></div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="establishment_year">Establishment Year:</label>
                                <input type="text" name="establishment_year" class="form-control"
                                    placeholder="Enter Establishment Year" value="{{ old('establishment_year') }}">
                                <div class="text-danger" id="establishment_yearError"></div>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" rows="10"
                                class="form-control">{{ old('description') }}</textarea>
                            <div class="text-danger" id="descriptionError"></div>
                        </div>

                        <div class="col-md-4 my-2">
                            <h4>Core Amenities</h4>
                            <div class="ms-2 d-flex flex-wrap" id="coreAmenitiesContainer"></div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary mt-2" id="addAmenityBtn">+</button>
                            </div>
                        </div>

                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">

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
                                <input type="file" name="thumbnail" class="dropify" />
                            </div>

                            <div class="col-md-4 mt-3">
                                <h4 class="mb-3">Images <span>(Multiple)</span></h4>
                                <input type="file" id="file-input" name="images[]" class="form-control" multiple />
                                <div class="text-danger" id="imagesError"></div>
                                <div id="image-previews" class="d-flex flex-wrap mt-3"></div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label>Floor Plan Ground</label>
                                <input type="file" name="ground_plan" class="dropify" />
                            </div>

                            <div class="col-md-4">
                                <label>Floor Plan First</label>
                                <input type="file" name="first_plan" class="dropify" />
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
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        $('.dropify').dropify();

        const fileInput = document.getElementById('file-input');
        const previewsContainer = document.getElementById('image-previews');

        fileInput.addEventListener('change', function (e) {
            previewsContainer.innerHTML = '';
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
                    wrapper.querySelector('.remove-image-btn').addEventListener('click', () => wrapper.remove());
                    previewsContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        });

        ClassicEditor.create(document.getElementById('description'))
            .catch(err => console.error(err));

        document.addEventListener("DOMContentLoaded", () => {
            const map = L.map('map').setView([23.8103, 90.4125], 10); // Default Dhaka

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            map.on("click", function (e) {
                document.getElementById("latitude").value = e.latlng.lat;
                document.getElementById("longitude").value = e.latlng.lng;
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

                container.appendChild(wrapper);
                lucide.createIcons();
            }

            document.getElementById('addAmenityBtn').addEventListener('click', () => createAmenityInput());

            createAmenityInput();
        });
    </script>

    <script>
        $('#propertyForm').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.property.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        window.location.href = "{{ route('admin.property.index') }}";
                    } else {
                        if (response.code && response.code == 422) {
                            toastr['error'](response.message);
                            $.each(response.errors, function (key, value) {
                                $(`input[name=${key}]`).addClass('is-invalid');
                                $(`#${key}Error`).text(value);
                            });
                        } else {
                            toastr['error'](response.message);
                        }
                    }
                },
                error: function () {
                    toastr['error']('Something went wrong!');
                }
            });
        });
    </script>
@endpush