<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- link boots --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    {{-- link css toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .zoomable {
            transition: transform 0.3s ease;
        }

        .zoomable:hover {
            transform: scale(3);
        }
    </style>

</head>

<body>
    <h1 class="text-center mb-4">Data Pegawai</h1>
    <div class="container">
        <a href="/login" type="button" class="btn btn-success">Add +</a>
        <div class="row g-3 align-items-center mt-1">
            <div class="col-auto">
                <form action="/home" method="get">
                    <input type="Search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
                </form>
            </div>
            <div class="col-auto">
                <a href="/exportPdf" type="button" class="btn btn-info">Export to PDF</a>
            </div>
            <div class="col-auto">
                <a href="/exportExcel" type="button" class="btn btn-success">Export to Excel</a>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Import Data
                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="importExcel" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="file" name="file" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Understood</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Age</th>
                        <th scope="col">Adress</th>
                        <th scope="col">Created</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                        <td>{{ $row->name }}</td>
                        <td>
                           <img src="{{ asset('img/'.$row->foto) }}" class="rounded-circle zoomable" style="width: 40px;" alt="">
                        </td>
                        <td>{{ $row->age }}</td>
                        <td>{{ $row->adress }}</td>
                        <td>{{ $row->created_at->format('D M Y')}}</td>
                        <td>
                            <a href="/showData/{{ $row->id }}" class="btn btn-outline-info">Edit</a>
                            <a href="/deleteData/{{ $row->id }}" type="button" class="btn btn-outline-danger delete" data-name="{{ $row->name }}" data-id="{{ $row->id }}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
        {{-- link js --}}

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
<script>
    $('.delete').click(function(event){
    event.preventDefault(); // Prevent the default anchor behavior
    var name = $(this).attr('data-name');
    var id = $(this).attr('data-id');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "Are you sure you want to remove the student " + name + ". You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = '/deleteData/' + id;
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Pooff,  you're almost dead!",
                icon: "error"
            });
        }
    });
});

</script>
<script>
    @if (Session::has('success'))
        toastr["success"]("{{ Session::get('success') }}")
    @endif
</script>

</html>
