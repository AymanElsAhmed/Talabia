@extends('admin.layouts.master')
@section('css')
    @toastr_css
@section('title')
    طلبية - العملاء
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> عرض جميع العملاء</h4>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <!-- add Grade -->

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- end errors -->


                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    اضافة عميل
                </button>
                <br><br>

                @if ($clients->count() == 0)
                    <div class="text-center col col-md-12">

                        {{ __('لا يوجد عملاء ') }}

                    </div>
                @else
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>العنوان</th>
                                    <th>رقم التليفون</th>
                                    <th>التاجر</th>
                                    <th>الإجراء</th>
                                </tr>
                            </thead>
                @endif
                <tbody>


                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->adress }}</td>
                            <td>0{{ $client->phone_number }}</td>
                            <td>{{ $client->user->name }}</td>

                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#edit{{ $client->id }}" title="edit"><i
                                        class="fa fa-edit"></i></button>


                                <a class="btn btn-danger" href="{{ route('admin.clients.destroy', $client->id) }}"
                                    onclick="event.preventDefault();
                document.getElementById('client-delete{{ $client->id }}').submit();">
                                    <i class="fa fa-trash"></i>
                                </a>

                                <form id="client-delete{{ $client->id }}"
                                    action="{{ route('admin.clients.destroy', $client->id) }}" method="POST"
                                    class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        <!-- edit modal Grade -->
                        <div class="modal fade" id="edit{{ $client->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('admin.clients.update', $client->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo' , sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                تعديل
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>


                                        </div>
                                        <div class="modal-body">
                                            <!-- edit form   here -->
                                            <div class="col-12">
                                                <label for="name"
                                                    class="form-label text-primary">{{ __('الاسم') }}</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name" name="name" placeholder="برجاء ادخال الاسم"
                                                    value="{{ old('name', $client->name) }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="col-12">
                                                <label for="adress"
                                                    class="form-label text-primary">{{ __('العنوان') }}</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="adress" name="adress" placeholder="برجاء ادخال العنوان"
                                                    value="{{ old('adress', $client->adress) }}">
                                                @error('adress')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="col-12">
                                                <label for="phone_number"
                                                    class="form-label text-primary">{{ __('المحمول') }}</label>
                                                <input type="text"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    id="phone_number" name="phone_number"
                                                    placeholder="برجاء ادخال رقم المحمول"
                                                    value="{{ old('phone_number', '0' . $client->phone_number) }}">
                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 my-3">
                                                <label for="vendor_id"
                                                    class="form-label text-primary">{{ __('التاجر') }}</label>
                                                <select name="user_id" id="vendor_id"
                                                    class="form-control form-select py-2">
                                                    {{-- <option value="0">{{ __('Choose Product') }}</option> --}}
                                                    @foreach ($users as $user)
                                                        <option value="{{ old('user_id', $user->id) }}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- @error('product_id')
            <div class="aler alert-danger p-2 mt-1 rounded-1">{{ $message }}</div>
        @enderror --}}
                                            </div>


                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">اغلاق</button>

                                            <button type="submit" class="btn btn-success">حفظ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </table>
            </div>
            <div class="float-right">{{ $clients->links() }}</div>
        </div>

    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form class="row g-3" method="POST" action="{{ route('admin.clients.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo' , sans-serif;" class="modal-title" id="exampleModalLabel">
                        اضافة عميل
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row container">
                        <div class="col-12">
                            <label for="name" class="form-label text-primary">{{ __('الاسم') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="برجاء ادخال الاسم">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="adress" class="form-label text-primary">{{ __('العنوان') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="adress" name="adress" placeholder="برجاء ادخال العنوان">
                            @error('adress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="phone_number" class="form-label text-primary">{{ __('المحمول') }}</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                id="phone_number" name="phone_number" placeholder="برجاء ادخال رقم المحمول">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 my-3">
                            <label for="vendor_id" class="form-label text-primary">{{ __('التاجر') }}</label>
                            <select name="user_id" id="vendor_id" class="form-control form-select py-2">
                                {{-- <option value="0">{{ __('Choose Product') }}</option> --}}
                                @foreach ($users as $user)
                                    <option value="{{ old('user_id', $user->id) }}">{{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- @error('product_id')
                    <div class="aler alert-danger p-2 mt-1 rounded-1">{{ $message }}</div>
                @enderror --}}
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>

                    <button type="submit" class="btn btn-success">حفظ</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- finished -->
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
