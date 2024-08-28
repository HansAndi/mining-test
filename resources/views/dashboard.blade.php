<x-app-layout>
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>User</h4>
                            </div>
                            <div class="card-body">
                                {{ $user }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Vehicle</h4>
                            </div>
                            <div class="card-body">
                                {{ $vehicle }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Location</h4>
                            </div>
                            <div class="card-body">
                                {{ $location }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Reservation</h4>
                            </div>
                            <div class="card-body">
                                {{ $reservation }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Total Konsumsi BBM Per Hari</h2>
                        <canvas id="myChart1"></canvas>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Reservasi Per Hari</h2>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // First Chart
        const ctx1 = document.getElementById('myChart1');
        const riwayatArray1 = @json($konsumsi->toArray());
        const tanggal1 = riwayatArray1.map(data => data.start_date);
        const fuel_usage = riwayatArray1.map(data => data.total_fuel_usage);

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: tanggal1,
                datasets: [{
                    label: 'Konsumsi BBM Perhari',
                    data: fuel_usage,
                    borderWidth: 1,
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 20
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: true
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });

        // second chart
        const ctx = document.getElementById('myChart2');
        const data1 = @json($pemakaian->toArray());
        const tanggal2 = data1.map(data => data.start_date); // Corrected variable name
        const total_reservation = data1.map(data => data.total_reservation);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: tanggal2, // Corrected variable name
                datasets: [{
                    label: 'Total Reservasi', // Updated label
                    data: total_reservation,
                    borderWidth: 1,
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 5
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: true
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }
        });
    </script>
</x-app-layout>
