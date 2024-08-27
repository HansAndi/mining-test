<x-app-layout>



    <div class="main-content">
        <section class="section">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-header">
                <h1>Vehicles</h1>
                {{-- <div class="section-header-button">
                    <a href="{{ route('products.create') }}"
                        class="btn btn-primary">Add New</a>
                </div> --}}
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
                                {{-- <div class="float-right">
                                    <form method="GET" action="{{ route('products.index') }}">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                placeholder="Search"
                                                name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Owner</th>
                                            <th>Status</th>
                                            <th>Last Used</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            @foreach ($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $vehicle->name }}</td>
                                            <td>{{ $vehicle->type }}</td>
                                            <td>{{ $vehicle->ownership }}</td>
                                            <td>{{ $vehicle->status->name }}</td>
                                            <td>{{ $vehicle->last_used_at }}</td>
                                        </tr>
                                        @endforeach
                                        </tr>
                                    </table>
                                </div>
                                {{-- <div class="float-right">
                                    {{ $products->links() }}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
