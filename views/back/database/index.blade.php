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
				            <h1>Database</h1>
				            @include('back.common.breadcrumb')
                    	</div>
	                    <div class="content body">
		                    <div class="row">
		                    	<div class="col-md-10">
			                        @if($relation == false)
			                            <a href="{{ route('relation.create')}}">Créer la table relation dans la base de donnée</a>
			                        @endif
			                    </div>
		                    </div>
		    			</div>
	    			</div>
    			</div>
	        </div>
	    </div>
	</div>
@endsection