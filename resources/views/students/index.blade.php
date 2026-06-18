<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Student Information System</h1>
        
        @include('flash-message')
        
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>{{ isset($student) ? 'Edit Student' : 'Add New Student' }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}" method="POST" novalidate>
                            @csrf
                            @if(isset($student))
                                @method('PUT')
                            @endif
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student ID</label>
                                <input type="text" class="form-control @error('student_id') is-invalid @enderror" 
                                       id="student_id" name="student_id" value="{{ old('student_id', $student->student_id ?? '') }}">
                                @error('student_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                       id="full_name" name="full_name" value="{{ old('full_name', $student->full_name ?? '') }}">
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="course" class="form-label">Course</label>
                                <input type="text" class="form-control @error('course') is-invalid @enderror" 
                                       id="course" name="course" value="{{ old('course', $student->course ?? '') }}">
                                @error('course')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                {{ isset($student) ? 'Update Student' : 'Add Student' }}
                            </button>
                            @if(isset($student))
                                <a href="{{ route('students.index') }}" class="btn btn-secondary w-100 mt-2">Cancel</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5>Student List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Full Name</th>
                                    <th>Course</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $stud)
                                <tr>
                                    <td>{{ $stud->student_id }}</td>
                                    <td>{{ $stud->full_name }}</td>
                                    <td>{{ $stud->course }}</td>
                                    <td>
                                        <a href="{{ route('students.edit', $stud->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('students.destroy', $stud->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No students found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
