<x-app-layout>
    <div class="mt-5 d-flex justify-content-center col-md-12">
        <form action="{{ route('uploadCourseFile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="course_file">Upload Course File:</label>
                <div class="mt-3">
                    <input type="file" name="course_file" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Upload Course</button>
        </form>
    </div> 
    <div class="mt-5 d-flex justify-content-center col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div> 
</x-app-layout>
