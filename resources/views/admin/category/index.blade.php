@extends('layouts.admin')
@section('title', 'Quản lý danh mục')
@section('content')

<div class="box-body table-responsive no-padding">
  <table class="table table-hover">
    <tbody>
    <tr>
      <th>ID</th>
      <th>Tên danh mục</th>
      <th>Danh mục cha</th>
      <th></th>
    </tr>
    @foreach ($cates as $element)
    	<tr>
	      <td>{{$element->id}}</td>
	      <td>{{$element->name}}</td>
	      <td>{{$element->parent_id}}</td>
	      <td>
	      	<a href="#" class="btn btn-info btn-xs">
	      		<i class="fa fa-pencil"></i> Update
	      	</a>
	      	<a href="#" class="btn btn-danger btn-xs">
	      		<i class="fa fa-remove"></i> Remove
	      	</a>
	      </td>
	    </tr>
    @endforeach
  </tbody>
  </table>
</div>
@endsection