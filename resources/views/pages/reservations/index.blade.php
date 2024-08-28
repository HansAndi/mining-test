<x-app-layout>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Reservations</h1>
                <div class="section-header-button">
                    <a href="{{ route('reservations.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Reservations</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Reservations</h4>
                                <div class="card-header-action">
                                    <a class="btn btn-primary" href="{{ route('reservations.export') }}">Export</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table id="table" class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Employee</th>
                                                <th>Location</th>
                                                <th>Vehicle</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('reservations.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'vehicle',
                        name: 'vehicle'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });
    </script>
</x-app-layout>
