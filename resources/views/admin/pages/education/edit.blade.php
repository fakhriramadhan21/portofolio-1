<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Dashboard | Education</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/images/avatar.ico') }}" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="{{ route('education.index') }}"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="{{ route('home.index') }}">
                <img src="{{ asset('assets/images/logo-mctech.png') }}" />
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                @if ($message = Session::get('success'))
                <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

                <script>
                    Toastify({
                        avatar: "{{ asset('assets/images/avatar.ico') }}",
                        text: {
                            !!json_encode($message) !!
                        },
                        duration: 5000,
                        destination: "https://github.com/apvarun/toastify-js",
                        newWindow: true,
                        close: true,
                        gravity: "bottom", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#49b462",
                            color: '#fff',
                        },
                        onClick: function() {} // Callback after click
                    }).showToast();
                </script>
                @endif
                <form action="{{ route('education.update', $education->id) }}" class="form form-vertical" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="institution-name-icon">Institution Name</label>
                                    <div class="position-relative">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Institution Name" id="institution-name-icon" value="{{ $education->name }}"/>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-control-icon">
                                            <i class="bi bi-buildings-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="year-id-icon">Year</label>
                                    <div class="position-relative">
                                        <input type="text" name="year" class="form-control @error('year') is-invalid @enderror" placeholder="Enter Study Year (e.g., 2015-2018)" id="year-id-icon" value="{{ $education->year }}"/>
                                        @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-control-icon">
                                            <i class="bi bi-calendar-date"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="major-id-icon">Major</label>
                                    <div class="position-relative">
                                        <input type="text" name="major" class="form-control @error('major') is-invalid @enderror" placeholder="Enter Major" id="major-id-icon" value="{{ $education->major }}"/>
                                        @error('major')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-check-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="faculty-id-icon">Faculty</label>
                                    <div class="position-relative">
                                        <input type="text" name="faculty" class="form-control @error('faculty') is-invalid @enderror" placeholder="Enter Faculty" value="{{ $education->faculty }}"/>
                                        @error('faculty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description-id-icon">Description</label>
                                    <div class="position-relative">
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ $education->description }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary me-2 mb-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-outline-secondary me-2 mb-1">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>