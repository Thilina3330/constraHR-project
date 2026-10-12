@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success" role="alert">
{{session('success')}}
</div>
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Site</h5>
            <form action="/store_site" method='post'>
                @csrf
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="site name" class="mb-1">Site name</label>
                            <input type="text" name='site_name' class="form-control @error('site_name') is-invalid @enderror" placeholder="enter site name">
                            @error('site_name') 
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                             @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Start Date" class="mb-1">Start Date</label>
                            <input type="date" name='start_date' class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="End Date" class="mb-1">End date</label>
                            <input type="Date"  name='end_date' class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Location" class="mb-1">Location</label>
                            <input type="text"  name='location' placeholder="Enter your location" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Select Site Engineer" class="mb-1">Select Site Engineer</label>
                            <select class="form-control"  name='site_engineer_id'>
                                <option value="" selected disabled>Select Engineer</option>
                                <option value="1">Amal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center">
                            <button type="submit" class='btn btn-warning'>Cereat site</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection