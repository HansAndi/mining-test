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
                    <form action="{{ isset($reservation) ? route('reservations.update', $reservation->id) : route('reservations.store') }}" method="POST">
                        @csrf
                        @isset($reservation)
                            @method('PUT')
                        @endisset

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <select class="form-control select2 @error('user_id') is-invalid @enderror"
                                            name="user_id" @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                            <option value="">Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" @if(isset($reservation) && $employee->id == $reservation->user_id) selected @endif>{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                        </select>
                                        @error('user_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                            name="start_date"
                                            value="{{ isset($reservation) ? $reservation->start_date : old('start_date') }}"
                                            @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                        @error('start_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Vehicle</label>
                                        <select class="form-control select2 @error('vehicle_id') is-invalid @enderror"
                                            name="vehicle_id" @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                            <option value="">Select Vehicle</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}" @if(isset($reservation) && $vehicle->id == $reservation->vehicle_id) selected @endif>{{ $vehicle->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Location</label>
                                        <select class="form-control select2 @error('location_id') is-invalid @enderror"
                                            name="location_id" @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                            <option value="">Select Location</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}" @if(isset($reservation) && $location->id == $reservation->location_id) selected @endif>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('location_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Return</label>
                                        <select class="form-control select2 @error('is_returned') is-invalid @enderror"
                                            name="is_returned" @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                            <option value="">Select Return</option>
                                            <option value="1" @if(isset($reservation) && $reservation->is_returned == 1) selected @endif>Yes</option>
                                            <option value="0" @if(isset($reservation) && $reservation->is_returned == 0) selected @endif>No</option>
                                            {{-- @foreach ($locations as $location)
                                                <option value="{{ $location->id }}" @if(isset($reservation) && $location->id == $reservation->is_returned) selected @endif>{{ $location->name }}</option>
                                            @endforeach --}}
                                        </select>
                                        @error('is_returned')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Fuel Usage</label>
                                        <input type="numeric" class="form-control @error('fuel_usage') is-invalid @enderror"
                                            name="fuel_usage"
                                            value="{{ isset($reservation) ? $reservation->fuel_usage : old('fuel_usage') }}"
                                            @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                        @error('fuel_usage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Driver</label>
                                        <select class="form-control select2 @error('driver_id') is-invalid @enderror"
                                            name="driver_id" @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                            <option value="">Select Driver</option>
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}" @if(isset($reservation) && $driver->id == $reservation->driver_id) selected @endif>{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('driver_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                            name="end_date"
                                            value="{{ isset($reservation) ? $reservation->end_date : old('end_date') }}"
                                            @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                        @error('end_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Leader</label>
                                        <select class="form-control select2 @error('leader_id') is-invalid @enderror"
                                            name="leader_id" @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                            <option value="">Select Leader</option>
                                            @foreach ($leaders as $leader)
                                                <option value="{{ $leader->id }}" @if(isset($reservation) && $leader->id == $reservation->leader_id) selected @endif>{{ $leader->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('leader_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Admin Approve</label>
                                        <select class="form-control select2 @error('admin_approved') is-invalid @enderror"
                                            name="admin_approved" @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                            <option value="">Select Approval</option>
                                            @foreach ($approvals as $approval)
                                                <option value="{{ $approval->value }}" @if(isset($reservation) && $approval->value == $reservation->admin_approved) selected @endif>{{ $approval->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('admin_approved')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Leader Approve</label>
                                        <select class="form-control select2 @error('leader_approved') is-invalid @enderror"
                                            name="leader_approved" @if(auth()->user()->role_id != \App\Enums\Role::Leader->value) disabled @endif>
                                            <option value="">Select Approval</option>
                                            @foreach ($approvals as $approval)
                                                <option value="{{ $approval->value }}" @if(isset($reservation) && $approval->value == $reservation->leader_approved) selected @endif>{{ $approval->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('leader_approved')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                            name="start_date"
                                            value="{{ isset($reservation) ? $reservation->start_date : old('start_date') }}"
                                            @if(auth()->user()->role_id != \App\Enums\Role::Admin->value) disabled @endif>
                                        @error('start_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> --}}
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
