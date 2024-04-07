@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                <span class="text-danger">{{ $error }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif

<br>
{{ Form::label('name', 'Название:') }}
<br>
{{ Form::text('name') }}
<br><br>
{{ Form::label('body', 'Содержание:') }}
<br>
{{ Form::textarea('body') }}
<br>


