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
                    		<h1>Back</h1>
			    			@include('back.common.breadcrumb')
                    	</div>
	    				<div class="content body">
				            
	    				</div>
    				</div>
    			</div>
	        </div>
	    </div>
	</div>
@endsection
