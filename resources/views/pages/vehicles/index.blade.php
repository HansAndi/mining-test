<x-app-layout>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Vehicle</h1>
                <div class="section-header-button">
                    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Vehicles</a></div>
                    <div class="breadcrumb-item">All Vehicles</div>
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
                                <h4>All Vehicles</h4>
                            </div>
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table id="table" class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Owner</th>
                                                <th>Status</th>
                                                <th>Last Used</th>
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
                ajax: '{{ route('vehicles.index') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'type', name: 'type' },
                    { data: 'ownership', name: 'ownership' },
                    { data: 'status', name: 'status', searchable: true },
                    { data: 'last_used_at', name: 'last_used_at' },
                    { data: 'action', name: 'action' }
                ]
            });
        });
    </script>
</x-app-layout>

