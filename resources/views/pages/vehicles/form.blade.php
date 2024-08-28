<x-app-layout>
    @push('style')
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Vehicles</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Vehicles</h2>
                <div class="card">
                    <form
                        action="{{ isset($vehicle) ? route('vehicles.update', $vehicle->id) : route('vehicles.store') }}"
                        method="POST">
                        @csrf
                        @isset($vehicle)
                            @method('PUT')
                        @endisset

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name"
                                            value="{{ isset($vehicle) ? $vehicle->name : old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control select2 @error('type') is-invalid @enderror"
                                            name="type">
                                            <option value="">Select Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->name }}"
                                                    @if (isset($vehicle) && $type->name == $vehicle->type) selected @endif>
                                                    {{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    @if(request()->routeIs('vehicles.edit'))
                                        <div class="form-group">
                                            <label>Last Used</label>
                                            <input type="date" class="form-control @error('last_used_at') is-invalid @enderror"
                                                name="last_used_at"
                                                value="{{ isset($vehicle) ? $vehicle->last_used_at : old('last_used_at') }}">
                                            @error('last_used_at')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ownership</label>
                                        <select class="form-control select2 @error('ownership') is-invalid @enderror"
                                            name="ownership" @if (auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                            <option value="">Select Driver</option>
                                            @foreach ($owners as $owner)
                                                <option value="{{ $owner->name }}"
                                                    @if (isset($vehicle) && $owner->name == $vehicle->ownership) selected @endif>
                                                    {{ $owner->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ownership')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select
                                            class="form-control select2 @error('status_id') is-invalid @enderror"
                                            name="status_id" @if (auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                            <option value="">Select Status</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->value }}"
                                                    @if (isset($vehicle) && $status->value == $vehicle->status_id) selected @endif>
                                                    {{ $status->status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </form>
                </div>
        </section>
    </div>
</x-app-layout>
