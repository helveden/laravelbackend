@extends('back.layout')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @include('back.common.header')
                </div>
                <div class="row">
                    <aside class="main-sidebar">
                        @include('back.common.menu')
                    </aside>
                    <div class="content-wrapper">
                        <div class="content-header">
                            <h1>Table</h1>
                            @include('back.common.breadcrumb')
                        </div>
                        <div class="content body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if(!empty($tables))
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Liste</div>
                                                <div class="panel-body">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <td>Nom</td>
                                                                <td></td>
                                                                <td style="width:10%;">Actions</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($tables as $table)
                                                            @continue( $table->Tables_in_laravel_voyager == 'migrations' )
                                                            @continue( $table->Tables_in_laravel_voyager == 'password_resets' )
                                                            {{-- @continue( $table->Tables_in_laravel_voyager == 'relation' ) --}}
                                                            {{-- @continue( $table->Tables_in_laravel_voyager == 'users' ) --}}
                                                            {{-- {{ route('table', $table->Tables_in_laravel_voyager) }} --}}
                                                            <tr>
                                                                <td><a href="{{ route('table') }}/{{ $table->Tables_in_laravel_voyager }}" class="">{{ $table->Tables_in_laravel_voyager }}</a></td>
                                                                <td></td>
                                                                <td><a href="{{ route('table') }}/{{ $table->Tables_in_laravel_voyager }}/deleteTable" class=""><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h2>Nouvelle table</h2>
                                    <form action="{{ route('table') }}/createTable" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="text" name="table" class="form-control" placeholder="Créer une nouvelle table">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection