@extends('common.main')

@section('head')
{{ HTML::script('js/datetime.js') }}
@stop

@section('content')

<h1>Some text and stuff</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, ea, dolorum nostrum libero dolore fuga deleniti labore quis possimus temporibus asperiores corporis consectetur quam quos impedit pariatur perferendis dicta rem nulla aperiam numquam accusantium doloribus eligendi totam cumque hic sapiente laborum obcaecati soluta quaerat modi id eaque aliquid. Animi, veniam.</p>
<input type="text" id="i1" class="testinput" value="{{ date('Y-m-d H:i:s' ,strtotime('now')) }}">
<h2>Some More Text</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, nemo, saepe, suscipit cupiditate officiis sunt quod sint dignissimos numquam repellendus nulla vel aut assumenda nesciunt eligendi. Quam, ut ducimus odit minima voluptas deleniti repudiandae mollitia architecto. Amet, blanditiis, at nulla ex doloribus odio recusandae quam doloremque voluptates porro ab consectetur tenetur earum odit exercitationem nihil sed assumenda voluptatem fugiat non ea. Id, nemo, deserunt totam praesentium quo animi nobis asperiores debitis corporis dignissimos? Ducimus, temporibus, deleniti minus fuga quos minima sed dolores suscipit accusantium dolorem facere animi qui magni est soluta architecto consectetur dignissimos totam! Quaerat dicta facilis eum culpa!</p>
<input type="text" id="i2" class="testinput" value="{{ date('Y-m-d H:i:s' ,strtotime('now')) }}">

<script>
$(document).ready(function(){

	$('.testinput').each(function(){
		$(this).datetime();
	});	

});
</script>


@stop

