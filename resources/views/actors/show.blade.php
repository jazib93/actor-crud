<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actor Submissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Actor Submissions</h2>
                    <a href="{{ route('actors.index') }}" class="btn btn-primary">Submit New Actor</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($actors->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>First Name</th>
                                            <th>Address</th>
                                            <th>Gender</th>
                                            <th>Height</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($actors as $actor)
                                            <tr>
                                                <td>{{ $actor->first_name }}</td>
                                                <td>{{ $actor->address }}</td>
                                                <td>{{ $actor->gender ?? 'N/A' }}</td>
                                                <td>{{ $actor->height ?? 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">No Actor Submissions Yet</h5>
                            <p class="card-text">Be the first to submit actor information!</p>
                            <a href="{{ route('actors.index') }}" class="btn btn-primary">Submit Actor Information</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
