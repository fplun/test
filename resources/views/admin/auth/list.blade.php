<table>
<tr>
<td>标题</td>
<td>uri</td>
<td>order</td>
</tr>
@foreach ($auth as $v)

<tr>
<td>{{$v->title}}</td>
<td>{{$v->uri}}</td>
<td>{{$v->order}}</td>
</tr>

@endforeach
</table>



<form action="/admin/auth_add" method="post" >
		{{ csrf_field() }}
标题<input type="text" name="title">
<br/>
uri<input type="text" name="uri">
<br/>
<input type="submit">
</form>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif