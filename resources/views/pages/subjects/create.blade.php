@extends('layouts.app')

@section('title', 'Create User')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Advanced Forms</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">{{$type_menu}}</a></div>
                <div class="breadcrumb-item"><a href="{{route('subject.create')}}">{{$type_detail}}</a></div>
                
            </div>
        </div>

        @include('components.alerts.alert-success')

        <div class="section-body">

            <form action="{{route('subject.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h4>Input Subject</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Subject Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>SKS </label>
                                    <div class="form-group">
                                        
                                        <select class="form-control @error('sks') is-invalid @enderror" name="sks" >
                                            <option value="">Please Select</option>
                                            <option value="1" {{ old('sks') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('sks') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('sks') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('sks') == '4' ? 'selected' : '' }}>4</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label>Tahun Ajaran </label>
                                    <div class="form-group">
                                        
                                        <select class="form-control @error('academic_year') is-invalid @enderror" name="sks" >
                                            <option value="">Please Select</option>
                                            <option value="1" {{ old('academic_year') == '2022/2023' ? 'selected' : '' }}>2022/2023</option>
                                            <option value="2" {{ old('academic_year') == '2023/2024' ? 'selected' : '' }}>2023/2024</option>
                                            <option value="3" {{ old('academic_year') == '2024/2025' ? 'selected' : '' }}>2024/2025</option>
                                            <option value="4" {{ old('academic_year') == '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                {{-- 
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                                </div>

                                --}}

                                <div class="form-group">
                                    <label>Lecturer Name</label>
                                    <select class="form-control select2" id="lecturer_option"
                                        multiple="">
                                        {{-- <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                        <option>Option 6</option> --}}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Semester</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="roles" value="ganjil" class="selectgroup-input" checked="">
                                            <span class="selectgroup-button">Ganjil</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="roles" value="genap" class="selectgroup-input">
                                            <span class="selectgroup-button">Genap</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <label>
                                        Address
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" data-height="150" required="" style="height: 150px;" name="address">
                                    {{old('address')}}</textarea>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
<script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush

@push('scripts')
<script>
     $(document).ready(function(){
        console.log('tes')
        
        $('.select2').select2({
            minimumInputLength:2,
            placeholder:'Select Lecturers',
            ajax:{
                url:"/lecturer-option",
                dataType:'json',
                data: (params) => {
            let query = {
                search: params.term,
                page: params.page || 1,
            };
            return query;
        },
                processResults:data=>{
                    
                    return {
                        results:data.map(res=>{
                            return {text:res.name,id:res.id}
                        })
                    }
                }
            }
        })
     })
</script>
@endpush