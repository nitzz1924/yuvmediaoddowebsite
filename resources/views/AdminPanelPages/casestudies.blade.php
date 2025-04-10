{{----------------------------------------------------🔱🙏HAR HAR MAHADEV🔱🙏----------------------------------------------------}}
@section('title', 'All Case Studies')
<x-app-layout>
    <div class="container-fluid">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <h4 class="fw-semibold mb-8">@yield('title')- ({{$casecnt}})</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">@yield('title')</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-2 d-flex justify-content-end align-items-center">
                        <div class="">
                            <a href="{{ route('admin.addcasestudy') }}" class="btn btn-outline-primary">
                                <i class="ti ti-plus"></i> Add New Case Study
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="">
                <div class="p-4">
                    <table id="file_export" class="table table-hover table-bordered display text-nowrap py-3">
                        <thead>
                            <tr>
                                <th>SNo.</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach ($cases as $index => $data)
                            <tr>
                                <td>{{  $index + 1}}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-6">
                                        <img src="{{asset('assets/images/CaseStudies/'.$data->caseimage)}}" width="45" class="rounded">
                                    </div>
                                </td>
                                <td>{{ Str::limit( $data->title,20)}}</td>
                                <td>{{ $data->category}}</td>
                                <td>{{ $data->created_at->format('d M Y | h:i A')}}</td>
                                <td>
                                    <div class="hstack gap-3 flex-wrap">
                                        <a href="{{ route('admin.editcasestudy',['id' => $data->id]) }}" class="link-dark fs-6" data-bs-toggle="tooltip" title="Edit">
                                        <i class="ti ti-edit"></i>
                                        </a>
                                        <button data-bs-toggle="tooltip" title="Delete" onclick="confirmDelete('{{ $data->id }}')" class="link-danger  fs-6"><i class="ti ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                    title: "Are you sure?"
                    , html: "You want to delete ?"
                    , icon: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: "#222222"
                    , cancelButtonColor: "#d33"
                    , confirmButtonText: "Yes, delete it!"
                    , cancelButtonText: "Cancel"
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/admin/deletecase/" + id;
                    }
                });
        }
    </script>
</x-app-layout>
