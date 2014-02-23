@extends('common.main')

@section('content')

<h1>{{ $customer->name }}</h1>
<p><strong>Customer Record</strong></p>
<p><strong>E-mail: </strong>{{ $customer->email }}</p>
<p><strong>Phone No: </strong>{{ $customer->phone }}</p>
<p><strong>ID: </strong>{{ $customer->id }}</p>

<p></p>
<p>{{ link_to("customers/{$customer->id}/edit", 'Edit Customer') }}</p>
<p></p>
{{ Form::open( array('method' => 'DELETE', 'route' => array('customers.destroy', $customer->id ) ) ) }}
	{{ Form::submit('Delete Customer') }}
{{ Form::close() }}

@stop