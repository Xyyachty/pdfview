<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Message Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Flash Message Demo</h1>
        
        @include('flash-message')
        
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Test Flash Messages</h5>
                    </div>
                    <div class="card-body">
                        <p>Click the buttons below to test different types of flash messages:</p>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('test.success') }}" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle"></i> Test Success Message
                            </a>
                            <a href="{{ route('test.error') }}" class="btn btn-danger btn-lg">
                                <i class="bi bi-x-circle"></i> Test Error Message
                            </a>
                            <a href="{{ route('test.warning') }}" class="btn btn-warning btn-lg">
                                <i class="bi bi-exclamation-triangle"></i> Test Warning Message
                            </a>
                            <a href="{{ route('test.info') }}" class="btn btn-info btn-lg">
                                <i class="bi bi-info-circle"></i> Test Info Message
                            </a>
                        </div>

                        <hr class="my-4">
                        
                        <div class="text-center">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                Go to Student Information System
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
