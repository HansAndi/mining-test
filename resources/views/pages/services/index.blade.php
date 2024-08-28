<x-app-layout>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Vehicle Service</h1>
                <div class="section-header-button">
                    {{-- <a class="btn btn-primary" onClick="add()" href="javascript:void(0)"> Add New</a> --}}
                    <a href="{{ route('vehicle-service.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Vehicle Service</a></div>
                    <div class="breadcrumb-item">All Vehicle Service</div>
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
                                <h4>All Vehicle Service</h4>
                            </div>
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table id="table" class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Vehicle</th>
                                                <th>Service Date</th>
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
                ajax: '{{ route('vehicle-service.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'vehicle',
                        name: 'vehicle'
                    },
                    {
                        data: 'service_date',
                        name: 'service_date',
                        searchable: true
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
