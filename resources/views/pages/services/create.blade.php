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
                    <div class="breadcrumb-item">Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product</h2>
                <div class="card">
                    <form action="{{ isset($vehicleService) ? route('vehicle-service.update', $vehicleService->id) : route('vehicle-service.store') }}" method="POST">
                        @csrf
                        @isset($vehicleService)
                            @method('PUT')
                        @endisset
                        <div class="card-body">
                            <div class="form-group">
                                <label>Vehicle</label>
                                <select class="form-control select2 @error('vehicle_id') is-invalid @enderror"
                                    name="vehicle_id">
                                    <option value="">Select Vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" @if(isset($vehicleService) && $vehicle->id == $vehicleService->vehicle_id) selected @endif>{{ $vehicle->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Service Date</label>
                                <input type="date" class="form-control @error('service_date') is-invalid @enderror"
                                    name="service_date"
                                    value="{{ isset($vehicleService) ? $vehicleService->service_date : old('service_date') }}">
                                @error('service_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </form>
                </div>
        </section>
    </div>
</x-app-layout>
