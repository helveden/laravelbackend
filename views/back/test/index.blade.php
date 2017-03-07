@extends('back.layout')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @include('back.common.menu')
                    <div class="col-md-10">
                        <h1>Back</h1>
                        @include('back.common.breadcrumb')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
