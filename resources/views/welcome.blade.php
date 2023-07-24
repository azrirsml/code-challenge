<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Styles -->

</head>

<body class="h-100 mt-3">
    <div class="container">
        <div class="card mt-10">
            <div class="card-body">
                <h5 class="fw-bold">
                    Upload from file
                </h5>
                <a class="link-secondary" href="{{ route('download_template', ['file' => 'template.xlsx']) }}">
                    <u>Download Excel Template</u>
                </a>

                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5 mt-3">
                        <label>Students<span class="text-danger">*</span></label>
                        <input class="form-control mt-1" name="students" type="file" accept=".xlsx, .xls, .csv" />
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 my-2">
                            <button class="btn w-100 btn-outline-primary rounded-pill" type="submit">UPLOAD</button>
                        </div>
                        <div class="col-md-6 my-2">
                            <button class="btn w-100 btn-outline-danger rounded-pill" id="resetButton" type="reset">CANCEL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table-striped table-responsive table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Level</th>
                            <th>Parent's Contact</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ ucwords($student->name) }}</td>
                                <td>{{ ucwords($student->class) }}</td>
                                <td>{{ $student->level }}</td>
                                <td>{{ $student->parent_contact }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $students->links() }}
            </div>
        </div>
    </div>
</body>

<script>
    document.getElementById('resetButton').addEventListener('click', function() {
        console.log('reload to remove validation errors message')
        window.location.reload();
    });
</script>

</html>
